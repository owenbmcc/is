<?php

// Add in support for featured images, custom image sizes, set default nav menu, 
function bare_bones_setup() {
    /*
    * ADD THEME SUPPORT
    * Docs here: https://codex.wordpress.org/Function_Reference/add_theme_support
    */
    
    if ( function_exists( 'add_theme_support' ) ) {
        
        add_theme_support('automatic-feed-links'); // adds rss feed information to pages
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ));
        add_theme_support( 'title-tag' ); // see for more info: https://codex.wordpress.org/Title_Tag

        /*
        * FEATURED IMAGES
        */
        //The following lines allow for featured images and tells WP what sizes to make available when you upload an image. More info here: https://codex.wordpress.org/Post_Thumbnails#Add_New_Post_Thumbnail_Sizes
        add_theme_support('post-thumbnails'); //This enables featured images:
        set_post_thumbnail_size( 150, 150, true ); // default thumb size (true means it is cropped)

        // additional image sizes
        add_image_size( 'front-page', 1920, 999 );
        add_image_size( 'post-featured', 1250, 9999 ); //1250 pixels wide (and unlimited height)
        add_image_size( 'post-large', 800, 600, true ); //800 wide by 600 high (cropped)
        add_image_size( 'post-medium', 600, 400, true ); //600 wide by 400 high (cropped)
        //add_image_size( 'post-medium', 600, 340, true ); //600 wide by 340 high (cropped)
    
    }// end if that checks for add_theme_support
    
    /*
    * ADD NAVIGATION MENU
    */
    register_nav_menu('main', 'Main Menu'); //register's the main menu
}

function style_setup() {
	/* main style sheet */
    wp_enqueue_style ('theme-style', get_template_directory_uri().'/css/main.css');
}

function add_custom_taxonomies() {

	/*
		based on Chris Stein media creators
		https://github.com/profstein/media-creators-plugin/blob/master/media-creators/media-creators.php
	*/

	/* course tax */
	$course_labels = array(
		'name'              => _x( 'Courses', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Course', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Courses', 'textdomain' ),
		'all_items'         => __( 'All Courses', 'textdomain' ),
		'parent_item'       => __( 'Parent Course', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Course:', 'textdomain' ),
		'edit_item'         => __( 'Edit Course', 'textdomain' ),
		'update_item'       => __( 'Update Course', 'textdomain' ),
		'add_new_item'      => __( 'Add New Course', 'textdomain' ),
		'new_item_name'     => __( 'New Course Name', 'textdomain' ),
		'menu_name'         => __( 'Course', 'textdomain' ),
	);

	$course_args = array(
		'hierarchical'      => true,
		'labels'            => $course_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'course' ),
	);

	register_taxonomy( 'course', array( 'post' ), $course_args );

	/* student tax */
	$student_labels = array(
		'name'              => _x( 'Students', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Student', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Students', 'textdomain' ),
		'all_items'         => __( 'All Students', 'textdomain' ),
		'parent_item'       => null,
		'parent_item_colon' => null,
		'edit_item'         => __( 'Edit Student', 'textdomain' ),
		'update_item'       => __( 'Update Student', 'textdomain' ),
		'add_new_item'      => __( 'Add New Student', 'textdomain' ),
		'new_item_name'     => __( 'New Student Name', 'textdomain' ),
		'separate_items_with_commas' => null,
    	'add_or_remove_items'   => __( 'Add or remove students' ),
    	'choose_from_most_used' => __( 'Choose from the already used students' ),
		'menu_name'         => __( 'Student', 'textdomain' ),
	);

	$student_args = array(
		'hierarchical'      => false,
		'labels'            => $student_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'update_count_callback' => '_update_post_term_count',
		'rewrite'           => array( 'slug' => 'student' ),
	);

	register_taxonomy( 'students', 'post', $student_args );

	/* major tax */
	$major_labels = array(
		'name'              => _x( 'Majors', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Major', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Majors', 'textdomain' ),
		'all_items'         => __( 'All Majors', 'textdomain' ),
		'parent_item'       => __( 'Parent Major', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Major:', 'textdomain' ),
		'edit_item'         => __( 'Edit Major', 'textdomain' ),
		'update_item'       => __( 'Update Major', 'textdomain' ),
		'add_new_item'      => __( 'Add New Major', 'textdomain' ),
		'new_item_name'     => __( 'New Major Name', 'textdomain' ),
		'menu_name'         => __( 'Major', 'textdomain' ),
	);

	$major_args = array(
		'hierarchical'      => true,
		'labels'            => $major_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'major' ),
	);

	register_taxonomy( 'major', array( 'post' ), $major_args );
	
	/* professor tax */
	$professor_labels = array(
		'name'              => _x( 'Professors', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Professor', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Professors', 'textdomain' ),
		'all_items'         => __( 'All Professors', 'textdomain' ),
		'parent_item'       => null,
		'parent_item_colon' => null,
		'separate_items_with_commas' => null,
		'add_or_remove_items'   => __( 'Add or remove Professors' ),
		'choose_from_most_used' => __( 'Choose from the already used Professors' ),
		'edit_item'         => __( 'Edit Professor', 'textdomain' ),
		'update_item'       => __( 'Update Professor', 'textdomain' ),
		'add_new_item'      => __( 'Add New Professor', 'textdomain' ),
		'new_item_name'     => __( 'New Professor Name', 'textdomain' ),
		'menu_name'         => __( 'Professor', 'textdomain' ),
	);

	$professor_args = array(
		'hierarchical'      => false,
		'labels'            => $professor_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'update_count_callback' => '_update_post_term_count',
		'rewrite'           => array( 'slug' => 'professor' ),
	);

	register_taxonomy( 'professors', 'post', $professor_args );
}

add_action('after_setup_theme','bare_bones_setup');
add_action('wp_loaded','style_setup');
add_action( 'init', 'add_custom_taxonomies', 0 );

/*
 * Allow for custom headr image
 */

$args = array(
	'width'         => 50,
	'height'        => 40,
	'default-image' => get_template_directory_uri() . '/images/logo.png',
	'uploads'       => true,
);
add_theme_support( 'custom-header', $args );

?>