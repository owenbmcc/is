<!-- 
 	template for single posts, 
 	individual student work with name, major, course and any content associated with work
 	support for video
 	can update to support vimeo and youtube
 -->
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="post" id="single-post">
		
		<div class="title">
			<?php the_title(); ?>
		</div>
		
		<!--  taxonomies information -->	
		<div class="student">
			<?php echo get_the_term_list( $post->ID, 'students', ' ',', '); ?>
			<!-- comma for multiple students -->
		</div>
		
		<div class="major">
			<?php echo get_the_term_list( $post->ID, 'major'); ?>
		</div>

		<div class="course">
			<?php echo get_the_term_list( $post->ID, 'course'); ?>
		</div>
		
		<div class="content">
			<?php the_content(); ?>
		</div>
	</div>
	
	<div class="post-footer menu">
		<!--  links to other posts on the site, not organized by category (for now) -->

		<div class="prev-work menu-item">
			<!--  7 is to filter out private posts  -->
			<?php previous_post_link( '%link', 'Previous Work: %title', false, '7' ); ?>
		</div>
		<div class="next-work menu-item">
			<?php next_post_link( '%link', 'Next Work: %title', false, '7' ); ?>
		</div>
	</div>

	<script>
		window.addEventListener('load', loader);

		function loader() {
			/* this is stupid i hate wordpress */

			document.getElementById('single-post').style.opacity = 1;
			const containers = document.getElementsByClassName('wp-video');
			for (let i = 0; i < containers.length; i++) {
				containers[i].style.width = 'auto';
				containers[i].style.height = 'auto';
			}
		}
	</script>


	

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>