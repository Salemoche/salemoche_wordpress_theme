<?php
/**
 * Blocks
 * 
 * @package Salemoche
 */

namespace SALEMOCHE_THEME\inc;

use SALEMOCHE_THEME\inc\traits\Singleton;

class Blocks {
    use Singleton;

    protected function __construct() {
        // Load class
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        // Actions and filters

        add_action( 'block_categories', [ $this, 'add_block_categories' ] );
    }

    public function add_block_categories( $categories ) {

        $category_slugs = wp_list_pluck( $categories, 'slug' );

        echo '<pre>';
        print_r($category_slugs);
        wp_die();
    }

}