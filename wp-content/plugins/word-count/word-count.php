<?php
/**   
 * Plugin Name: Word Count Plugin
 * Plugin URI: demouri.com
 * Version: 1.0.0
 * Description: lorem ipsum dolor sit amet
 * Author: pappu
 * Text Domain: word-count
 * Domain Path: '/languages' 
 * **/


function wordcount_activation_hook(){

}
register_activation_hook(__FILE__,"wordcount_activation_hook");


function wordcount_deactivation_hook(){

}
register_deactivation_hook(__FILE__,"wordcount_deactivation_hook");

function wordcount_load_textdomain(){
    load_plugin_textdomain("word-count", false,dirname(__FILE__)."/languages");
}
add_action("plugins_loaded","wordcount_load_textdomain");

function wordcount_count_words($content){
    $stripped_content = strip_tags($content);
    $wordn = str_word_count($stripped_content);
    $label = __("Total number of words","word-count");
    $label = apply_filters('wordcount_heading',$label);
    $tag = apply_filters('wordcount_tag','h2');
    $content .= printf("<%s>%s: %s </%s>", $tag,$label, $wordn, $tag);
    return $content;
}
add_filter("the_content", "wordcount_count_words");

function wordcount_reading_time($content){
    $stripped_content = strip_tags($content);
    $wordn = str_word_count($stripped_content);
    $reading_minutes = ceil($wordn/200);
    $reading_seconds = floor($wordn%200 /(200/60));

    $content .= printf("<p>Total reading time is <span style='color: red'> %s</span>  <span style='color: #3498db'> %s</span>",  $reading_minutes,  $reading_seconds );
    return $content;
}
add_filter("the_content", "wordcount_reading_time");