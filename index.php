<?php
/**
 * Main Template file
 * @package Salemoche
*/

get_header();

?>

<div id="primary">
    <main id="main" class="site-main mt-5" role="main">
        <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();
            
            get_template_part('template_parts/content');

            endwhile; 
    
        salemoche_pagination();
        
        else :
            get_template_part('template_parts/content-none');
        endif; 
        ?>
    </main>
</div>
    
<?php
get_footer();