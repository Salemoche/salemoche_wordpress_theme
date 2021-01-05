<?php
/**
 * Content Template
 * 
 * @package Salemoche
 */

?>

<article id="post-<?php the_ID(); ?>">
    <?php the_title(); ?>
    <?php get_template_part('template_parts/entry-header') ?>
    <?php get_template_part('template_parts/entry-meta') ?>
    <?php get_template_part('template_parts/entry-content') ?>
    <?php get_template_part('template_parts/entry-footer') ?>
</article>