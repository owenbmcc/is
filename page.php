<!-- 
	template for pages
	includes about page, non public facing tutorials etc.
 -->

<?php get_header(); ?>

<div class="container">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<!-- featured image across the top -->
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="featured-image">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php  the_post_thumbnail( 'post-medium', array( 'class' => 'img-fluid' ) );?>
				</a>
			</div>
		<?php endif; ?>
		<div class="page-header title">
			<?php the_title(); ?>
		</div>
		<div class="content">
			<?php the_content() ?>
		</div>
	<?php endwhile; ?>
	<?php endif; ?>
</div><!-- end container-->

<?php get_footer(); ?>