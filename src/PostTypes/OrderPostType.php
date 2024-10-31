<?php

namespace RelayPay\PostTypes;

class OrderPostType {
	const KEY = 'shop_order';

	public function __construct() {
		add_filter( 'woocommerce_order_data_store_cpt_get_orders_query', array( $this, 'custom_query_vars' ), 10, 2 );
	}


	/**
	 * Handle a custom 'customvar' query var to get orders with the 'customvar' meta.
	 *
	 * @param array $query      - Args for WP_Query.
	 * @param array $query_vars - Query vars from WC_Order_Query.
	 *
	 * @return array modified $query
	 */
	function custom_query_vars( $query, $query_vars ) {
		if ( ! empty( $query_vars['relaypay_hash'] ) ) {
			$query['meta_query'][] = array(
				'key'   => '_relaypay_hash',
				'value' => esc_attr( $query_vars['relaypay_hash'] ),
			);
		}

		return $query;
	}
}
