<?php
/**   
 * Plugin Name: Carbon Test
 * Plugin URI: test.com
 * Version: 1.0.0
 * Description: Carbon field helper plugin
 * Author: pappu
 * Text Domain: carbon-test
 * Domain Path: '/languages' 
 * **/

use Carbon_Fields\Container;
use Carbon_Fields\Field;
 class CarbonTest{
     function __construct(){
        add_action('plugins_loaded',[$this, 'carbonBoot']);
        add_action( 'carbon_fields_register_fields', [$this,'crbTestThemeOptions']);
     }

     function crbTestThemeOptions(){
        Container::make('post_meta',__('Sample Metabox','carbon-test'))
        ->where('post_type','=','page')
        ->set_context('side')
        ->set_priority('high')
        ->add_fields([
            Field::make('text','ct_number_of_post',__('Number Of Post','carbon-test')),
            Field::make('text','ct_number_of_charecters',__('Number of charecters','carbon-test')),
        ]);

        Container::make('post_meta',__('Only Image','carbon-test'))
        ->where('post_type','=','post')
        ->where('post_format','=','audio')
        ->set_context('side')
        ->add_fields([
            Field::make('text','prefix_image_title',__('Image','carbon-test')),
        ]);
     }
      

     function carbonBoot(){
        require_once( 'vendor/autoload.php' );
        \Carbon_Fields\Carbon_Fields::boot();
     }
     
 }
 new CarbonTest;