<?php 


class TestWidgetOperation extends WP_Widget{
    public function __construct(){
        parent::__construct(
            'test-widget1',
            __('Test Widget 1','test-widget'),
            __('Widget Description','test-widget'),
        );
    }

    public function form($instance){
        $title = isset($instance['title']) ? $instance['title'] : __('Demo Widget Title', 'test-widget'); 

         $description = isset($instance['description']) ? $instance['description'] : __('Demo Widget Description', 'test-widget'); ?>

        <p>
        <label for="<?= esc_attr($this->get_field_id('title')); ?>"><?php _e('Title','test-widget') ?></label>
        <input class="widefat" type="text" id="<?= esc_attr($this->get_field_id('title')); ?>" value="<?= esc_attr($title); ?>" name="<?= esc_attr($this->get_field_name('title')); ?>" >
        </p>

        <p>
        <label for="<?= esc_attr($this->get_field_id('description')); ?>"><?php _e('Description','test-widget') ?></label>
        <textarea id="<?= esc_attr($this->get_field_id('description')); ?>"  class="widefat" cols="30" rows="10" name="<?= esc_attr($this->get_field_name('description')); ?>"><?= esc_attr($description); ?></textarea>
        </p>

    <?php }

    public function widget($args, $instance){
        echo $args['before_widget'];
        if(isset($instance['title']) && $instance['title'] != "" ){
            echo $args['before_title'];
            echo apply_filters('widget_title',$instance['title']);
            echo $args['after_title'];
            
        } ?>

        <div class="demo-widget">
           <table class="table">
            <tr>
                <td>Title</td>
                <td><?= isset($instance['title']) ? $instance['title'] : ''; ?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><?= isset($instance['description']) ? $instance['description'] : ''; ?></td>
            </tr>
           </table>

        </div>

    <?php    echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance){

        $instance= $new_instance;
        $title = $new_instance['title'];
        if(strlen($title) < 4){
            $instance['title'] = $old_instance['title'];
        }
        return $instance;
    }
}