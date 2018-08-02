<?php
/**
 * Admin notice that this plugin needs the Gutenberg plugin.
 *
 * @package    FancyBlocks
 * @subpackage Includes\Partials
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 *
 * @todo       Revisit this when the block editor is in core.
 */

namespace FancyBlocks\Includes\Partials;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} ?>
<div class="notice notice-error">
	<?php
	echo sprintf(
		'<p>FancyBlocks %1s <a href="%2s" target="_blank">Gutenberg</a> %3s</p>',
		esc_html__( 'needs the', 'fancyblocks' ),
		esc_url( 'https://wordpress.org/plugins/gutenberg/' ),
		esc_html__( 'plugin to be installed and activated.', 'fancyblocks' )
	); ?>
</div>