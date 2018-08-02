<?php
/**
 * FancyBlocks plugin
 *
 * @package           FancyBlocks
 * @version           1.0.0
 * @author            Greg Sweet <greg@ccdzine.com>
 * @copyright         Copyright © 2018, Greg Sweet
 * @link              https://github.com/ControlledChaos/fancyblocks
 * @license           GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 *
 * Plugin Name:       FancyBlocks
 * Plugin URI:        https://github.com/ControlledChaos/fancyblocks
 * Description:       Fancybox images, galleries and modals in the WordPress block editor.
 * Version:           1.0.0
 * Author:            Controlled Chaos Design
 * Author URI:        http://ccdzine.com/
 * License:           GPL-3.0+
 * License URI:       https://www.gnu.org/licenses/gpl.txt
 * Text Domain:       fancyblocks
 * Domain Path:       /languages
 * Requires at least: 4.9
 * Tested up to:      4.9.8 beta
 * Requires PHP:      5.4
 */

/*
Controlled Chaos Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Controlled Chaos Plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Controlled Chaos Plugin. If not, see {URI to Plugin License}.
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Get plugins path to check for the Gutenberg plugin.
 *
 * @since 1.0.0
 * @todo  Revisit this when the block editor is in core.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Bail if Gutenberg is not active.
 *
 * @since 1.0.0
 * @todo  Revisit this when the block editor is in core.
 */
if ( ! is_plugin_active( 'gutenberg/gutenberg.php' ) ) {
	return;
}

/**
 * The core plugin class.
 *
 * Defines constants, gets the initialization class file
 * plus the activation and deactivation classes.
 *
 * @since  1.0.0
 * @access public
 */
final class FancyBlocks {

	/**
	 * Get an instance of the class.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns the instance.
	 */
	public static function instance() {

		// Varialbe for the instance to be used outside the class.
		static $instance = null;

		if ( is_null( $instance ) ) {

			// Set variable for new instance.
			$instance = new self;

			// Define plugin constants.
			$instance->constants();

			// Require the core plugin class files.
			$instance->dependencies();

		}

		// Return the instance.
		return $instance;

	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void Constructor method is empty.
	 */
	private function __construct() {}

	/**
	 * Throw error on object clone.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __clone() {

		// Cloning instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, __( 'This is not allowed.', 'fancyblocks' ), '1.0.0' );

	}

	/**
	 * Disable unserializing of the class.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __wakeup() {

		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, __( 'This is not allowed.', 'fancyblocks' ), '1.0.0' );

	}

	/**
	 * Define plugin constants.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function constants() {

		/**
		 * Plugin version number.
		 *
		 * @since  1.0.0
		 * @return string Returns the latest plugin version.
		 */
		if ( ! defined( 'FANCYBLOCKS_VERSION' ) ) {
			define( 'FANCYBLOCKS_VERSION', '1.0.0' );
		}

		/**
		 * Plugin directory path.
		 *
		 * @since  1.0.0
		 * @return string Returns the filesystem directory path (with trailing slash)
		 *                for the plugin __FILE__ passed in.
		 */
		if ( ! defined( 'FANCYBLOCKS_PATH' ) ) {
			define( 'FANCYBLOCKS_PATH', plugin_dir_path( __FILE__ ) );
		}

		/**
		 * Plugin directory URL.
		 *
		 * @since  1.0.0
		 * @return string Returns the URL directory path (with trailing slash)
		 *                for the plugin __FILE__ passed in.
		 */
		if ( ! defined( 'FANCYBLOCKS_URL' ) ) {
			define( 'FANCYBLOCKS_URL', plugin_dir_url( __FILE__ ) );
		}

	}

	/**
	 * Require the core plugin class files.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void Gets the file which contains the core plugin class.
	 */
	private function dependencies() {

		// The hub of all other dependency files.
		require_once FANCYBLOCKS_PATH . 'includes/class-init.php';

		// Include the activation class.
		require_once FANCYBLOCKS_PATH . 'includes/class-activate.php';

		// Include the deactivation class.
		require_once FANCYBLOCKS_PATH . 'includes/class-deactivate.php';

	}

}
// End core plugin class.

/**
 * Put an instance of the plugin class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns the instance of the `FancyBlocks` class.
 */
function fancyblocks() {

	return FancyBlocks::instance();

}

// Begin plugin functionality.
fancyblocks();

/**
 * Register the activaction & deactivation hooks.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
register_activation_hook( __FILE__, '\fancyblocks_activate_plugin' );
register_deactivation_hook( __FILE__, '\fancyblocks_deactivate_plugin' );

/**
 * The code that runs during plugin activation.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function fancyblocks_activate_plugin() {

	// Run the activation class.
	fancyblocks_activate();

}

/**
 * The code that runs during plugin deactivation.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function fancyblocks_deactivate_plugin() {

	// Run the deactivation class.
	fancyblocks_deactivate();

}

/**
 * Add a link to the media settings screen from the plugins screen.
 *
 * @param  array $links Default plugin links on the 'Plugins' admin page.
 * @since  1.0.0
 * @access public
 * @return mixed[] Returns an HTML string for the settings page link.
 *                 Returns an array of the settings link with the default plugin links.
 */
function fancyblocks_settings_link( $links ) {

	// Create new settings link array as a variable.
	$media = [
		sprintf(
			'<a href="%1s" class="fancyblocks-settings-link">%2s</a>',
			admin_url( 'options-media.php' ),
			esc_attr( 'Settings', 'fancyblocks' )
		),
	];

	// Merge the new settings array with the default array.
	return array_merge( $media, $links );

}
// Filter the default settings links with new array.
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'fancyblocks_settings_link' );