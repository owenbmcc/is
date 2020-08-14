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

<body id="<?php echo  $post->post_name; ?>" <?php body_class( get_query_var( 'slideshow' ) ? 'slideshow' : '' ); ?>>
	
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
		
			<?php if (!get_query_var( 'slideshow' )): ?>
			<div id="main-menu" class="menu <?php echo is_page('slideshow') || is_front_page() || wp_is_mobile() ? '':'open'; ?>">
				<!-- <div class="menu-item" id="home-link">
					<a href="<?php echo get_home_url(); ?>">Home</a>
				</div> -->
				
				<div id="showcase" class="menu-item">
					<a href="#">Showcase</a>
					<div id="showcase-menu" class="sub-nav sub menu">
						<div id="portfolio-nav" class="sub-nav-menu-item">
							<a href="#">Portfolios</a>
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
						<div id="alumni-nav" class="sub-nav-menu-item">
							<a href="#">Alumni</a>
						</div>
					</div>
				</div>

				<div id="major" class="menu-item">
					<a href="#">Majors</a>
					<div id="major-menu" class="sub menu">
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
					<a href="#">Courses</a>
					<div id="course-menu" class="sub-nav sub menu">
						<?php
							$tax = get_taxonomy( 'course' );
							if ($tax) {
								// $terms = get_terms( $tax->name );
								// $parents = get_terms( 'major', array => ( 'parent' => 0) );
								$parent_terms = get_terms( 'course', array( 'parent' => 0, 'orderby' => 'slug', 'hide_empty' => false ) );
								foreach ( $parent_terms as $pterm ) {
									echo '<div id="course-nav-' . $pterm->name . '" class="sub-nav-menu-item">';
									echo '<a href="' . get_term_link( $pterm ) . '">' . $pterm->name . '</a>' ;


									$terms = get_terms( 'course', array( 'parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );

									foreach ( $terms as $term ) {
										echo '<div class="sub-menu-item">';
										echo '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a>' ;
										echo '</div>';
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

				<!-- <div class="menu-item" >
					<a href="<?php echo get_home_url(); ?>/category/animation">Animation</a>
				</div>
				<div class="menu-item" >
					<a href="<?php echo get_home_url(); ?>/category/film-video/">Film & Video</a>
				</div>
				<div class="menu-item" >
					<a href="<?php echo get_home_url(); ?>/category/graphic-design/">Graphic Design</a>
				</div>
				<div class="menu-item" >
					<a href="<?php echo get_home_url(); ?>/category/Interactive/">Interactive</a>
				</div> -->
				
				
			</div>

			
			<!-- menu/sub menu script -->
			<script>
				const major = document.getElementById('major');
				const course = document.getElementById('course');
				const mainMenu = document.getElementById('main-menu');
				const majorMenu = document.getElementById('major-menu');
				const courseMenu = document.getElementById('course-menu');

				if (isMobile) document.body.classList.add('mobile');

				if (window.innerWidth >= 768 && !isFrontPage && !isSlideshow) {
					mainMenu.classList.add('open');
					isMobile = false; /* tablets */
				}

				// major.addEventListener('click', ev => {
				// 	courseMenu.classList.remove('open');
				// 	if (majorMenu.classList.contains('open'))
				// 		majorMenu.classList.remove('open');
				// 	else
				// 		majorMenu.classList.add('open');
				// });

				// course.addEventListener('click', ev => {
				// 	majorMenu.classList.remove('open');
				// 	if (courseMenu.classList.contains('open'))
				// 		courseMenu.classList.remove('open');
				// 	else
				// 		courseMenu.classList.add('open');
				// });
			</script>

			<?php endif; ?>
			<!-- 
				use logo as a home link in regular pages
			 -->
			<script>

				const logo = document.getElementById('logo');
				logo.addEventListener('click', ev => {
					if (isFrontPage || isMobile) {
						if (mainMenu.classList.contains('open')) {
							mainMenu.classList.remove('open');
							courseMenu.classList.remove('open');
							majorMenu.classList.remove('open');
						}
						else
							mainMenu.classList.add('open');
					} else {
						location.href = homeUrl;
					}
				});
			</script>
		</div>

	<!--  start content -->
	<div id="content">

	