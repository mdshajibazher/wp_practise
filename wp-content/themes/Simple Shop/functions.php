<?php
/**
 * Simple Shop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Simple_Shop
 */


include_once('inc/customizer/class-kirki-installer.php');
include_once('inc/customizer/kirki.php');



if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'simple_shop_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function simple_shop_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Simple Shop, use a find and replace
		 * to change 'simple-shop' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'simple-shop', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'simple-shop' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'simple_shop_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'simple_shop_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function simple_shop_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'simple_shop_content_width', 640 );
}
add_action( 'after_setup_theme', 'simple_shop_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function simple_shop_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'simple-shop' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'simple-shop' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'simple_shop_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function simple_shop_scripts() {
    wp_enqueue_style('google-font', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900');
    wp_enqueue_style('bootstrap-css', get_theme_file_uri('/assets/vendor/bootstrap/css/bootstrap.min.css'),array(), _S_VERSION);
    wp_enqueue_style('font-awesome-css', get_theme_file_uri('/assets/vendor/font-awesome/css/font-awesome.min.css'),array(), _S_VERSION);
    wp_enqueue_style('bicon-css', get_theme_file_uri('/assets/vendor/bicon/css/bicon.css'),array(), _S_VERSION);
    wp_enqueue_style('simple-shop-woocommerce-layouts', get_theme_file_uri('/assets/css/woocommerce-layouts.css'),array(), _S_VERSION);
    wp_enqueue_style('simple-shop-woocommerce-small-screen-css', get_theme_file_uri('/assets/css/woocommerce-small-screen.css'),array(), _S_VERSION);
    wp_enqueue_style('simple-shop-woocommerce-css', get_theme_file_uri('/assets/css/woocommerce.css'),array(), _S_VERSION);
    wp_enqueue_style('simple-shop-main-css', get_theme_file_uri('/assets/css/main.css'),array(), _S_VERSION);
    wp_enqueue_style('simple-shop-custom-css', get_theme_file_uri('/assets/css/custom.css'),array(), _S_VERSION);


    wp_enqueue_style( 'simple-shop-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'simple-shop-style', 'rtl', 'replace' );

	wp_enqueue_script( 'simple-shop-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script('bootstrap-js',get_theme_file_uri('/assets/vendor/bootstrap/js/bootstrap.min.js'),['jquery'],_S_VERSION);
	wp_enqueue_script('popper-js',get_theme_file_uri('/assets/vendor/popper.min.js'),['jquery'],_S_VERSION);
	wp_enqueue_script('simple-shop-scripts-js',get_theme_file_uri('/assets/js/scripts.js'),['jquery'],_S_VERSION);


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'simple_shop_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';



/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

