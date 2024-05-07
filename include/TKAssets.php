<?php

defined('ABSPATH') || die;

class TKAssets
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'home_assets']);
        add_action('admin_enqueue_scripts', [$this, 'admin_assets']);
    }

    public function admin_assets()
    {
        wp_enqueue_script('tk-admin-app', TK_ADMIN_ASSETS . '/js/app.js', ['jquery'], TK_VERSION, true);
    }

    public function home_assets()
    {
        wp_enqueue_style('tk-home-app', TK_HOME_ASSETS . '/css/app.css', [], TK_VERSION);
    }
}
