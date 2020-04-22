<?php

/**
 * @link              https://reslab.tech
 * @since             1.0.0
 * @package           Epb
 *
 * @wordpress-plugin
 * Plugin Name:       Express Pay Buttons
 * Plugin URI:        https://academweb.com
 * Description:       PayPal and Stripe buttons for express pay
 * Version:           1.0.0
 * Author:            Andrew A. Chuev
 * Author URI:        https://reslab.tech/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       epb
 * Domain Path:       /languages
 */


if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'EPB_VERSION', '1.0.0' );

function activate_epb() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-epb-activator.php';
	Epb_Activator::activate();
}

function deactivate_epb() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-epb-deactivator.php';
	Epb_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_epb' );
register_deactivation_hook( __FILE__, 'deactivate_epb' );

require plugin_dir_path( __FILE__ ) . 'includes/class-epb.php';

function run_epb() {
	$plugin = new Epb();
	$plugin->run();

}

run_epb();
