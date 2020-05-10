<?php
/**
 * Our Simple plugin
 *
 * @package 	ourSimplePlugin
 * @author  	MD Imtiaz
 * @copyright	2020 md imtiaz
 *
 * @wordpress-plugin
 * Plugin Name: Our Simple plugin
 * Description: This is a plugin test.
 * Author: MD Imtiaz
 * Author URI: https://wpmaestro.net/
 * Version: 1.0.0
 * Requires at least: 5.3.0
 * Tested up to: 5.4
 **/ 

class OUR_SIMPLE_PLUGIN {


	public function __construct() {
		

		add_action('init', array($this, 'init'), 10, 0);

		//testing and familiar with actions
		add_action( 'woocommerce_before_cart_table', array($this,'wpdesk_cart_free_shipping_text'), 10,0 );

		add_action( 'woocommerce_before_cart', array($this,'wooco_cart'), 10,0 );

		add_action( 'woocommerce_before_cart_table', array($this,'wooco_cart2'), 10,0 );

		add_action( 'woocommerce_cart_is_empty', array($this,'wooco_cart3'), 10,0 );
		add_action( 'woocommerce_cart_totals_after_order_total', array($this,'wooco_cart4'), 10,0 );


		add_action( 'WP_ENEQUEUE_SCRIPTS' , array($this,'my_style'), 10,0);
	}



	public function init() {
		add_filter('the_title', array($this, 'filtered_title'), 10, 2);


		add_filter('woocommerce_get_regular_price', array( $this, 'my_custom_price'), 99);
		add_filter('woocommerce_get_price', array( $this, 'my_custom_price'), 99);
		
	}


	public function filtered_title($title, $id ) {

		$product = wc_get_product( $id );

		if ( !empty($product) && $product->get_id() ) {
			return 'Product: ' . $title;
		}

		return $title;
	}

	public function my_custom_price( $original_price ) {
  		global $post, $woocommerce;

  		$new_price = $original_price * 2;

  	
  	return $new_price;
 }

public function my_style() {
	wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', array(), filemtime(get_template_directory() . '/css/style.css'), false);
}


public function wpdesk_cart_free_shipping_text() {
	echo '<div class="woocommerce-info">Free Shipping available from $29!</div>';
}

public function wooco_cart() {
	echo '<p class="woocommerce-info">I am a test action who used 	woocommerce_before_cart action</p>';
}

public function wooco_cart2() {
	echo '<p class="woocommerce-info">I am a test action as used 	woocommerce_before_cart_table action</p>';
}

public function wooco_cart3() {
 	echo '<p class="woocommerce-info para-1">I am a test action as used 	woocommerce_before_cart_table action</p>';
}

public function wooco_cart4() {
 	echo '<p href="../" class="para-1" >Ready to pay sir</p>';
}

}


new OUR_SIMPLE_PLUGIN();