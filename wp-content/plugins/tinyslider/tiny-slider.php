<?php
/**   
 * Plugin Name: T Slider
 * Plugin URI: demouri.com
 * Version: 1.0.0
 * Description: some test shortcode
 * Author: pappu
 * Text Domain: tinyslider-test
 * Domain Path: '/languages' 
 * **/

function tinys_load_textdomain(){
    load_plugin_textdomain('tinyslider-test', false, dirname(__FILE__).'/languages');
}
 add_action('plugins_loaded','tinys_load_textdomain');

function tinys_assets(){
    wp_enqueue_style('tinys_css', '//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css',null, '1.0.0');
    wp_enqueue_script('tinys_js', '//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js', null, '1.0.0', true);
    wp_enqueue_script('tinys_main_js', plugin_dir_url(__FILE__).'/assets/js/main.js',array('jquery'),'1.0',true);
}
add_action('wp_enqueue_scripts', 'tinys_assets');

function tinys_init(){
    add_image_size('tiny-slider', 800,600, true);
}
add_action('init', 'tinys_init');

 function tinys_shortcode_tslider($arguments, $content){
    $defaults = [
        'width' => 500,
        'height' => 500,
        'id' => '',
    ];

    $attributs = shortcode_atts($defaults,$arguments);

    $content = do_shortcode($content);

    $shortcode_output ='
        <div id="'.$arguments['id'].'" style="height: '.$arguments['height'].'; width:'.$arguments['width'].'">
            <div class="slider">
                '.$content.'
            </div>
        </div>';

    return $shortcode_output;
 }

 function tinys_shortcode_tslide($arguments){
    $defaults = [
        'caption' => '',
        'id' => '',
        'size' => 'large',
    ];

    $attributes = shortcode_atts($defaults,$arguments );

    $image_src = wp_get_attachment_image_src($attributes['id'],$attributes['size']);

    $shortcode_output= '<div class="slide">
    <p><img src="'.$image_src[0].'" /></p>
    <p>'.$attributes['caption'].'</p>
    </div>';
 }
 add_shortcode('tsilder', 'tinys_shortcode_tslider');
 add_shortcode('tsilde', 'tinys_shortcode_tslide');