<?php
/**
 * define Ajax
 */

 function handle_filter_real_estates_ajax_request() {
    // Check nonce for security
    check_ajax_referer( 'ajax_nonce', 'security' );
    // Filtering data

    $location = sanitize_text_field( $_POST['location'] );
    $lifestyle_activities = sanitize_text_field( $_POST['lifestyle_activities'] );
    $features_amenities = sanitize_text_field( $_POST['features_amenities'] );
    $ownership_type = sanitize_text_field( $_POST['ownership_type'] );
    $atts = $_POST['atts'];
    
    // Prepare tax_query array 
    $tax_query = array('relation' => 'AND');

    // Add location to tax_query only if it's not empty
    if ( !empty( $location ) ) {
        $tax_query[] = array(
            'taxonomy' => 'locations',
            'field'    => 'term_id',
            'terms'    => $location
        );
    }

    // Add features_amenities to tax_query only if it's not empty
    if ( ! empty( $features_amenities ) ) {
        $tax_query[] = array(
            'taxonomy' => 'features',
            'field'    => 'term_id',
            'terms'    => $features_amenities
        );
    }

    $args = array(
        'post_type' => 'real_estate', 
        'posts_per_page' => $atts['display_counts'], // Number of posts to display
        'tax_query' => $tax_query,
    );

    $query = new WP_Query($args);

    if ( $query->have_posts() ) {
        // Start output buffering
        ob_start();

        while ( $query->have_posts() ) {
            $query->the_post();

            // Ensure that the template part outputs only the necessary HTML
            get_template_part( 'template-parts/single-real-estate-grid', null, array( 'post_id' => get_the_ID(), 'atts' => $atts ) );
        }

        wp_reset_postdata();
    } else {
        $response = array(
            'success' => true,
            'html' => 'No posts found',
        );
    
        wp_send_json($response);
    }

    $html = ob_get_clean();

    $response = array(
        'success' => true,
        'html' => $html,
    );

    wp_send_json($response);

    wp_die();
}

add_action( 'wp_ajax_filter_real_estates_action', 'handle_filter_real_estates_ajax_request' );
add_action( 'wp_ajax_nopriv_filter_real_estates_action', 'handle_filter_real_estates_ajax_request' );