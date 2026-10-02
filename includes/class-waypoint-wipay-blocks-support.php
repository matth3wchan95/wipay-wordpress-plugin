<?php
/**
 * WooCommerce Blocks integration for Waypoint WiPay.
 *
 * @package Waypoint_WiPay
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Exposes the hosted WiPay gateway to the Cart and Checkout blocks.
 */
final class Waypoint_WiPay_Blocks_Support extends \\Automattic\\WooCommerce\\Blocks\\Payments\\Integrations\\AbstractPaymentMethodType {
	/**
	 * Payment method ID; must match the WooCommerce gateway ID and JS registration.
	 *
	 * @var string
	 */
	protected $name = 'waypoint_wipay';

	/**
	 * Loads the gateway's saved settings for the Blocks API.
	 *
	 * @return void
	 */
	public function initialize() {
		$this->settings = get_option( 'woocommerce_' . $this->name . '_settings', array() );
	}

	/**
	 * Returns whether the gateway is enabled.
	 *
	 * @return bool
	 */
	public function is_active() {
		return 'yes' === $this->get_setting( 'enabled', 'no' );
	}

	/**
	 * Registers the frontend payment method script.
	 *
	 * @return string[]
	 */
	public function get_payment_method_script_handles() {
		$handle = 'waypoint-wipay-blocks';

		wp_register_script(
			$handle,
			plugins_url( 'assets/js/checkout-blocks.js', WAYPOINT_WIPAY_PLUGIN_FILE ),
			array( 'wc-blocks-registry', 'wc-settings', 'wp-element', 'wp-html-entities' ),
			WAYPOINT_WIPAY_VERSION,
			true
		);

		return array( $handle );
	}

	/**
	 * Registers the same display script in the checkout block editor.
	 *
	 * @return string[]
	 */
	public function get_payment_method_script_handles_for_admin() {
		return $this->get_payment_method_script_handles();
	}

	/**
	 * Exposes safe presentation settings to the Blocks frontend.
	 *
	 * @return array<string, mixed>
	 */
	public function get_payment_method_data() {
		return array(
			'title'       => wp_strip_all_tags( $this->get_setting( 'title', __( 'Credit card', 'waypoint-wipay' ) ) ),
			'description' => wp_kses_post( $this->get_setting( 'description', __( 'You will complete payment on WiPay’s secure hosted checkout.', 'waypoint-wipay' ) ) ),
			'supports'    => array( 'products' ),
		);
	}
}
