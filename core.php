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

class Core
{
    public function __construct()
    {
        $this->constants();
        
        $this->init();
    }

    public function constants()
    {
        define('TK_PATH', plugin_dir_path(__FILE__));
        define('TK_URL', plugin_dir_url(__FILE__));
        define('TK_ADMIN_ASSETS', TK_URL . '/assets/admin');
        define('TK_HOME_ASSETS', TK_URL . 'assets/home');

        if (!function_exists('get_plugin_data')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
        
        define('TK_VERSION', get_plugin_data(__FILE__)['Version']);
    }

    public function init()
    {
        register_activation_hook(__FILE__, [$this, 'activate']);
        register_deactivation_hook(__FILE__, [$this, 'deactivation']);
    }

    public function activate()
    {
        //
    }

    public function deactivate()
    {
        //
    }
}

$core = new Core();
