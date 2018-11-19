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

<!--     Custom styles for this template -->
    <link href="<?php echo get_template_directory_uri(); ?>/css/ionicons.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/cubeportfolio.css" />
   
    <link href="<?php echo get_template_directory_uri(); ?>/css/custom-animations.css" rel="stylesheet">

  <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.min.js"></script>

    
    <?php wp_head(); ?>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.cubeportfolio.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.unveilEffects.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/theme.js"></script>
</head>

<body <?php body_class(); ?>>
    
    <!--    Add in WordPress Navigation -->

   <nav class="navbar navbar-light navbar-toggleable-md fixed-top" role="navigation">
     <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#bs4navbar" aria-controls="bs4navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <a class="navbar-brand" href="http://bmcc.is"><img src="<?php echo get_template_directory_uri(); ?>/img/mea-Logo2.PNG" width="40"></a>
<!--   New walker attempt-->
   <?php
   wp_nav_menu([
     'menu'            => 'main',
     'theme_location'  => 'main',
     'container'       => 'div',
     'container_id'    => 'bs4navbar',
     'container_class' => 'collapse navbar-collapse',
     'menu_id'         => false,
     'menu_class'      => 'navbar-nav mr-auto',
     'depth'           => 2,
     'fallback_cb'     => 'bs4navwalker::fallback',
     'walker'          => new bs4navwalker()
   ]);
   ?>
   
    </nav>
    