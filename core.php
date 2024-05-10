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

defined('ABSPATH') || die;

class Core
{
    private static $_instance = null;

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __construct()
    {
        $this->constants();

        $this->check_version();

        $this->init();

        $this->providers();
    }

    public function constants()
    {
        if (!function_exists('get_plugin_data')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        define('TK_PATH', plugin_dir_path(__FILE__));
        define('TK_URL', plugin_dir_url(__FILE__));
        define('TK_ADMIN_ASSETS', TK_URL . '/assets/admin');
        define('TK_HOME_ASSETS', TK_URL . 'assets/home');
        define('TK_VERSION', get_plugin_data(__FILE__)['Version']);
        define('TK_MINIMUM_PHP_VERSION', get_plugin_data(__FILE__)['RequiresPHP']);
    }

    public function init()
    {
        require_once TK_PATH . '/vendor/autoload.php';
        require_once TK_PATH . '/include/Admin/Codestar/codestar-framework.php';
        require_once TK_PATH . '/include/Admin/TKSettings.php';

        register_activation_hook(__FILE__, [$this, 'activate']);
        register_deactivation_hook(__FILE__, [$this, 'deactivate']);
    }

    public function activate()
    {
        (new TKDB())->create_tables();
    }

    public function deactivate()
    {
        //
    }

    public function providers()
    {
        new TKAssets();

        if (is_admin()) {
            new TKMenu();
        }
    }

    public function check_version()
    {
        if (version_compare(PHP_VERSION, TK_MINIMUM_PHP_VERSION, '<')) {

            wp_admin_notice(
                ' افزونه تیکت پشتیبانی برای اجرای صحیح نیاز به نسخه ' . TK_MINIMUM_PHP_VERSION . ' دارد ',
                ['type' => 'error']
            );

            return;
        }
    }
}

Core::instance();
