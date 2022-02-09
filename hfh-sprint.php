<?php

/**
 * Plugin Name:     HfH Sprint
 * Description:     Custom functionality for Sprint
 * Author:          Matthias Nötzli
 * Author URI:      https://github.com/matthias-noetzli
 * Text Domain:     hfh-sprint
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         HfH_Sprint
 */

namespace HfH\Sprint;

if (!defined('ABSPATH')) {
    return;
}

if (!defined('HFH_SPRINT_URL')) {
    define('HFH_SPRINT_URL', plugin_dir_url(__FILE__));
}

require_once("inc/class-hfh-sprint.php");
HfH_Sprint::get_instance();
