<?php

abstract class BaseMenu
{
    protected $page_title;
    protected $menu_title;
    protected $capability;
    protected $menu_slug;
    protected $icon_url = '';
    protected $position = null;
    protected $has_submenu = false;
    protected $submenus = [];

    public function __construct()
    {
        $this->capability = 'manage_options';

        add_action('admin_menu', [$this, 'create_menu']);
    }

    public function create_menu()
    {
        add_menu_page(
            $this->page_title,
            $this->menu_title,
            $this->capability,
            $this->menu_slug,
            [$this, 'page'],
            $this->icon_url,
            $this->position
        );

        if ($this->has_submenu) {
            foreach ($this->submenus as $submenu) {
                add_submenu_page(
                    $this->menu_slug,
                    $submenu['page_title'],
                    $submenu['menu_title'],
                    $this->capability,
                    $submenu['menu_slug'],
                    [$this, $submenu['callback'] ?? '']
                );
            }
        }

        remove_submenu_page(
            $this->menu_slug,
            $this->menu_slug
        );
    }

    abstract public function page();
}
