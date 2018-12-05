<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<div id="post-<?php the_ID(); ?>" class="post" >
		
		<div class="post-header">
			<?php
				$video_url = explode( "\n", get_post_meta( $post->ID, 'enclosure', true ) )[0];
				if ($video_url) { ?>
					<div class="featured-video">
						<video src="<?php echo $video_url; ?>" controls>
					</div>
			<?php  } else { ?>
				<div class="featured-image">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'post-featured', array( 'class' => 'img-fluid' ) );?>
					<?php endif; ?>
				</div>
				<div class="title">
 					<?php the_title(); ?>
				</div>
			<?php } ?>
		</div>

		<div class="content single">

			<div class="info">
				<div class="student">
					<div class="label">Student</div>
					<div class="value">
						<?php echo get_the_term_list( $post->ID, 'students', ' ',', '); ?>
					</div>
					<!-- comma for multiple students -->
				</div>
				
				<div class="major">
					<div class="label">Major</div>
					<div class="value">
						<?php echo get_the_term_list( $post->ID, 'major'); ?>
					</div>
				</div>

				<div class="course">
					<div class="label">Course</div>
					<div class="value">
						<?php echo get_the_term_list( $post->ID, 'course'); ?>
					</div>
				</div>
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