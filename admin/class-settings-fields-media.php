<?php
/**
 * Settings fields for media options.
 *
 * @package    FancyBlocks
 * @subpackage Admin
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace FancyBlocks\Admin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Settings fields for media options.
 *
 * @since  1.0.0
 * @access public
 */
class Settings_Fields_Media {

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

		}

		// Return the instance.
		return $instance;

	}

    /**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
    public function __construct() {

        // Media settings.
        add_action( 'admin_init', [ $this, 'settings' ] );

    }

    /**
	 * FancyBlocks media settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function settings() {

        // FancyBlocks settings section.
        add_settings_section(
            'fancyblocks-media-settings',
            __( 'FancyBlocks', 'fancyblocks' ),
            [ $this, 'fancyblocks_description' ],
            'media'
        );

        // fancyBox image block setting.
        add_settings_field(
            'fancyblocks_image',
            __( 'Use fancyBox image block', 'fancyblocks' ),
            [ $this, 'fancyblocks_image' ],
            'media', 'fancyblocks-media-settings',
            [ __( 'Adds a single image that can be opened full size.', 'fancyblocks' ) ]
        );

        register_setting(
            'media',
            'fancyblocks_image'
        );

        // fancyBox gallery block setting.
        add_settings_field(
            'fancyblocks_gallery',
            __( 'Use fancyBox gallery block', 'fancyblocks' ),
            [ $this, 'fancyblocks_gallery' ],
            'media', 'fancyblocks-media-settings',
            [ __( 'Adds an image gallery that can be opened in a slideshow.', 'fancyblocks' ) ]
        );

        register_setting(
            'media',
            'fancyblocks_gallery'
        );

    }

    /**
     * Fancybox settings description.
     *
     * @since  1.0.0
	 * @access public
	 * @return string
     */
    public function fancyblocks_description() {

        $html = sprintf(
            '<p>%1s</p>',
            esc_html__( 'Add fancyBox functionality to the block editor.', 'fancyblocks' )
        );

        echo $html;

    }

    /**
     * fancyBox image block.
     *
     * @since  1.0.0
	 * @access public
	 * @return string
     */
    public function fancyblocks_image( $args ) {

        $html = '<p><input type="checkbox" id="fancyblocks_image" name="fancyblocks_image" value="1" ' . checked( 1, get_option( 'fancyblocks_image' ), false ) . '/>';

        $html .= '<label for="fancyblocks_image"> '  . $args[0] . '</label></p>';

        echo $html;

    }

    /**
     * fancyBox gallery block.
     *
     * @since  1.0.0
	 * @access public
	 * @return string
     */
    public function fancyblocks_gallery( $args ) {

        $html = '<p><input type="checkbox" id="fancyblocks_gallery" name="fancyblocks_gallery" value="1" ' . checked( 1, get_option( 'fancyblocks_gallery' ), false ) . '/>';

        $html .= '<label for="fancyblocks_gallery"> '  . $args[0] . '</label></p>';

        echo $html;

    }

}

/**
 * Put an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function fancyblocks_settings_fields_media() {

	return Settings_Fields_Media::instance();

}

// Run an instance of the class.
fancyblocks_settings_fields_media();