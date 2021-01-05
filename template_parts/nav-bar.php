<?php
/**
 * Creates the Navigation Menu
 * 
 * @package Salemoche
 */

$menu_class = \SALEMOCHE_THEME\inc\Menus::get_instance();
$header_menu_id = $menu_class->get_menu_id('salemoche-header-menu');
$header_menu = wp_get_nav_menu_items( $header_menu_id );
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <?php if (function_exists( 'the_custom_logo')) {
        the_custom_logo();
    } ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php
        if ( !empty( $header_menu ) && is_array( $header_menu) ) :
            ?>
            <ul class="navbar-nav mr-auto">

                <?php 
                foreach ( $header_menu as $menu_item ) :
                    if( !$menu_item->menu_item_parent ) :

                        $child_menu_items = $menu_class->get_child_menu_items($header_menu, $menu_item->ID);
                        $has_children = is_array($child_menu_items) && !empty( $child_menu_items );

                        if ( !$has_children) : 
                            ?>
                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo esc_url( $menu_item->url ) ?> "><?php echo esc_html( $menu_item->title ) ?> <span class="sr-only">(current)</span></a>
                            </li>
                            <?php 
                        else : 
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="<?php echo esc_url( $menu_item->url ) ?> " id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo esc_html( $menu_item->title ) ?> 
                                </a>
                                <?php
                                foreach ( $child_menu_items as $child_menu_item ) :
                                    ?>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="<?php echo esc_url( $child_menu_item->url ) ?>"><?php echo esc_html( $child_menu_item->title ) ?></a>
                                    </div>
                                    <?php
                                endforeach;
                                ?>
                            </li>
                            <?php 
                        endif;
                        ?>

                        <?php
                    endif;
                endforeach;
                ?>
            </ul>
            <?php
        endif;
        ?>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>