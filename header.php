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
	<title><?php get_bloginfo( 'name'); ?></title>

	<!-- wp head -->
	<?php wp_head(); ?>
	<!-- end wp head -->
</head>

<body <?php body_class(); ?>>
	

	<div id="header">
		<div id="logo">
			<?php if( ini_get('allow_url_fopen') ): 
					$url =  get_template_directory_uri() . '/img/mea.svg';
					echo file_get_contents( $url ); 
				else : ?>
				<img src="<?php echo get_template_directory_uri() . '/img/mea.png' ?>">
			<?php endif; ?>
		</div>
		
		<div id="main-menu" class="menu <?php echo is_front_page() ? '':'open'; ?>">
			<div class="menu-item">
				<a href="<?php echo get_home_url(); ?>">Home</a>
			</div>
			<div class="menu-item">
				<a href="<?php echo get_home_url(); ?>/about/">About</a>
			</div>
			<div id="major" class="menu-item">Majors</div>
			<div id="course" class="menu-item">Courses</div>
			
		</div>

		<?php
			$menus = array( 'major' , 'course' );
			foreach ( $menus as $menu ) {
				$taxonomy = get_taxonomy( $menu ); 
				if ($taxonomy) {
					$terms = get_terms(  $taxonomy->name );
					echo '<div id="' . $menu . '-menu" class="menu">';
					foreach ( $terms as $term) {
						echo '<div class="menu-item">';
						echo '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a>' ;
						echo '</div>';
					}
					echo '</div>';
				}
			}
		?>

	</div>

	<!-- menu/sub menu script -->
	<script>

		const logo = document.getElementById('logo');
		const major = document.getElementById('major');
		const course = document.getElementById('course');
		const discipline = document.getElementById('discipline');
		const mainMenu = document.getElementById('main-menu');
		const majorMenu = document.getElementById('major-menu');
		const courseMenu = document.getElementById('course-menu');
		const disciplineMenu = document.getElementById('discipline-menu');


		logo.addEventListener('click', ev => {
			if (mainMenu.classList.contains('open')) {
				mainMenu.classList.remove('open');
				courseMenu.classList.remove('open');
				majorMenu.classList.remove('open');
				disciplineMenu.classList.remove('open');
			}
			else
				mainMenu.classList.add('open');
		});

		major.addEventListener('click', ev => {
			courseMenu.classList.remove('open');
			disciplineMenu.classList.remove('open');
			if (majorMenu.classList.contains('open'))
				majorMenu.classList.remove('open');
			else
				majorMenu.classList.add('open');
		});

		course.addEventListener('click', ev => {
			majorMenu.classList.remove('open');
			disciplineMenu.classList.remove('open');
			if (courseMenu.classList.contains('open'))
				courseMenu.classList.remove('open');
			else
				courseMenu.classList.add('open');
		});

		discipline.addEventListener('click', ev => {
			courseMenu.classList.remove('open');
			majorMenu.classList.remove('open');
			if (disciplineMenu.classList.contains('open'))
				disciplineMenu.classList.remove('open');
			else
				disciplineMenu.classList.add('open');
		});

		
	</script>