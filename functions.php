<?php
/**
 * Enqueue script for child theme.
 * 
 * @author Binjuhor - <binjuhor@gmail.com>
 * @version 1.0.0
 */
 function binjuhor_enqueue_js()
 {
    wp_enqueue_script( 'binjuhor_sticker_news', get_stylesheet_directory_uri() . '/js/jquery.newsTicker.min.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'binjuhor_custom_script', get_stylesheet_directory_uri() . '/js/binjuhor.js', array('jquery'), '1.0.0', true );
 }
 add_action( 'wp_enqueue_scripts', 'binjuhor_enqueue_js' );

 include (get_stylesheet_directory().'/inc/lastest_post_widget.php');
  