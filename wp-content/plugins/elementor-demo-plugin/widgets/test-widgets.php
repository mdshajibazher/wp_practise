<?php

class Elementor_oEmbed_Widget extends \Elementor\Widget_Base
{


	public function get_name()
	{
		return 'oembed';
	}


	public function get_title()
	{
		return __('oEmbed', 'elementor-test-extension');
	}


	public function get_icon()
	{
		return 'fa fa-eye';
	}


	public function get_categories()
	{
		return ['general', 'first-category'];
	}


	protected function _register_controls()
	{
		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Content', 'elementor-test-extension'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading',
			[
				'label' => __('Type Something', 'elementor-test-extension'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __('Hello World', 'elementor-test-extension'),
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' => __('Alignment', 'elementor-test-extension'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'elementor-test-extension'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'elementor-test-extension'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'elementor-test-extension'),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} h1.heading' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} p.address' => 'text-align: {{VALUE}}',
				],
				'default' => 'center',
			],

		);

		$this->add_control(
			'address',
			[
				'label' => __('Enter Address', 'elementor-test-extension'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				//'placeholder' => __( 'Hello World', 'elementor-test-extension' ),
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'test_section',
			[
				'label' => __('RAW HTML nd Color Section', 'elementor-test-extension'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'url',
			[
				'label' => __('Raw HTML', 'elementor-test-extension'),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'color',
			[
				'label' 	=> __('Color', 'elementor-test-extension'),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'default' 	=> 'red',
				'selectors' => [
					'{{WRAPPER}} h1.heading'	=> 'color: {{VALUE}}',
					'{{WRAPPER}} p.address' 	=> 'color: {{VALUE}}',
				],
			],

		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image_section',
			[
				'label' => __('Image Section', 'elementor-test-extension'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control('imagex', [
			'label' 	=> __('Image', 'elementor-test-extension'),
			'type' 		=> \Elementor\Controls_Manager::MEDIA,
			'default' 	=> [
				'url' 	=> \Elementor\Utils::get_placeholder_image_src()
			]
		]);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'default' => 'large',
				'name'    => 'imagesz'
			]
		);


		$this->end_controls_section();
	}


	protected function render()
	{

		$settings = $this->get_settings_for_display();
		$html = wp_oembed_get($settings['url']);

		//print_r($settings);
		$heading = $settings['heading'];

		$this->add_inline_editing_attributes('heading', 'none');
		$this->add_render_attribute('heading', ['class' => 'heading']);
		$this->add_inline_editing_attributes('address', 'none');
		$this->add_render_attribute('address', ['class' => 'address']);
		echo "<h1 " . $this->get_render_attribute_string('heading') . ". class='heading' >" . esc_html($heading) . "</h1> <br>";

		echo '<div class="oembed-elementor-widget">';

		echo $html;

		echo '</div>';

		echo '<p ' . $this->get_render_attribute_string('address') . '. class="address">';
		echo wp_kses_post($settings['address']);
		echo '</p>';
		//echo wp_get_attachment_image($settings['image']['id'],'medium');
		//echo '<img style="width: 200px" src="'.$settings['image']['url'].'" />';

		echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings,'imagesz','imagex');
	} 

	 protected function _content_template(){ ?> 
	
		<#
		console.log(settings); 
		var image = {
			id: settings.imagex.id,
			url: settings.imagex.url,
			size: settings.imagesz_size,
			dimension: settings.imagesz_custom_dimension
		}
		var imageURL = elementor.imagesManager.getImageUrl(image);
		#>

			<h1 class="heading">{{{settings.heading}}}</h1>
			<p class="address">{{{settings.address}}}</p>
			<img src="{{{imageURL}}}" alt="">
	<?php }


}

	
	 

	 ?>