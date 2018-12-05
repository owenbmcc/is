<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<div id="post-<?php the_ID(); ?>" class="post" >
		
		<div class="post-header">	
			<div class="featured-image">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'post-featured', array( 'class' => 'img-fluid' ) );?>
				<?php endif; ?>
			</div>
			<div class="title">
 				<?php the_title(); ?>
			</div>
		</div>

		<div class="content single">
			
			<div class="student">
				Student: <?php echo get_the_term_list( $post->ID, 'students', ' ',', '); ?> 
				<!-- comma for multiple students -->
			</div>
			
			<div class="major">
				Major: <?php echo get_the_term_list( $post->ID, 'major'); ?>
			</div>

			<div class="course">
				Course: <?php echo get_the_term_list( $post->ID, 'course'); ?>
			</div>

			<div class="main-content">
				<?php the_content() ?>
			</div>
		</div>

		<div class="post-footer">
			<div class="prev-work">
				<?php echo get_previous_post_link('Previous Work: %link', '%title'); ?>
			</div>
			<div class="next-work">
 				<?php echo get_next_post_link('Next Work: %link', '%title'); ?>
 			</div>
		</div>
	</div>

                

		

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>