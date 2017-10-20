<?php 
/*
Author: Jay Deutsch - http://hudsonvalleywebdesign.net
*/

function JD_BOOTSTRAP_theme_setup() {
         add_theme_support( 'post-thumbnails' );
      }
      add_action( 'after_setup_theme', 'JD_BOOTSTRAP_theme_setup' );
  // remove WP version from RSS
  function JD_bootstrap_rss_version() { return ''; }
  add_filter('the_generator', 'JD_bootstrap_rss_version');

// Fixing the Read More in the Excerpts
// This removes the annoying […] to a Read More link
function JD_bootstrap_excerpt_more($more) {
  global $post;
  return '...  <a href="'. get_permalink($post->ID) . '" class="more-link" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
}
add_filter('excerpt_more', 'JD_bootstrap_excerpt_more');



// Allow PHP in html
add_filter('widget_text','execute_php',100);
function execute_php($html){
     if(strpos($html,"<"."?php")!==false){
          ob_start();
          eval("?".">".$html);
          $html=ob_get_contents();
          ob_end_clean();
     }
     return $html;
}


// Function to remove menu items from admin area
// since we are not using comments or blog posts and never use tools - we can hide their menu items
add_action( 'admin_menu', 'my_remove_menu_pages' );
function my_remove_menu_pages() {
  remove_menu_page('edit-comments.php'); 
    remove_menu_page('edit.php'); 
      remove_menu_page('tools.php'); 
}

// Function to remove menu items from admin-bar on top 
add_action( 'admin_bar_menu', 'remove_wp_admin_bar_items', 999 );
function remove_wp_admin_bar_items( $wp_admin_bar ) {
  $wp_admin_bar->remove_node( 'comments' );
   $wp_admin_bar->remove_node( 'wp-logo' );
      $wp_admin_bar->remove_node( 'new-content' );
}

/*
*
// Custom Backend Footer
*
*/
add_filter('admin_footer_text', 'custom_admin_footer');
function custom_admin_footer() {
  echo '<span id="footer-thankyou">Developed by: Jay Deutsch</span>. Built using <a href="http://getbootstrap.com/" target="_blank">Bootstrap</a> and some <span class="dashicons dashicons-heart"></span>';
}

// adding it to the admin area
add_filter('admin_footer_text', 'custom_admin_footer');


/*
*
//Add custom logo file
*
*/
$args = array(
  'width'         => 444,
  'height'        => 60,
  'default-image' => get_stylesheet_directory_uri() . '/images/logo.png',
  'uploads'       => true,
);
add_theme_support( 'custom-header', $args );


/***** hilight search term *****/
function highlight_search_term($text){
    if(is_search()){
    $keys = implode('|', explode(' ', get_search_query()));
    $text = preg_replace('/(' . $keys .')/iu', '<span class="search-term" style="background: none repeat scroll 0 0 #ffda00;font-weight: bold;}">\0</span>', $text);
  }
    return $text;
}
add_filter('the_excerpt', 'highlight_search_term');
add_filter('the_title', 'highlight_search_term');

  /* custom functions for log-in screen */
    function custom_login_css() {
echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/login/style.css" />';
}
add_action('login_head', 'custom_login_css');

function my_login_logo_url() {
return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
return get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


//* Login Screen: Don't inform user which piece of credential was incorrect
function wp_failed_login () {
  return 'The login information you have entered is incorrect. Please try again.';
}
add_filter ( 'login_errors', 'wp_failed_login' );


// Stop Wordpress from adding <p> tags
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');


/**
 * Add to extended_valid_elements for TinyMCE
 *
 * @param $init assoc. array of TinyMCE options
 * @return $init the changed assoc. array
 */
function my_change_mce_options( $init ) {
    // Command separated string of extended elements
    $ext = 'pre[id|name|class|style]';

    // Add to extended_valid_elements if it alreay exists
    if ( isset( $init['extended_valid_elements'] ) ) {
        $init['extended_valid_elements'] .= ',' . $ext;
    } else {
        $init['extended_valid_elements'] = $ext;
    }

    // Super important: return $init!
    return $init;
}

add_filter('tiny_mce_before_init', 'my_change_mce_options');

/*
*
// ADD WOO Support
*
*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<section class="clearfix">';
}

function my_theme_wrapper_end() {
  echo '</section>';
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_filter('woocommerce_form_field_args', function ($args, $key, $value) {
    $args['input_class'][] = 'form-control';
    $args['class'][] = 'form-group';
    return $args;
}, 10, 3);

/*
*
** Bootstrap Responsive Images *
*
*/
// remove width and height from images
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}
// remove all default image classes
add_filter( 'get_image_tag_class', '__return_empty_string' );
//add Bootstrap img-responsive class
function image_tag_class($class) {
    $class .= 'img-responsive';
    return $class;
}
add_filter('get_image_tag_class', 'image_tag_class' );



/*
*
** //SEO Meta-Box plugin 
*
*/
$meta_box['post'] = array(

     'id' => 'post-format-meta',   
     'title' => '<span class="dashicons dashicons-tag"></span> SEO Title & Description',    
     'context' => 'normal',    
     'priority' => 'high',
        
     'fields' => array(
        array(
            'name' => 'SEO-TItle',
            'desc' => 'SEO friendly title',
            'id' => 'seo_title',
            'type' => 'text',
            'default' => ''
        ),
        array(
            'name' => 'SEO-Description',
            'desc' => 'Meta Description tag for individual page or post.',
            'id' => 'seo_description',
            'type' => 'text',
            'default' => ''
        )
    )
); 

$meta_box['page'] = array(
       'id' => 'post-format-meta',   
      'title' => '<span class="dashicons dashicons-tag"></span> SEO Title & Description',    
       'context' => 'normal',    
      'priority' => 'high',
       'fields' => array(
        array(
            'name' => 'SEO-TItle',
            'desc' => 'SEO friendly title',
            'id' => 'seo_title',
            'class' => 'seo_title_count',
            'type' => 'text',
            'default' => ''
        ),
        array(
            'name' => 'SEO-Description',
            'desc' => 'Meta Description tag for individual page or post.',
            'id' => 'seo_description',
            'class' => 'seo_description_count',
            'type' => 'text',
            'default' => ''
        )
    )
); 
add_action('admin_menu', 'plib_add_box'); 

//Add meta boxes to post types
function plib_add_box() {
    global $meta_box;
    
    foreach($meta_box as $post_type => $value) {
        add_meta_box($value['id'], $value['title'], 'plib_format_box', $post_type, $value['context'], $value['priority']);
    }
}

//Format meta boxes
function plib_format_box() {
  global $meta_box, $post;

  // Use nonce for verification
  echo '<input type="hidden" name="plib_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  echo '<table class="form-table">';

  foreach ($meta_box[$post->post_type]['fields'] as $field) {
      // get current post meta data
      $meta = get_post_meta($post->ID, $field['id'], true);

      echo '<tr>'.
              '<th style="width:20%"><label for="'. $field['id'] .'">'. $field['name']. '</label></th>'.
              '<td>';
      switch ($field['type']) {
          case 'text':
              echo '<input  type="text" name="'. $field['id']. '" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['default']) . '" size="30" style="width:97%" />'. '<br />'. $field['desc'];
              echo '<div  class="alignright '. $field['class'] .'" style="margin-right: 24px;"></div>';
              break;
          case 'textarea':
              echo '<textarea  name="'. $field['id']. '" id="'. $field['id']. '" cols="60" rows="4" style="width:97%">'. ($meta ? $meta : $field['default']) . '</textarea>'. '<br />'. $field['desc'];
              break;
          case 'select':
              echo '<select name="'. $field['id'] . '" id="'. $field['id'] . '">';
              foreach ($field['options'] as $option) {
                  echo '<option '. ( $meta == $option ? ' selected="selected"' : '' ) . '>'. $option . '</option>';
              }
              echo '</select>';
              break;
          case 'radio':
              foreach ($field['options'] as $option) {
                  echo '<input type="radio" name="' . $field['id'] . '" value="' . $option['value'] . '"' . ( $meta == $option['value'] ? ' checked="checked"' : '' ) . ' />' . $option['name'];
              }
              break;
          case 'checkbox':
              echo '<input type="checkbox" name="' . $field['id'] . '" id="' . $field['id'] . '"' . ( $meta ? ' checked="checked"' : '' ) . ' />';
              break;
      }
      echo     '<td>'.'</tr>';
  }

  echo '</table>';

}




//load script to count characters in title and description
    function load_counter_script_wp_admin() 
    {
        wp_enqueue_script('meta_box_counterJS', get_template_directory_uri() . '/library/js/counter.js', array('jquery'),'0', true );
    }
    add_action( 'admin_enqueue_scripts', 'load_counter_script_wp_admin' );




    
// Save data from meta box
function plib_save_data($post_id) {
    global $meta_box,  $post;
    
    //Verify nonce
    if (!wp_verify_nonce($_POST['plib_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    //Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    //Check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
    foreach ($meta_box[$post->post_type]['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}
add_action('save_post', 'plib_save_data');
