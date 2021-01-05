<?php
/**
 * No content available
 * 
 * @package Salemoche
 */

?>

<section class="no-result not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'Salemoche' ); ?> </h1>
    </header>

    <div class="page-content">
        <?php
            if ( is_home && current_user_can( 'publish_posts' ) ) :
            ?>
            <p>
                <?php 
                    printf(
                        wp_kses(
                            __( 'Ready to publish your first post? <a href="%s">Get started here </a>', 'salemoche'),

                            [
                                'a' => [
                                    'href' => []
                                ]
                            ]
                        ),
                        esc_url(admin_url( 'post-new.php ') )
                    )
                ?>
            </p>
            <?php
            elseif ( is_search() ):
                ?>
                <p><?php esc_html_e( 'Sorry but nothing matched your search item. Please try again with some different keywords', 'salemoche' ) ?></p>
                <?php get_search_form();?>
                <?php
            else :
                ?>
                <p><?php esc_html_e( 'It seems that we cannot find what you are looking for. Perhaps the search can help', 'salemoche' ) ?></p>
                <?php get_search_form();?>
                <?php
            endif;
            ?>
    </div>
</section>