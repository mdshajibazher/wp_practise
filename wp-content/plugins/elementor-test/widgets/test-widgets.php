<?php

class Elementor_Test_Widget extends \Elementor\Widget_Base{

	public function get_name() {
        return "Test Widget";
    }

	public function get_title() {
        return __("Test Widget", 'elementor-test');
    }

	public function get_icon() {
        return 'fa fa-code';
    }

	public function get_categories() {
        return ['general'];
    }

	public function get_script_depends() {}

	public function get_style_depends() {}

	protected function _register_controls() {

        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'elementor-test' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading',
			[
				'label' => __( 'Type Something', 'elementor-test' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Hello World', 'elementor-test' ),
			]
		);

		$this->end_controls_section();
    }

	protected function render() {
		$settings = $this->get_settings_for_display();

		$heading = $settings['heading'];
		echo "<h1>".esc_html($heading )."</h1>";
    }

	protected function _content_template() {}
}