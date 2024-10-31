<?php

namespace RelayPay\Repositories;

use RelayPay\Models\OrderModel;
use Automattic\WooCommerce\Utilities\OrderUtil;

/**
 * @method OrderModel get( $object = null )
 */
class OrderRepository extends \RelayPayDeps\Wpify\Model\OrderRepository {
	/**
	 * @inheritDoc
	 */
	public function model(): string {
		return OrderModel::class;
	}

	public function get_by_hash( $hash ): ?OrderModel {
		if ( OrderUtil::custom_orders_table_usage_is_enabled() ) {
			$args = array(
				'meta_query' => array(
					array(
						'key'   => 'relaypay_hash',
						'value' => $hash,
					),
				),
			);
		} else {
			$args = array(
				'relaypay_hash' => $hash,
			);
		}

		$items = $this->find( $args );;

		return ! empty( $items ) ? $items[0] : null;
	}
}
