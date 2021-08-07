<?php
/**   
 * Plugin Name: Carbon Gutenberg
 * Plugin URI: test.com
 * Version: 1.0.0
 * Description: Carbon field gutenberg
 * Author: pappu
 * Text Domain: carbon-gutenberg
 * Domain Path: '/languages' 
 * **/

use Carbon_Fields\Block;
use Carbon_Fields\Field;
 class CarbonTestGutenberg{
     function __construct(){
        add_action('plugins_loaded',[$this, 'carbonBoot']);
        add_action('carbon_fields_register_fields',[$this, 'carbonBlock']);
     }

     function carbonBlock(){
        Block::make(__("Text and Image","carbon-gutenberg"))
        ->set_description(__('Lorem Ipusm Dolor','carbon-gutenberg'))
        ->set_category('carbon_block',__('Carbon Fields'))
        ->add_fields([
            Field::make('text','heading',__('Block Heading','carbon-gutenberg')),
            Field::make('image','image',__('Block Image','carbon-gutenberg')),
            Field::make('rich_text','content',__('Block Content','carbon-gutenberg')),
        ])->set_render_callback(function($fields,$attributes,$inner_blocks){ ?>
         <div class="blocks" style="color: black">
            <div class="block-heading" style="color: black">
               <h1 style="color: black"><?php echo esc_html($fields['heading']); ?></h1>
            </div>

            <div class="block-image">
               <h1><?php echo wp_get_attachment_image($fields['image'],'full'); ?></h1>
            </div>
            <div class="block-content" style="color: black">
               <?php echo apply_filters('the_content',$fields['content']); ?>
            </div>

         </div>
        <?php });
     }
     function carbonBoot(){
        require_once( 'vendor/autoload.php' );
        \Carbon_Fields\Carbon_Fields::boot();
     }
     
 }
 new CarbonTestGutenberg;