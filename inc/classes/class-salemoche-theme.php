<?php
/**
 * ========================================
 * 
 * Bootstrap the Salemoche Theme
 * 
 * @package Salemoche
 * 
 * ========================================
 */

namespace SALEMOCHE_THEME\inc;

use SALEMOCHE_THEME\inc\traits\Singleton;

class SALEMOCHE_THEME {
    use Singleton;

    protected function __construct() {
        // load class

        Assets::get_instance();
        Menus::get_instance();
        Meta_Boxes::get_instance();
    
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        // actions and filters

        add_action( 'after_setup_theme', [ $this, 'setup_theme' ] );
    }

    public function setup_theme() {
        add_theme_support( 'title-tag' );

        add_theme_support( 'custom-logo', [
            'header-text'   => ['site-title', 'site-description'],
            'height'        => 100,
            'width'         => 400,
            'flex-height'   => true,
            'flex-width'    => true
        ] );

        add_theme_support( 'post-thumbnails' ); 

        add_image_size( 'featured-thumbnail', 350, 233, true); // get this size from the inspector to see how big the image should be

        add_theme_support( 'customize-selective-refresh-widgets' );

        add_theme_support( 'automatic-feed-links' );

        add_theme_support( 
            'html5', 
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'script',
                'style'
            ]
        );

        add_theme_support( 'wp-block-style' );

        add_theme_support( 'align-wide' );

        add_editor_style( 'assets/build/css/editor.css' );

        global $content_width;
        if ( !isset( $content_width ) ) {
            $content_width = 1240;
        }
    }
}