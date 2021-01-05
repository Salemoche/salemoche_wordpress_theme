<?php

function get_the_post_custom_thumbnail( $post_id, $size = 'featured-thumbnail', $additional_attributes = [] ) {
    if ( $post_id === null ) {
        $post_id = get_the_ID();
    }

    if ( has_post_thumbnail( $post_id ) ) {
        $default_attributes = [
            'loading' => 'lazy'
        ];

        $attributes = array_merge( $additional_attributes, $default_attributes );  

        $custom_thumnail = wp_get_attachment_image(
            get_post_thumbnail_id( $post_id ),
            $size,
            false,
            $attributes
        );
    }

    return $custom_thumnail;
}

function the_post_custom_thumbnail ( $post_id, $size = 'featured-thumbnail', $additional_attributes = [] ) {
    echo  get_the_post_custom_thumbnail( $post_id, $size, $additional_attributes );
}

function salemoche_posted_on () {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    if (get_the_time( 'U' ) != get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf(
        $time_string,
        // get_the_date( DATE_RFC7231 ),
        esc_attr(get_the_date( DATE_W3C )),
        esc_attr(get_the_date( )),
        esc_attr(get_the_modified_date( DATE_W3C )),
        esc_attr(get_the_modified_date( ))
    );

    // echo $time_string;

    $posted_on = sprintf(
        esc_html_x( 'Posted on %s', 'post date', 'salemoche'),
        '<a href="' . esc_url( get_the_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on text-secondary">' . $posted_on . '</span>';
}

function salemoche_posted_by () {
    $byline = sprintf(
        esc_html_x( ' by %s', 'post author', 'salemoche'),
        '<span class="author vcard"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )) . '">' . esc_html(get_the_author_meta( 'display_name' )) . '</a></span>'
    );

    echo '<span class="byline">' . $byline . '</span>';
}

function salemoche_the_exerpt ($trim_character_count = 0) {
    if (!has_excerpt() || $trim_character_count === 0) {
        the_excerpt();
        return;
    } 
    
    $excerpt = wp_strip_all_tags( get_the_excerpt() );
    $excerpt = substr( $excerpt, 0, $trim_character_count);
    $excerpt = substr( $excerpt, 0, strpos( $excerpt, ' ')); //ends on the end of a word

    echo $excerpt . " ..."; 
}

function salemoche_read_more ( $more = '' ) {
    if (!is_single()) {
        $more = sprintf(
            '<button class="mt-4 btn btn-info"><a href="%1$s">%2$s</a></button>',
            get_permalink( get_the_ID() ),
            __('Read more', 'salemoche')
        );
    }

    echo $more;
}

function salemoche_pagination () {

    $allowed_tags = [
        'a' => [
            'class' => [],
            'href' => []
        ],
        'span' => [
            'class' => []
        ]

    ];

    $args = [
        'before_page_number' => '<span class="btn btn-secondary border mb-2 mr-2">',
        'after_page_number' => '</span>'
    ];

    printf( '<nav class="salemoche-pagination clearfix>%s</nav>', wp_kses( paginate_links( $args ), $allowed_tags ));
}