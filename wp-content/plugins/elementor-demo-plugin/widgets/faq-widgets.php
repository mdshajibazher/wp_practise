<?php


class Elementor_Faq_Widget  extends \Elementor\Widget_Base{
    public function get_name()
    {
        return 'faqWidget';
    }


    public function get_title()
    {
        return __('faqWidget', 'elementor-test-extension');
    }


    public function get_icon()
    {
        return 'fa fa-question';
    }


    public function get_categories()
    {
        return ['general'];
    }
    protected function _register_controls()
    {
        $this->start_controls_section(
            'faq_content_section',
            [
                'label' => __('Content', 'elementor-test-extension'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeter = new \Elementor\Repeater();
        $repeter->add_control('title',[
            'label' => __('Title', 'elementor-test-extension'),
            'type'  => \Elementor\Controls_Manager::TEXT,
        ]);

        $repeter->add_control('description',[
            'label' => __('Description', 'elementor-test-extension'),
            'type'  => \Elementor\Controls_Manager::TEXTAREA,
        ]);

        $this->add_control('faqs',[
            'label'     => __('FAQs', 'elementor-test-extension'),
            'type'      => \Elementor\Controls_Manager::REPEATER,
            'fields'    => $repeter->get_controls(),
            'title_field' => '{{{title}}}',
            'defaults' => [
                [
                    'title' => 'FAQ 1',
                    'description' => 'DESC 1',
                ],
                [
                    'title' => 'FAQ 2',
                    'description' => 'DESC 2',
                ]
            ]
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if($settings['faqs']){
            foreach($settings['faqs'] as $index => $faq){
                $key = $this->get_repeater_setting_key('title','faqs',$index);
                $this->add_inline_editing_attributes($key);
                echo "<h3 {$this->get_render_attribute_string($key)}> {$faq['title']} </h3>  <p>{$faq['description']}</p> <br>";
            }
        }
    }

    protected function _content_template()
    { ?>
        <#
        if(settings.faqs.length){
        _.each(settings.faqs,function(faq){ #>
        <h3> {{{faq.title}}} </h3>  <p>{{{faq.description}}}</p> <br>

        <#    })
            }
        #>

    <?php }

}