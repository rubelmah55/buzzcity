<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}


// Extra post classes
$classes = array();

if(!version_compare( $woocommerce->version, '2.6', ">=" )) {

	global $woocommerce_loop;

	// Store loop count we're currently on
	if ( empty( $woocommerce_loop['loop'] ) ) {
		$woocommerce_loop['loop'] = 0;
	}

	// Store column count for displaying the grid
	if ( empty( $woocommerce_loop['columns'] ) ) {
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
	}

	// Increase loop count
	$woocommerce_loop['loop']++;

	// Extra post classes
	if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
		$classes[] = 'first';
	}
	if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
		$classes[] = 'last';
	}

} 

$options = get_nectar_theme_options(); 
$product_style = (!empty($options['product_style'])) ? $options['product_style'] : 'classic';
$classes[] = $product_style;

?>
<div <?php post_class( $classes ); ?>>

	<?php //do_action( 'woocommerce_before_shop_loop_item' ); ?>



	<div class="product-item-wrapper">
		<div class="product-item-col-4 product-image">
			<?php if(has_post_thumbnail()) : ?>
				<?php echo get_the_post_thumbnail(); ?>
			<?php else : ?>
				<img src="https://dummyimage.com/600x400/000/fff&text=Product+Image" alt="">
			<?php endif; ?>
		</div>
		<div class="product-item-col-6 product-description">
			<h2><?php the_title(); ?></h2>
			<?php

				$Bproduct = getBookableProduct($product->id); 
				$WCproduct = wc_get_product($product->id);
				$min_duration = get_post_meta($product->id, '_wc_booking_min_duration');
				$max_duration = get_post_meta($product->id, '_wc_booking_max_duration');


				
				

			 ?>
			<h4><?php echo 'Hours: ' . $min_duration[0] . ' - ' . $max_duration[0];
				echo '<span>' . 'Price: $' . $Bproduct->get_base_cost() . '</span>'; ?></h4>
			<?php echo city_limit_text($WCproduct->short_description, 200); ?>

		</div>
		<div class="product-item-col-2 product-button">
			<a href="<?php the_permalink(); ?>" class="btn book-button">Book Online</a>
		</div>
	</div>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</div>