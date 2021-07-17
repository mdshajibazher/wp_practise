<?php
/* 
Plugin Name: Elementor Test
Plugin URI: test.com
Version: 1.0.0
Description: for custom elementor controls
Author: pappu
Text Domain: elementor-test
Domain Path: '/languages' 
*/

if(!defined('ABSPATH')){
    wp_die("direct access not allowed");
}

final class Elementor_Test_Extension {

	const VERSION="1.0.0";
	const MINIMUM_ELEMENTOR_VERSION="3.2.5";
	const MINIMUM_PHP_VERSION="7.0";
    public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'on_plugins_loaded' ] );
	}
	private static $_instance = null;
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

    public function on_plugins_loaded() {
		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}
    }
    public function init() {
		//check elementor installed or not
        if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

    }


	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-test' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}


	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function init_widgets() {
		load_plugin_textdomain('elementor-test', false, plugin_dir_url(__FILE__).'/languages');
		// Include Widget files
		require_once( __DIR__ . '/widgets/test-widgets.php' );
		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Test_Widget());

	}


	public function is_compatible() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		return true;
	}

	public function includes() {}

}
Elementor_Test_Extension::instance();