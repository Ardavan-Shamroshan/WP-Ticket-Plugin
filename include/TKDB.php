<?php

defined('ABSPATH') || die;

class TKDB
{
    public $charset;
    public $departments_table;
    public $users_table;
    public $tickets_table;
    public $replies_table;

    public function __construct()
    {
        global $wpdb;

        $this->charset = $wpdb->get_charset_collate();        
        $this->departments_table = $wpdb->prefix . 'tk_departments';
        $this->users_table = $wpdb->prefix . 'tk_users';
        $this->tickets_table = $wpdb->prefix . 'tk_tickets';
        $this->replies_table = $wpdb->prefix . 'tk_replies';
    }

    public function create_tables()
    {

        if (!function_exists('dbDelta')) {
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        }

        dbDelta($this->departments());
        dbDelta($this->users());
        dbDelta($this->tickets());
        dbDelta($this->replies());
    }

    public function departments()
    {
        return "
            CREATE TABLE IF NOT EXISTS `" . $this->departments_table . "` (
                `ID` bigint(20) NOT NULL AUTO_INCREMENT,
                `name` varchar(255) NOT NULL,
                `parent_id` bigint(20) DEFAULT NULL,
                `position` int(11) NOT NULL DEFAULT '1',
                `description` varchar(255) DEFAULT NULL,
                PRIMARY KEY (`ID`),
                KEY `parent_id` (`parent_id`)
        ) ENGINE = InnoDB " . $this->charset . ";";
    }

    public function users()
    {
        return "
        CREATE TABLE IF NOT EXISTS `" . $this->users_table . "` (
            `ID` bigint(20) NOT NULL AUTO_INCREMENT,
            `user_id` bigint(20) DEFAULT NULL,
            `department_id` bigint(20) DEFAULT NULL,
            PRIMARY KEY (`ID`),
            KEY `user_id` (`user_id`),
            KEY `department_id` (`department_id`)
        ) ENGINE = InnoDB " . $this->charset . ";";
    }

    public function tickets()
    {
        return "
        CREATE TABLE IF NOT EXISTS `" . $this->tickets_table . "` (
            `ID` bigint(20) NOT NULL AUTO_INCREMENT,
            `user_id` bigint(20) DEFAULT NULL,
            `creator_id` bigint(20) DEFAULT NULL,
            `department_id` bigint(20) DEFAULT NULL,
            `title` varchar(255) NOT NULL,
            `body` text NOT NULL,
            `user_name` varchar(255) DEFAULT NULL,
            `user_email` varchar(255) DEFAULT NULL,
            `user_phone` varchar(255) DEFAULT NULL,
            `from_admin` tinyint(1) DEFAULT NULL,
            `status` varchar(255) NOT NULL,
            `priority` varchar(255) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `reply_date` varchar(255) DEFAULT NULL,
            `voice` varchar(512) DEFAULT NULL,
            `file` text DEFAULT NULL,
            PRIMARY KEY (`ID`),
            KEY `user_id` (`user_id`),
            KEY `department_id` (`department_id`),
            KEY `creator_id` (`creator_id`),
            KEY `title` (`title`),
            KEY `from_admin` (`from_admin`),
            KEY `status` (`status`)
        ) ENGINE = InnoDB " . $this->charset . ";";
    }

    public function replies()
    {
        return "
        CREATE TABLE IF NOT EXISTS `" . $this->replies_table . "` (
            `ID` bigint(20) NOT NULL AUTO_INCREMENT,
            `ticket_id` bigint(20) NOT NULL,
            `created_id` bigint(20) DEFAULT NULL,
            `body` text NOT NULL,
            `from_admin` tinyint(1) DEFAULT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `voice` varchar(255) DEFAULT NULL,
            `file` text DEFAULT NULL,
            PRIMARY KEY (`ID`),
            KEY `ticket_id` (`ticket_id`),
            KEY `created_id` (`created_id`)
        ) ENGINE = InnoDB " . $this->charset . ";";
    }
}
