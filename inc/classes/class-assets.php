<?php
/**
 * Enqueues all Assets
 * 
 * @package Salemoche
 */

namespace SALEMOCHE_THEME\inc;

use SALEMOCHE_THEME\inc\traits\Singleton;

class Assets {
    use Singleton;

    protected function __construct() {
        // Load class
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        // Actions and filters

        add_action( 'wp_enqueue_scripts', [ $this, 'register_styles'] );
        add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts'] );
    }

    public function register_styles() {
        
        // Register Styles
        wp_register_style( 'style-css', get_stylesheet_uri(), [], filemtime( SALEMOCHE_DIR_PATH . '/style.css'), 'all' );
        wp_register_style( 'bootstrap-css', SALEMOCHE_DIR_URI . '/src/library/bootstrap/bootstrap.min.css', [], false, 'all' );
        wp_register_style( 'main-css', SALEMOCHE_BUILD_CSS_URI . '/main.css', ['bootstrap-css'], filemtime( SALEMOCHE_BUILD_CSS_DIR_PATH . '/main.css'), 'all' );

        // Enqueue Styles
        wp_enqueue_style('style-css');
        wp_enqueue_style('bootstrap-css');
        wp_enqueue_style('main-css');
    }

    public function register_scripts() {

        // Register Scripts
        wp_register_script( 'main-js', SALEMOCHE_BUILD_JS_URI . '/main.js', [ 'jquery' ], filemtime( SALEMOCHE_BUILD_JS_DIR_PATH . '/main.js'), true );
        wp_register_script( 'bootstrap-js', SALEMOCHE_DIR_URI . '/src/library/bootstrap/bootstrap.min.js', [ 'jquery' ], false, true );
    
        // Enqueue Scripts
        wp_enqueue_script('main-js');
        wp_enqueue_script('bootstrap-js');
    }
}