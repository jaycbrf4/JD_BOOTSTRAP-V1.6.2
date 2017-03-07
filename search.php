<?php get_header(); ?>

<div id="content">
<div class="container">
<div class="clearfix row">
    <div id="main" class="clearfix" role="main">

	<div class="page-header"><h1><span><?php _e("Search Results for","JD_BOOTSTRAP"); ?>:</span> <?php echo esc_attr(get_search_query()); ?></h1></div>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
		
		<header>
			
			<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
			
			
		
		</header> <!-- end article header -->
	
		<section class="post_content">
			<?php the_excerpt('<span class="read-more">' . __("Read more on","JD_BOOTSTRAP") . ' "'.the_title('', '', false).'" &raquo;</span>'); ?>
	
		</section> <!-- end article section -->
		
	
	
	</article> <!-- end article -->
	
	<?php endwhile; ?>	
	
	
	
	<?php else : ?>
	
	<!-- this area shows up if there are no results -->
	
	<article id="post-not-found">
	    <header>
	    	<h1><?php _e("Not Found", "JD_BOOTSTRAP"); ?></h1>
	    </header>
	    <section class="post_content">
	    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "JD_BOOTSTRAP"); ?></p>
	    </section>

	</article>
	
	<?php endif; ?>

</div> <!-- /main -->
</div><!--/row-->
</div><!--/container-->

</div> <!-- /content -->

<?php get_footer(); ?>