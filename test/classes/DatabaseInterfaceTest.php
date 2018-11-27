<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Test for faked database access
 *
 * @package PhpMyAdmin-test
 */
declare(strict_types=1);

namespace PhpMyAdmin\Tests;

use PhpMyAdmin\DatabaseInterface;
use PhpMyAdmin\Dbi\DbiDummy;
use PhpMyAdmin\Util;

/**
 * Tests basic functionality of dummy dbi driver
 *
 * @package PhpMyAdmin-test
 */
class DatabaseInterfaceTest extends PmaTestCase
{
    /**
     * @var DatabaseInterface
     */
    private $_dbi;

    /**
     * Configures test parameters.
     *
     * @return void
     */
    protected function setUp()
    {
        $GLOBALS['server'] = 0;
        $extension = new DbiDummy();
        $this->_dbi = new DatabaseInterface($extension);
    }

    /**
     * Tests for DBI::getCurrentUser() method.
     *
     * @param array  $value    value
     * @param string $string   string
     * @param array  $expected expected result
     *
     * @return void
     * @test
     * @dataProvider currentUserData
     */
    public function testGetCurrentUser($value, $string, $expected)
    {
        Util::cacheUnset('mysql_cur_user');

        $extension = new DbiDummy();
        $extension->setResult('SELECT CURRENT_USER();', $value);

        $dbi = new DatabaseInterface($extension);

        $this->assertEquals(
            $expected,
            $dbi->getCurrentUserAndHost()
        );

        $this->assertEquals(
            $string,
            $dbi->getCurrentUser()
        );
    }

    /**
     * Data provider for getCurrentUser() tests.
     *
     * @return array
     */
    public function currentUserData()
    {
        return [
            [[['pma@localhost']], 'pma@localhost', ['pma', 'localhost']],
            [[['@localhost']], '@localhost', ['', 'localhost']],
            [false, '@', ['', '']],
        ];
    }

    /**
     * Tests for DBI::getColumnMapFromSql() method.
     *
     * @return void
     * @test
     */
    public function testPMAGetColumnMap()
    {
        $extension = $this->getMockBuilder('PhpMyAdmin\Dbi\DbiDummy')
            ->disableOriginalConstructor()
            ->getMock();

        $extension->expects($this->any())
            ->method('realQuery')
            ->will($this->returnValue(true));

        $meta1 = new \stdClass();
        $meta1->table = "meta1_table";
        $meta1->name = "meta1_name";

        $meta2 = new \stdClass();
        $meta2->table = "meta2_table";
        $meta2->name = "meta2_name";

        $extension->expects($this->any())
            ->method('getFieldsMeta')
            ->will(
                $this->returnValue(
                    [
                        $meta1, $meta2
                    ]
                )
            );

        $dbi = new DatabaseInterface($extension);

        $sql_query = "PMA_sql_query";
        $view_columns = [
            "view_columns1", "view_columns2"
        ];

        $column_map = $dbi->getColumnMapFromSql(
            $sql_query,
            $view_columns
        );

        $this->assertEquals(
            [
                'table_name' => 'meta1_table',
                'refering_column' => 'meta1_name',
                'real_column' => 'view_columns1'
            ],
            $column_map[0]
        );
        $this->assertEquals(
            [
                'table_name' => 'meta2_table',
                'refering_column' => 'meta2_name',
                'real_column' => 'view_columns2'
            ],
            $column_map[1]
        );
    }

    /**
     * Tests for DBI::getSystemDatabase() method.
     *
     * @return void
     * @test
     */
    public function testGetSystemDatabase()
    {
        $sd = $this->_dbi->getSystemDatabase();
        $this->assertInstanceOf('PhpMyAdmin\SystemDatabase', $sd);
    }

    /**
     * Tests for DBI::postConnectControl() method.
     *
     * @return void
     * @test
     */
    public function testPostConnectControl()
    {
        $GLOBALS['db'] = '';
        $GLOBALS['cfg']['Server']['only_db'] = [];
        $this->_dbi->postConnectControl();
        $this->assertInstanceOf('PhpMyAdmin\Database\DatabaseList', $GLOBALS['dblist']);
    }

    /**
     * Test for getDbCollation
     *
     * @return void
     * @test
     */
    public function testGetDbCollation()
    {
        $GLOBALS['server'] = 1;
        // test case for system schema
        $this->assertEquals(
            'utf8_general_ci',
            $this->_dbi->getDbCollation("information_schema")
        );

        $GLOBALS['cfg']['Server']['DisableIS'] = false;
        $GLOBALS['cfg']['DBG']['sql'] = false;

        $this->assertEquals(
            'utf8_general_ci',
            $this->_dbi->getDbCollation('pma_test')
        );
    }

    /**
     * Test for getServerCollation
     *
     * @return void
     * @test
     */
    public function testGetServerCollation()
    {
        $GLOBALS['server'] = 1;
        $GLOBALS['cfg']['DBG']['sql'] = true;
        $this->assertEquals('utf8_general_ci', $this->_dbi->getServerCollation());
    }

    /**
     * Test for getConnectionParams
     *
     * @param array      $server_cfg Server configuration
     * @param integer    $mode       Mode to test
     * @param array|null $server     Server array to test
     * @param array      $expected   Expected result
     *
     * @return void
     *
     * @dataProvider connectionParams
     */
    public function testGetConnectionParams($server_cfg, $mode, $server, $expected)
    {
        $GLOBALS['cfg']['Server'] = $server_cfg;
        $result = $this->_dbi->getConnectionParams($mode, $server);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for getConnectionParams test
     *
     * @return array
     */
    public function connectionParams()
    {
        $cfg_basic = [
            'user' => 'u',
            'password' => 'pass',
            'host' => '',
            'controluser' => 'u2',
            'controlpass' => 'p2',
        ];
        $cfg_ssl = [
            'user' => 'u',
            'password' => 'pass',
            'host' => '',
            'ssl' => true,
            'controluser' => 'u2',
            'controlpass' => 'p2',
        ];
        $cfg_control_ssl = [
            'user' => 'u',
            'password' => 'pass',
            'host' => '',
            'control_ssl' => true,
            'controluser' => 'u2',
            'controlpass' => 'p2',
        ];
        return [
            [
                $cfg_basic,
                DatabaseInterface::CONNECT_USER,
                null,
                [
                    'u',
                    'pass',
                    [
                        'user' => 'u',
                        'password' => 'pass',
                        'host' => 'localhost',
                        'socket' => null,
                        'port' => 0,
                        'ssl' => false,
                        'compress' => false,
                        'controluser' => 'u2',
                        'controlpass' => 'p2',
                    ]
                ],
            ],
            [
                $cfg_basic,
                DatabaseInterface::CONNECT_CONTROL,
                null,
                [
                    'u2',
                    'p2',
                    [
                        'host' => 'localhost',
                        'socket' => null,
                        'port' => 0,
                        'ssl' => false,
                        'compress' => false,
                    ]
                ],
            ],
            [
                $cfg_ssl,
                DatabaseInterface::CONNECT_USER,
                null,
                [
                    'u',
                    'pass',
                    [
                        'user' => 'u',
                        'password' => 'pass',
                        'host' => 'localhost',
                        'socket' => null,
                        'port' => 0,
                        'ssl' => true,
                        'compress' => false,
                        'controluser' => 'u2',
                        'controlpass' => 'p2',
                    ]
                ],
            ],
            [
                $cfg_ssl,
                DatabaseInterface::CONNECT_CONTROL,
                null,
                [
                    'u2',
                    'p2',
                    [
                        'host' => 'localhost',
                        'socket' => null,
                        'port' => 0,
                        'ssl' => true,
                        'compress' => false,
                    ]
                ],
            ],
            [
                $cfg_control_ssl,
                DatabaseInterface::CONNECT_USER,
                null,
                [
                    'u',
                    'pass',
                    [
                        'user' => 'u',
                        'password' => 'pass',
                        'host' => 'localhost',
                        'socket' => null,
                        'port' => 0,
                        'ssl' => false,
                        'compress' => false,
                        'controluser' => 'u2',
                        'controlpass' => 'p2',
                        'control_ssl' => true,
                    ]
                ],
            ],
            [
                $cfg_control_ssl,
                DatabaseInterface::CONNECT_CONTROL,
                null,
                [
                    'u2',
                    'p2',
                    [
                        'host' => 'localhost',
                        'socket' => null,
                        'port' => 0,
                        'ssl' => true,
                        'compress' => false,
                    ]
                ],
            ],
        ];
    }

    /**
     * Test error formatting
     *
     * @param int    $error_number  Error code
     * @param string $error_message Error message as returned by server
     * @param string $match         Expected text
     *
     * @return void
     *
     * @dataProvider errorData
     */
    public function testFormatError($error_number, $error_message, $match)
    {
        $this->assertContains(
            $match,
            DatabaseInterface::formatError($error_number, $error_message)
        );
    }

    /**
     * @return array
     */
    public function errorData()
    {
        return [
            [2002, 'msg', 'The server is not responding'],
            [2003, 'msg', 'The server is not responding'],
            [1698, 'msg', 'logout.php'],
            [1005, 'msg', 'server_engines.php'],
            [1005, 'errno: 13', 'Please check privileges'],
            [-1, 'error message', 'error message'],
        ];
    }

    /**
     * Tests for DBI::isAmazonRds() method.
     *
     * @param mixed $value    value
     * @param mixed $expected expected result
     *
     * @return void
     * @test
     * @dataProvider isAmazonRdsData
     */
    public function atestIsAmazonRdsData($value, $expected)
    {
        Util::cacheUnset('is_amazon_rds');

        $extension = new DbiDummy();
        $extension->setResult('SELECT @@basedir', $value);

        $dbi = new DatabaseInterface($extension);

        $this->assertEquals(
            $expected,
            $dbi->isAmazonRds()
        );
    }

    /**
     * Data provider for isAmazonRds() tests.
     *
     * @return array
     */
    public function isAmazonRdsData()
    {
        return [
            [[['/usr']], false],
            [[['E:/mysql']], false],
            [[['/rdsdbbin/mysql/']], true],
            [[['/rdsdbbin/mysql-5.7.18/']], true],
        ];
    }

    /**
     * Test for version parsing
     *
     * @param string $version  version to parse
     * @param int    $expected expected numeric version
     * @param int    $major    expected major version
     * @param bool   $upgrade  whether upgrade should ne needed
     *
     * @return void
     *
     * @dataProvider versionData
     */
    public function testVersion($version, $expected, $major, $upgrade)
    {
        $ver_int = DatabaseInterface::versionToInt($version);
        $this->assertEquals($expected, $ver_int);
        $this->assertEquals($major, (int)($ver_int / 10000));
        $this->assertEquals($upgrade, $ver_int < $GLOBALS['cfg']['MysqlMinVersion']['internal']);
    }

    /**
     * @return array
     */
    public function versionData()
    {
        return [
            ['5.0.5', 50005, 5, true],
            ['5.05.01', 50501, 5, false],
            ['5.6.35', 50635, 5, false],
            ['10.1.22-MariaDB-', 100122, 10, false],
        ];
    }

    /**
     * Tests for DBI::setCollationl() method.
     *
     * @return void
     * @test
     */
    public function testSetCollation()
    {
        $extension = $this->getMockBuilder('PhpMyAdmin\Dbi\DbiDummy')
            ->disableOriginalConstructor()
            ->getMock();
        $extension->expects($this->any())->method('escapeString')
            ->will($this->returnArgument(1));

        $extension->expects($this->exactly(4))
            ->method('realQuery')
            ->withConsecutive(
                ["SET collation_connection = 'utf8_czech_ci';"],
                ["SET collation_connection = 'utf8mb4_bin_ci';"],
                ["SET collation_connection = 'utf8_czech_ci';"],
                ["SET collation_connection = 'utf8_bin_ci';"]
            )
            ->willReturnOnConsecutiveCalls(
                true,
                true,
                true,
                true
            );

        $dbi = new DatabaseInterface($extension);

        $GLOBALS['charset_connection'] = 'utf8mb4';
        $dbi->setCollation('utf8_czech_ci');
        $dbi->setCollation('utf8mb4_bin_ci');
        $GLOBALS['charset_connection'] = 'utf8';
        $dbi->setCollation('utf8_czech_ci');
        $dbi->setCollation('utf8mb4_bin_ci');
    }

    /**
     * Tests for DBI::getForeignKeyConstrains() method.
     *
     * @return void
     * @test
     */
    public function testGetForeignKeyConstrains()
    {
        $this->assertEquals([
            [
                'TABLE_NAME' => 'table2',
                'COLUMN_NAME' => 'idtable2',
                'REFERENCED_TABLE_NAME' => 'table1',
                'REFERENCED_COLUMN_NAME' => 'idtable1',
            ]
        ], $this->_dbi->getForeignKeyConstrains('test', ['table1', 'table2']));
    }
}
