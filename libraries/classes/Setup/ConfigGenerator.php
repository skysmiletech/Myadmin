<?php
/**
 * Config file generator
 */

declare(strict_types=1);

namespace PhpMyAdmin\Setup;

use PhpMyAdmin\Config\ConfigFile;
use PhpMyAdmin\Version;

use function array_keys;
use function count;
use function gmdate;
use function implode;
use function is_array;
use function is_string;
use function mb_strlen;
use function preg_replace;
use function sodium_bin2hex;
use function sodium_crypto_secretbox_keygen;
use function sprintf;
use function str_contains;
use function strtr;
use function var_export;

use const DATE_RFC1123;
use const SODIUM_CRYPTO_SECRETBOX_KEYBYTES;

/**
 * Config file generation class
 */
class ConfigGenerator
{
    /**
     * Creates config file
     *
     * @param ConfigFile $cf Config file instance
     */
    public static function getConfigFile(ConfigFile $cf): string
    {
        $eol = isset($_SESSION['eol']) && $_SESSION['eol'] === 'win' ? "\r\n" : "\n";
        $conf = $cf->getConfig();

        // header
        $ret = '<?php' . $eol
            . '/**' . $eol
            . ' * Generated configuration file' . $eol
            . ' * Generated by: phpMyAdmin '
                . Version::VERSION
                . ' setup script' . $eol
            . ' * Date: ' . gmdate(DATE_RFC1123) . $eol
            . ' */' . $eol . $eol;

        //servers
        if (! empty($conf['Servers'])) {
            $ret .= self::getServerPart($cf, $eol, $conf['Servers']);
            unset($conf['Servers']);
        }

        // other settings
        $persistKeys = $cf->getPersistKeysMap();

        foreach ($conf as $k => $v) {
            $k = preg_replace('/[^A-Za-z0-9_]/', '_', (string) $k);
            $ret .= self::getVarExport($k, $v, $eol);
            if (! isset($persistKeys[$k])) {
                continue;
            }

            unset($persistKeys[$k]);
        }

        // keep 1d array keys which are present in $persist_keys (config.values.php)
        foreach (array_keys($persistKeys) as $k) {
            if (str_contains($k, '/')) {
                continue;
            }

            $k = preg_replace('/[^A-Za-z0-9_]/', '_', $k);
            $ret .= self::getVarExport($k, $cf->getDefault($k), $eol);
        }

        return $ret . $eol;
    }

    /**
     * Returns exported configuration variable
     *
     * @param string $var_name  configuration name
     * @param mixed  $var_value configuration value(s)
     * @param string $eol       line ending
     */
    private static function getVarExport($var_name, $var_value, string $eol): string
    {
        if ($var_name === 'blowfish_secret') {
            $secret = self::getBlowfishSecretKey($var_value);

            return sprintf('$cfg[\'blowfish_secret\'] = \sodium_hex2bin(\'%s\');%s', sodium_bin2hex($secret), $eol);
        }

        if (! is_array($var_value) || empty($var_value)) {
            return "\$cfg['" . $var_name . "'] = "
                . var_export($var_value, true) . ';' . $eol;
        }

        if (self::isZeroBasedArray($var_value)) {
            return "\$cfg['" . $var_name . "'] = "
                . self::exportZeroBasedArray($var_value, $eol)
                . ';' . $eol;
        }

        $ret = '';
        // string keys: $cfg[key][subkey] = value
        foreach ($var_value as $k => $v) {
            $k = preg_replace('/[^A-Za-z0-9_]/', '_', $k);
            $ret .= "\$cfg['" . $var_name . "']['" . $k . "'] = "
                . var_export($v, true) . ';' . $eol;
        }

        return $ret;
    }

    /**
     * Check whether $array is a continuous 0-based array
     *
     * @param array $array Array to check
     */
    private static function isZeroBasedArray(array $array): bool
    {
        for ($i = 0, $nb = count($array); $i < $nb; $i++) {
            if (! isset($array[$i])) {
                return false;
            }
        }

        return true;
    }

    /**
     * Exports continuous 0-based array
     *
     * @param array  $array Array to export
     * @param string $eol   Newline string
     */
    private static function exportZeroBasedArray(array $array, string $eol): string
    {
        $retv = [];
        foreach ($array as $v) {
            $retv[] = var_export($v, true);
        }

        $ret = '[';
        if (count($retv) <= 4) {
            // up to 4 values - one line
            return $ret . implode(', ', $retv) . ']';
        }

        // more than 4 values - value per line
        $imax = count($retv);
        for ($i = 0; $i < $imax; $i++) {
            $ret .= ($i > 0 ? ',' : '') . $eol . '    ' . $retv[$i];
        }

        return $ret . ']';
    }

    /**
     * Generate server part of config file
     *
     * @param ConfigFile $cf      Config file
     * @param string     $eol     Carriage return char
     * @param array      $servers Servers list
     */
    protected static function getServerPart(ConfigFile $cf, string $eol, array $servers): string|null
    {
        if ($cf->getServerCount() === 0) {
            return null;
        }

        $ret = '/* Servers configuration */' . $eol . '$i = 0;' . $eol . $eol;
        foreach ($servers as $id => $server) {
            $ret .= '/* Server: '
                . strtr($cf->getServerName($id) . ' [' . $id . '] ', '*/', '-')
                . '*/' . $eol
                . '$i++;' . $eol;
            foreach ($server as $k => $v) {
                $k = preg_replace('/[^A-Za-z0-9_]/', '_', (string) $k);
                $ret .= "\$cfg['Servers'][\$i]['" . $k . "'] = "
                    . (is_array($v) && self::isZeroBasedArray($v)
                        ? self::exportZeroBasedArray($v, $eol)
                        : var_export($v, true))
                    . ';' . $eol;
            }

            $ret .= $eol;
        }

        $ret .= '/* End of servers configuration */' . $eol . $eol;

        return $ret;
    }

    /**
     * @param mixed $key
     *
     * @psalm-return non-empty-string
     */
    private static function getBlowfishSecretKey($key): string
    {
        if (is_string($key) && mb_strlen($key, '8bit') === SODIUM_CRYPTO_SECRETBOX_KEYBYTES) {
            return $key;
        }

        return sodium_crypto_secretbox_keygen();
    }
}
