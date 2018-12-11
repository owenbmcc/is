<?php get_header(); ?>

<div class="container">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
			<!-- featured image across the top -->
			<div class="featured-image">
					<!-- check if the post has a Post Thumbnail assigned to it. -->
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php  the_post_thumbnail( 'post-medium', array( 'class' => 'img-fluid' ) );?>
						</a>
					<?php endif; ?>
			</div>
			<div class="page-header title">
				<?php the_title(); ?>
			</div>
			<div class="content">
				<?php the_content() ?>
			</div>
		</div><!-- end post-->
	<?php endwhile; ?>
	<?php endif; ?>
</div><!-- end container-->

<?php get_footer(); ?>