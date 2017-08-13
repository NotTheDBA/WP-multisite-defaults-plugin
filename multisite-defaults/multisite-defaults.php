<?php
/**
 * Plugin Name: Multi-Site Default Settings
 * Description: Sets default site values for new sites.
 * Network:     true
 * Plugin URL:  http://wordpress.stackexchange.com/a/219504/31323
 * License:     MIT
 * Version:     1.0.1-beta
 */
namespace WPSE177819;

add_action( 'wp_loaded', __NAMESPACE__ . '\init' );

/**
 * @wp-hook wp_loaded
 */
function init() {

    add_action(
        'wpmu_new_blog',
        function( $blog_id, $user_id ) {

            switch_to_blog( $blog_id );

            // $front_page_id = wp_insert_post( front_page_data( $user_id ) );
            // $index_page_id = wp_insert_post( index_page_data( $user_id ) );

            // if ( ! is_wp_error( $front_page_id ) && 0 !== $front_page_id ) {
            //     update_option( 'show_on_front', 'page' );
            //     update_option( 'page_on_front', $front_page_id );
            // }
            // if ( ! is_wp_error( $index_page_id ) && 0 !== $index_page_id ) {
            //     update_option( 'page_for_posts', $index_page_id );
            // }

            // update_option( 'date_format', date_format() );
            // update_option( 'time_format', time_format() );
            update_option( 'timezone_string', timezone_string() );
            
            restore_current_blog();
        },
        10,
        2
    );
}

/**
 * Returns the data of the blog index page
 *
 * @param int $post_author
 *
 * @return array
 */
function index_page_data( $post_author ) {

    return [
        'post_title'   => 'My blog index',
        'post_content' => '',
        'post_type'    => 'page',
        'post_author'  => $post_author,
        'post_status'  => 'publish'
    ];
}

/**
 * Returns the data of the front page
 *
 * @param int $post_author
 *
 * @return array
 */
function front_page_data( $post_author ) {

    return [
        'post_title'   => 'Hello World',
        'post_content' => 'Welcome to my new site!',
        'post_type'    => 'page',
        'post_author'  => $post_author,
        'post_status'  => 'publish'
    ];
}


/**
 * Returns the Timezone setting
 *
 * @return string
 */
 function timezone_string() {
    
        return 'America/New_York';
    }


/**
 * Returns the custom date format
 *
 * @return string
 */
 function date_format() {
    
        return 'd,m,Y';
    }
        
/**
 * Returns the custom time format
 *
 * @return string
 */
function time_format() {

    return 'H/i/s';
}

?>