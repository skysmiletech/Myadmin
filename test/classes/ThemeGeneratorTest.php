<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * tests for ThemeGenerator class
 *
 * @package PhpMyAdmin-test
 */
declare(strict_types=1);

namespace PhpMyAdmin\Tests;

use PhpMyAdmin\ThemeGenerator;
use PhpMyAdmin\Tests\PmaTestCase;

/**
 * Tests for PMA_ThemeGenerator class
 *
 * @package PhpMyAdmin-test
 */
class ThemeGeneratorTest extends PmaTestCase
{
    var $ouput;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $_POST['theme_name'] = 'phpunit';
        $_POST['Navigation_Panel'] = '#ffffff';
        $_POST['Navigation_Hover'] = '#ffffff';
        $_POST['Text_Color'] = '#ffffff';
        $_POST['Background_Color'] = '#ffffff';
        $_POST['Header'] = '#ffffff';
        $_POST['Table_Header_and_Footer'] = '#ffffff';
        $_POST['Table_Header_and_Footer_Background'] = '#ffffff';
        $_POST['Table_Row_Background'] = '#ffffff';
        $_POST['Table_Row_Alternate_Background'] = '#ffffff';
        $_POST['Table_Row_Hover_and_Selected'] = '#ffffff';
        $_POST['Hyperlink_Text'] = '#ffffff';
        $_POST['Group_Background'] = '#ffffff';
        $this->theme = new ThemeGenerator();
        $this->output = $this->theme->createFileStructure($_POST);
        return $_POST;
    }

    /**
     * Test for ThemeGenerator::colorPicker
     *
     * @return void
     */
    public function testColorPicker()
    {
        $output = $this->theme->colorPicker();
        $this->assertContains('<div id="container">' , $output);
        $this->assertContains('<div id="palette" class="block">' , $output);
        $this->assertContains('<div id="color-palette"></div>' , $output);
        $this->assertContains('<div id="picker" class="block">' , $output);
        $this->assertContains('<div class="ui-color-picker" data-topic="picker" data-mode="HSB"></div>' , $output);
        $this->assertContains('<div id="picker-samples" sample-id="master">' , $output);
    }

    /**
     * Test for ThemeGenerator::form
     *
     * @return void
     */
    public function testForm()
    {
        $output = $this->theme->form();
        $this->assertContains('<form action="index.php" method="post" id="save">' , $output);
        $this->assertContains('<select name="type" id="theme">' , $output);
        $this->assertContains('<input type="text" name="theme_name"></input>' , $output);
        $this->assertContains('<input type="submit">' , $output);
    }

    /**
     * Test for ThemeGenerator::createJsonFile
     *
     * @return void
     */
    public function testCreateJsonFile()
    {
        $name = $_POST['theme_name'];
        $this->assertFileIsReadable('themes/' . $name . '/theme.json');
        $this->assertContains('"name": "' . $name . '",' , $this->output['json']);
    }

    public function getLayoutData()
    {
        return $this->output['layout'];
    }

    /**
     * Deletes all the created files
     *
     * @return void
     */
    public function tearDown()
    {
        $name = $_POST['theme_name'];
        unlink('themes/' . $name . '/theme.json');
        unlink('themes/' . $name . '/layout.inc.php');
        unlink('themes/' . $name . '/css/common.css.php');
        unlink('themes/' . $name . '/css/navigation.css.php');
        rmdir('themes/' . $name . '/css');
        rmdir('themes/' . $name);
    }
}
