<?php
/**
 * Simple Blog functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Simple_Blog
 */

if ( ! function_exists( 'simple_blog_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function simple_blog_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Simple Blog, use a find and replace
	 * to change 'simple-blog' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'simple-blog', get_template_directory() . '/languages' );

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
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'simple-blog' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'simple_blog_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'simple_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function simple_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'simple_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'simple_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function simple_blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'simple-blog' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'simple-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'simple_blog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function simple_blog_scripts() {
	wp_enqueue_style( 'simple-blog-style', get_stylesheet_uri() );

	wp_enqueue_script( 'simple-blog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '20160502', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '20160502', true );

	wp_enqueue_script( 'simple-blog-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'simple_blog_scripts' );

/**
 * Enqueue scripts and styles.
 */
function add_google_fonts() {
	//<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	$query_args = array(
		'family' => 'Roboto:400,400italic,700,700italic',
		'subset' => 'latin,latin-ext',
	);
	//wp_register_style( 'google_fonts', add_query_arg( $query_args, "https://fonts.googleapis.com/css" ), array(), null );
	wp_enqueue_style( 'google_fonts', 'https://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic&subset=latin,latin-ext', false );

}
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );


/**
 * ********************************************************************************************************************
 * RESPONSIVE IMAGES
 * ********************************************************************************************************************
 */
if (!function_exists('add_responsive_class')) {
	function add_responsive_class($content){

		$content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
		$document = new DOMDocument();
		libxml_use_internal_errors(true);
		$document->loadHTML(utf8_decode($content));

		$imgs = $document->getElementsByTagName('img');
		foreach ($imgs as $img) {
			$existing_class = $img->getAttribute('class');
			$img->setAttribute('class', "img-responsive $existing_class");

		}

		$html = $document->saveHTML();
		return $html;
	}
	add_filter('the_content', 'add_responsive_class');
}

// Run this code on 'after_theme_setup', when plugins have already been loaded.
add_action('after_setup_theme', 'my_load_plugin');
// This function loads the plugin.
function my_load_plugin() {

	if (!class_exists('About_Me_Widget')) {
		// load Social if not already loaded
		include_once(get_template_directory() . '/include/widgets/About_Me_Widget.php');
	}
}

if (!function_exists('register_about_me_widget')) {
	function register_about_me_widget() {

		register_widget( 'About_Me_Widget' );

	}
	add_action( 'widgets_init', 'register_about_me_widget' );
}



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load wp_bootstrap_navwalker a custom walker file.
 */
require_once( get_template_directory() . '/inc/wp_bootstrap_navwalker.php');

