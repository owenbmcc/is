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
	<link rel="icon" href="img/favicon.ico">
	<title><?php wp_title(); ?></title>
	 <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!--    Add in WordPress Navigation -->
	<nav class="navbar navbar-light navbar-toggleable-md fixed-top" role="navigation">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#bs4navbar" aria-controls="bs4navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand" href="http://bmcc.is"><img src="<?php echo get_template_directory_uri(); ?>/img/mea-Logo2.PNG" width="40"></a>
	</nav>
    