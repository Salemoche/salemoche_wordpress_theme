<?php
/**
 * No content available
 * 
 * @package Salemoche
 */

    $the_post_id = get_the_ID();
    $has_post_thumbnail = get_the_post_thumbnail( $the_post_id );

?>

<div class="entry-meta mb-3">
    <?php
        salemoche_posted_on();
        salemoche_posted_by();
    ?>
</div>