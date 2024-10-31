<?php


namespace RelayPay\Features;

class WooCommerce {
	public function __construct() {
		add_filter( 'woocommerce_payment_gateways', array( $this, 'add_gateway' ) );
		add_action( 'woocommerce_blocks_loaded', array( $this, 'block_support' ) );
	}

	/**
	 * Add gateway
	 *
	 * @param array $gateways Array of available gateways.
	 *
	 * @return array
	 */
	public function add_gateway( array $gateways ): array {
		$gateways[] = Gateway::class;

		return $gateways;
	}

	public function block_support(  ) {
		if ( class_exists( 'Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType' ) ) {
			add_action(
				'woocommerce_blocks_payment_method_type_registration',
				function ( \Automattic\WooCommerce\Blocks\Payments\PaymentMethodRegistry $payment_method_registry ) {
					$payment_method_registry->register( new CheckoutIntegration() );
				}
			);
		}
	}

}
