<?php
/**
 * shortcodes for Real estates CPT
 */

 /**
  * The callback of the shortcode to retrieve real-estate CPTs
  * @param mixed $atts
  * @return false|string
  */

if ( !function_exists( 'real_estates_shortcode_callback' ) ) {
    function real_estates_shortcode_callback( $atts ) {
        $atts = shortcode_atts( array(
            'column'            => 3,
            'direction'         => 'column',
            'display_type'      => 'grid',
            'location'          => 'yes',
            'price'             => 'yes',
            'display_counts'    => 8,
            'align_text'        => 'center',
            'fractional'        => 'no'
        ), $atts );
    
        $args = array (
            'post_type' => 'real_estate',
            'post_status' => array( 'publish' ),
            'posts_per_page' => $atts['display_counts']
        );
    
        $query = new WP_Query( $args );    

        wp_localize_script( 'custom-main-js', 'real_estate_direction_data', array(
            'direction' => $atts['direction'],
        ));

        ob_start();
    
        if ( $query->have_posts() ) {
            if ( $atts['display_type'] == 'slider' ) {
                ?>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                <?php
            } else {
                ?>
                <div class="real-estate-listing-grid real-estate-listing-column-<?php echo esc_attr( $atts['column'] ); ?>">
                <?php
            }
    
            while ( $query->have_posts() ) {
                $query->the_post();
    
                if ( $atts['display_type'] == 'slider' ) {
                    ?>
                    <div class="swiper-slide">
                        <?php get_template_part( 'template-parts/single-real-estate-slider', null, array( 'post_id' => get_the_ID(), 'atts' => $atts ) ); ?>
                    </div><!-- .swiper-slide -->
                    <?php
                } else {
                    get_template_part( 'template-parts/single-real-estate-grid', null, array( 'post_id' => get_the_ID(), 'atts' => $atts ) );
                }
            }
    
            if ( $atts['display_type'] == 'slider' && $atts['direction'] == 'column' ) {
                ?>
                </div><!-- .swiper-wrapper  -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                </div><!-- .swiper-container -->
                <?php
            } else {
                ?>
                </div><!-- .real-estate-listing-grid -->
                <?php
            }
        } else {
            echo 'No listings found.';
        }
    
        wp_reset_postdata();
    
        return ob_get_clean();
    }
}

add_shortcode('real_estates', 'real_estates_shortcode_callback');


 /**
  * The callback of the shortcode to display filters of real-estate CPTs
  * @param mixed $atts
  * @return false|string
  */
if ( !function_exists( 'custom_search_filter_shortcode_callback' ) ) {
    function custom_search_filter_shortcode_callback( $atts ) {
        $atts = shortcode_atts( array(
            'column'            => 4,
            'direction'         => 'column',
            'display_type'      => 'grid',
            'location'          => 'yes',
            'price'             => 'yes',
            'display_counts'    => 8,
            'align_text'        => 'center',
            'fractional'        => 'no'
        ), $atts );

        $locations = get_terms( array(
            'taxonomy'      => 'locations',
            'hide_empty'    => false
        ) );
        
        $features = get_terms( array(
            'taxonomy'      => 'features',
            'hide_empty'    => false
        ) );

        ob_start();
        ?>
        <div class="filter-container">
            <div>
                <label>Filter Your Results:</label>
            </div>
            <div class="filters">
                <?php if ( !empty( $locations ) ) : ?>
                    <div class="custom-select">
                        <select name="location" id="filter_location">
                            <option value="">Location</option>
                            <?php foreach ( $locations as $location ) : ?>
                                <option value="<?php echo esc_attr( $location->term_id ); ?>"><?php echo $location->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>
                <div class="custom-select">
                    <select name="lifestyle_activities" id="filter_lifestyle_activities">
                        <option value="">Lifestyle & Activities</option>
                    </select>
                </div>
                <?php if ( !empty( $features ) ) : ?>
                    <div class="custom-select">
                        <select name="features_amenities" id="filter_features_amenities">
                            <option value="">Features & Amenities</option>
                            <?php foreach ( $features as $feature ) : ?>
                                <option value="<?php echo esc_attr( $feature->term_id ); ?>"><?php echo $feature->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>
                <div class="custom-select">
                    <select name="ownership_type" id="filter_ownership_type">
                        <option value="">Ownership Type</option>
                    </select>
                </div>
                <button id="apply_filter" class="apply-button">APPLY</button>
            </div>
        </div>
        <div id="filtered_results" class="real-estate-listing-grid real-estate-listing-column-<?php echo $atts['column']; ?>" data-atts='<?php echo json_encode( $atts ); ?>'></div>
        <?php

        return ob_get_clean();
    }
}

add_shortcode( 'custom_search_filter', 'custom_search_filter_shortcode_callback' );


/**
 * Register shortcode for Real estates taxonomies
 */

if ( !function_exists( 'real_estate_features_shortcode_callback' ) ) {
	function real_estate_features_shortcode_callback( $atts ) {
		$features = get_terms( array(
			'taxonomy'      => 'features',
			'hide_empty'    => false
		) );

		ob_start();

		if ( !empty( $features ) ) : 
			?>
			<ul class="real-estates-features">
				<?php foreach ( $features as $feature ) : ?>
					<li>
						<a href="<?php echo get_term_link( $feature->term_id ); ?>"><?php echo $feature->name; ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php
		endif;

		return ob_get_clean();
	}
}

add_shortcode('real_estate_features', 'real_estate_features_shortcode_callback');