<?php
function fb_register_sidebar() {
    
    //Register Sidebar function - https://developer.wordpress.org/reference/functions/register_sidebar/
    register_sidebar(
        array(
            'name'          => __( 'Header Sidebar', 'textdomain' ),
            'id'            => 'sidebar-1',
            'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'textdomain' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
    
} 

// Action hook 

add_action( 'widgets_init', 'fb_register_sidebar' );
?>