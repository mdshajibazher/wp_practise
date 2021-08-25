
<?php
define('SIMPLESHOP_CUSTOMIZER_CONFIG_ID','simpleshop_customizer_settings');
define('SIMPLESHOP_PANEL_ID','simpleshop_customizer_panel');

if(class_exists('Kirki')) :

Kirki::add_config( SIMPLESHOP_CUSTOMIZER_CONFIG_ID, array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

Kirki::add_panel( SIMPLESHOP_PANEL_ID, array(
    'priority'    => 10,
    'title'       => esc_html__( 'SimpleShop', 'simple-shop' ),
    'description' => esc_html__( 'SimpleShop setting', 'simple-shop' ),
) );

Kirki::add_section( 'simpleshop-homepage', array(
    'title'          => esc_html__( 'Homepage settings', 'simple-shop' ),
    'panel'          => SIMPLESHOP_PANEL_ID,
    'priority'       => 160,
    'active_callback' => function(){
        return is_page_template('page-templates/homepage.php');
    }
) );


Kirki::add_field( SIMPLESHOP_CUSTOMIZER_CONFIG_ID, [
	'type'     => 'text',
	'settings' => 'simpleshop_homepage_categories_title',
	'label'    => esc_html__( 'Categories Title', 'simple-shop' ),
	'section'  => 'simpleshop-homepage',
	'default'  => esc_html__( 'This is a default value', 'simple-shop' ),
	'priority' => 10,
] );

Kirki::add_field( SIMPLESHOP_CUSTOMIZER_CONFIG_ID, [
    'type'        => 'switch',
    'settings'    => 'simpleshop_homepage_display_categories',
    'label'       => esc_html__( 'Display Categories Section', 'simple-shop' ),
    'section'     => 'simpleshop-homepage',
    'default'     => 'on',
    'priority'    => 10,
    'choices'     => [
        'on'  => esc_html__( 'Display', 'simple-shop' ),
        'off' => esc_html__( 'Hide', 'simple-shop' ),
    ],
] );


endif;