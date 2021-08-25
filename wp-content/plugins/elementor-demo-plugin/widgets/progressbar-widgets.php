<?php


class Elementor_progressbar_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'progressbarWidget';
    }


    public function get_title()
    {
        return __('progressbarWidget', 'elementor-test-extension');
    }


    public function get_icon()
    {
        return 'fa fa-spinner';
    }


    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'progressbar_content_section',
            [
                'label' => __('Content', 'elementor-test-extension'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display(); ?>
        <div class="progress">

        </div>
    <?php }

//    protected function _content_template()
//    {
//    }

}