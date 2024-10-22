<?php
/**
 * The template for single real estates
 */

$post_id = $args['post_id'];
$atts = $args['atts'];


// ACF Fields
$except = get_field( 'except', $post_id );
$stree_name = get_field( 'street_name', $post_id );
$state = get_field( 'state', $post_id );
$postal_code = get_field( 'postal_code', $post_id );
$city = get_field( 'city', $post_id );
$country = get_field( 'country', $post_id );
$price = get_field( 'price', $post_id );
$bedroom = get_field( 'bedroom', $post_id );
$bathroom = get_field( 'bathroom', $post_id );
$garage = get_field( 'garage', $post_id );
$carport = get_field( 'carport', $post_id );
$square_foot = get_field( 'square_foot', $post_id );
$ownership = get_field( 'ownership', $post_id );

$terms = get_the_terms( $post_id, 'features' );

?>

<div class="single-real-estate single-real-estate-slider single-real-estate-<?php echo $atts['direction']; ?>">
    
    <!-- Slider Left Color Section -->
    <?php if( $atts['direction'] == 'column' ) :?>
        <div class="slider-left"></div>
    <?php endif; ?>
    
    <div class="slider-content-container">
        <!-- Slider Image -->
        <?php if ( has_post_thumbnail( $post_id ) ) : ?>
            <div class="post-thumbnail">
                <?php echo get_the_post_thumbnail( $post_id, 'full' ); ?> 
            </div>
        <?php endif; ?>

        <div class="post-content">
            <?php if ( $atts['location'] == 'yes' && $country ) : ?>
                <h5><?php echo $country; ?></h5>
            <?php endif; ?>

            <h3 class="post-title"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title( $post_id ); ?></a></h3>

            <?php if ( $except ) : ?>
                <p><?php echo esc_html( $except ); ?></p>
            <?php endif; ?>

            <!-- Features -->
            <?php if ( $terms && ! is_wp_error( $terms ) ) :  ?>
                <div class="features">
                    <?php foreach ( $terms as $term ) : ?>
                        <a class="feature-button" href="<?php echo esc_url( get_term_link( $term->slug, 'features' ) ); ?>"> <?php echo $term->name; ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

<!--             <?php if ($atts['direction'] == 'row') : ?>
                <div class="learn-more">
                    <a class="learn-more-button" href="#">Learn more</a>
                </div>
            <?php endif; ?> -->

        </div>
    </div>
    <!-- Slider Right Color Section -->
    <?php if( $atts['direction'] == 'column' ) :?>
        <div class="slider-right"></div>
    <?php endif; ?>
</div>