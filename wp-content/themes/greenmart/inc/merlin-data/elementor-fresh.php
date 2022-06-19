<?php

class Greenmart_Merlin_Elementor_Fresh {
	public function import_files_wpb_el_fresh(){
		$prefix_name = 'Elementor';
		$prefix 	 = 'elementor';
		$skin 		 = 'fresh';
		$skin_name 	 = 'Fresh';
		$rev_sliders = [
			"http://demosamples.thembay.com/greenmart/${prefix}/${skin}/revslider/slider-1.zip",
			"http://demosamples.thembay.com/greenmart/${prefix}/${skin}/revslider/slider-2.zip",
			"http://demosamples.thembay.com/greenmart/${prefix}/${skin}/revslider/slider-3.zip",
			"http://demosamples.thembay.com/greenmart/${prefix}/${skin}/revslider/slider-4.zip",
			"http://demosamples.thembay.com/greenmart/${prefix}/${skin}/revslider/slider-5.zip",
		];

		$data_url = "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/data.xml";
		$widget_url = "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/widgets.wie";

		return array(
			array(
				'import_file_name'           => 'Home 1',
				'home'                       => 'home-1',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home1/redux_options.json",
						'option_name' => 'greenmart_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home1/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'greenmart' ),
				'preview_url'                => 'https://el3.thembaydev.com/greenmart_fresh/',
				'group_label_start'          => 'yes',
				'group_label_name'           => $prefix_name.' '. $skin_name,
			),
			array(
				'import_file_name'           => 'Home 2',
				'home'                       => 'home-2',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home2/redux_options.json",
						'option_name' => 'greenmart_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home2/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'greenmart' ),
				'preview_url'                => 'https://el3.thembaydev.com/greenmart_fresh/home-2/',
			),
			array(
				'import_file_name'           => 'Home 3',
				'home'                       => 'home-3',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home3/redux_options.json",
						'option_name' => 'greenmart_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home3/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'greenmart' ),
				'preview_url'                => 'https://el3.thembaydev.com/greenmart_fresh/home-3/',
			),
			array(
				'import_file_name'           => 'Home 4',
				'home'                       => 'home-4',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home4/redux_options.json",
						'option_name' => 'greenmart_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home4/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'greenmart' ),
				'preview_url'                => 'https://el3.thembaydev.com/greenmart_fresh/home-4/',
			),
			array(
				'import_file_name'           => 'Home 5',
				'home'                       => 'home-5',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home5/redux_options.json",
						'option_name' => 'greenmart_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home5/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'greenmart' ),
				'preview_url'                => 'https://el3.thembaydev.com/greenmart_fresh/home-5/',
				'group_label_end'          => 'yes',
			),
		);
	}

	public function import_files_wpb_el_fresh_rtl(){
		$prefix_name = 'Elementor';
		$prefix 	 = 'elementor';
		$skin 		 = 'fresh-rtl';
		$skin_name 	 = 'Fresh RTL';
		$rev_sliders = [
			"http://demosamples.thembay.com/greenmart/${prefix}/${skin}/revslider/slider-1.zip",
			"http://demosamples.thembay.com/greenmart/${prefix}/${skin}/revslider/slider-2.zip",
			"http://demosamples.thembay.com/greenmart/${prefix}/${skin}/revslider/slider-3.zip",
			"http://demosamples.thembay.com/greenmart/${prefix}/${skin}/revslider/slider-4.zip",
			"http://demosamples.thembay.com/greenmart/${prefix}/${skin}/revslider/slider-5.zip",
		];

		$data_url = "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/data.xml";
		$widget_url = "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/widgets.wie";

		return array(
			array(
				'import_file_name'           => 'Home 1',
				'home'                       => 'home-1',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home1/redux_options.json",
						'option_name' => 'greenmart_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home1/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'greenmart' ),
				'preview_url'                => 'https://el3.thembaydev.com/greenmart_fresh_rtl/',
				'group_label_start'          => 'yes',
				'group_label_name'           => $prefix_name.' '. $skin_name,
			),
			array(
				'import_file_name'           => 'Home 2',
				'home'                       => 'home-2',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home2/redux_options.json",
						'option_name' => 'greenmart_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home2/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'greenmart' ),
				'preview_url'                => 'https://el3.thembaydev.com/greenmart_fresh_rtl/home-2/',
			),
			array(
				'import_file_name'           => 'Home 3',
				'home'                       => 'home-3',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home3/redux_options.json",
						'option_name' => 'greenmart_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home3/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'greenmart' ),
				'preview_url'                => 'https://el3.thembaydev.com/greenmart_fresh_rtl/home-3/',
			),
			array(
				'import_file_name'           => 'Home 4',
				'home'                       => 'home-4',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home4/redux_options.json",
						'option_name' => 'greenmart_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home4/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'greenmart' ),
				'preview_url'                => 'https://el3.thembaydev.com/greenmart_fresh_rtl/home-4/',
			),
			array(
				'import_file_name'           => 'Home 5',
				'home'                       => 'home-5',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home5/redux_options.json",
						'option_name' => 'greenmart_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/${skin}/home5/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'greenmart' ),
				'preview_url'                => 'https://el3.thembaydev.com/greenmart_fresh_rtl/home-5/',
				'group_label_end'          => 'yes',
			),
		);
	}

	public function import_files_wpb_el_fresh_marketplaces(){
		$prefix_name = 'Elementor Fresh';
		$prefix 	 = 'elementor';

		return array(
			array(
				'import_file_name'           => 'Demo Dokan',
				'home'                       => 'home',
				'import_file_url'          	 => "http://demosamples.thembay.com/greenmart/${prefix}/fresh-dokan/data.xml",
				'import_widget_file_url'     => "http://demosamples.thembay.com/greenmart/${prefix}/fresh-dokan/widgets.wie",
				'import_redux'         => array(
					array(
						'file_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/fresh-dokan/home/redux_options.json",
						'option_name' => 'greenmart_tbay_theme_options',
					),
				),
				'rev_sliders'                => array(
					"http://demosamples.thembay.com/greenmart/${prefix}/fresh-dokan/revslider/slider-4.zip",
				),
				'import_preview_image_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/fresh-dokan/home/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'greenmart' ),
				'preview_url'                => 'https://el3.thembaydev.com/greenmart_fresh_dokan/',
				'group_label_start'          => 'yes',
				'group_label_name'           => $prefix_name.' '. 'Marketplaces',
			),
			array(
				'import_file_name'           => 'Demo WCMP',
				'home'                       => 'home',
				'import_file_url'          	 => "http://demosamples.thembay.com/greenmart/${prefix}/fresh-wcmp/data.xml",
				'import_widget_file_url'     => "http://demosamples.thembay.com/greenmart/${prefix}/fresh-wcmp/widgets.wie",
				'import_redux'         => array(
					array(
						'file_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/fresh-wcmp/home/redux_options.json",
						'option_name' => 'greenmart_tbay_theme_options',
					),
				),
				'rev_sliders'                => array(
					"http://demosamples.thembay.com/greenmart/${prefix}/fresh-wcmp/revslider/slider-5.zip",
				),
				'import_preview_image_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/fresh-wcmp/home/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'greenmart' ),
				'preview_url'                => 'https://el3.thembaydev.com/greenmart_fresh_wcmp/',
			),
			array(
				'import_file_name'           => 'Demo WCFM',
				'home'                       => 'home',
				'import_file_url'          	 => "http://demosamples.thembay.com/greenmart/${prefix}/fresh-wcfm/data.xml",
				'import_widget_file_url'     => "http://demosamples.thembay.com/greenmart/${prefix}/fresh-wcfm/widgets.wie",
				'import_redux'         => array(
					array(
						'file_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/fresh-wcfm/home/redux_options.json",
						'option_name' => 'greenmart_tbay_theme_options',
					),
				),
				'rev_sliders'                => array(
					"http://demosamples.thembay.com/greenmart/${prefix}/fresh-wcfm/revslider/slider-4.zip",
				),
				'import_preview_image_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/fresh-wcfm/home/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'greenmart' ),
				'preview_url'                => 'https://el3.thembaydev.com/greenmart_fresh_wcfm/',
			),
			array(
				'import_file_name'           => 'Demo WCVendors',
				'home'                       => 'home',
				'import_file_url'          	 => "http://demosamples.thembay.com/greenmart/${prefix}/fresh-wcvendors/data.xml",
				'import_widget_file_url'     => "http://demosamples.thembay.com/greenmart/${prefix}/fresh-wcvendors/widgets.wie",
				'import_redux'         => array(
					array(
						'file_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/fresh-wcvendors/home/redux_options.json",
						'option_name' => 'greenmart_tbay_theme_options',
					),
				),
				'rev_sliders'                => array(
					"http://demosamples.thembay.com/greenmart/${prefix}/fresh-wcvendors/revslider/slider-5.zip",
				),
				'import_preview_image_url'   => "http://demosamples.thembay.com/greenmart/${prefix}/fresh-wcvendors/home/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'greenmart' ),
				'preview_url'                => 'https://el3.thembaydev.com/greenmart_fresh_wcvendors/',
				'group_label_end'          => 'yes',
			),
		);
	}
}