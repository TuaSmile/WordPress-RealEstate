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

$categories = get_categories( array(
    'taxonomy'   => 'category', 
    'orderby'    => 'name',
    'parent'     => 0,
    'hide_empty' => 0, 
) );

?>

<div class="single-real-estate real-estate-grid">
    
    <!-- Post Thumnbnail -->
    <?php if ( has_post_thumbnail( $post_id ) ) : ?>
        <div class="post-thumbnail-grid-container">
            <div class="post-thumbnail">
                <?php echo get_the_post_thumbnail( $post_id, 'full' ); ?>
            </div>
            <?php if( $atts['fractional'] =='yes') : ?>
                <div class="fractional-image">    
                    <img src="http://localhost/test/wp-content/uploads/2024/10/Fraction-badge.png" />
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Post Content -->
    <div class="post-content">
        <?php if ( $atts['location'] == 'yes' && $country ) : ?>
            <h6><?php echo $country; ?></h6>
        <?php endif; ?>

        <h3 class="post-title"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title( $post_id ); ?></a></h3>

        <?php if ( $except ) : ?>
            <p><?php echo esc_html( $except ); ?></p>
        <?php endif; ?>

        <?php if ( $price && $atts['price'] == 'yes' ) : ?>
            <h6>FROM USD $<?php echo esc_html( $price ); ?></h6>
        <?php endif; ?>
        
        <?php if ( !empty( get_the_content( $post_id ) ) ) : ?>
            <div class="content"><?php echo get_the_content( $post_id ); ?></div>
        <?php endif; ?>
    </div>
    
</div>