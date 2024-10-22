<?php
/**
 * The template for single real estates
 */

$post_id = $args['post_id'];
$atts = $args['atts'];
$categories = $args['categories'];


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

?>

<div class="single-real-estate real-estate-direction-<?php echo $atts['direction']; ?> <?php if( $atts['display_type'] == 'slider' &&  $atts['direction'] == 'row' ) : ?> <?php echo 'slider-flex' ?> <?php endif; ?>">
    
    <!-- Slider Image -->
    <?php if ( has_post_thumbnail( $post_id ) ) : ?>
         <?php if ( $atts['display_type'] == 'grid' ) : ?>
          <div class="post-thumbnail  <?php if( $atts['display_type'] == 'slider' ) : ?> <?php echo 'post-thumbnail-width' ?> <?php endif; ?>"><?php echo get_the_post_thumbnail( $post_id, 'full' ); ?> </div>
        <?php endif; ?>

        <?php if ( $atts['display_type'] == 'slider' ) : ?>
          <div class="post-content-container-left"></div>
          <div class="post-content-container-center">
          <div class="post-thumbnail  <?php if( $atts['display_type'] == 'slider' ) : ?> <?php echo 'post-thumbnail-width' ?> <?php endif; ?>"><?php echo get_the_post_thumbnail( $post_id, 'full' ); ?> </div>
         <?php endif; ?>

    <?php endif; ?>

    <div class="single-real-estate post-content <?php if( $atts['display_type'] == 'slider' ) : ?> <?php echo 'post-content-width' ?> <?php endif; ?> ">
        <?php if ( $atts['display_type'] == 'grid' ) : ?>
            <?php if ( $atts['location'] == 'yes' ) : ?>
                <h6> ST.KITS </h6>
            <?php endif; ?>

            <h5><?php echo get_the_title( $post_id ); ?></h5>

            <?php if ( $except ) : ?>
                <p><?php echo esc_html( $except ); ?></p>
            <?php endif; ?>

            <?php if ( $price && $atts['price'] == 'yes' ) : ?>
                <h6>FROM USD $<?php echo esc_html( $price ); ?></h6>
            <?php endif; ?>
        <?php endif; ?>
       
        <!-- Slider Content -->
        <div class="slider-content"> 
            <?php if ( $atts['display_type'] == 'slider' ) : ?>
                <h5><?php echo "Tamarindo Real Estate"; ?></h5>
                <h2><?php echo "Hacienda Pinilla"; ?></h2>
                <p><?php echo "A 4,500-acre beachfront gated community located near Tamarindo, Hacienda Pinilla offers luxury homes, villas, and condos with access to a world-class golf course, equestrian center, private beach club, and 3 miles of pristine coastline.
                Highlights: Beachfront estates, golf course residences, luxury amenities, 24/7 security, and access to JW Marriott amenities."; ?>
                </p>

                <!-- Slider Content Features(Categories) -->
                <?php 
                    $counter = 0;
                    echo '<div class="slider-features-first-two-categories">';
                    foreach ( $categories as $category ) {
                        $category_name = $category->name;
                        if ( $counter < 2 ) {
                            echo '<button class="slider-features-button">' . esc_html( $category_name ) . '</button> ';
                        }
                        $counter++;
                    } 
                    echo '</div>';
                    echo '<div class="slider-features-other-categories">';
                    $counter = 0;
                    foreach ( $categories as $category ) {
                        $category_name = $category->name;

                        if ( $counter >= 2 ) {
                            echo '<button class="slider-features-button">' . esc_html( $category_name ) . '</button> ';
                        }
                        $counter++;
                    }
                    echo '</div>';
                ?>
            <?php endif; ?>
        </div>
        <div class="content"><?php echo get_the_content( $post_id ); ?></div>
    </div>
    <?php if ( $atts['display_type'] == 'slider' ) : ?>
        <?php echo '</div>' ?>
          <div class="post-content-container-right"></div>
     <?php endif; ?>
</div>