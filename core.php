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
    public function __construct() {
        $this->constants();
        $this->init();
    }

    public function constants()
    {
        define('TK_BASE_FILE', __FILE__);
        define('TK_PATH', plugin_dir_path(TK_BASE_FILE));
        define('TK_URL', plugin_dir_url(TK_BASE_FILE));
    }

    public function init()
    {
        register_activation_hook(TK_BASE_FILE, [$this, 'activate']);
        register_deactivation_hook(TK_BASE_FILE, [$this, 'deactivation']);
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
