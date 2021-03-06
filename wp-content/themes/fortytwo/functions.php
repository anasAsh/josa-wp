<?php
require get_stylesheet_directory() . '/inc/home-sidebars.php';
require get_stylesheet_directory() . '/inc/content-types.php';
require get_stylesheet_directory() . '/widgets/instagram-widget.php';
require get_stylesheet_directory() . '/widgets/social-widget.php';
require get_stylesheet_directory() . '/widgets/programs-widget.php';
require get_stylesheet_directory() . '/widgets/profiles-widget.php';
require get_stylesheet_directory() . '/shortcodes/widget.php';

define('ACF_EARLY_ACCESS', '5');

function understrap_remove_scripts() {
  wp_dequeue_style( 'understrap-styles' );
  wp_deregister_style( 'understrap-styles' );

  wp_dequeue_script( 'understrap-scripts' );
  wp_deregister_script( 'understrap-scripts' );

  // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

  // Get the theme data
  $the_theme = wp_get_theme();
  wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/forty-two.min.css', array(), $the_theme->get( 'Version' ) );
  wp_enqueue_script( 'jquery');
  wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), false);
  wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/forty-two.min.js', array(), $the_theme->get( 'Version' ), true );
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}

function add_child_theme_textdomain() {
  load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

function themename_custom_logo_setup() {
  $defaults = array(
    'height'    => 100,
    'width'     => 400,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
  );
  add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );