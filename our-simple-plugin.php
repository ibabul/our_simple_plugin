<?php
/**
 * Our Simple plugin
 *
 * @package   ourSimplePlugin
 * @author    MD Imtiaz
 * @copyright 2020 md imtiaz
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

 define( 'OUR_SIMPLE_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
 define( 'OUR_SIMPLE_PLUGIN_VERSION', '1.0.0.' );

class OUR_SIMPLE_PLUGIN {




	/**
	 * @return void
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ), 10, 0 );
	}


	/**
	 * @return void
	 */
	public function init() {
		add_filter( 'the_title', array( $this, 'filtered_title' ), 10, 2 );

		add_filter( 'woocommerce_get_regular_price', array( $this, 'my_custom_price' ), 99 );
		add_filter( 'woocommerce_get_price', array( $this, 'my_custom_price' ), 99 );

		// testing and familiar with actions.
		add_action( 'woocommerce_before_cart_table', array( $this, 'wpdesk_cart_free_shipping_text' ), 10, 0 );

		add_action( 'woocommerce_before_cart', array( $this, 'wooco_cart' ), 10, 0 );

		add_action( 'woocommerce_before_cart_table', array( $this, 'wooco_cart2' ), 10, 0 );

		add_action( 'woocommerce_cart_is_empty', array( $this, 'wooco_cart3' ), 10, 0 );
		add_action( 'woocommerce_cart_totals_after_order_total', array( $this, 'wooco_cart4' ), 10, 0 );

		add_filter( 'admin_footer_text', array( $this, 'footer_manupulation' ), 10, 1 );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_plugin_styles' ), 10, 0 );

	}


	/** to target each product title of woocommerce with product id
	 *
	 * @param STRING  $title
	 * @param INTEGER $id
	 *
	 * @return STRING
	 */
	public function filtered_title( $title, $id ) {

		$product = wc_get_product( $id );

		if ( ! empty( $product ) && $product->get_id() ) {
			return 'Product: ' . $title;
		}

		return $title;
	}

	/**
	 * To manupulate original product price of woocommerce
	 *
	 * @param INTEGER $original_price
	 *
	 * @return MIXED
	 */

	public function my_custom_price( $original_price ) {
		global $post, $woocommerce;

		$new_price = $original_price;
		return $new_price;
	}
 


	/** adding stylesheet
	 *
	 * @return style
	 */
	public function enqueue_plugin_styles() {
		wp_register_style( 'our-custom-plugin-style', OUR_SIMPLE_PLUGIN_URI . '/css/custom_style.css', array(), OUR_SIMPLE_PLUGIN_VERSION );
		wp_enqueue_style( 'our-custom-plugin-style' );
	}


	/** Adding   text
	 *
	 * @return STRING
	 */
	public function wpdesk_cart_free_shipping_text() {
		echo '<div class="woocommerce-info">Free Shipping available from $29!</div>';
	}

	/** Adding a text before cart action
	 *
	 * @return string;
	 */
	public function wooco_cart() {
		echo '<p class="woocommerce-info">I am a test action who used woocommerce_before_cart action</p>';
	}

	/** Adding text before cart action
	 *
	 * @return string
	 */
	public function wooco_cart2() {
		echo '<p class="woocommerce-info para-2">I am a test action as used woocommerce_before_cart_table action</p>';
	}


	public function wooco_cart3() {
		echo '<p class="woocommerce-info para-1">I am a test action as used woocommerce_before_cart_table action</p>';
	}

	public function wooco_cart4() {
		echo '<p href="../" class="para-1" >Ready to pay</p>';
	}


	public function footer_manupulation( $string ) {
		echo( 'test' );
		die;
		$string .= 'I am taking footer alng with me';
		return $string;
	}
}


new OUR_SIMPLE_PLUGIN();
