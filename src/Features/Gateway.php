<?php

namespace RelayPay\Features;

use RelayPay\Managers\ApiManager;
use RelayPay\Models\OrderModel;
use RelayPay\Repositories\OrderRepository;
use RelayPayDeps\RelayPay\SDK\RelayPay;
use RelayPayDeps\Wpify\PluginUtils\PluginUtils;
use WC_Order;
use WC_Payment_Gateway;
use WP_Error;

use function apply_filters;

class Gateway extends WC_Payment_Gateway {
	const NAME = 'relaypay';
	public $status_successful_payment;
	public $order_id;
	public $enabled_gopay_methods;
	private $plugin;
	private $public_key;
	private $private_key;
	private $merchant_id;
	private $environment;
	private $store_name;
	/**
	 * Order
	 *
	 * @var $order WC_Order
	 */
	public $order;

	/**
	 * Constructor for the gateway.
	 */
	public function __construct() {
		$this->id                 = self::NAME;
		$this->icon               = apply_filters( 'woocommerce_relaypay_icon', relay_pay_container()->get( PluginUtils::class )->get_plugin_url( 'assets/images/logo.svg' ) );
		$this->has_fields         = false;
		$this->method_title       = __( 'RelayPay', 'relaypay' );
		$this->method_description = __( 'RelayPay', 'relaypay' );

		// Load the settings.
		$this->init_form_fields();
		$this->init_settings();
		$this->title                     = $this->get_option( 'title' );
		$this->description               = $this->get_option( 'description' );
		$this->status_successful_payment = $this->get_option( 'status_successful_payment' );
		$this->public_key                = $this->get_option( 'public_key' );
		$this->private_key               = $this->get_option( 'private_key' );
		$this->merchant_id               = $this->get_option( 'merchant_id' );
		$this->environment               = $this->get_option( 'environment' );
		$this->store_name                = $this->get_option( 'store_name' );


		// Actions.
		add_action( "woocommerce_update_options_payment_gateways_{$this->id}", array(
			$this,
			'process_admin_options',
		) );
	}

	/**
	 * Initialize Gateway Settings Form Fields
	 */
	public function init_form_fields() {
		$wc_order_statuses = wc_get_order_statuses();

		$settings = array(
			'enabled' => array(
				'title'   => __( 'Enable/Disable', 'relaypay' ),
				'type'    => 'checkbox',
				'label'   => __( 'Enable Relaypay Payment', 'relaypay' ),
				'default' => 'yes',
			),

			'title' => array(
				'title'       => __( 'Title', 'relaypay' ),
				'type'        => 'text',
				'description' => __( 'This controls the title for the payment method the customer sees during checkout.', 'relaypay' ),
				'default'     => __( 'RelayPay', 'relaypay' ),
				'desc_tip'    => true,
			),

			'description'               => array(
				'title'       => __( 'Description', 'relaypay' ),
				'type'        => 'textarea',
				'description' => __( 'Payment method description that the customer will see on your checkout.', 'relaypay' ),
				'default'     => __( 'RelayPay', 'relaypay' ),
				'desc_tip'    => true,
			),
			'public_key'                => array(
				'title'       => __( 'Public key', 'relaypay' ),
				'type'        => 'text',
				'description' => __( 'Enter your public key.', 'relaypay' ),
				'desc_tip'    => true,
			),
			'private_key'               => array(
				'title'       => __( 'Private key', 'relaypay' ),
				'type'        => 'text',
				'description' => __( 'Enter your private key.', 'relaypay' ),
				'desc_tip'    => true,
			),
			'merchant_id'               => array(
				'title'       => __( 'MerchantID', 'relaypay' ),
				'type'        => 'text',
				'description' => __( 'Enter your merchant ID.', 'relaypay' ),
				'desc_tip'    => true,
			),
			'store_name'                => array(
				'title'       => __( 'Store name', 'relaypay' ),
				'type'        => 'text',
				'description' => __( 'Enter store name.', 'relaypay' ),
				'desc_tip'    => true,
			),
			'environment'               => array(
				'title'       => __( 'Environment', 'relaypay' ),
				'description' => __( 'Select the environment', 'relaypay' ),
				'type'        => 'select',
				'desc_tip'    => true,
				'options'     => [
					'test' => __( 'Test', 'relaypay' ),
					'live' => __( 'Live', 'relaypay' ),
				],
			),
			'status_successful_payment' => array(
				'title'       => __( 'Successful payment status', 'relaypay' ),
				'description' => __( 'Set the status to update the order to when the payment was successful.', 'relaypay' ),
				'default'     => 'wp-completed',
				'type'        => 'select',
				'desc_tip'    => true,
				'options'     => $wc_order_statuses,
			),
		);

		$this->form_fields = apply_filters( 'relay_pay_settings', $settings );
	}

	/**
	 * Process the payment and return the result
	 *
	 * @param int $order_id Order Id.
	 *
	 * @return array
	 */
	public function process_payment( $order_id ): array {
		$repository = relay_pay_container()->get( OrderRepository::class );
		$order      = $repository->get( $order_id );

		$result = $this->create_payment( $order );

		if ( is_wp_error( $result ) ) {
			wc_add_notice( $result->get_error_message(), 'error' );

			return [];
		}
		// Reduce stock levels.
		wc_reduce_stock_levels( $order->id );

		// Remove cart.
		WC()->cart->empty_cart();

		// Return thankyou redirect.
		return array(
			'result'   => 'success',
			'redirect' => $result->getRedirectionUrl(),
		);
	}


	public function create_payment( OrderModel $order, $args = array() ) {
		$args = $order->get_relay_pay_data();

		$repository  = relay_pay_container()->get( OrderRepository::class );
		$api_manager = relay_pay_container()->get( ApiManager::class );
		if ( ! $order->relaypay_hash ) {
			$order->relaypay_hash = $order->generate_hash();
			$repository->save( $order );
		}

		$args['storeName']                 = $this->store_name;
		$args['callbackUrlRedirect']       = $order->get_wc_order()->get_checkout_order_received_url();
		$args['callbackCancelUrlRedirect'] = add_query_arg( [ 'hash' => $order->relaypay_hash ], $api_manager->get_rest_url() . '/cancelled' );
		$args['webHookUrl']                = add_query_arg( [ 'hash' => $order->relaypay_hash ], $api_manager->get_rest_url() . '/order-status' );

		$args = apply_filters( 'relay_pay_payment_args', $args );

		try {
			$response = $this->get_relaypay()->ecommerce()->createTransaction( $args );
		} catch ( \RelayPayDeps\RelayPay\ApiException $e ) {
			$body = json_decode( $e->getResponseBody() );

			return new WP_Error( 'payment-error', $body->message ?? __( 'Error creating payment', 'relaypay' ) );
		}

		return $response;
	}

	/**w
	 * If There are no payment fields show the description if set.
	 * Override this in your gateway if you have some.
	 */
	public function payment_fields() { ?>
		<style style="display: none">
			.payment_method_relaypay img {
				width: 100px;
			}
		</style>
		<?php
		$description = $this->get_description();

		if ( $description ) {
			echo wpautop( wptexturize( esc_html( $description ) ) );
		}
	}


	public function get_relaypay(): RelayPay {
		return new RelayPay( $this->public_key, $this->private_key, $this->merchant_id, $this->environment === 'live' ? 'live' : 'test' );
	}
}
