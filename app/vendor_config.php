<?php
/**
 * File for vendor customization, you can change here paths or some behaviour,
 * which vendors such as Linux distributions might want to change.
 *
 * For changing this file you should know what you are doing. For this reason
 * options here are not part of normal configuration.
 */

declare(strict_types=1);


return [
    /**
     * Path to vendor autoload file. Useful when you want to have vendor dependencies somewhere else.
     */
    'autoloadFile' => ROOT_PATH . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php',

    /**
     * Directory where cache files are stored.
     */
    'tempDir' => '/var/lib/phpmyadmin/tmp/',

    /**
     * Path to changelog file, can be gzip compressed.
     * Useful when you want to have documentation somewhere else, e.g. /usr/share/doc.
     */
    'changeLogFile' => ROOT_PATH . 'ChangeLog',

    /**
     * Path to license file. Useful when you want to have documentation somewhere else, e.g. /usr/share/doc.
     */
    'licenseFile' => ROOT_PATH . 'LICENSE',

    /**
     * Directory where SQL scripts to create/upgrade configuration storage reside.
     */
    'sqlDir' => ROOT_PATH . 'resources' . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR,

    /**
     * Filename of a configuration file.
     */
    'configFile' => '/etc/phpmyadmin/config.inc.php',

    /**
     * Filename of custom header file.
     */
    'customHeaderFile' => ROOT_PATH . 'config.header.inc.php',

    /**
     * Filename of custom footer file.
     */
    'customFooterFile' => ROOT_PATH . 'config.footer.inc.php',

    /**
     * Default value for check for version upgrades.
     */
    'versionCheckDefault' => true,

    /**
     * Path to files with compiled locales (*.mo)
     */
    'localePath' => ROOT_PATH . 'resources' . DIRECTORY_SEPARATOR . 'locale' . DIRECTORY_SEPARATOR,

    /**
     * Define the cache directory for routing cache and other cache files
     */
    'cacheDir' => ROOT_PATH . 'app' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR,

    /**
     * Suffix to add to the phpMyAdmin version
     */
    'versionSuffix' => '',
];
