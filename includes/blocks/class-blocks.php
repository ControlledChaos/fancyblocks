<?php
/**
 * Start stacking blocks.
 *
 * @package    FancyBlocks
 * @subpackage Includes
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace FancyBlocks\Includes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Start stacking blocks.
 *
 * @since  1.0.0
 * @access public
 */
class FancyBlocks_Blocks {

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		$this->dependencies();

	}

	/**
	 * Load the required dependencies for this class.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function dependencies() {}

}

$fancyblocks_blocks = new FancyBlocks_Blocks();