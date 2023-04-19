<?php

namespace HfH\Sprint;

class Category_Table
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
        add_action('init', array($this, 'init'));
    }

    public function init()
    {
        add_shortcode('hfh_category_table', array($this, 'category_table_shortcode'));
        add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_scripts'));
    }

    /**
     * The hfh_category_table shortcode displays tables of the current pages categories.
     * The categories are grouped by "top categories", which are categories without a parent.
     * The top categories are used as table headers while the subcategories are concatenated in a comma-separated string.
     * The top categories to be used can be specified using the "categories" attribute of the shortcode, which should be a comma-sepparated list of category ids.
     * 
     * @param array $atts The shortcode attributes.
     * 
     */
    public function category_table_shortcode($atts)
    {

        $top_categories =  $this->get_top_categories(get_the_category());

        if ($atts && $atts["categories"]) {
            $top_category_ids = explode(",", $atts["categories"]);
            $top_categories = array_reduce($top_category_ids, function ($acc, $id) use ($top_categories) {
                foreach ($top_categories as $key => $value) {
                    if ($id == $key) {
                        $acc[$key] = $value;
                    }
                }
                return $acc;
            }, []);
        }

        $o              = '';

        foreach ($top_categories as $top_id => $categories) {
            $top_category = get_category($top_id);
            $o           .= '<table class="hfh-category-table"><tbody>';
            $o           .= "<tr><th>$top_category->name</th></tr>";
            $o           .= "<tr style='border-bottom: 2px solid #F2D1D4;'><td style='background-color: #fbf3f4;'>";
            $o           .= implode(', ', array_map(function ($category) {
                return $category->name;
            }, $categories));
            $o           .= '</td></tr></tbody></table>';
        }

        return $o;
    }

    private function get_top_categories($categories)
    {
        $result = array();
        foreach ($categories as $category) {
            $children = get_categories(
                array(
                    'parent' => $category->term_id,
                )
            );
            if (count($children) === 0) {
                $top_ancestor                       = $this->get_top_ancestor($category);
                $result[$top_ancestor->term_id][] = $category;
            }
        }
        return $result;
    }

    private function get_top_ancestor($term)
    {
        if ($term->parent != 0) {
            $term = get_term($term->parent);
            return $this->get_top_ancestor($term);
        }
        return $term;
    }


    public function wp_enqueue_scripts()
    {
        wp_enqueue_style('hfh-sprint-category-table', HFH_SPRINT_URL . 'css/category-table.css');
    }
}
