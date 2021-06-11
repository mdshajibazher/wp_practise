<?php
/**   
 * Plugin Name: Post To QR code
 * Plugin URI: demouri.com
 * Version: 1.0.0
 * Description: display qr code under every posts
 * Author: pappu
 * Text Domain: posts-to-qr-code
 * Domain Path: '/languages' 
 * **/


$pqrc_countiries = array(
    __('none','posts-to-qr-code'),
    __('Afganstan','posts-to-qr-code'),
    __('Bangladesh','posts-to-qr-code'),
    __('India','posts-to-qr-code'),
    __('Srilanka','posts-to-qr-code'),
    __('Vhutan','posts-to-qr-code'),
    __('Nepal','posts-to-qr-code'),
    __('Pakisthan','posts-to-qr-code'),
);

function pqrc_init(){
    global $pqrc_countiries;
    $pqrc_countiries = apply_filters('pqrc_countiries',$pqrc_countiries);
}
add_action('init','pqrc_init');

function qrcode_load_textdomain(){
    load_plugin_textdomain("posts-to-qr-code", false,dirname(__FILE__)."/languages");
}
add_action("plugins_loaded","qrcode_load_textdomain");

function pqrc_display_qr_code($content){
    $current_post_ID = get_the_ID();
    $current_post_title = get_the_title($current_post_ID);
    $current_post_link = urlencode(get_the_permalink( $current_post_ID));
    $height = get_option('pqrc_height') ? get_option('pqrc_height') : 100;
    $width = get_option('pqrc_width') ? get_option('pqrc_width') : 100;
    $dimension = $height.'x'.$width;
    $image_src = sprintf("https://api.qrserver.com/v1/create-qr-code/?size=%s&data=%s",$dimension,$current_post_link);
    // $content .= '<img src="'.$image_src.'" alt=""/>';
    $content .= sprintf("<div class='card'><img src='%s' alt='%s'/></div>",$image_src,$current_post_title);
    return $content;

}
add_filter('the_content','pqrc_display_qr_code');

function pqrc_settings_init(){
    add_settings_section('pqrc_section', __('PQRC to QR code Section','posts-to-qr-code'), 'pqrc_section_callback', 'general');
    add_settings_field('pqrc_height',__('QR Code height','posts-to-qr-code',''),'pqrc_display_height','general','pqrc_section');
    add_settings_field('pqrc_width',__('QR Code Width','posts-to-qr-code'),'pqrc_display_width','general','pqrc_section');
    add_settings_field('pqrc_select',__('Dropdown','posts-to-qr-code'),'pqrc_display_select_field','general','pqrc_section');
    add_settings_field('pqrc_checkbox',__('Select Countries','posts-to-qr-code'),'pqrc_display_checkbox_field','general','pqrc_section');
    add_settings_field('pqrc_toggle',__('Toggle Field','posts-to-qr-code'),'pqrc_display_toggle_field','general','pqrc_section');

    register_setting('general','pqrc_height',array('sanitize_callback' => 'esc_attr'));
    register_setting('general','pqrc_width',array('sanitize_callback' => 'esc_attr'));
    register_setting('general','pqrc_select',array('sanitize_callback' => 'esc_attr'));
    register_setting('general','pqrc_checkbox');
    register_setting('general','pqrc_toggle');
}

function pqrc_display_toggle_field(){
    $option = get_option('pqrc_toggle');
    echo '<div id="toggle1">
    </div><input type="hidden" name="pqrc_toggle" id="pqrc_toggle" value="'.$option.'"/>';

    
}


function pqrc_display_checkbox_field(){
    global $pqrc_countiries;
    $option = get_option('pqrc_checkbox');
    foreach($pqrc_countiries as $country){
        $selected = '';
        if(is_array($option) && in_array($country, $option)){
            $selected = 'checked';
        }

        printf('<input type="checkbox" name="pqrc_checkbox[]" value="%s" %s>%s <br>',$country, $selected, $country);
    }

}

function pqrc_display_select_field(){
    global $pqrc_countiries;
    $option = get_option('pqrc_select');
    printf('<select name="%s" id="%s">','pqrc_select','pqrc_select');
    foreach($pqrc_countiries as $country){
        $selected = '';
        $option == $country ?  $selected='selected' : '';
        printf('<option value="'.$country.'"'.$selected .'>'.$country.'</option>');
    }
    echo '</select>';
}

function pqrc_section_callback(){
    echo "<p>From PQRC Plugin description</p>";
}

function pqrc_display_height(){
    $height = get_option('pqrc_height');
    printf('<input type="text" id="%s" name="%s" value="%s">','pqrc_height','pqrc_height',$height);
}
function pqrc_display_width(){
    $width = get_option('pqrc_width');
    printf('<input type="text" id="%s" name="%s" value="%s">','pqrc_width','pqrc_width',$width);
}

add_action('admin_init', 'pqrc_settings_init');

function pqrc_assets($screen){
   if($screen === 'options-general.php'){
    wp_enqueue_style('pqrc_min_toggle_css',plugin_dir_url(__FILE__).'/assets/css/mini-toggle.css');
    wp_enqueue_script('pqrc_min_toggle_js',plugin_dir_url(__FILE__).'/assets/js/mini-toggle.js',['jquery'],'1.0.0',true);
    wp_enqueue_script('pqrc_main_js',plugin_dir_url(__FILE__).'/assets/js/pqrc-main.js',['jquery'],'1.0.0',true);
   }

}
add_action('admin_enqueue_scripts','pqrc_assets');