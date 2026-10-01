<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

add_action('wp_enqueue_scripts', 'rtmega_menu_wp_enqueue_scripts');
add_action( 'enqueue_block_assets', 'rtmega_menu_block_editor_styles' );
function rtmega_menu_wp_enqueue_scripts (){
    wp_enqueue_style( 'rtmegamenu-style', RTMEGA_MENU_PL_URL . 'public/assets/css/rtmega.css', array(), RTMEGA_MENU_VERSION );
    wp_enqueue_script( 'rtmegamenu-accordion-script', RTMEGA_MENU_PL_URL . 'public/assets/js/rtmega-accordion.js', array('jquery'), RTMEGA_MENU_VERSION, TRUE );
    wp_enqueue_script( 'rtmegamenu-public', RTMEGA_MENU_PL_URL . 'public/assets/js/rtmega-menu-public.js', array('jquery'), RTMEGA_MENU_VERSION, TRUE );

    // Sticky header behaviour. Previously printed as two inline <script> blocks
    // by the Elementor widget; it now keys off the rtmega-sticky-on /
    // rtmega-backscroll-on classes the widget puts on the menu container, and
    // does nothing when neither class is present.
    wp_enqueue_script( 'rtmegamenu-sticky-header', RTMEGA_MENU_PL_URL . 'public/assets/js/rtmega-sticky-header.js', array( 'jquery' ), RTMEGA_MENU_VERSION, TRUE );
}

/**
 * Load only the menu stylesheet inside the block editor so the block preview
 * stays styled. The front-end jQuery menu scripts are not needed in the editor;
 * they were previously loaded there because this hook shared the front-end
 * callback. On the front-end this hook does nothing, since the stylesheet is
 * already enqueued by rtmega_menu_wp_enqueue_scripts().
 */
function rtmega_menu_block_editor_styles (){
    if ( is_admin() ) {
        wp_enqueue_style( 'rtmegamenu-style', RTMEGA_MENU_PL_URL . 'public/assets/css/rtmega.css', array(), RTMEGA_MENU_VERSION );
    }
}