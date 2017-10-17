<?php
/**
 * Homepage
 *
 */
?>
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
  <?php do_action('wp_head()'); ?><!-- added for custom wp_colors from theme customizer -->
</head>
<body <?php body_class(); ?> >
    
  <header id="header">
    <div class="cover-container">
      <img  src="<?php bloginfo('stylesheet_directory'); ?>/images/hero.jpg" alt="FasTrax Solutions">
    </div><!--/.cover-container-->
    
    <div class="cover-wrapper-inner">
      <!-- NAVBAR  ================================================== -->
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#jd-bootstrap-nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- custom calls to options stored in Admin section "Theme Options" to display the logo or not -->
             <a class="navbar-brand" id="logo" href="<?php echo site_url(); ?>"><img src="<?php header_image(); ?>" alt="Logo" class="img-responsive logo"/></a>
            <!-- custom calls to options stored in Admin section "Theme Options" to display the logo or not -->

          </div><!-- /. navbar-header -->
          <!-- Collect the nav links from WordPress -->
          <div class="collapse navbar-collapse" id="jd-bootstrap-nav-collapse">         
      		  <?php $args = array(
              'theme_location' => 'primary',
              'depth' => 0,
              'menu_class'  => 'nav navbar-nav',
              'walker'  => new BootstrapNavMenuWalker()
              );
              wp_nav_menu($args);
            ?>
          </div><!-- ./collapse -->
        </div><!-- /.container -->
      </nav>
      <div  id="hero-content" class="container">
         <div class="inner cover">
          <h1 class="cover-heading">This is the heading Text</h1>
          <p class="lead pull-right">
            <a href="#" class="btn btn-lg btn-default hidden-sm hidden-xs">Learn more</a>
            <a href="#" class="btn btn-sm btn-default visible-sm">Learn more</a>
            <a href="#" class="btn btn-xs btn-default visible-xs">Learn more</a>
          </p>
        </div>
      </div><!--/.container-->
    </div><!-- /.cover-wrapper-inner-->
  </header>

<div id="content">
   <div  class="container-fluid">
     <div class="row">
       <div id="main" class="clearfix" role="main">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
              
        <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
          
          <section class="post_content">
            
            <?php the_content(); ?>
        
          </section> <!-- end article section -->
        
        </article> <!-- end article -->
        
        <?php endwhile; ?>  
        <?php endif; ?>

      </div><!--/main-->
    </div><!--row-->
  </div><!--/container-->
</div><!-- /. content -->

<?php get_footer(); ?>

