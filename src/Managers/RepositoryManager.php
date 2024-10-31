<?php

namespace RelayPay\Managers;

use RelayPay\Repositories\OrderRepository;
use RelayPayDeps\Wpify\Model\Manager;

class RepositoryManager {
	public function __construct(
		private Manager $manager,
		OrderRepository $order_repository
	) {
		$this->manager->register_repository( $order_repository );
	}
}
