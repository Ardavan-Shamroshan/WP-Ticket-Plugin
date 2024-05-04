<?php

/**
 * Plugin Name: تیکت پشتیبانی
 * Plugin URI: https://wordpress.com/
 * Description: افزونه تیکت پشتیبانی، پرسش خودت رو بنویس و به سرعت پاسخ و راه حل رو دریافت کن.
 * Version: 1.0.0
 * Author: Ardavan Shamroshan
 * Author URI: https://ardavanshamroshan.ir
 * Text Domain: wordpress
 * Requires at least: 6.4
 * Requires PHP: 7.4
 *
 * @package TicketPlugin
 */

use Inc\TKAssets;

// Die if accessed externally
defined('ABSPATH') || die;

// Dump autoload
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

// Constants
define('TK_PATH', plugin_dir_path(__FILE__));
define('TK_URL', plugin_dir_url(__FILE__));
define('TK_ADMIN_ASSETS', TK_URL . '/assets/admin');
define('TK_HOME_ASSETS', TK_URL . 'assets/home');

if (!function_exists('get_plugin_data')) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

define('TK_VERSION', get_plugin_data(__FILE__)['Version']);

function activate()
{
    \Inc\Core\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate');

function deactivate()
{
    Inc\Core\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate');

if (class_exists(Inc\Core\Core::class)) {
    \Inc\Core\Core::register_services();
}
