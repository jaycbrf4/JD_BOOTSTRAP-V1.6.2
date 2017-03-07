<?php
/*
Author: Jay Deutsch @jaycbrf4
*/


show_admin_bar( false );
require_once('includes/theme-functions.php');
// Cleaning up the Wordpress Head
function JD_bootstrap_head_cleanup() {
  // remove header links
  remove_action( 'wp_head', 'feed_links_extra', 3 );                                                 // Category Feeds
  remove_action( 'wp_head', 'feed_links', 2 );                                                         // Post and Comment Feeds
  remove_action( 'wp_head', 'rsd_link' );                                                               // EditURI link
  remove_action( 'wp_head', 'wlwmanifest_link' );                                                 // Windows Live Writer
  remove_action( 'wp_head', 'index_rel_link' );                                                    // index link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );                                // previous link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );                                  // start link
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );          // Links for Adjacent Posts
  remove_action( 'wp_head', 'wp_generator' );                                               // WP version
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );                    // Remove silly Emoji scripts
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
}
  // launching operation cleanup
  add_action('init', 'JD_bootstrap_head_cleanup');

/* remove Howdy */
add_action( 'admin_bar_menu', 'wp_admin_bar_my_custom_account_menu', 11 );

function wp_admin_bar_my_custom_account_menu( $wp_admin_bar ) {
$user_id = get_current_user_id();
$current_user = wp_get_current_user();
$profile_url = get_edit_profile_url( $user_id );

if ( 0 != $user_id ) {
/* Add the "My Account" menu */
$avatar = get_avatar( $user_id, 28 );
$howdy = sprintf( __('Hey There, %1$s'), $current_user->display_name );
$class = empty( $avatar ) ? '' : 'with-avatar';

$wp_admin_bar->add_menu( array(
'id' => 'my-account',
'parent' => 'top-secondary',
'title' => $howdy . $avatar,
'href' => $profile_url,
'meta' => array(
'class' => $class,
),
) );

}
}

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
  // Loads Bootstrap minified JavaScript file.
  wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/library/js/bootstrap.min.js', array('jquery'),'3.3.7', true );
        // Loads WoW JavaScript file.
  wp_enqueue_script('WoWjs', get_template_directory_uri() . '/library/js/wow.js', array('jquery'),'', true );
        // Loads NivoLightbox JavaScript file.
   wp_enqueue_script('nivolightobx', get_template_directory_uri() . '/library/nivolightbox/nivo-lightbox.min.js', array('jquery'),'1.2.0', true );
  // Loads Bootstrap minified CSS file.
  wp_enqueue_style('bootstrapcss', get_template_directory_uri() . '/library/css/bootstrap.min.css', false ,'3.3.7');
   // Loads Font-Awesome CSS file.
  wp_enqueue_style('fontawesomecss', get_template_directory_uri() . '/library/css/font-awesome.min.css', false ,'4.6.3');
    // Loads NivoLightbox CSS file.
  wp_enqueue_style('nivolightboxcss', get_template_directory_uri() . '/library/nivolightbox/nivo-lightbox.css', false ,'1.2.0');
    // Loads NivoLightbox theme CSS file.
  wp_enqueue_style('nivolightboxthemecss', get_template_directory_uri() . '/library/nivolightbox/themes/default/default.css', false ,'1.0');
   // Loads Animate.CSS file.
  wp_enqueue_style('animatecss', get_template_directory_uri() . '/library/css/animate.css', false ,'');

  // Loads our main stylesheet LAST
  wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css', false ,'1.6');
  // Loads theme JavaScript file LAST.
    wp_enqueue_script('themejs', get_template_directory_uri() . '/library/js/theme.js', array('jquery'),'0', true );

}
add_action('wp_enqueue_scripts', 'JD_BOOTSTRAP_scripts_styles');


// Initialize Wordpress Menu
register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'JD_BOOTSTRAP' ),
    'secondary' => __( 'Secondary Menu', 'JD_BOOTSTRAP' ),
) );

require_once('includes/customizer.php');
require_once('includes/wp_bootstrap_navwalker.php');
