<!-- 
	template for front page slideshow
	does not play videos automatically like ?slideshow=true
	that requires user interaction
 -->
<?php get_header(); ?>

<div id="features">

	<?php 
		$featured = new WP_Query( array( 'category_name' => 'featured' ) );
		if ( have_posts() ) : while ( $featured->have_posts() ) : $featured->the_post(); 
			$post_id = get_the_ID();
	?>
		<div class="feature hidden">
			<div class="info">
				<div class="title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</div>
				<div class="students">
					<?php echo get_the_term_list( $post->ID, 'students', ' ',', '); ?>
				</div>
				<div class="major">
					<?php echo get_the_term_list( $post->ID, 'major'); ?>
				</div>
				<div class="course">
					<?php echo get_the_term_list( $post->ID, 'course'); ?>
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
		features[count].classList.replace('hidden', 'show');
		function nextFeature() {
			features[count].classList.replace('show', 'hidden');
			if (count < features.length - 1) {
				count ++;
			} else {
				count = 0;
			}
			features[count].classList.replace('hidden', 'show');
		}
		setInterval(nextFeature, 8000);
	</script>
</div>
