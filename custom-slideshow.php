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
<script> 
	var duration = "<?= get_post_meta( get_the_ID(), 'duration')[0]  ?>" || 10;
</script>
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
		/* doesn't work for front page? */
		if ( !get_query_var( 'slideshow' ) || is_front_page() ) {
			$featured = new WP_Query( array( 'category_name' => 'featured' ) );
		} /* for /slideshow/ */

		if ( is_page( 'hall-monitor' ) ) {
			$featured = new WP_Query( array( 'category_name' => 'hall-monitor', 'orderby' => 'rand' ) );
		} /* for /hall-monitor/ */


		if ( $password == 1 && have_posts() ) : while ( $featured->have_posts() ) : $featured->the_post(); 
			$post_id = get_the_ID();
	?>
		<div class="feature hidden">
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

			<!--  video, gallery or image  -->
			<?php 
				$video_url = explode( "\n", get_post_meta( $post->ID, 'enclosure', true) )[0];
				if ($video_url) { ?>
				<div class="video">
					<video src="<?php echo $video_url; ?>" >
				</div>
			<?php } else if (has_shortcode( $post->post_content, 'gallery' )) {
				$gallery = get_post_gallery_images( $post );
				$image_list = '<div class="gallery">';
					foreach( $gallery as $image_url ) {
						$image_list .= '<div class="gallery-item">' . '<img src="' . $image_url . '">' . '</div>';
					}
					$image_list .= '</div>';
					echo $image_list;
			} else { ?>
				<div class="image">
					<?php the_post_thumbnail( 'front-page' ); ?>
				</div>
			<?php } ?>
		</div>
	<?php endwhile; endif; wp_reset_postdata(); ?>
</div>

<script>
	/* fade in/out features */
	const features = document.getElementsByClassName('feature'),
		infos = document.getElementsByClassName('info'),
		featureDuration = duration * 1000, 
		galleryDuration = featureDuration / 2,
		infoDuration = featureDuration / 4;
	let count = 0;
	let galleryCount = 0;

	/* info appears at beginning and end of each work duration */
	function showInfo() {
		infos[count].style.opacity = 1;
		setTimeout(() => {
			infos[count].style.opacity = 0;
		}, infoDuration);
	}

	function playGallery() {
		const items = features[count].children[1].children;
		items[galleryCount].style.opacity = 0;
		galleryCount++;
		items[galleryCount].style.opacity = 1;
		if (galleryCount < items.length - 1) {
			setTimeout(playGallery, galleryDuration);
		} else {
			items[galleryCount].style.opacity = 0;
			galleryCount = 0;
			showInfo();
			setTimeout(nextFeature, galleryDuration);
		}
	}

	function playFeature() {
		showInfo();
		if (features[count].children[1].classList.contains('video')) {
			features[count].children[1].children[0].play();
			let delay = features[count].children[1].children[0].duration * 1000 - infoDuration * 1.5;
			setTimeout(showInfo, delay);
			features[count].children[1].children[0].addEventListener('ended', nextFeature);
		} else if (features[count].children[1].classList.contains('gallery')) {
			features[count].children[1].children[galleryCount].style.opacity = 1;
			setTimeout(playGallery, galleryDuration);
		} else {
			setTimeout(showInfo, featureDuration - infoDuration * 1.5);
			setTimeout(nextFeature, featureDuration);
		}
	}

	function nextFeature() {
		features[count].classList.replace('show', 'hidden');
		if (count < features.length - 1) count++;
		else count = 0;
		features[count].classList.replace('hidden', 'show');
		playFeature();
	}

	/* start slideshow */
	function start(ev) {
		document.getElementById('start').style.display = 'none';
		features[count].classList.replace('hidden', 'show');
		var el = document.documentElement,
		rfs = el.requestFullscreen
			|| el.webkitRequestFullScreen
			|| el.mozRequestFullScreen
			|| el.msRequestFullscreen;
		rfs.call(el);  // full screen
		playFeature();
	}
	document.getElementById('start').addEventListener('click', start);
	document.addEventListener('keydown', ev => { if (ev.which == 13) start(ev); });
</script>