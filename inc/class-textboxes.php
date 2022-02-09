<?php

namespace HfH\Sprint;

class Textboxes
{
    private static $instance = false;

    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __construct()
    {
        add_filter('admin_head', array($this, 'admin_head'));
        add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_scripts'));
    }

    public function admin_head()
    {
        add_filter("mce_external_plugins", array($this, 'mce_external_plugins'));
        add_filter('mce_buttons', array($this, 'mce_buttons'));
        add_filter('mce_css', array($this, 'mce_css'));
    }

    /**
     * Adds custom css to tinymce
     */
    public function mce_css(string $stylesheets)
    {
        if (!empty($stylesheets)) {
            $stylesheets .= ',';
        }
        $stylesheets .= HFH_SPRINT_URL . 'css/textboxes.css';
        return $stylesheets;
    }

    /**
     * Registers tinymce plugins
     */
    public function mce_external_plugins($plugin_array)
    {
        $plugin_array['hfh-sprint-textboxes'] = HFH_SPRINT_URL . 'js/textboxes.js';
        return $plugin_array;
    }

    /**
     * Adds custom buttons to tinymce
     */
    public function mce_buttons($buttons)
    {
        array_push($buttons, 'hfh-sprint-textboxes');
        return $buttons;
    }

    public function wp_enqueue_scripts()
    {
        wp_enqueue_style('hfh-sprint-textboxes', HFH_SPRINT_URL . 'css/textboxes.css');
    }
}
