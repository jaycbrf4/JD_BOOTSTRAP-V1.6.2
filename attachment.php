<?php get_header(); ?>
    <div id="content">
        <div class="container-fluid">
            <div class="row">
                <div id="main" class="clearfix" role="main">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix'); ?> role="article">
                        <section class="post_content product_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h1 class="page-title">  <?php the_title(); ?></h1>
                                        <div class="image-wrapper col-sm-6 clearfix">
                                            <?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "full");?>
                                            <img src="<?php echo $att_image[0];?>" class="img-responsive" alt="<?php the_title(); ?>" />
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-sm-6 image-content-wrapper">
                                            <?php the_content(); ?>
                                        </div>
                                        <div class="col-sm-12 hidden-xs mt20">
                                            <a class="btn btn-success btn-white pull-right" href="<?php echo site_url(); ?>/contact"><i class="fa fa-bullhorn"></i> Get More Info</a> <a class="btn btn-default pull-left" href="<?php echo site_url(); ?>/products"><i class="fa fa-hand-o-left"></i> Back to Products</a>
                                        </div>
                                        <div class="col-sm-12 visible-xs mt20">
                                            <a class="btn btn-success btn-white pull-right btn-sm" href="<?php echo site_url(); ?>/contact"><i class="fa fa-bullhorn"></i> Get More Info</a> <a class="btn btn-default pull-left btn-sm" href="<?php echo site_url(); ?>/products"><i class="fa fa-hand-o-left"></i> Back to Products</a>
                                        </div>
                                    </div><!-- /. col -->
                                </div><!-- /.row -->
                            </div><!-- /.container -->
                        </section><!-- end article section -->
                    </article>
                    <!-- end article -->
                    <?php endwhile; ?>
                    <?php else : ?>
                    <article id="post-not-found">
                        <header>
                            <h1><?php _e("Not Found", "JD_BOOTSTRAP"); ?></h1>
                        </header>
                        <section class="post_content">
                            <p>
                                <?php _e("Sorry, but the requested resource was not found on this site.", "JD_BOOTSTRAP"); ?>
                            </p>
                        </section>
                    </article>
                    <?php endif; ?>
                </div><!--/main-->
            </div><!--row-->
        </div><!--/container-->
    </div><!-- /. content -->
    <?php get_footer(); ?>
