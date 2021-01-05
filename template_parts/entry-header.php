<?php
/**
 * Header Template
 * 
 * @package Salemoche
 */

    $the_post_id = get_the_ID();
    $hide_title = get_post_meta( $the_post_id, '_hide_post_title');
    $has_post_thumbnail = get_the_post_thumbnail( $the_post_id );

?>

<header>
    <?php
        if ( $has_post_thumbnail ) {
            ?>
            <div class="post_thumbnail mb-5">
                <a href="<?php the_permalink(); ?>">
                    <?php
                        the_post_custom_thumbnail (
                            $the_post_id,
                            'featured-thumbnail',
                            [
                                'sizes' => ('max-width: 350px) 350px, 233px '),
                                'class' => 'attachment-featured-thumbnail size-featured-image'
                            ]
                        )
                    ?>
                </a>
            </div>
            <?php
        }
    ?>
</header>