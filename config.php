<?php

use RelayPayDeps\DI\Definition\Helper\CreateDefinitionHelper;
use RelayPayDeps\Wpify\Model\Manager;
use RelayPayDeps\Wpify\PluginUtils\PluginUtils;

return array(
	PluginUtils::class       => ( new CreateDefinitionHelper() )
		->constructor( __DIR__ . '/relaypay.php' ),
	Manager::class => ( new CreateDefinitionHelper() )
		->constructor( [] )
);
