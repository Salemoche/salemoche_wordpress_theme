<?php
/**
 * No content available
 * 
 * @package Salemoche
 */

    $the_post_id = get_the_ID();
    $has_post_thumbnail = get_the_post_thumbnail( $the_post_id );

?>

<div class="entry-content">
    <?php
    if (is_single() ) {
        the_content(
            sprintf(
                wp_kses( 
                    __('Continue reading %s <span class="meta-nav">&arr;</span>', 'salemoche'),
                    [
                        'span' => [
                            'class' => []
                        ]
                    ]
                ),

                the_title('<span class="screen-reader-text">"', '"</span>', false)
            )
        );

        wp_link_pages( 
            [
                'before' => '<div class="page_links">' . esc_html__( 'Pages', 'Salemoche'),
                'after' => '</div>'
            ]
            );
    } else {
        salemoche_the_exerpt();
        salemoche_read_more();
    }
    ?>
</div>