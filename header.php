<?php
/**
 * Default Header
 *
 *
 */?>
 <!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?php $key="seo_title"; echo get_post_meta($post->ID, $key, true); ?></title>
<meta name="description" content="<?php $key="seo_description"; echo get_post_meta($post->ID, $key, true); ?>" />  
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  <?php wp_head(); ?>
    <?php do_action('wp_head()'); ?><!-- added for custom wp colors from theme customizer -->
</head>
<body <?php body_class(); ?> >

<header id="header">
<!-- NAVBAR  ================================================== -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
        <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#jd-bootstrap-nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                </button>
<!-- custom calls to options stored in Admin section "Theme Options" to display the logo or not -->
 <a class="navbar-brand" id="logo" href="<?php echo site_url(); ?>"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" class="img-responsive logo"/></a>
<!-- custom calls to options stored in Admin section "Theme Options" to display the logo or not -->

        </div><!-- /. navbar-header -->
            <!-- Collect the nav links from WordPress -->
  <div class="collapse navbar-collapse" id="jd-bootstrap-nav-collapse">         
					  <?php $args = array(
					          'theme_location' => 'primary',
					          'depth' => 0,
					          'container' => 'false',
					          'menu_class'  => 'nav navbar-nav',
					          'walker'  => new BootstrapNavMenuWalker()
					          );
					    wp_nav_menu($args);
					  ?>
  </div><!-- ./collapse -->
          </div><!-- /.container -->
        </nav>
</header>