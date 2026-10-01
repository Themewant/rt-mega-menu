<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// register category
function rtmega_block_categories( $block_categories, $editor_context ) {
    ///if ( ! empty( $editor_context->post ) ) {
       $attr = array(
            array(
                'slug'  => 'rt-mega-menu',
                'title' => __( 'RT Mega Menu', 'rt-mega-menu' ),
            )
        );
        $block_categories =  array_merge( $attr, $block_categories );
	   
   //}
    return $block_categories;
}

add_filter( 'block_categories_all', 'rtmega_block_categories', 999999, 2 );

function rtmega_register_blocks() {
	if ( function_exists( 'register_block_type' ) ) {
		register_block_type( RTMEGA_MENU_PL_PATH . 'public/blocks/rt-mega-menu/build' );
	}
}
add_action( 'init', 'rtmega_register_blocks' );

add_action( 'enqueue_block_editor_assets', 'rtmega_block_mobile_menu_notice_script' );

/**
 * Registers a dependency-only handle for the block editor.
 *
 * Do not remove it: rt-mega-menu-pro lists 'rtmega-block-mobile-menu-notice' as a
 * dependency of its own editor script, so dropping the handle would stop Pro's
 * Mobile Menu control from loading for existing customers.
 */
function rtmega_block_mobile_menu_notice_script() {
	wp_register_script(
		'rtmega-block-mobile-menu-notice',
		false,
		[ 'wp-hooks', 'wp-element', 'wp-block-editor', 'wp-components' ],
		RTMEGA_MENU_VERSION,
		true
	);
	wp_enqueue_script( 'rtmega-block-mobile-menu-notice' );
}
