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
        add_action( 'enqueue_block_assets', [ $this, 'enqueue_editor_assets'] );
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

    public function enqueue_editor_assets() {
        $asset_config_file = sprintf('%s/assets.php', SALEMOCHE_BUILD_PATH);

        if ( !file_exists( $asset_config_file ) ) {
            return;
        }

        $asset_config = require_once $asset_config_file;

        if ( empty( $asset_config['js/editor.js'] ) ) {
            return;
        }

        $editor_asset = $asset_config['js/editor.js'];

        // Theme Gutenberg Blocks JS

        $js_dependencies = !empty( $editor_asset['dependencies'] ) ? $editor_asset['dependencies'] : [];
        $version = !empty( $editor_asset['version'] ) ? $editor_asset['version'] : filemtime( $asset_config_file );

        if ( is_admin() ) {
            wp_register_script( 'salemoche-blocks-js', SALEMOCHE_BUILD_JS_URI . '/blocks.js', $js_dependencies, $version, true );
            wp_enqueue_script('salemoche-blocks-js');
        }

        // Theme Gutenberg Blocks CSS

        $css_dependencies = [
            'wp-block-library-theme',
            'wp-block-library'
        ];

        wp_register_style( 'salemoche-blocks-css', SALEMOCHE_BUILD_CSS_URI . '/blocks.css', $css_dependencies, filemtime( SALEMOCHE_BUILD_CSS_DIR_PATH . '/blocks.css'), 'all' );
        wp_enqueue_style( 'salemoche-blocks-css' );
    }
}