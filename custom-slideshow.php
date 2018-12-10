<?php /* Template Name: Slideshow Template */ ?>
<!-- slideshow template -->
<?php get_header(); ?>

<button id="start">
	Start Slideshow
</button>

<script>
	document.getElementById('main-menu').classList.remove('open');
</script>

<div id="features">
	<?php 

		global $wp;
		// echo serialize( $wp );
		//$category = preg_split("?", $wp->request); 
		//echo serialize( $category );

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


			<!--  image or video  -->
			<?php 
				$video_url = explode( "\n", get_post_meta( $post->ID, 'enclosure', true) )[0];
				if ($video_url) { ?>
				<div class="video">
					<video src="<?php echo $video_url; ?>" >
				</div>
			<?php } else { ?>
				<div class="image">
					<?php the_post_thumbnail( 'front-page' ); ?>
				</div>
			<?php } ?>
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
			if (features[count].children[1].classList.contains('video')) {
				features[count].children[1].children[0].play();
				features[count].children[1].children[0].addEventListener('ended', () => {
					nextFeature();
				});
			} else {
				setTimeout(nextFeature, 5000);
			}
		}

		document.getElementById('start').addEventListener('click', ev => {
			ev.currentTarget.style.display = 'none';
			if (features[count].children[1].classList.contains('video')) {
				features[count].children[1].children[0].play();
				features[count].children[1].children[0].addEventListener('ended', () => {
					nextFeature();
				});
			}
		});

		 // setInterval(nextFeature, 5000);
	</script>
</div>

</html>
</body>