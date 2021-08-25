<?php


class Elementor_pricing_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'pricingWidget';
    }


    public function get_title()
    {
        return __('pricingWidget', 'elementor-test-extension');
    }


    public function get_icon()
    {
        return 'fa fa-table';
    }


    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'pricing_content_section',
            [
                'label' => __('Content', 'elementor-test-extension'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control('title', [
            'label' => __('Title', 'elementor-test-extension'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Pricing Table',
        ]);





        $repeter = new \Elementor\Repeater();
        $repeter->add_control('featured', [
            'label' => __('Featured', 'elementor-test-extension'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => false,
        ]);
        $repeter->add_control('title', [
            'label' => __('Title', 'elementor-test-extension'),
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);

        $repeter->add_control('description', [
            'label' => __('Description', 'elementor-test-extension'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
        ]);



        $repeter->add_control('pricing', [
            'label' => __('Pricing', 'elementor-test-extension'),
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);

        $repeter->add_control('button_title', [
            'label' => __('Button Title', 'elementor-test-extension'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Buy Now'
        ]);

        $repeter->add_control('button_url', [
            'label' => __('Button URL', 'elementor-test-extension'),
            'type' => \Elementor\Controls_Manager::URL,
        ]);

        $this->add_control('pricings', [
            'label' => __('Pricings Columns', 'elementor-test-extension'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeter->get_controls(),
            'title_field' => '{{{title}}}',
        ]);


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $heading = $this->get_settings('title');
        $pricings = $this->get_settings('pricings');
        ?>
        <section class="fdb-block"
                 style="background-image: url('<?php echo plugins_url('../assets/images/red.svg', __FILE__) ?>');">
            <div class="container">
                <div class="row text-center">
                    <div class="col">
                        <h1 class="text-white"><?php echo esc_html($heading); ?></h1>
                    </div>
                </div>

                <div class="row mt-5 align-items-center">
                    <?php
                    if ($pricings) :
                        foreach ($pricings as $pricing) : ?>
                            <div class="col-12 col-sm-10 col-md-8 m-auto col-lg-4 text-center">
                                <div class="fdb-box p-4">
                                    <h2><?php echo $pricing['title']; ?></h2>
                                    <p class="lead"><?php echo $pricing['description']; ?></p>

                                    <p class="h1 mt-5 mb-5">$<?php echo $pricing['pricing']; ?></p>
                                    <p><a href="<?php echo $pricing['button_url']['url']; ?>"
                                          class="btn <?php echo $pricing['featured'] ? 'btn-primary' : 'btn-dark'; ?> "><?php echo $pricing['button_title']; ?></a>
                                    </p>
                                </div>
                            </div>
                        <?php
                        endforeach;
                    endif;
                    ?>

                </div>
            </div>
        </section>
    <?php }

//    protected function _content_template()
//    {
//    }

}