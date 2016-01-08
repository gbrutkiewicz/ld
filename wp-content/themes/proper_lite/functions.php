<?php
/**
 * properlite functions and definitions
 *
 * @package properlite
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'properlite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function properlite_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on properlite, use a find and replace
	 * to change 'properlite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'properlite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'properlite-max-control', 1600 );
	add_image_size( 'client-thumb', 250 );
	add_image_size( 'project-thumb', 800, 800, array( 'center', 'center' ) );
	add_image_size( 'team-thumb', 300, 300, array( 'center', 'center' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'properlite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'properlite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // properlite_setup
add_action( 'after_setup_theme', 'properlite_setup' );


/*-----------------------------------------------------------------------------------------------------//
	Register Widgets
	
	@link http://codex.wordpress.org/Function_Reference/register_sidebar
-------------------------------------------------------------------------------------------------------*/


function properlite_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'properlite' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Home Widget Area #1', 'properlite' ),
		'id'            => 'home-widget-area-one',
		'description'   => __( 'Use this widget area to display home page content', 'properlite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Home Widget Area #2', 'properlite' ),
		'id'            => 'home-widget-area-two',
		'description'   => __( 'Use this widget area to display home page content', 'properlite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Social Widget Area', 'properlite' ),
		'id'            => 'social-widget-area', 
		'description'   => __( 'Drag the MT - Social Icons widget here.', 'properlite' ),
		'before_widget' => '',
		'after_widget'  => '', 
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Call-to-Action', 'properlite' ),
		'id'            => 'footer-cta', 
		'description'   => __( 'Use this widget area to populate your Footer Call-to-Action', 'properlite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) ); 
	
	
	//Register the sidebar widgets   
	register_widget( 'properlite_Video_Widget' ); 
	register_widget( 'properlite_Contact_Info' );
	register_widget( 'properlite_social' );
	register_widget( 'properlite_action' );
	register_widget( 'properlite_home_news' );
	register_widget( 'properlite_home_pages' );
	
	
}
add_action( 'widgets_init', 'properlite_widgets_init' );

/*-----------------------------------------------------------------------------------------------------//
	Scripts
-------------------------------------------------------------------------------------------------------*/

function properlite_scripts() {
	wp_enqueue_style( 'properlite-style', get_stylesheet_uri() );
	
	$headings_font = esc_html(get_theme_mod('headings_fonts'));
	$body_font = esc_html(get_theme_mod('body_fonts'));
	
	if( $headings_font ) {
		wp_enqueue_style( 'properlite-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );	
	} else {
		wp_enqueue_style( 'properlite-open-headings', '//fonts.googleapis.com/css?family=Playfair+Display:400,400italic|Source+Sans+Pro:400,600,300italic|Montserrat:700');   
	}	
	if( $body_font ) {
		wp_enqueue_style( 'properlite-body-fonts', '//fonts.googleapis.com/css?family='. $body_font ); 	
	} else {
		wp_enqueue_style( 'properlite-open-body', '//fonts.googleapis.com/css?family=Playfair+Display:400,400italic|Source+Sans+Pro:400,600,300italic|Montserrat:700');  
	}


	if ( get_theme_mod('properlite_animate') != 1 ) { 
	
	wp_enqueue_style( 'properlite-animate', get_template_directory_uri() . '/css/animate.css' );
	
	}  

	wp_enqueue_style( 'properlite-menu', get_template_directory_uri() . '/css/jPushMenu.css' );
	
	wp_enqueue_style( 'properlite-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.css' );

	wp_enqueue_style( 'font-custom-font', get_template_directory_uri() . '/fonts/font-custom-font.css' );
	
	wp_enqueue_style( 'properlite-slick', get_template_directory_uri() . '/css/slick.css' );
	
	wp_enqueue_style( 'properlite-column-clear', get_template_directory_uri() . '/css/mt-column-clear.css' );

	wp_enqueue_script( 'properlite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'properlite-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'properlite-menu', get_template_directory_uri() . '/js/jPushMenu.js', array('jquery'), false, true );

	wp_enqueue_script( 'properlite-menu-script', get_template_directory_uri() . '/js/menu.script.js', array(), false, true );

	wp_enqueue_script( 'properlite-parallax', get_template_directory_uri() . '/js/parallax.min.js', array('jquery'), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'properlite_scripts' );

/**
 * Load html5shiv
 */
function properlite_html5shiv() {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'properlite_html5shiv' );


/*-----------------------------------------------------------------------------------------------------//
	Includes
-------------------------------------------------------------------------------------------------------*/

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Include additional custom admin panel features. 
 */
require get_template_directory() . '/panel/functions-admin.php';
require get_template_directory() . '/panel/theme-admin-page.php'; 

/**
 * Google Fonts  
 */
require get_template_directory() . '/inc/gfonts.php';  

/**
 * register your custom widgets
 */ 
require get_template_directory() . "/widgets/contact-info.php"; 
require get_template_directory() . "/widgets/video-widget.php";
require get_template_directory() . "/widgets/widget-mt-social.php"; 
require get_template_directory() . "/widgets/widget-mt-cta.php";
require get_template_directory() . "/widgets/widget-mt-home-news.php";
require get_template_directory() . "/widgets/widget-mt-home-pages.php";

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/properlite-styles.php';
require get_template_directory() . '/inc/properlite-sanitize.php';

/**
 * Favicon uploads
 */
require get_template_directory() . '/inc/properlite-favicon.php';

/**
 * Sidebar widget columns
 */
require get_template_directory() . '/inc/properlite-sidebar-columns.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

