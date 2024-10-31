<?php

namespace RelayPay\Models;

use RelayPay\Repositories\OrderRepository;
use RelayPayDeps\Wpify\Model\Attributes\Meta;
use RelayPayDeps\Wpify\Model\Order;

/**
 * @method OrderRepository model_repository()
 */
class OrderModel extends Order {
	#[Meta('_relaypay_sign')]
	public ?string $relaypay_sign;

	#[Meta('_relaypay_hash')]
	public ?string $relaypay_hash;

	public function get_relay_pay_data() {
		$wc_order = $this->get_wc_order();
		$data     = [
			'amount'        => floatval( $wc_order->get_total() ),
			'customerName'  => $wc_order->get_formatted_billing_full_name(),
			'customerEmail' => $wc_order->get_billing_email(),
			'storeName'     => 'Store24',
			'currency'      => $wc_order->get_currency(),
			'orderId'       => $wc_order->get_id(),
			'securityToken' => $this->relaypay_hash,
		];

		return apply_filters( 'relay_pay_order_data', $data, $wc_order, $this );
	}

	public function generate_hash() {
		return substr( str_replace( [ '+', '/', '=' ], '', base64_encode( random_bytes( 32 ) ) ), 0, 32 );
	}
}
