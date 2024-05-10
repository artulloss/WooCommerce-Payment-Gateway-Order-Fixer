<?php

declare(strict_types=1);

namespace WooCommercePaymentGatewayOrderFixer;

use WC_Payment_Gateways;

/**
 * @link              https://artulloss.dev
 * @since             1.0.0
 * @package           Woocommerce_Payment_Gateway_Order_Fixer
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Payment Gateway Order Fixer
 * Plugin URI:        https://github.com/artulloss/WooCommerce-Payment-Gateway-Order-Fixer
 * Description:       Is a misbehaving plugin overriding the order of your payment gateways? This will fix it!
 * Version:           1.0.0
 * Author:            Adam Tulloss
 * Author URI:        https://artulloss.dev/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-payment-gateway-order-fixer
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// This is the maximum priority, so it should always run last. This plugin does nothing else so this is very important.
add_filter('woocommerce_available_payment_gateways', __NAMESPACE__ . '\fix_payment_gateway_order', PHP_INT_MAX);

function bigcity_fix_payment_gateway_order(array $gateways): array {
    $all_gateways = WC_Payment_Gateways::instance()->payment_gateways;
    $filtered_gateways = [];
    foreach($all_gateways as $gateway) {
        if(isset($gateways[$gateway->id])) {
            $filtered_gateways[$gateway->id] = $gateways[$gateway->id];
        }
    }
    return $filtered_gateways;
}
