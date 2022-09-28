<?php /*
Template Name: Homepage
*/ 
?>

<?php get_header(); ?>

<div class="default-page">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<?php
				if ( have_posts() ) : 
				    while ( have_posts() ) : the_post(); ?>
					    <div class="page-content"><?php the_content(); ?></div>
				    <?php
					endwhile; 
				endif; 
				?>

				
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>

