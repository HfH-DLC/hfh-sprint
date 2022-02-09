<?php

namespace HfH\Sprint;

class Category_Filter_Order
{

    private static $instance = false;

    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __construct()
    {
        add_filter('hfh_category_filter_params', array($this, 'filter_order'));
    }


    /**
     * Changes the category order of the Category Filter plugin
     */
    public function filter_order($args)
    {
        $args['orderby'] = 'slug';
        $args['order'] = 'asc';
        return $args;
    }
}
