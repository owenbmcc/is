<?php get_header(); ?>

<div id="features">

	<?php 
		$featured = new WP_Query( array( 'category_name' => 'featured' ) );
		if ( have_posts() ) : while ( $featured->have_posts() ) : $featured->the_post(); 
			$post_id = get_the_ID();

	?>
		<div class="feature">
			<div class="info">
				<div class="title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</div>
				<div class="major">
					<?php
						$terms = get_the_terms( $post->ID , 'major' );
						foreach ( $terms as $term ) {
							$major = $term->name;
							$major_link = get_term_link( $term );
						}
					?>
					<a href="<?php echo $major_link; ?>">
						<?php echo $major; ?>
					</a>
				</div>
				<div class="course">
					<?php
						$terms = get_the_terms( $post->ID , 'course' );
						foreach ( $terms as $term ) {
							$course = $term->name;
							$course_link = get_term_link( $term );
						}
					?>
					<a href="<?php echo $course_link; ?>">
						<?php echo $course; ?>
					</a>
				</div>
			</div>
			<div class="image">
				<?php the_post_thumbnail( 'front-page' ); ?>
			</div>
		</div>
	<?php endwhile; endif; wp_reset_postdata(); ?>

	<script>
		/* fade in/out features */
		const features = document.getElementsByClassName('feature');
		let count = 0;
		function nextFeature() {
			features[count].style.opacity = 0;
			if (count < features.length - 1) {
				count ++;
			} else {
				count = 0;
			}
			features[count].style.opacity = 1;
		}
		// setInterval(nextFeature, 5000);
	</script>


</div>
