<?php

/**
 * @link              http://www.emoxie.com
 * @since             1.0.0
 * @package           User_Allowed_Ip_Addresses
 *
 * @wordpress-plugin
 * Plugin Name:       User Allowed IP Addresses
 * Plugin URI:        http://www.emoxie.com
 * Description:       Gives the ability to restrict login access to specific IP addresses for specific users.
 * Version:           1.0.0
 * Author:            Matt Pramschufer
 * Author URI:        http://www.emoxie.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       user-allowed-ip-addresses
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-user-allowed-ip-addresses-activator.php
 */
function activate_user_allowed_ip_addresses() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-user-allowed-ip-addresses-activator.php';
	User_Allowed_Ip_Addresses_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-user-allowed-ip-addresses-deactivator.php
 */
function deactivate_user_allowed_ip_addresses() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-user-allowed-ip-addresses-deactivator.php';
	User_Allowed_Ip_Addresses_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_user_allowed_ip_addresses' );
register_deactivation_hook( __FILE__, 'deactivate_user_allowed_ip_addresses' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-user-allowed-ip-addresses.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_user_allowed_ip_addresses() {

	$plugin = new User_Allowed_Ip_Addresses();
	$plugin->run();

}
run_user_allowed_ip_addresses();
