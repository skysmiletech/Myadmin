<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Holds the PhpMyAdmin\ThemeGenerator class
 *
 * @package PhpMyAdmin
 */
declare(strict_types=1);

namespace PhpMyAdmin;

use PhpMyAdmin\Sanitize;
use PhpMyAdmin\Template;
use PhpMyAdmin\Theme\Common;
use PhpMyAdmin\Theme\Layout;
use PhpMyAdmin\Theme\Navigation;

/**
 * Set of functions for Automated Theme Generator in phpMyAdmin
 *
 * @package PhpMyAdmin
 */
class ThemeGenerator
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->template = new Template();
    }

    /**
     * Colour Picker HTML file
     *
     * @return string HTML for the color picker tool
     */
    public function colorPicker()
    {
        $output = $this->template->render('theme_generator/color_picker');
        return $output;
    }

    /**
     * File creation form
     *
     * @return string HTML for the form submission
     */
    public function form()
    {
        $output = $this->template->render('theme_generator/form');
        return $output;
    }

    /**
     * Preview panel for Navigation panel
     *
     * @return string HTML for the preview panels
     */
    public function navigationPreview()
    {
        $output = $this->template->render('theme_generator/navigation_preview');
        return $output;
    }

    /**
     * Creates file structure
     *
     * @param array $post POST form data
     *
     * @return array $out generated file data
     */
    public function createFileStructure(array $post)
    {
        $out = array();
        $nav = new Navigation();
        $layout = new Layout();
        $common = new Common();
        $post['theme_name'] = Sanitize::sanitizeFilename($post['theme_name'], true);
        $name = $post['theme_name'];
        if (!is_dir("themes/" . $name)) {
            mkdir("themes/" . $name);
            mkdir("themes/" . $name . "/css");
        }
        $out['json'] = $this->createJsonFile($post);
        $common->createCommonFile($name);
        $out['layout'] = $layout->createLayoutFile($post);
        $nav->createNavigationFile($name);
        return $out;
    }

    /**
     * Creates theme.json
     *
     * @param array $post POST data
     *
     * @return string $txt JSON file data
     */
    public function createJsonFile($post)
    {
        $name = $post['theme_name'];
        $file = fopen("themes/" . $name . "/theme.json", "w");
        $txt = '{';
        $txt .= '"name": "' . $name . '",';
        if ($post['version'] != "") {
            $txt .= '"version": "' . $post['version'] . '",';
        } else {
            $txt .= '"version": "5.0",';
        }
        if ($post['description'] != "") {
            $txt .= '"description": "' . $post['description'] . '",';
        } else {
            $txt .= '"description": "Theme Generated by Automated Theme Generator",';
        }
        if ($post['author'] != "") {
            $txt .= '"author": "' . $post['author'] . '",';
        } else {
            $txt .= '"author": "phpMyAdmin developers",';
        }
        if ($post['url'] != "") {
            $txt .= '"url": "' . $post['url'] . '",';
        } else {
            $txt .= '"url": "https://www.phpmyadmin.net/",';
        }
        $txt .= '"supports": ["5.0"]';
        $txt .= '}';
        fwrite($file, $txt);
        fclose($file);
        return $txt;
    }
}

