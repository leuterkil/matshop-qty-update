<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              echarissopoulos.herokuapp.com
 * @since             1.0.0
 * @package           Matshop_Products
 *
 * @wordpress-plugin
 * Plugin Name:       Matshop Products Qty
 * Plugin URI:        matshop-products-qty
 * Description:       A wordpress plugin specified for the greek site matshop.gr to show the qty of products that are in stock.
 * Version:           1.0.0
 * Author:            left4dev
 * Author URI:        echarissopoulos.herokuapp.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       matshop-products
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MATSHOP_PRODUCTS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-matshop-products-activator.php
 */
function activate_matshop_products() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-matshop-products-activator.php';
	Matshop_Products_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-matshop-products-deactivator.php
 */
function deactivate_matshop_products() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-matshop-products-deactivator.php';
	Matshop_Products_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_matshop_products' );
register_deactivation_hook( __FILE__, 'deactivate_matshop_products' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-matshop-products.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_matshop_products() {

	$plugin = new Matshop_Products();
	$plugin->run();

}
run_matshop_products();
