<?php

namespace HfH\Sprint;

require_once("class-category-filter-order.php");
require_once("class-category-table.php");
require_once("class-search.php");
require_once("class-textboxes.php");


class HfH_Sprint
{
    private static $instance = false;

    private function __construct()
    {
        Category_Filter_Order::get_instance();
        Category_Table::get_instance();
        Search::get_instance();
        Textboxes::get_instance();
    }

    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
