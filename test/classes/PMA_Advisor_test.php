<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * tests for Advisor class
 *
 * @package PhpMyAdmin-test
 */

/*
 * Include to test.
 */
require_once 'libraries/Advisor.class.php';
require_once 'libraries/Theme.class.php';
require_once 'libraries/php-gettext/gettext.inc';
require_once 'libraries/url_generating.lib.php';
require_once 'libraries/core.lib.php';

class Advisor_Test extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $_SESSION[' PMA_token '] = 'token';
        $GLOBALS['lang'] = 'en';
        $_SESSION['PMA_Theme'] = PMA_Theme::load('./themes/pmahomme');
        $GLOBALS['server'] = 0;
        $GLOBALS['cfg']['ServerDefault'] = '';
    }

    /**
     * Tests string escaping
     *
     * @param string $text     Text to escape
     * @param string $expected Expected output
     *
     * @return void
     *
     * @dataProvider escapeStrings
     */
    public function testEscape($text, $expected)
    {
        $this->assertEquals(Advisor::escapePercent($text), $expected);
    }

    public function escapeStrings()
    {
        return array(
            array('80%', '80%%'),
            array('%s%', '%s%%'),
            array('80% foo', '80%% foo'),
            array('%s% foo', '%s%% foo'),
            );
    }

    public function testParse()
    {
        $advisor = new Advisor();
        $parseResult = $advisor->parseRulesFile();
        $this->assertEquals($parseResult['errors'], array());
    }
   
    public function testADVISOR_bytime()
    {
        $advisor = new Advisor();
        $result = $advisor->ADVISOR_bytime(10, 2);
        $this->assertEquals("10 per second");
        
        $result = $advisor->ADVISOR_bytime(0.02, 2);
        $this->assertEquals("1.2 per minute");
         
        $result = $advisor->ADVISOR_bytime(0.003, 2);
        $this->assertEquals("10.8 per hour");
    }
 
    public function testADVISOR_timespanFormat()
    {
        $advisor = new Advisor();
        $result = $advisor->ADVISOR_timespanFormat(1200);
        $this->assertEquals("0 days, 0 hours, 20 minutes and 0 seconds");
        
        $result = $advisor->ADVISOR_timespanFormat(100);
        $this->assertEquals("0 days, 0 hours, 1 minutes and 40 seconds");
    }

    /**
     * Test for adding rule
     *
     * @param array  $rule     Rule to test
     * @param array  $expected Expected rendered rulle in fired/errors list
     * @param string $error    Expected error string (null if none error expected)
     *
     * @return void
     *
     * @depends testParse
     * @dataProvider rulesProvider
     */
    public function testAddRule($rule, $expected, $error)
    {
        $advisor = new Advisor();
        $parseResult = $advisor->parseRulesFile();
        $this->assertEquals($parseResult['errors'], array());
        $advisor->variables['value'] = 0;
        $advisor->addRule('fired', $rule);
        if (isset($advisor->runResult['errors']) || !is_null($error)) {
            $this->assertEquals($advisor->runResult['errors'], array($error));
        }
        if (isset($advisor->runResult['fired']) || $expected != array()) {
            $this->assertEquals($advisor->runResult['fired'], array($expected));
        }
    }

    public function rulesProvider()
    {
        return array(
            array(
                array(
                    'justification' => 'foo',
                    'name' => 'Basic',
                    'issue' => 'issue',
                    'recommendation' => 'Recommend'
                ),
                array(
                    'justification' => 'foo',
                    'id' => 'Basic',
                    'name' => 'Basic',
                    'issue' => 'issue',
                    'recommendation' => 'Recommend'
                ),
                null,
            ),
            array(
                array(
                    'justification' => 'foo',
                    'name' => 'Variable',
                    'issue' => 'issue',
                    'recommendation' => 'Recommend {status_var}'
                ),
                array(
                    'justification' => 'foo',
                    'id' => 'Variable',
                    'name' => 'Variable',
                    'issue' => 'issue',
                    'recommendation' => 'Recommend <a href="server_variables.php?lang=en&amp;token=token&filter=status_var">status_var</a>'
                ),
                null,
            ),
            array(
                array(
                    'justification' => '%s foo | value',
                    'name' => 'Format',
                    'issue' => 'issue',
                    'recommendation' => 'Recommend'
                ),
                array(
                    'justification' => '0 foo',
                    'id' => 'Format',
                    'name' => 'Format',
                    'issue' => 'issue',
                    'recommendation' => 'Recommend'
                ),
                null,
            ),
            array(
                array(
                    'justification' => '%s% foo | value',
                    'name' => 'Percent',
                    'issue' => 'issue',
                    'recommendation' => 'Recommend'
                ),
                array(
                    'justification' => '0% foo',
                    'id' => 'Percent',
                    'name' => 'Percent',
                    'issue' => 'issue',
                    'recommendation' => 'Recommend'
                ),
                null,
            ),
            array(
                array(
                    'justification' => '"\'foo',
                    'name' => 'Quotes',
                    'issue' => 'issue',
                    'recommendation' => 'Recommend"\''
                ),
                array(
                    'justification' => '"\'foo',
                    'id' => 'Quotes',
                    'name' => 'Quotes',
                    'issue' => 'issue',
                    'recommendation' => 'Recommend"\''
                ),
                null,
            ),
            array(
                array(
                    'justification' => 'foo | fsafdsa',
                    'name' => 'Failure',
                    'issue' => 'issue',
                    'recommendation' => 'Recommend'
                ),
                array(),
                'Failed formatting string for rule \'Failure\'. PHP threw following error: Use of undefined constant fsafdsa - assumed \'fsafdsa\'',
            ),
            array(
                array(
                    'justification' => 'Version string (%s) | value',
                    'name' => 'Distribution',
                    'issue' => 'official MySQL binaries.',
                    'recommendation' => 'See <a href="http://phpma.org/">web</a>',
                ),
                array(
                    'justification' => 'Version string (0)',
                    'name' => 'Distribution',
                    'issue' => 'official MySQL binaries.',
                    'recommendation' => 'See <a href="./url.php?url=http%3A%2F%2Fphpma.org%2F&amp;lang=en&amp;token=token">web</a>',
                    'id' => 'Distribution'
                ),
                null,
            ),
        );
    }
}
?>
