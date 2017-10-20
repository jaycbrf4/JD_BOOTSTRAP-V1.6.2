<div id="sidebar1" class="col-sm-4 col-md-3" role="complementary">
	<aside>		
		<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar1' ); ?>

		<?php else : ?>
	</aside>
		<!-- This content shows up if there are no widgets defined in the backend. -->	
	<div class="alert alert-message">						
		<p><?php _e("No sidebar widgets active","JD_BOOTSTRAP"); ?>.</p>						
	</div>
	<?php endif; ?>
</div><!--/.sidebar -->

