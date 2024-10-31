<?php

namespace RelayPay;

use RelayPay\Managers\ApiManager;
use RelayPay\Managers\FeaturesManager;
use RelayPay\Managers\PostTypesManager;
use RelayPay\Managers\RepositoryManager;

final class Plugin {
	public function __construct(
		RepositoryManager $repository_manager,
		ApiManager $api_manager,
		PostTypesManager $post_types_manager,
		FeaturesManager $features_manager
	) {
	}

	/**
	 * @param bool $network_wide
	 */
	public function activate( bool $network_wide ) {
	}

	/**
	 * @param bool $network_wide
	 */
	public function deactivate( bool $network_wide ) {
	}

	/**
	 *
	 */
	public function uninstall() {
	}
}
