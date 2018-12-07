<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<div id="post-<?php the_ID(); ?>" class="post" >
		
		<div class="post-header">
			<?php
				/* embedded videos generate enclosure custom field*/
				$video_url = explode( "\n", get_post_meta( $post->ID, 'enclosure', true ) )[0];
				/* text for a youtube video */
				if (!$video_url) {
					$content_post = get_post($post->ID);
					$content = $content_post->post_content;
				}
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

				<!-- <div class="course">
					<div class="label">Professor</div>
					<div class="value">
						<?php echo get_the_term_list( $post->ID, 'professors'); ?>
					</div>
				</div> -->
				<!-- no professors on original site -->
			</div>

			
			<!-- if there's a main video, display content without first video -->
			<?php if ($video_url) { ?>
				<?php 
					$content_post = get_post($post->ID);
					$content = $content_post->post_content;
					$content = preg_replace("/\[video.+video\]/i", "", $content, 1);
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);

					/* display if there's content left over */
					if ($content) { 
				?>
					<div class="main-content">
						<?php echo $content; ?>
					</div>
			<?php }
				} else { ?>
				<!-- if no video, just show main content -->
				<div class="main-content">
					<?php the_content(); ?>
				</div>
			<?php } ?>
				
			</div>
		</div>

		<div class="post-footer menu">
			<div class="prev-work menu-item">
				<?php previous_post_link( '%link', 'Previous Work: %title' ); ?>
			</div>
			<div class="next-work menu-item">
 				<?php next_post_link( '%link', 'Next Work: %title' ); ?>
 			</div>
		</div>
	</div>

                

		

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>