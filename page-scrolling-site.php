<?php
/* 
*
* Template Name: Static Front Page
*
* This template is for a one page scrolling site. - rename to front-page.php and create pages
* Make sure to change page names in loop to match pages in backend.
*/
?>

<?php get_header(); ?>

        <div id="content">
          <div  class="container-fluid">
            <div class="row">
              <div id="main" class="clearfix" role="main">

                <!-- begin sections where each section is a page of content -->
                <div class="section" id="first">
                  <div class="container">
                    <div class="row">
                      <div class="col-xs-12">
                        <?php
                          $query = new WP_query ('pagename=page-1'); // page name adds pages to loop
                            // The LooP
                            if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {
                              $query->the_post(); ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
                                <section class="post_content">
                              <?php the_content(); ?>
                                </section> <!-- end article section -->
                              </article><!-- / article-->  
                            <?php 
                            }
                            }
                          wp_reset_postdata();
                        ?>
                      </div><!-- /.col-->
                    </div><!--row-->
                  </div><!--/container-->
                </div><!--/.section-->

                <div class="section" id="second">
                  <div class="container">
                    <div class="row">
                      <div class="col-xs-12">
                        <?php
                          $query = new WP_query ('pagename=page-2'); // page name adds pages to loop
                            // The LooP
                            if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {
                              $query->the_post(); ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
                                <section class="post_content">
                              <?php the_content(); ?>
                                </section> <!-- end article section -->
                              </article><!-- / article-->  
                            <?php 
                            }
                            }
                          wp_reset_postdata();
                        ?>
                      </div><!-- /.col-->
                    </div><!--row-->
                  </div><!--/container-->
                </div><!--/.section-->
              </div><!--/main-->
            </div><!--row-->
          </div><!--/container-->
        </div><!-- /. content -->
<?php get_footer(); ?>
