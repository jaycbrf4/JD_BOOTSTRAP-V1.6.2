<?php
/* 
*
* Template Name: Standard Full Width Page
*
*/
?>

<?php get_header(); ?>

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

                <?php else : ?>

                  <article id="post-not-found">
                    <header>
                      <h1><?php _e("Not Found", "JD_BOOTSTRAP"); ?></h1>
                    </header>
                    <section class="post_content">
                      <p><?php _e("Sorry, but the requested resource was not found on this site.", "JD_BOOTSTRAP"); ?></p>
                    </section>
                  </article>

                <?php endif; ?>

              </div><!--/main-->
            </div><!--row-->
          </div><!--/container-->
        </div><!-- /. content -->
<?php get_footer(); ?>

