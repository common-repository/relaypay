<?php

namespace RelayPay\Api;

use RelayPay\Gateway;
use RelayPay\Managers\ApiManager;
use RelayPay\Repositories\OrderRepository;
use RelayPayDeps\RelayPay\Model\EcommerceMerchantTransaction;
use WP_Error;
use WP_REST_Controller;
use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;

class RelayPayApi extends WP_REST_Controller {
	/** @var string */
	protected $namespace = 'relaypay/v1';

	/** @var string */
	protected $nonce_action = 'wp_rest';

	public function __construct(
		private OrderRepository $order_repository
	) {
		add_action( 'rest_api_init', [ $this, 'register_routes' ] );
	}

	/**
	 * Register the routes for the objects of the controller.
	 */
	public function register_routes() {
		register_rest_route(
			ApiManager::REST_NAMESPACE,
			'order-status',
			array(
				array(
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'handle_webhook' ),
					'permission_callback' => '__return_true',
					'args'                => [
						'hash' => [
							'required' => true,
						],
					],
				),
			)
		);
		register_rest_route(
			ApiManager::REST_NAMESPACE,
			'cancelled',
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'handle_cancelled' ),
					'permission_callback' => '__return_true',
				),
			)
		);
	}

	/**
	 * Handle webhook
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 *
	 * @return WP_Error|WP_REST_Response
	 */
	public function handle_webhook( $request ) {
		/** @var Gateway $gateway */
		$gateway = $this->get_gateway();
		// Gateway not active
		if ( ! $gateway ) {
			return new WP_Error( 'gateway-not-active', 'Gateway not active', [ 'status' => 200 ] );
		}

		if ( ! $request->get_header( 'sign' ) ) {
			return new WP_Error( 'no-sign', __( 'No sign', 'relaypay' ), [ 'status' => 200 ] );
		}

		$order = $this->order_repository->get_by_hash( $request->get_param( 'hash' ) );

		//file_put_contents( __DIR__ . '/log.txt', json_encode( [ 'order_id' => $order->get_id() ] ) . "\n", FILE_APPEND );

		if ( ! $order ) {
			return new WP_Error( 'order-not-found', __( 'Order not found', 'relaypay' ), [ 'status' => 200 ] );
		}

		// Validate signature
		if ( ! $gateway->get_relaypay()->ecommerce()->validateSignature( $request->get_body(), $request->get_header( 'sign' ) ) ) {
			return new WP_Error( 'invalid-signature', __( 'Invalid sign', 'relaypay' ), [ 'status' => 200 ] );
		}

		$body   = json_decode( $request->get_body() );
		$status = $body->orderStatus;

		if ( $status === EcommerceMerchantTransaction::ORDER_STATUS_CANCELLED || $status === EcommerceMerchantTransaction::ORDER_STATUS_FAILED ) {
			$order->wc_order->update_status( 'failed' );
		} elseif ( $status === EcommerceMerchantTransaction::ORDER_STATUS_SUCCESS ) {
			$successful_payment_status = $this->get_gateway()->status_successful_payment;
			if ( $successful_payment_status ) {
				$order->wc_order->update_status( $successful_payment_status );
			}
		}

		return new WP_REST_Response( array( 'status' => 'success' ) );
	}

	/**
	 * Handle cancelled payment
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 *
	 * @return void
	 */
	public function handle_cancelled( $request ) {
		$order = $this->order_repository->get_by_hash( $request->get_param( 'hash' ) );
		if ( ! $order ) {
			wp_die( __( 'Order not found', 'relaypay' ) );
		}

		$order->wc_order->update_status( 'failed' );
		wp_redirect( $order->wc_order->get_checkout_order_received_url() );
		exit();
	}


	/**
	 * Check if a given request has access to create items
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 *
	 * @return bool
	 */
	public function create_item_permissions_check( $request ) {
		return true;
	}


	/**
	 * Prepare the item for the REST response
	 *
	 * @param mixed           $item    WordPress representation of the item.
	 * @param WP_REST_Request $request Request object.
	 *
	 * @return mixed
	 */
	public function prepare_item_for_response( $item, $request ) {
		return array();
	}

	/**
	 * Get the gateway
	 *
	 * @return mixed|null
	 */
	public function get_gateway() {
		$gateways = WC()->payment_gateways()->payment_gateways();

		return ! empty( $gateways['relaypay'] ) ? $gateways['relaypay'] : null;
	}
}
