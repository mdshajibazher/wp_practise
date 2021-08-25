<?php
/**
 * Plugin Name: Elementor Test Extension
 * Description: Custom Elementor extension.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Elementor
 * Author URI:  https://elementor.com/
 * Text Domain: elementor-test-extension
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class Elementor_Test_Extension {


	const VERSION = '1.0.0';

	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';


	const MINIMUM_PHP_VERSION = '7.0';


	private static $_instance = null;


	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {

		add_action( 'plugins_loaded', [ $this, 'on_plugins_loaded' ] );

	}


	public function i18n() {
		load_plugin_textdomain('elementor-test-extension', false, plugin_dir_url(__FILE__).'/languages');
	}


	public function on_plugins_loaded() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}

	}


	public function is_compatible() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}


	public function init() {
	
		$this->i18n();

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this,'add_elementor_widget_categories']);
		//add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );
        add_action('elementor/frontend/after_enqueue_styles',[$this,'widget_styles']);
        add_action('elementor/editor/after_enqueue_scripts',[$this,'custom_widget_scripts']);
        add_action('elementor/frontend/after_enqueue_scripts',[$this,'progressbar_widget_scripts']);

	}

	function progressbar_widget_scripts(){
        wp_enqueue_script('progressbar-custom-script',plugins_url('/assets/js/progressbar.min.js',__FILE__),null,time(),true);
        wp_enqueue_script('progressbar-helper-js',plugins_url('/assets/js/progressbar-helper.js',__FILE__),null,time(),true);
    }
	function custom_widget_scripts(){
        wp_enqueue_script('el-demo-custom-script',plugins_url('/assets/js/custom.js',__FILE__),array('jquery'),time(),true);
    }

	function widget_styles(){
	    wp_enqueue_style('froala','//cdnjs.cloudflare.com/ajax/libs/froala-design-blocks/2.0.1/css/froala_blocks.min.css');
    }

	function add_elementor_widget_categories($elements_manager){
		$elements_manager->add_category(
			'first-category',
			[
				'title' => __( 'Category One', 'elementor-test-extension' ),
				'icon' => 'fa fa-plug',
			]
		);

	}

	public function init_widgets() {

		// Include Widget files
		require_once( __DIR__ . '/widgets/test-widgets.php' );
		require_once( __DIR__ . '/widgets/faq-widgets.php' );
		require_once( __DIR__ . '/widgets/pricing-widgets.php' );
		require_once( __DIR__ . '/widgets/progressbar-widgets.php' );

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_oEmbed_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Faq_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_pricing_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_progressbar_Widget() );

	}


	public function init_controls() {

		// Include Control files
		require_once( __DIR__ . '/controls/test-control.php' );

		// Register control
		\Elementor\Plugin::$instance->controls_manager->register_control( 'control-type-', new \Test_Control() );

	}
	

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}


	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}


	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-test-extension' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

}

Elementor_Test_Extension::instance();
