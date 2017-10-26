<?php
/*
Author: Jay Deutsch @jaycbrf4
*/


// Cleaning up the Wordpress Head
function JD_bootstrap_head_cleanup() {
  // remove header links
  remove_action( 'wp_head', 'feed_links_extra', 3 );                                  // Category Feeds
  remove_action( 'wp_head', 'feed_links', 2 );                                        // Post and Comment Feeds
  remove_action( 'wp_head', 'rsd_link' );                                             // EditURI link
  remove_action( 'wp_head', 'wlwmanifest_link' );                                     // Windows Live Writer
  remove_action( 'wp_head', 'index_rel_link' );                                       // index link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );                          // previous link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );                          // start link
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );             // Links for Adjacent Posts
  remove_action( 'wp_head', 'wp_generator' );                                        // WP version
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );                    // Remove silly Emoji scripts
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
}
  // launching operation cleanup
  add_action('init', 'JD_bootstrap_head_cleanup');

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function JD_bootstrap_register_sidebars() {
     register_sidebar(array(
      'id' => 'sidebar1',
      'name' => 'Main Sidebar',
      'description' => 'Main Sidebar',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widgettitle">',
      'after_title' => '</h3>',
    ));
      register_sidebar(array(
      'id' => 'footer1',
      'name' => 'Footer Column 1',
      'description' => 'Footer Links 1',
      'before_widget' => '<div id="%1$s" class="widget %2$s col-sm-3">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widgettitle">',
      'after_title' => '</h3>',
    ));
      register_sidebar(array(
      'id' => 'footer2',
      'name' => 'Footer Column 2',
      'description' => 'Footer Links 2',
      'before_widget' => '<div id="%1$s" class="widget %2$s col-sm-3">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widgettitle">',
      'after_title' => '</h3>',
    ));
      register_sidebar(array(
      'id' => 'footer3',
      'name' => 'Footer Column 3',
      'description' => 'Footer Links 3',
      'before_widget' => '<div id="%1$s" class="widget %2$s col-sm-3">',
      'after_widget' => '</div>',
      'before_title' => '<h3 class="widgettitle">',
      'after_title' => '</h3>',
    ));

} // don't remove this bracket!
add_action( 'widgets_init', 'JD_bootstrap_register_sidebars' ); // This function initializes widgets




// enqueue styles
function JD_BOOTSTRAP_scripts_styles() {
     // Loads modernizr JavaScript file.
  wp_enqueue_script('modernizrjs', get_template_directory_uri() . '/library/js/modernizr.js');
  // Loads Bootstrap minified JavaScript file.
  wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/library/js/bootstrap.min.js', array('jquery'),'3.3.7', true );
        // Loads WoW JavaScript file.
  wp_enqueue_script('WoWjs', get_template_directory_uri() . '/library/js/wow.js', array('jquery'),'', true );
  // Loads NivoLightbox JavaScript file.
  wp_enqueue_script('nivolightobx', get_template_directory_uri() . '/library/nivolightbox/nivo-lightbox.min.js', array('jquery'),'1.2.0', true );
   // Loads Fancybox JavaScript file.
   wp_enqueue_script('fancyboxjs', get_template_directory_uri() . '/library/js/jquery.fancybox.min.js', array('jquery'),'3.0.47', true );
   // Loads Classie JavaScript file.
  wp_enqueue_script('Classiejs', get_template_directory_uri() . '/library/js/classie.js');
  // Loads Morph-buttons JavaScript file.
  wp_enqueue_script('MorphButtonsjs', get_template_directory_uri() . '/library/js/uiMorphingButton_fixed.js');
  // Loads Bootstrap minified CSS file.
  wp_enqueue_style('bootstrapcss', get_template_directory_uri() . '/library/css/bootstrap.min.css', false ,'3.3.7');
   // Loads Font-Awesome CSS file.
  wp_enqueue_style('fontawesomecss', get_template_directory_uri() . '/library/css/font-awesome.min.css', false ,'4.6.3');
  // Loads NivoLightbox CSS file.
  wp_enqueue_style('nivolightboxcss', get_template_directory_uri() . '/library/nivolightbox/nivo-lightbox.css', false ,'1.2.0');
   // Loads Fancybox CSS file.
  wp_enqueue_style('fancyboxcss', get_template_directory_uri() . '/library/css/jquery.fancybox.min.css', false ,'3.0.47');
    // Loads NivoLightbox theme CSS file.
  wp_enqueue_style('nivolightboxthemecss', get_template_directory_uri() . '/library/nivolightbox/themes/default/default.css', false ,'1.0');
   // Loads Animate.CSS file.
  wp_enqueue_style('animatecss', get_template_directory_uri() . '/library/css/animate.css', false ,'');
  // Loads morph-buttons.CSS file.
  wp_enqueue_style('morph-buttoncss', get_template_directory_uri() . '/library/css/morph-buttons.css', false ,'');
  // Loads our main stylesheet LAST
  wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css', false ,'1.6');
  // Loads theme JavaScript file LAST.
  wp_enqueue_script('themejs', get_template_directory_uri() . '/library/js/theme.js', array('jquery'),'0', true );

}
add_action('wp_enqueue_scripts', 'JD_BOOTSTRAP_scripts_styles');


// deregister WordPress default jQuery version for a higher version
  function modify_jquery_version() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, '2.2.4');
        wp_enqueue_script('jquery');
    }
  }
add_action('init', 'modify_jquery_version');


// Initialize Wordpress Menu
register_nav_menus( array(
    'primary'   => __( 'Primary Menu', 'JD_BOOTSTRAP' ),
    'secondary' => __( 'Secondary Menu', 'JD_BOOTSTRAP' ),
) );


require_once('includes/theme-functions.php');
require_once('includes/customizer.php');
require_once('includes/wp_bootstrap_navwalker.php');
