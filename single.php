<!-- 
 	template for single posts, 
 	individual student work with name, major, course and any content associated with work
 	support for video
 	can update to support vimeo and youtube
 -->
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="post" >
		<div class="post-header">
			<div class="title">
 				<?php the_title(); ?>
			</div>
			<!-- for video posts, show video as featured image, otherwise use featured image
				does not include youtube or vimeo embeds (for now)  -->
			<?php
				/* embedded videos generate enclosure custom field */
				$video_url = explode( "\n", get_post_meta( $post->ID, 'enclosure', true ) )[0];
				// echo  serialize( get_post_meta( $post->ID ) );
				
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
						<?php the_post_thumbnail( 'front-page', array( 'class' => 'img-fluid' ) );?>
					<?php endif; ?>
				</div>

				<!-- title appears on top of video/image -->
				
			<?php } ?>
		</div>
		
		<div class="content">
			<!--  taxonomies information -->			
			<div class="info">
				<div class="student">
					<div class="label">Student</div>
					<div class="value">
						<?php echo get_the_term_list( $post->ID, 'students', ' ',', '); ?>
					</div><!-- comma for multiple students -->
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

			<script>
				const labels = document.getElementsByClassName('label')
				Array.from(labels).forEach(label => {
					const t = label.textContent;
					const html = t.split('').map( letter =>  { 
						return `<span class="letter">${letter}</span>`;
					}).join('');
					label.innerHTML = html;
				});		
			</script>

			<!-- wp post content  -->
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
				<div class="main-content"><?php the_content(); ?></div>
			<?php } ?>
				
			</div>
		</div>

		<div class="post-footer menu">
			<!--  links to other posts on the site, not organized by category (for now) -->
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