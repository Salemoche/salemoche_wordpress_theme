<?php
/**
 *  Theme Functions
 * 
 *  @package Salemoche
 */

// echo '<pre>';
// print_r (SALEMOCHE_DIR_PATH);
// wp_die();

if ( !defined('SALEMOCHE_DIR_PATH')) {
    define( 'SALEMOCHE_DIR_PATH', untrailingslashit( get_template_directory() ));
}

if ( !defined('SALEMOCHE_DIR_URI')) {
    define( 'SALEMOCHE_DIR_URI', untrailingslashit( get_template_directory_uri() ));
}

if ( !defined('SALEMOCHE_BUILD_URI')) {
    define( 'SALEMOCHE_BUILD_URI', untrailingslashit( get_template_directory_uri() . '/assets/build' ));
}

if ( !defined('SALEMOCHE_BUILD_JS_DIR_PATH')) {
    define( 'SALEMOCHE_BUILD_JS_DIR_PATH', untrailingslashit( get_template_directory() . '/assets/build/js' ));
}

if ( !defined('SALEMOCHE_BUILD_JS_URI')) {
    define( 'SALEMOCHE_BUILD_JS_URI', untrailingslashit( get_template_directory_uri() . '/assets/build/js' ));
}

if ( !defined('SALEMOCHE_BUILD_IMG_URI')) {
    define( 'SALEMOCHE_BUILD_IMG_URI', untrailingslashit( get_template_directory_uri() . '/assets/build/img' )); 
}

if ( !defined('SALEMOCHE_BUILD_CSS_URI')) {
    define( 'SALEMOCHE_BUILD_CSS_URI', untrailingslashit( get_template_directory_uri() . '/assets/build/css' ));
}

if ( !defined('SALEMOCHE_BUILD_CSS_DIR_PATH')) {
    define( 'SALEMOCHE_BUILD_CSS_DIR_PATH', untrailingslashit( get_template_directory() . '/assets/build/css' ));
}

require_once SALEMOCHE_DIR_PATH . '/inc/helpers/autoloader.php';
require_once SALEMOCHE_DIR_PATH . '/inc/helpers/template-tags.php';

function salemoche_get_theme_instance() {
    \SALEMOCHE_THEME\inc\SALEMOCHE_THEME::get_instance();
}

salemoche_get_theme_instance();

?>