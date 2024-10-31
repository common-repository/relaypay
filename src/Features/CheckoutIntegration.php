<?php

namespace RelayPay\Features;

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;
use RelayPayDeps\Wpify\Asset\AssetFactory;
use RelayPayDeps\Wpify\PluginUtils\PluginUtils;

class CheckoutIntegration extends AbstractPaymentMethodType {
	/**
	 * The gateway instance.
	 *
	 * @var Gateway
	 */
	private $gateway;

	/**
	 * Payment method name/id/slug.
	 *
	 * @var string
	 */
	protected $name = Gateway::NAME;

	/**
	 * Initializes the payment method type.
	 */
	public function initialize() {
		$this->settings = get_option( 'woocommerce_' . $this->name . '_settings', [] );
		$this->gateway  = new Gateway();
	}

	/**
	 * Returns if this payment method should be active. If false, the scripts will not be enqueued.
	 *
	 * @return boolean
	 */
	public function is_active() {
		return $this->gateway->is_available();
	}

	/**
	 * Returns an array of scripts/handles to be registered for this payment method.
	 *
	 * @return array
	 */
	public function get_payment_method_script_handles() {
		$utils         = relay_pay_container()->get( PluginUtils::class );
		$asset_factory = relay_pay_container()->get( AssetFactory::class );

		$asset_factory->wp_script(
			$utils->get_plugin_path( 'build/gateway.js' ),
			array(
				'do_enqueue' => '__return_false',
				'handle'     => 'relaypay-gateway-blocks',
				'in_footer'  => true,
			)
		);

		if ( function_exists( 'wp_set_script_translations' ) ) {
			wp_set_script_translations( 'relaypay-gateway-blocks', 'relaypay', $utils->get_plugin_path( 'languages' ) );
		}

		return array( 'relaypay-gateway-blocks' );
	}

	/**
	 * Returns an array of key=>value pairs of data made available to the payment methods script.
	 *
	 * @return array
	 */
	public function get_payment_method_data() {
		return array(
			'title'       => $this->get_setting( 'title' ),
			'description' => $this->get_setting( 'description' ),
			'supports'    => array_filter( $this->gateway->supports, array( $this->gateway, 'supports' ) ),
		);
	}
}



