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

}


new OUR_SIMPLE_PLUGIN();