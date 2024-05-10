<?php

defined('ABSPATH') || die;

class TKMenu extends BaseMenu
{
    public function __construct()
    {
        parent::__construct();

        $this->page_title = 'تیکت پشتیبانی';
        $this->menu_title = 'تیکت پشتیبانی';
        $this->menu_slug = 'ticket-plugin';
        $this->icon_url = 'dashicons-tickets-alt';
        $this->has_submenu = true;

        $this->submenus = [
            'tickets' => [
                'page_title' => 'لیست تیکت ها',
                'menu_title' => 'لیست تیکت ها',
                'menu_slug' => 'tkt-tickets-list',
                'callback' => 'tickets_page',
            ],
            
            'departments' => [
                'page_title' => 'لیست دپارتمان ها',
                'menu_title' => 'لیست دپارتمان ها',
                'menu_slug' => 'tkt-departments-list',
                'callback' => 'departments_page',
            ]
        ];
    }

    public function page()
    {
        echo 'ticket plugin page';
    }

    public function tickets_page(){
        echo '<h2>لیست تیکت ها </h2>';
    }
    
    public function departments_page(){
        echo '<h2>لیست دپارتمان ها </h2>';
    }
}
