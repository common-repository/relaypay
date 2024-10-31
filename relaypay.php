<?php

/*
 * Plugin Name:       RelayPay WooCommerce
 * Description:       Official RelayPay integration for WooCommerce
 * Version:           2.0.2
 * Requires PHP:      8.0.0
 * Requires at least: 6.0.0
 * Author:            RelayPay
 * Author URI:        https://www.relaypay.io/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       relaypay
 * Domain Path: /languages
*/

use Automattic\WooCommerce\Utilities\FeaturesUtil;
use RelayPay\Plugin;
use RelayPayDeps\DI\Container;
use RelayPayDeps\DI\ContainerBuilder;

if ( ! defined( 'RELAY_PAY_MIN_PHP_VERSION' ) ) {
	define( 'RELAY_PAY_MIN_PHP_VERSION', '8.0.0' );
}

/**
 * @return Plugin
 * @throws Exception
 */
function relay_pay(): Plugin {
	return relay_pay_container()->get( Plugin::class );
}

/**
 * @return Container
 * @throws Exception
 */
function relay_pay_container(): Container {
	static $container;

	if ( empty( $container ) ) {
		$definition       = require_once __DIR__ . '/config.php';
		$containerBuilder = new ContainerBuilder();
		$containerBuilder->addDefinitions( $definition );
		$container = $containerBuilder->build();
	}

	return $container;
}

function relay_pay_activate( $network_wide ) {
	relay_pay()->activate( $network_wide );
}

function relay_pay_deactivate( $network_wide ) {
	relay_pay()->deactivate( $network_wide );
}

function relay_pay_uninstall() {
	relay_pay()->uninstall();
}

function relay_pay_php_upgrade_notice() {
	$info = get_plugin_data( __FILE__ );

	echo sprintf(
		__( '<div class="error notice"><p>Opps! %s requires a minimum PHP version of %s. Your current version is: %s. Please contact your host to upgrade.</p></div>', 'relaypay' ),
		$info['Name'],
		RELAY_PAY_MIN_PHP_VERSION,
		PHP_VERSION
	);
}

function relay_pay_php_vendor_missing() {
	$info = get_plugin_data( __FILE__ );

	echo sprintf(
		__( '<div class="error notice"><p>Opps! %s is corrupted it seems, please re-install the plugin.</p></div>', 'relaypay' ),
		$info['Name']
	);
}

if ( version_compare( PHP_VERSION, RELAY_PAY_MIN_PHP_VERSION ) < 0 ) {
	add_action( 'admin_notices', 'relay_pay_php_upgrade_notice' );
} else {
	$deps_loaded   = false;
	$vendor_loaded = false;

	$deps = array_filter( array( __DIR__ . '/deps/scoper-autoload.php', __DIR__ . '/deps/autoload.php' ), function ( $path ) {
		return file_exists( $path );
	} );

	foreach ( $deps as $dep ) {
		include_once $dep;
		$deps_loaded = true;
	}

	if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
		include_once __DIR__ . '/vendor/autoload.php';
		$vendor_loaded = true;
	}

	if ( $deps_loaded && $vendor_loaded ) {
		add_action( 'plugins_loaded', 'relay_pay', 5 );
		register_activation_hook( __FILE__, 'relay_pay_activate' );
		register_deactivation_hook( __FILE__, 'relay_pay_deactivate' );
		register_uninstall_hook( __FILE__, 'relay_pay_uninstall' );
	} else {
		add_action( 'admin_notices', 'relay_pay_php_vendor_missing' );
	}
}

add_action( 'before_woocommerce_init', function() {
	if ( class_exists( FeaturesUtil::class ) ) {
		FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
	}
} );
