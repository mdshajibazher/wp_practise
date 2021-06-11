<?php
/**   
 * Plugin Name: Essential Shortcode
 * Plugin URI: demouri.com
 * Version: 1.0.0
 * Description: some test shortcode
 * Author: pappu
 * Text Domain: shortcode-test
 * Domain Path: '/languages' 
 * **/


 function youtube_iframe_url($attributes){
      $default = array(
           'width' => '100%',
           'height' => '100px',
      );

      $map_attributes = shortcode_atts($default,$attributes );
      return sprintf('<iframe width="%s" height="%s" src="https://www.youtube.com/embed/0RZnl0aHDWc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',$map_attributes['width'], $map_attributes['height']);
 }
 add_shortcode('test-youtube-video','youtube_iframe_url');

function uppercase_function($attributes, $content=''){
     return strtoupper($content);
}
 add_shortcode('uc', 'uppercase_function');