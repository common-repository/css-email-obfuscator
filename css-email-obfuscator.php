<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://blog.kastner.wtf/
 * @since             1.0.0
 * @package           Css_Email_Obfuscator
 *
 * @wordpress-plugin
 * Plugin Name:       CSS Email Obfuscator
 * Plugin URI:        https://blog.kastner.wtf/
 * Description:       Shortcode for simple email address obfuscation using CSS.
 * Version:           1.0.0
 * Author:            Cedric Kastner
 * Author URI:        https://blog.kastner.wtf/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       css-email-obfuscator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-css-email-obfuscator-activator.php
 */
function activate_css_email_obfuscator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-css-email-obfuscator-activator.php';
	Css_Email_Obfuscator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-css-email-obfuscator-deactivator.php
 */
function deactivate_css_email_obfuscator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-css-email-obfuscator-deactivator.php';
	Css_Email_Obfuscator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_css_email_obfuscator' );
register_deactivation_hook( __FILE__, 'deactivate_css_email_obfuscator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-css-email-obfuscator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_css_email_obfuscator() {

	$plugin = new Css_Email_Obfuscator();
	$plugin->run();

}
run_css_email_obfuscator();
