<?php
/**
 * Register Meta Boxes
 * 
 * @package Salemoche
 */

namespace SALEMOCHE_THEME\inc;

use SALEMOCHE_THEME\inc\traits\Singleton;

class Meta_Boxes {
    use Singleton;

    protected function __construct() {
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        add_action( 'add_meta_boxes', [$this, 'add_custom_meta_box']);
        add_action( 'save_post', [$this, 'save_post_meta_data']);
    }

    public function add_custom_meta_box () {

        $screens = [ 'post', 'wporg_cpt' ];
        foreach ( $screens as $screen ) {
            add_meta_box(
                'hide page title',                  // Unique ID
                __('Hide page title', 'salemoche'),         // Box title
                [$this, 'custom_meta_box_html'],         // Content callback, must be of type callable
                $screen,                          // Post type
                'side'                            // Context
            );
        }
    }

    public function custom_meta_box_html ($post) {
        
        $value = get_post_meta( $post->ID, '_hide_page_title', true );

        /**
         * Use nonce for verification
         */

        wp_nonce_field( plugin_basename( __FILE__ ), 'hide_title_meta_box_nonce_name');

        ?>
        <label for="salemoche-field"><?php esc_html_e( 'Description for this field', 'salemoche' ) ?></label>
        <select name="salemoche_hide_title_field" id="salemoche_field" class="postbox">
            <option value=""><?php esc_html_e( 'Select something...', 'salemoche' ) ?></option>
            <option value="yes" <?php selected( $value, 'yes' ); ?>><?php esc_html_e( 'Yes', 'salemoche' ) ?></option>
            <option value="no" <?php selected( $value, 'no' ); ?>><?php esc_html_e( 'No', 'salemoche' ) ?></option>
        </select>
        <?php
    }

    public function save_post_meta_data ($post_id) {

        /**
         * When the post is saved or updated we get access to the $_POST
         * Check if user is authorised
         */

        if ( current_user_can( 'edit_post', $post_id ))

        /**
         * Check if the nonce value we received is the same we created
         */

        if ( !isset( $_POST['hide_title_meta_box_nonce_name']) || ! wp_verify_nonce( $_POST['hide_title_meta_box_nonce_name'], plugin_basename( __FILE__ )) ) {
            return;
        }
        
        if ( array_key_exists( 'salemoche_hide_title_field', $_POST ) ) {
            update_post_meta(
                $post_id,
                '_hide_page_title', // SM: This is the key that is used in get_post_meta()
                $_POST['salemoche_hide_title_field']
            );
        }
    }
}