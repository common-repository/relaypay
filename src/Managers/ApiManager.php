<?php

namespace RelayPay\Managers;

use RelayPay\Api\RelayPayApi;

final class ApiManager {
	public const REST_NAMESPACE = 'relaypay/v1';

	public function __construct(
		RelayPayApi $relay_pay_api
	) {
	}

	public function get_rest_url() {
		return rest_url( $this->get_rest_namespace() );
	}

	public function get_rest_namespace() {
		return self::REST_NAMESPACE;
	}
}
