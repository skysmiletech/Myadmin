<?php

declare(strict_types=1);

namespace PhpMyAdmin\Tests\Command;

use PhpMyAdmin\Command\SetVersionCommand;
use PhpMyAdmin\Tests\AbstractTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use RangeException;
use Symfony\Component\Console\Command\Command;

use function class_exists;
use function sprintf;

#[CoversClass(SetVersionCommand::class)]
class SetVersionCommandTest extends AbstractTestCase
{
    private SetVersionCommand $command;

    protected function setUp(): void
    {
        if (! class_exists(Command::class)) {
            return;
        }

        $this->command = new SetVersionCommand();
    }

    /** @return mixed[][] */
    public static function dataProviderBadVersions(): array
    {
        return [
            [''],
            ['4.9.0.1'],
            ['4.9'],
            ['4-9-0-1'],
            ['4-9-0'],
            ['0-0-0'],
            ['0.0.0'],
            ['1.0.0'],
            ['2.0.0'],
            ['3.0.0'],
            ['4.0.0'],
            ['0.0.-1'],
            ['5.000.0'],
            ['5.0.000'],
            ['5.0.0-'],
            ['5.0.0-foo bar'],
        ];
    }

    #[DataProvider('dataProviderBadVersions')]
    public function testGetGeneratedClassInvalidVersion(string $version): void
    {
        if (! class_exists(Command::class)) {
            self::markTestSkipped('The Symfony Console is missing');
        }

        $this->expectException(RangeException::class);
        $this->expectExceptionMessage('The version number is in the wrong format: ' . $version);
        $this->callFunction(
            $this->command,
            SetVersionCommand::class,
            'getGeneratedClass',
            [$version],
        );
    }

    /** @return mixed[][] */
    public static function dataProviderGoodVersions(): array
    {
        return [
            [
                '5.0.0-rc1',
                '    public const VERSION = \'5.0.0-rc1\' . VERSION_SUFFIX;' . "\n"
                . '    public const SERIES = \'5.0\';' . "\n"
                . '    public const MAJOR = 5;' . "\n"
                . '    public const MINOR = 0;' . "\n"
                . '    public const PATCH = 0;' . "\n"
                . '    public const ID = 50000;' . "\n"
                . '    public const PRE_RELEASE_NAME = \'rc1\';' . "\n"
                . '    public const IS_DEV = false;',
            ],
            [
                '5.0.0-beta',
                '    public const VERSION = \'5.0.0-beta\' . VERSION_SUFFIX;' . "\n"
                . '    public const SERIES = \'5.0\';' . "\n"
                . '    public const MAJOR = 5;' . "\n"
                . '    public const MINOR = 0;' . "\n"
                . '    public const PATCH = 0;' . "\n"
                . '    public const ID = 50000;' . "\n"
                . '    public const PRE_RELEASE_NAME = \'beta\';' . "\n"
                . '    public const IS_DEV = false;',
            ],
            [
                '5.0.0-beta1',
                '    public const VERSION = \'5.0.0-beta1\' . VERSION_SUFFIX;' . "\n"
                . '    public const SERIES = \'5.0\';' . "\n"
                . '    public const MAJOR = 5;' . "\n"
                . '    public const MINOR = 0;' . "\n"
                . '    public const PATCH = 0;' . "\n"
                . '    public const ID = 50000;' . "\n"
                . '    public const PRE_RELEASE_NAME = \'beta1\';' . "\n"
                . '    public const IS_DEV = false;',
            ],
            [
                '5.0.0-alpha',
                '    public const VERSION = \'5.0.0-alpha\' . VERSION_SUFFIX;' . "\n"
                . '    public const SERIES = \'5.0\';' . "\n"
                . '    public const MAJOR = 5;' . "\n"
                . '    public const MINOR = 0;' . "\n"
                . '    public const PATCH = 0;' . "\n"
                . '    public const ID = 50000;' . "\n"
                . '    public const PRE_RELEASE_NAME = \'alpha\';' . "\n"
                . '    public const IS_DEV = false;',
            ],
            [
                '5.0.0-alpha1',
                '    public const VERSION = \'5.0.0-alpha1\' . VERSION_SUFFIX;' . "\n"
                . '    public const SERIES = \'5.0\';' . "\n"
                . '    public const MAJOR = 5;' . "\n"
                . '    public const MINOR = 0;' . "\n"
                . '    public const PATCH = 0;' . "\n"
                . '    public const ID = 50000;' . "\n"
                . '    public const PRE_RELEASE_NAME = \'alpha1\';' . "\n"
                . '    public const IS_DEV = false;',
            ],
            [
                '5.0.0-alpha1',
                '    public const VERSION = \'5.0.0-alpha1\' . VERSION_SUFFIX;' . "\n"
                . '    public const SERIES = \'5.0\';' . "\n"
                . '    public const MAJOR = 5;' . "\n"
                . '    public const MINOR = 0;' . "\n"
                . '    public const PATCH = 0;' . "\n"
                . '    public const ID = 50000;' . "\n"
                . '    public const PRE_RELEASE_NAME = \'alpha1\';' . "\n"
                . '    public const IS_DEV = false;',
            ],
            [
                '5.1.0-dev',
                '    public const VERSION = \'5.1.0-dev\' . VERSION_SUFFIX;' . "\n"
                . '    public const SERIES = \'5.1\';' . "\n"
                . '    public const MAJOR = 5;' . "\n"
                . '    public const MINOR = 1;' . "\n"
                . '    public const PATCH = 0;' . "\n"
                . '    public const ID = 50100;' . "\n"
                . '    public const PRE_RELEASE_NAME = \'dev\';' . "\n"
                . '    public const IS_DEV = true;',
            ],
            [
                '9.99.99-dev',
                '    public const VERSION = \'9.99.99-dev\' . VERSION_SUFFIX;' . "\n"
                . '    public const SERIES = \'9.99\';' . "\n"
                . '    public const MAJOR = 9;' . "\n"
                . '    public const MINOR = 99;' . "\n"
                . '    public const PATCH = 99;' . "\n"
                . '    public const ID = 99999;' . "\n"
                . '    public const PRE_RELEASE_NAME = \'dev\';' . "\n"
                . '    public const IS_DEV = true;',
            ],
        ];
    }

    #[DataProvider('dataProviderGoodVersions')]
    public function testGetGeneratedClassValidVersion(string $version, string $content): void
    {
        if (! class_exists(Command::class)) {
            self::markTestSkipped('The Symfony Console is missing');
        }

        $output = $this->callFunction(
            $this->command,
            SetVersionCommand::class,
            'getGeneratedClass',
            [$version],
        );
        $template = <<<'PHP'
<?php

declare(strict_types=1);

namespace PhpMyAdmin;

use const VERSION_SUFFIX;

/**
 * This class is generated by bin/console.
 *
 * @see \PhpMyAdmin\Command\SetVersionCommand
 * @see \PhpMyAdmin\Config::defineVendorConstants() Defines the VERSION_SUFFIX constant.
 */
final class Version
{
%s
}

PHP;
        self::assertSame(
            sprintf($template, $content),
            $output,
        );
    }
}
