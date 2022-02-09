<?php

namespace HfH\Sprint;

class Search
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
        add_filter('posts_search', array($this, 'search'), 500, 2);
    }

    /**
     * Customs search that also includes category names
     */
    public function search($search, $wp_query)
    {
        global $wpdb;
        if (empty($search))
            return $search;

        $terms = $wp_query->query_vars['s'];
        $exploded = explode(' ', $terms);
        if ($exploded === FALSE || count($exploded) == 0)
            $exploded = array(0 => $terms);

        $search = '';
        foreach ($exploded as $index => $term) {
            $search .= "AND (
                        ($wpdb->posts.post_title LIKE '%$term%') 
                        OR ($wpdb->posts.post_excerpt LIKE '%$term%') 
                        OR ($wpdb->posts.post_content LIKE '%$term%')
                        OR EXISTS
                (
                          SELECT 
                               *
                           FROM 
                               $wpdb->term_relationships 
                      LEFT JOIN 
                               $wpdb->terms 
                        ON 
                                $wpdb->term_relationships.term_taxonomy_id = $wpdb->terms.term_id
                            WHERE
                                   $wpdb->terms.name LIKE '%$term%'
                                AND
                                    $wpdb->term_relationships.object_id = $wpdb->posts.ID
                )
                )";
        }

        return $search;
    }
}
