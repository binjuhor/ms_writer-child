<?php
/**
 * Enqueue script for child theme.
 * 
 * @author Binjuhor - <binjuhor@gmail.com>
 * @version 1.0.0
 */
 function binjuhor_enqueue_js()
 {
    wp_enqueue_script( 'binjuhor_custom_script', get_stylesheet_directory_uri() . '/js/binjuhor.js', 'jquery', '1.0.0', true );
 }
 add_action( 'wp_enqueue_scripts', 'binjuhor_enqueue_js' );