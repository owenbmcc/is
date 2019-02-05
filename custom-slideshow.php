<!-- 
	template for slideshow, for /slideshow/ and /hall-monitor/
	also add ?slideshow=true to any archive/taxonomy/category page to create a slideshow of just that work
 -->
<?php /* Template Name: Slideshow Template */ ?>
<?php get_header(); ?>

<!--  start button to enable full screen and playing media, both require user interaction -->
<button id="start">
	Start Slideshow
</button>
<!--  password protection for hall monitor slideshow -->
<?php
global $post;
$password = true; 
/* default password is accepted unless asks for one 
	password is cached in browser, should only need to sign in once	*/
if ( post_password_required( $post ) ) {
	$password = false;
    echo my_password_form();
}
?>
<div id="features">
	<?php 
		$featured = $wp_query; /* default for any taxonomy page */

		if ( !get_query_var( 'slideshow' ) ) {
			$featured = new WP_Query( array( 'category_name' => 'featured' ) );
		} /* for /slideshow/ */

		if ( is_page( 'hall-monitor' ) ) {
			$featured = new WP_Query( array( 'category_name' => 'hall-monitor', 'orderby' => 'rand' ) );
		} /* for /hall-monitor/ */

		if ( $password == 1 && have_posts() ) : while ( $featured->have_posts() ) : $featured->the_post(); 
			$post_id = get_the_ID();
	?>
		<div class="feature">
			<div class="info" style="opacity: 0">
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
		const features = document.getElementsByClassName('feature'),
			infos = document.getElementsByClassName('info'),
			featureDuration = 16000, 
			infoDuration = 3000;
		let count = 0;

		/* info appears at beginning and end of each work duration */
		function showInfo() {
			infos[count].style.opacity = 1;
			setTimeout(() => {
				infos[count].style.opacity = 0;
			}, infoDuration);
		}

		function playFeature() {
			showInfo();
			if (features[count].children[1].classList.contains('video')) {
				features[count].children[1].children[0].play();
				let delay = features[count].children[1].children[0].duration * 1000 - infoDuration * 1.5;
				setTimeout(showInfo, delay);
				features[count].children[1].children[0].addEventListener('ended', nextFeature);
			} else {
				setTimeout(showInfo, featureDuration - infoDuration * 1.5);
				setTimeout(nextFeature, featureDuration);
			}
		}

		function nextFeature() {
			features[count].style.opacity = 0;
			if (count < features.length - 1) {
				count++;
			} else {
				count = 0;
			}
			features[count].style.opacity = 1;
			playFeature();
		}

		/* start slideshow */
		document.getElementById('start').addEventListener('click', ev => {
			ev.currentTarget.style.display = 'none';
			var el = document.documentElement,
			rfs = el.requestFullscreen
				|| el.webkitRequestFullScreen
				|| el.mozRequestFullScreen
				|| el.msRequestFullscreen;
			rfs.call(el);  // full screen
			playFeature();
		});
	</script>
</div>
<!-- slideshow template -->
