<?php get_header(); ?>

<div id="features">

	<?php 
		$featured = new WP_Query( array( 'category_name' => 'featured' ) );
		if ( have_posts() ) : while ( $featured->have_posts() ) : $featured->the_post(); 
			$post_id = get_the_ID();

	?>
		<div class="post">
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
		const posts = document.getElementsByClassName('post');
		let count = 0;
		function nextPost() {
			posts[count].style.opacity = 0;
			if (count < posts.length - 1) {
				count ++;
			} else {
				count = 0;
			}
			posts[count].style.opacity = 1;
		}
		setInterval(nextPost, 2000);

	</script>


</div>

<!-- <?php get_footer(); ?> -->