<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico ?>">
	<title><?php echo get_bloginfo( 'name'); ?></title>

	<script type="text/javascript">
		var homeUrl = '<?= get_home_url(); ?>';
		var isMobile = '<?= wp_is_mobile(); ?>';
		var isFrontPage = '<?= is_front_page(); ?>';
		var isSlideshow = "<?= is_page('slideshow'); ?>";
	</script>

	<!-- wp head -->
	<?php wp_head(); ?>
	<!-- end wp head -->
</head>

<?php
	if (isset($post->post_name)) {
		$body_id = $post->post_name;
	} else if (isset($pagename)) {
		$body_id = $pagename;
	}
?>

<body id="<?php echo (isset($body_id) ? $body_id : 'body-id'); ?>" <?php body_class( 'mea-site ' . (get_query_var( 'slideshow' ) ? 'slideshow' : '') ); ?>>

		<div id="header">
			<div id="logo">
				<?php if( ini_get( 'allow_url_fopen' ) ): 
						$url =  get_template_directory_uri() . '/img/mea.svg';
						echo file_get_contents( $url ); 
					else : ?>
					<img src="<?php echo get_template_directory_uri() . '/img/mea.png' ?>">
				<?php endif; ?>
				<?php if (is_front_page() || is_page('slideshow') || wp_is_mobile())  : ?> 
					<span>Student Showcase</span>
				<?php endif; ?>
			</div>

			<?php if (is_front_page() || is_page('slideshow')): ?>
				<div id="hamburger">
					<?php if( ini_get( 'allow_url_fopen' ) ): 
						$url =  get_template_directory_uri() . '/img/hamburger.svg';
						echo file_get_contents( $url ); 
					else : ?>
					<img src="<?php echo get_template_directory_uri() . '/img/hamburger_orange.png' ?>">
				<?php endif; ?>
				</div>
			<?php endif; ?>
		
			<?php if (!get_query_var( 'slideshow' )): ?>
			<div id="main-menu" class="menu <?php echo is_page('slideshow') || is_front_page() || wp_is_mobile() ? '':'open'; ?>">

				<div id="portfolios-link" class="menu-item">
					<a href="<?php echo get_home_url(); ?>/portfolios/">Portfolios</a>
				</div>

				<div id="major" class="menu-item">
					<span class="menu-header">Majors</span>
					<div id="major-menu" class="sub block menu">
						<?php
							$tax = get_taxonomy( 'major' );
							if ($tax) {
								$terms = get_terms( $tax->name );
								foreach ( $terms as $term ) {
									echo '<div class="sub-menu-item">';
									echo '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a>' ;
									echo '</div>';
								}
							}
						?>
					</div>
				</div>

				<div id="course" class="menu-item">
					<span class="menu-header">Courses</span>
					<div id="course-menu" class="sub-nav flex sub menu">
						<?php
							$tax = get_taxonomy( 'course' );
							if ($tax) {
								// $terms = get_terms( $tax->name );
								// $parents = get_terms( 'major', array => ( 'parent' => 0) );
								$parent_terms = get_terms( 'course', array( 'parent' => 0, 'orderby' => 'slug', 'hide_empty' => false ) );
								foreach ( $parent_terms as $pterm ) {
									echo '<div id="course-nav-' . $pterm->slug . '" class="sub-nav-menu-item">';
									echo   $pterm->name ;

									$terms = get_terms( 'course', array( 'parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );

									foreach ( $terms as $term ) {
										// check for posts in term first
										$post_query = new WP_Query( array( 'course' => $term->slug ) );
										$count = $post_query->found_posts;
										if ($count > 0) {
											echo '<div class="sub-menu-item">';
											echo '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a>' ;
											echo '</div>';
										}
									}
									echo '</div>';
								}
							}
						?>
					</div>
				</div>

				<div id="about-link" class="menu-item">
					<a href="<?php echo get_home_url(); ?>/about/">About</a>
				</div>

				
			</div>

			
			<!-- menu/sub menu script -->
			<script>
				const major = document.getElementById('major');
				const course = document.getElementById('course');
				const mainMenu = document.getElementById('main-menu');
				const portfolioMenu = document.getElementById('portfolio-menu');
				const majorMenu = document.getElementById('major-menu');
				const courseMenu = document.getElementById('course-menu');

				if (isMobile) {
					document.body.classList.add('mobile');

					[majorMenu, portfolioMenu, courseMenu].forEach(menu => {
						menu.addEventListener('click', ev => {
							console.log(menu, menu.classList.contains('open'));
							// menu.classList.remove('open');
							if (menu.classList.contains('open'))
								menu.classList.remove('open');
							else
								menu.classList.add('open');
						});
					});
				}

				if (window.innerWidth >= 768 && !isFrontPage && !isSlideshow) {
					mainMenu.classList.add('open');
					isMobile = false; /* tablets */
				}

				
			</script>

			<?php endif; ?>
			<!-- 
				use logo as a home link in regular pages
			 -->
			<script>

				function openMenu() {
					if (isFrontPage || isMobile) {
						if (mainMenu.classList.contains('open')) {
							mainMenu.classList.remove('open');
							courseMenu.classList.remove('open');
							majorMenu.classList.remove('open');
							if (burg) burg.style.display = 'block';
						} else {
							mainMenu.classList.add('open');
							if (burg) burg.style.display = 'none';
						}
					} else {
						location.href = homeUrl;
					}
				}

				const logo = document.getElementById('logo');
				logo.addEventListener('click', openMenu);

				let burg; // burg menu button only on front page

				if (isFrontPage) {
					burg = document.getElementById('hamburger');
					burg.addEventListener('click', openMenu);
				}
			</script>
		</div>

	<!--  start content -->
	<div id="content">

	