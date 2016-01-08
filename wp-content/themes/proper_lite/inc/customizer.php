<?php
/**
 * properlite Theme Customizer 
 *
 * @package properlite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object. 
 */
function properlite_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
//-------------------------------------------------------------------------------------------------------------------//
// Move and Replace
//-------------------------------------------------------------------------------------------------------------------// 
	
	//Colors
	$wp_customize->add_panel( 'properlite_colors_panel', array( 
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'General Colors', 'properlite' ),
    'description'    => __( 'Edit your general color settings.', 'properlite' ),
	));
	
	//Nav
	$wp_customize->add_panel( 'properlite_nav_panel', array(
    'priority'       => 11,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Navigation', 'properlite' ),
    'description'    => __( 'Edit your theme navigation settings.', 'properlite' ),
	));
	
	// nav 
	$wp_customize->add_section( 'nav', array( 
	'title' => __( 'Navigation Settings', 'properlite' ),
	'priority' => '10', 
	'panel' => 'properlite_nav_panel'
	) );
	
	// colors
	$wp_customize->add_section( 'colors', array(
	'title' => __( 'Theme Colors', 'properlite' ),   
	'priority' => '10', 
	'panel' => 'properlite_colors_panel' 
	) );
	
	// Move sections up 
	$wp_customize->get_section('static_front_page')->priority = 10; 
	
	//premiums are better
    class properlite_Info extends WP_Customize_Control { 
     
        public $label = '';
        public function render_content() {
        ?>

        <?php
        }
    }	
	

//-------------------------------------------------------------------------------------------------------------------//
// Upgrade
//-------------------------------------------------------------------------------------------------------------------//

    $wp_customize->add_section(
        'properlite_theme_info',
        array(
            'title' => __('Proper Premium', 'properlite'), 
            'priority' => 5, 
            'description' => __('Need some more Proper? If you want to see what additional features <a href="http://modernthemes.net/premium-wordpress-themes/proper/" target="_blank">Proper Premium</a> has, check them all out right <a href="http://modernthemes.net/premium-wordpress-themes/proper/" target="_blank">here</a>.', 'properlite'), 
        )
    );
	 
    //show them what we have to offer 
    $wp_customize->add_setting('properlite_help', array(
			'sanitize_callback' => 'properlite_no_sanitize',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new properlite_Info( $wp_customize, 'properlite_help', array( 
        'section' => 'properlite_theme_info', 
        'settings' => 'properlite_help',  
        'priority' => 10
        ) )
    );
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Navigation
//-------------------------------------------------------------------------------------------------------------------//


	//Navigation/Menu Options
	$wp_customize->add_setting( 'properlite_menu_method', array( 
		'default'	        => 'option1', 
		'sanitize_callback' => 'properlite_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'properlite_menu_method', array(
		'description'    => __( 'Choose between a the Icon Toggle Menu or a classic listed menu.', 'properlite' ),
		'section'  => 'nav', 
		'settings' => 'properlite_menu_method',
		'type'     => 'radio',
		'choices'  => array(
			'option1' => __( 'Toggle Menu', 'properlite' ),
			'option2' => __( 'Classic Menu', 'properlite' ), 
			), 
		'input_attrs' => array(
            'style' => 'margin-top: 15px; padding: 15px;', 
        ),
	)));
	
	$wp_customize->add_setting( 'properlite_menu_toggle', array(
		'default' => 'icon', 
    	'capability' => 'edit_theme_options',
    	'sanitize_callback' => 'properlite_sanitize_menu_toggle_display', 
  	));

  	$wp_customize->add_control( 'properlite_menu_toggle_radio', array(
    	'settings' => 'properlite_menu_toggle',
    	'label'    => __( 'Menu Toggle Display', 'properlite' ), 
    	'section'  => 'nav',
    	'type'     => 'radio',
    	'choices'  => array(
      		'icon' => __( 'Icon', 'properlite' ),
      		'label' => __( 'Menu', 'properlite' ),
      		'icon-label' => __( 'Icon and Menu', 'properlite' ) 
    	),
	));
	
	//nav font size
    $wp_customize->add_setting( 
        'properlite_nav_text_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
        )
    );
	
    $wp_customize->add_control( 'properlite_nav_text_size', array( 
        'type'        => 'number', 
        'priority'    => 30,
        'section'     => 'nav',  
        'label'       => __('Navigation Font Size', 'properlite'), 
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 32, 
            'step'  => 1,
            'style' => 'margin-bottom: 10px; padding: 10px;',
        ),
  	));
	
	// Nav Colors
    $wp_customize->add_section( 'properlite_nav_colors_section' , array(
	    'title'       => __( 'Navigation Colors', 'properlite' ),
	    'priority'    => 20, 
	    'description' => __( 'Set your theme navigation colors.', 'properlite'),
		'panel' => 'properlite_nav_panel',
	));
	
	$wp_customize->add_setting( 'properlite_nav_bg_color', array(
        'default'     => '#0c0c0c',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_nav_bg_color', array(
        'label'	   => __( 'Navigation Background Color', 'properlite' ),
        'section'  => 'properlite_nav_colors_section',
        'settings' => 'properlite_nav_bg_color',
		'priority' => 10
    )));
	
	$wp_customize->add_setting( 'properlite_nav_link_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_nav_link_color', array(
        'label'	   => __( 'Navigation Link Color', 'properlite' ),
        'section'  => 'properlite_nav_colors_section',
        'settings' => 'properlite_nav_link_color',
		'priority' => 20 
    )));
	
	$wp_customize->add_setting( 'properlite_nav_link_hover_color', array(
        'default'     => '#999999', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_nav_link_hover_color', array(
        'label'	   => __( 'Navigation Link Hover Color', 'properlite' ),
        'section'  => 'properlite_nav_colors_section',
        'settings' => 'properlite_nav_link_hover_color', 
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'properlite_menu_button', array(
        'default'     => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_menu_button', array(
        'label'	   => __( 'Navigation Button', 'properlite' ),
        'section'  => 'properlite_nav_colors_section',
        'settings' => 'properlite_menu_button',
		'priority' => 40 
    )));
	
	$wp_customize->add_setting( 'properlite_menu_button_hover', array(
        'default'     => '#444444',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_menu_button_hover', array(
        'label'	   => __( 'Navigation Button Hover', 'properlite' ),
        'section'  => 'properlite_nav_colors_section',
        'settings' => 'properlite_menu_button_hover',
		'priority' => 50 
    )));
	
	$wp_customize->add_setting( 'properlite_nav_dropdown_bg', array(
        'default'     => '#212121',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_nav_dropdown_bg', array(
        'label'	   => __( 'Classic Menu Dropdown Background', 'properlite' ),
        'section'  => 'properlite_nav_colors_section',
        'settings' => 'properlite_nav_dropdown_bg',
		'priority' => 55 
    )));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Logos and Favicons
//-------------------------------------------------------------------------------------------------------------------//
	
	
	// Logo upload
    $wp_customize->add_section( 'properlite_logo_section' , array(  
	    'title'       => __( 'Logo and Icons', 'properlite' ),
	    'priority'    => 20, 
	    'description' => __( 'Upload a logo to replace the default site name and description in the header. Also, upload your site favicon and Apple Icons.', 'properlite'),
	));

	$wp_customize->add_setting( 'properlite_logo', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'properlite_logo', array( 
		'label'    => __( 'Logo', 'properlite' ),
		'type'           => 'image',
		'section'  => 'properlite_logo_section', 
		'settings' => 'properlite_logo',
		'priority' => 10,
	))); 
	
	// Logo Width
	$wp_customize->add_setting( 'logo_size', array(
	    'sanitize_callback' => 'absint',
		'default' => '120'
	));

	$wp_customize->add_control( 'logo_size', array( 
		'label'    => __( 'Logo Size', 'properlite' ), 
		'description' => __( 'Change the width of the Logo in PX. Only enter numeric value.', 'properlite' ),
		'section'  => 'properlite_logo_section', 
		'settings' => 'logo_size',
		'type'        => 'number',
		'priority'   => 30,
		'input_attrs' => array(
            'style' => 'margin-bottom: 15px;',  
        ), 
	));
	
	//Favicon Upload
	$wp_customize->add_setting(
		'site_favicon',
		array(
			'sanitize_callback' => 'esc_url_raw',
	));
	
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_favicon',
            array(
               'label'          => __( 'Upload your favicon (16x16 pixels)', 'properlite' ),
			   'type' 			=> 'image',
               'section'        => 'properlite_logo_section',
               'settings'       => 'site_favicon',
               'priority' => 40,
    )));
	
    //Apple touch icon 144
    $wp_customize->add_setting(
        'apple_touch_144',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
    ));
	
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_144',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (144x144 pixels)', 'properlite' ),
               'type'           => 'image',
               'section'        => 'properlite_logo_section',
               'settings'       => 'apple_touch_144',
               'priority'       => 45,
    )));
	
    //Apple touch icon 114
    $wp_customize->add_setting(
        'apple_touch_114',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw', 
    ));

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_114',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (114x114 pixels)', 'properlite' ),
               'type'           => 'image',
               'section'        => 'properlite_logo_section',
               'settings'       => 'apple_touch_114',
               'priority'       => 50,
    )));
	
    //Apple touch icon 72
    $wp_customize->add_setting(
        'apple_touch_72',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
    ));
	
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_72',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (72x72 pixels)', 'properlite' ),
               'type'           => 'image',
               'section'        => 'properlite_logo_section', 
               'settings'       => 'apple_touch_72',
               'priority'       => 60,
    )));
	
    //Apple touch icon 57
    $wp_customize->add_setting(
        'apple_touch_57',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
    ));
	
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_57',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (57x57 pixels)', 'properlite' ),
               'type'           => 'image',
               'section'        => 'properlite_logo_section',
               'settings'       => 'apple_touch_57',
               'priority'       => 70,
    )));
	

//-------------------------------------------------------------------------------------------------------------------//
// Hero Section
//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_panel( 'properlite_home_hero_panel', array(
    'priority'       => 22,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Home Hero Section', 'properlite' ),
    'description'    => __( 'Edit your home page settings', 'properlite' ),
	));
	
	//Home Hero Section
    $wp_customize->add_section( 'properlite_home_hero_section' , array(  
	    'title'       => __( 'Home Hero Options', 'properlite' ),
	    'priority'    => 10, 
	    'description' => __( 'Edit the options for the home page Hero section.', 'properlite'),
		'panel' => 'properlite_home_hero_panel',
	));
	
	$wp_customize->add_setting( 'properlite_home_bg_image', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'properlite_home_bg_image', array( 
		'label'    => __( 'Background Image', 'properlite' ),
		'type'           => 'image', 
		'section'  => 'properlite_home_hero_section', 
		'settings' => 'properlite_home_bg_image', 
		'priority' => 10,
	)));

    $wp_customize->add_setting( 'properlite_home_bg_image2', array(
        'sanitize_callback' => 'esc_url_raw',
    ));    

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'properlite_home_bg_image2', array( 
        'label'    => __( 'Background Image 2', 'properlite' ),
        'type'           => 'image', 
        'section'  => 'properlite_home_hero_section', 
        'settings' => 'properlite_home_bg_image2', 
        'priority' => 11,
    )));
	
    $wp_customize->add_setting( 'properlite_home_bg_image3', array(
        'sanitize_callback' => 'esc_url_raw',
    ));    

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'properlite_home_bg_image3', array( 
        'label'    => __( 'Background Image 3', 'properlite' ),
        'type'           => 'image', 
        'section'  => 'properlite_home_hero_section', 
        'settings' => 'properlite_home_bg_image3', 
        'priority' => 11,
    )));
	$wp_customize->add_setting( 'properlite_hero_bg_color', array(
        'default'     => '#111111', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hero_bg_color', array(
        'label'	   => __( 'Background Color', 'properlite' ),
        'section'  => 'properlite_home_hero_section',
        'settings' => 'properlite_hero_bg_color',
		'priority' => 15
    ))); 
	
	//Title
	$wp_customize->add_setting( 'properlite_home_title',
	    array(
	        'sanitize_callback' => 'properlite_sanitize_text',  
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'properlite_home_title', array(
		'label'    => __( 'Title Text', 'properlite' ), 
		'section'  => 'properlite_home_hero_section',  
		'settings' => 'properlite_home_title', 
		'priority'   => 20
	)));

    //Logo Central
    $wp_customize->add_setting( 'properlite_home_central_logo',
        array(
            'sanitize_callback' => 'esc_url_raw', 
    )); 

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'properlite_home_central_logo', array( 
        'label'    => __( 'Central Logo', 'properlite' ),
        'type'           => 'image', 
        'section'  => 'properlite_home_hero_section', 
        'settings' => 'properlite_home_central_logo', 
        'priority' => 21,
    )));
	
	$wp_customize->add_setting( 'properlite_hero_heading_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hero_heading_color', array(
        'label'	   => __( 'Title Color', 'properlite' ),
        'section'  => 'properlite_home_hero_section',
        'settings' => 'properlite_hero_heading_color',
		'priority' => 25
    )));
	
	//Button Text
	$wp_customize->add_setting( 'properlite_home_button_text',
	    array(
	        'sanitize_callback' => 'properlite_sanitize_text',  
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'properlite_home_button_text', array(
		'label'    => __( 'Button Text', 'properlite' ), 
		'section'  => 'properlite_home_hero_section',  
		'settings' => 'properlite_home_button_text', 
		'priority'   => 30
	)));
	
	
	// Page Drop Downs 
	$wp_customize->add_setting('properlite_home_button_url', array( 
		'capability' => 'edit_theme_options', 
        'sanitize_callback' => 'properlite_sanitize_int' 
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'properlite_home_button_url', array( 
    	'label' => __( 'Hero Button URL', 'properlite' ), 
    	'section' => 'properlite_home_hero_section', 
		'type' => 'dropdown-pages',
    	'settings' => 'properlite_home_button_url', 
		'priority'   => 40  
	)));
	
	
	$wp_customize->add_setting( 'properlite_button_text_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_button_text_color', array(
        'label'	   => __( 'Button Text Color', 'properlite' ),
        'section'  => 'properlite_home_hero_section',
        'settings' => 'properlite_button_text_color',
		'priority' => 45
    )));
	
	$wp_customize->add_setting( 'properlite_button_bg_color', array(
        'default'     => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_button_bg_color', array(
        'label'	   => __( 'Button Background Color', 'properlite' ),
        'section'  => 'properlite_home_hero_section',
        'settings' => 'properlite_button_bg_color',
		'priority' => 50
    )));
	
	$wp_customize->add_setting( 'properlite_button_hover_color', array(
        'default'     => '#444444',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_button_hover_color', array(
        'label'	   => __( 'Button Hover Color', 'properlite' ),
        'section'  => 'properlite_home_hero_section',
        'settings' => 'properlite_button_hover_color',
		'priority' => 60
    )));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Home Page
//-------------------------------------------------------------------------------------------------------------------//
	
	
	$wp_customize->add_panel( 'properlite_home_page_panel', array(
    'priority'       => 25,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Home Page Options', 'properlite' ),
    'description'    => __( 'Edit your home page settings', 'properlite' ),
	));
	
	//First Widget Area
    $wp_customize->add_section( 'properlite_home_widget_section_1' , array(  
	    'title'       => __( 'Home Widget Area #1', 'properlite' ),
	    'priority'    => 10, 
	    'description' => __( 'Edit the options for the first home page widget area.', 'properlite'),
		'panel' 	  => 'properlite_home_page_panel', 
	));
	
	
	// Number of Widget Columns 
	$wp_customize->add_setting( 'properlite_widget_column_one', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'properlite_sanitize_widget_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'properlite_widget_column_one', array(
		'label'    => __( 'Number of Widget Columns', 'properlite' ),
		'description'    => __( '1 Column will take up the entire widget area, while 4 columns will give space to use 4 widgets for content in one row. Recommended: Set to 1 Column if you are using ModernThemes plugin widgets.', 'properlite' ),
		'section'  => 'properlite_home_widget_section_1', 
		'settings' => 'properlite_widget_column_one', 
		'type'     => 'radio',
		'priority'   => 5,  
		'choices'  => array(
			'option1' => __( '1 Column', 'properlite' ),
			'option2' => __( '2 Columns', 'properlite' ), 
			'option3' => __( '3 Columns', 'properlite' ),
			'option4' => __( '4 Columns', 'properlite' ),
			),
		'input_attrs' => array(
            'style' => 'margin-bottom: 10px; padding: 10px;',
        ),
	)));
	
	
	//Hide Section 
	$wp_customize->add_setting('active_hw_1',
	    array(
	        'sanitize_callback' => 'properlite_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_hw_1', array(
        'type' => 'checkbox',
        'label' => __( 'Hide Home Widget Area #1', 'properlite' ),
        'section' => 'properlite_home_widget_section_1', 
		'priority'   => 10
    ));
	
	$wp_customize->add_setting( 'properlite_hw_area_1_bg_color', array(
        'default'     => '#f5f5f3',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hw_area_1_bg_color', array(
        'label'	   => __( 'Background Color', 'properlite' ),
        'section'  => 'properlite_home_widget_section_1',
        'settings' => 'properlite_hw_area_1_bg_color',
		'priority' => 20 
    )));
	
	$wp_customize->add_setting( 'properlite_hw_area_1_text_color', array(
        'default'     => '#404040',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hw_area_1_text_color', array(
        'label'	   => __( 'Text Color', 'properlite' ),
        'section'  => 'properlite_home_widget_section_1',
        'settings' => 'properlite_hw_area_1_text_color',
		'priority' => 30 
    )));
	
	$wp_customize->add_setting( 'properlite_hw_area_1_heading_color', array(
        'default'     => '#404040',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hw_area_1_heading_color', array(
        'label'	   => __( 'Heading Color', 'properlite' ),
        'section'  => 'properlite_home_widget_section_1',
        'settings' => 'properlite_hw_area_1_heading_color',
		'priority' => 35
    )));
	
	$wp_customize->add_setting( 'properlite_hw_area_1_link_color', array(
        'default'     => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hw_area_1_link_color', array(
        'label'	   => __( 'Link Color', 'properlite' ),
        'section'  => 'properlite_home_widget_section_1',
        'settings' => 'properlite_hw_area_1_link_color', 
		'priority' => 38
    )));
	
	$wp_customize->add_setting( 'properlite_hw_area_1_link_hover_color', array(
        'default'     => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hw_area_1_link_hover_color', array(
        'label'	   => __( 'Link Hover Color', 'properlite' ),
        'section'  => 'properlite_home_widget_section_1',
        'settings' => 'properlite_hw_area_1_link_hover_color', 
		'priority' => 39
    )));
	
	$wp_customize->add_setting( 'properlite_hw_area_1_button_color', array(
        'default'     => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hw_area_1_button_color', array(
        'label'	   => __( 'Button Color', 'properlite' ),
        'section'  => 'properlite_home_widget_section_1',
        'settings' => 'properlite_hw_area_1_button_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'properlite_hw_area_1_button_hover_color', array(
        'default'     => '#444444', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hw_area_1_button_hover_color', array(
        'label'	   => __( 'Button Hover Color', 'properlite' ),
        'section'  => 'properlite_home_widget_section_1',
        'settings' => 'properlite_hw_area_1_button_hover_color',
		'priority' => 50  
    ))); 
	
	//Second Widget Area
    $wp_customize->add_section( 'properlite_home_widget_section_2' , array(  
	    'title'       => __( 'Home Widget Area #2', 'properlite' ),
	    'priority'    => 20, 
	    'description' => __( 'Edit the options for the second home page widget area.', 'properlite'),
		'panel' 	  => 'properlite_home_page_panel',
	));
	
	// Number of Widget Columns 
	$wp_customize->add_setting( 'properlite_widget_column_two', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'properlite_sanitize_widget_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'properlite_widget_column_two', array(
		'label'    => __( 'Number of Widget Columns', 'properlite' ),
		'description'    => __( '1 Column will take up the entire widget area, while 4 columns will give space to use 4 widgets for content in one row. Recommended: Set to 1 Column if you are using ModernThemes plugin widgets.', 'properlite' ),
		'section'  => 'properlite_home_widget_section_2', 
		'settings' => 'properlite_widget_column_two', 
		'type'     => 'radio',
		'priority'   => 5,  
		'choices'  => array(
			'option1' => __( '1 Column', 'properlite' ),
			'option2' => __( '2 Columns', 'properlite' ), 
			'option3' => __( '3 Columns', 'properlite' ),
			'option4' => __( '4 Columns', 'properlite' ),
			),
		'input_attrs' => array(
            'style' => 'margin-bottom: 10px; padding: 10px;',
        ),
	)));
	
	//Hide Section 
	$wp_customize->add_setting('active_hw_2',
	    array(
	        'sanitize_callback' => 'properlite_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_hw_2', array(
        'type' => 'checkbox',
        'label' => __( 'Hide Home Widget Area #2', 'properlite' ),
        'section' => 'properlite_home_widget_section_2', 
		'priority'   => 10
    ));
	
	$wp_customize->add_setting( 'properlite_hw_area_2_bg_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hw_area_2_bg_color', array(
        'label'	   => __( 'Background Color', 'properlite' ),
        'section'  => 'properlite_home_widget_section_2',
        'settings' => 'properlite_hw_area_2_bg_color',
		'priority' => 20 
    )));
	
	$wp_customize->add_setting( 'properlite_hw_area_2_text_color', array(
        'default'     => '#404040',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hw_area_2_text_color', array(
        'label'	   => __( 'Text Color', 'properlite' ),
        'section'  => 'properlite_home_widget_section_2',
        'settings' => 'properlite_hw_area_2_text_color',
		'priority' => 30 
    )));
	
	
	$wp_customize->add_setting( 'properlite_hw_area_2_heading_color', array(
        'default'     => '#404040',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hw_area_2_heading_color', array(
        'label'	   => __( 'Heading Color', 'properlite' ),
        'section'  => 'properlite_home_widget_section_2',
        'settings' => 'properlite_hw_area_2_heading_color',
		'priority' => 35
    )));
	
	$wp_customize->add_setting( 'properlite_hw_area_2_link_color', array(
        'default'     => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hw_area_2_link_color', array(
        'label'	   => __( 'Link Color', 'properlite' ),
        'section'  => 'properlite_home_widget_section_2',
        'settings' => 'properlite_hw_area_2_link_color', 
		'priority' => 38
    )));
	
	$wp_customize->add_setting( 'properlite_hw_area_2_link_hover_color', array(
        'default'     => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hw_area_2_link_hover_color', array(
        'label'	   => __( 'Link Hover Color', 'properlite' ),
        'section'  => 'properlite_home_widget_section_2',
        'settings' => 'properlite_hw_area_2_link_hover_color', 
		'priority' => 39
    )));
	
	
	$wp_customize->add_setting( 'properlite_hw_area_2_button_color', array(
        'default'     => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hw_area_2_button_color', array(
        'label'	   => __( 'Button Color', 'properlite' ),
        'section'  => 'properlite_home_widget_section_2',
        'settings' => 'properlite_hw_area_2_button_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'properlite_hw_area_2_button_hover_color', array(
        'default'     => '#444444', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hw_area_2_button_hover_color', array(
        'label'	   => __( 'Button Hover Color', 'properlite' ),
        'section'  => 'properlite_home_widget_section_2',
        'settings' => 'properlite_hw_area_2_button_hover_color', 
		'priority' => 50  
    )));

	
	// Footer Panel
	$wp_customize->add_panel( 'properlite_footer_panel', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Footer Options', 'properlite' ),
    'description'    		 => __( 'Edit your footer options', 'properlite' ),
	));
	
	// Add Footer CTA
	$wp_customize->add_section( 'footer-custom-cta' , array(
    	'title' => __( 'Footer Call-to-Action', 'properlite' ),
    	'priority' => 10,
    	'description' => __( 'Customize your footer call-to-action area', 'properlite' ),
		'panel' => 'properlite_footer_panel'
	));
	
	$wp_customize->add_setting( 'properlite_footer_cta_color', array( 
        'default'     => '#ffffff',  
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_footer_cta_color', array(
        'label'	   => __( 'Background Color', 'properlite'),
        'section'  => 'footer-custom-cta',
        'settings' => 'properlite_footer_cta_color',
		'priority' => 10
    )));
	
	$wp_customize->add_setting( 'properlite_footer_cta_text_color', array( 
        'default'     => '#404040', 
        'sanitize_callback' => 'sanitize_hex_color',  
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_footer_cta_text_color', array(
        'label'	   => __( 'Text Color', 'properlite'),
        'section'  => 'footer-custom-cta',
        'settings' => 'properlite_footer_cta_text_color',
		'priority' => 20
    )));
	
	$wp_customize->add_setting( 'properlite_footer_cta_heading_color', array( 
        'default'     => '#404040', 
        'sanitize_callback' => 'sanitize_hex_color',  
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_footer_cta_heading_color', array(
        'label'	   => __( 'Heading Color', 'properlite'),
        'section'  => 'footer-custom-cta',
        'settings' => 'properlite_footer_cta_heading_color', 
		'priority' => 25
    )));
	
	$wp_customize->add_setting( 'properlite_footer_cta_link_color', array(  
        'default'     => '#404040', 
        'sanitize_callback' => 'sanitize_hex_color',  
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_footer_cta_link_color', array(
        'label'	   => __( 'Link Color', 'properlite'),
        'section'  => 'footer-custom-cta',
        'settings' => 'properlite_footer_cta_link_color', 
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'properlite_footer_cta_link_hover_color', array(  
        'default'     => '#404040', 
        'sanitize_callback' => 'sanitize_hex_color',  
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_footer_cta_link_hover_color', array(
        'label'	   => __( 'Link Hover Color', 'properlite'),
        'section'  => 'footer-custom-cta',
        'settings' => 'properlite_footer_cta_link_hover_color', 
		'priority' => 40
    )));
	
	$wp_customize->add_setting( 'properlite_footer_cta_border_color', array( 
        'default'     => '#ededed', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_footer_cta_border_color', array(
        'label'	   => __( 'Border Color', 'properlite'),
        'section'  => 'footer-custom-cta',
        'settings' => 'properlite_footer_cta_border_color', 
		'priority' => 50
    )));
	
	$wp_customize->add_setting( 'properlite_footer_cta_button_color', array(
        'default'     => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_footer_cta_button_color', array(
        'label'	   => __( 'Button Color', 'properlite' ),
        'section'  => 'footer-custom-cta',
        'settings' => 'properlite_footer_cta_button_color',
		'priority' => 60 
    ))); 
	
	$wp_customize->add_setting( 'properlite_footer_cta_button_hover_color', array(
        'default'     => '#444444', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_footer_cta_button_hover_color', array(
        'label'	   => __( 'Button Hover Color', 'properlite' ),
        'section'  => 'footer-custom-cta',
        'settings' => 'properlite_footer_cta_button_hover_color', 
		'priority' => 70  
    ))); 
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Footer
//-------------------------------------------------------------------------------------------------------------------//
	 
	// Add Footer Section
	$wp_customize->add_section( 'footer-custom' , array(
    	'title' => __( 'Footer', 'properlite' ),
    	'priority' => 20,
    	'description' => __( 'Customize your footer area', 'properlite' ),
		'panel' => 'properlite_footer_panel'
	));

	$wp_customize->add_setting( 'properlite_footer_logo', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'properlite_footer_logo', array( 
		'label'    => __( 'Footer Logo', 'properlite' ),
		'type'           => 'image',
		'section'  => 'footer-custom', 
		'settings' => 'properlite_footer_logo',
		'priority' => 10,
	)));

    $wp_customize->add_setting( 'properlite_footer_logo_left', array(
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'properlite_footer_logo_left', array( 
        'label'    => __( 'Footer Left Logo', 'properlite' ),
        'type'           => 'image',
        'section'  => 'footer-custom', 
        'settings' => 'properlite_footer_logo_left',
        'priority' => 11,
    )));
	
	// Footer Logo Width
	$wp_customize->add_setting( 'footer_logo_size', array(
	    'sanitize_callback' => 'absint',
		'default' => '120'
	));

	$wp_customize->add_control( 'footer_logo_size', array( 
		'label'    => __( 'Footer Logo Size', 'properlite' ),
		'description' => __( 'Change the width of the Logo in PX. Only enter numeric value.', 'properlite' ),
		'section'  => 'footer-custom', 
		'settings' => 'footer_logo_size', 
		'type'        => 'number',
		'priority'   => 20,
		'input_attrs' => array(
            'style' => 'margin-bottom: 15px;',  
        ),
	));

    // Footer Left Logo Width
    $wp_customize->add_setting( 'footer_logo_size_left', array(
        'sanitize_callback' => 'absint',
        'default' => '120'
    ));

    $wp_customize->add_control( 'footer_logo_size_left', array( 
        'label'    => __( 'Footer Left Logo Size', 'properlite' ),
        'description' => __( 'Change the width of the Left Logo in PX. Only enter numeric value.', 'properlite' ),
        'section'  => 'footer-custom', 
        'settings' => 'footer_logo_size_left', 
        'type'        => 'number',
        'priority'   => 21,
        'input_attrs' => array(
            'style' => 'margin-bottom: 15px;',  
        ),
    ));
	
	// Footer Text
	$wp_customize->add_setting( 'properlite_footer_text',
	    array(
	        'sanitize_callback' => 'properlite_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'properlite_footer_text', array(
	'type'     => 'textarea',
    'label' => __( 'Footer Text', 'properlite' ),
    'section' => 'footer-custom', 
    'settings' => 'properlite_footer_text',
	'priority'   => 25
	)));

	// Footer Byline Text 
	$wp_customize->add_setting( 'properlite_footerid',
	    array(
	        'sanitize_callback' => 'properlite_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'properlite_footerid', array(
    'label' => __( 'Footer Byline Text', 'properlite' ),
    'section' => 'footer-custom', 
    'settings' => 'properlite_footerid',
	'priority'   => 30
	)));
	
	//Hide Section 
	$wp_customize->add_setting('active_byline',
	    array(
	        'sanitize_callback' => 'properlite_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_byline', array(
        'type' => 'checkbox',
        'label' => __( 'Hide Footer Byline', 'properlite' ),
        'section' => 'footer-custom',  
		'priority'   => 35
    ));
	
	$wp_customize->add_setting( 'properlite_footer_color', array( 
        'default'     => '#040404',  
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_footer_color', array(
        'label'	   => __( 'Footer Background Color', 'properlite'),
        'section'  => 'footer-custom',
        'settings' => 'properlite_footer_color',
		'priority' => 40
    )));
	
	$wp_customize->add_setting( 'properlite_footer_text_color', array( 
        'default'     => '#cccccc', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_footer_text_color', array(
        'label'	   => __( 'Footer Text Color', 'properlite'),
        'section'  => 'footer-custom',
        'settings' => 'properlite_footer_text_color', 
		'priority' => 50
    )));
	
	$wp_customize->add_setting( 'properlite_footer_heading_color', array( 
        'default'     => '#cccccc', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_footer_heading_color', array(
        'label'	   => __( 'Footer Heading Color', 'properlite'),
        'section'  => 'footer-custom',
        'settings' => 'properlite_footer_heading_color',
		'priority' => 50
    )));
	
	$wp_customize->add_setting( 'properlite_footer_link_color', array(  
        'default'     => '#cccccc', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_footer_link_color', array(
        'label'	   => __( 'Footer Link Color', 'properlite'),  
        'section'  => 'footer-custom',
        'settings' => 'properlite_footer_link_color', 
		'priority' => 60 
    )));
	
	$wp_customize->add_setting( 'properlite_footer_link_hover_color', array(  
        'default'     => '#cccccc', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_footer_link_hover_color', array(
        'label'	   => __( 'Footer Link Hover Color', 'properlite'),  
        'section'  => 'footer-custom', 
        'settings' => 'properlite_footer_link_hover_color', 
		'priority' => 70
    )));
	
	$wp_customize->add_setting( 'properlite_footer_button_color', array(
        'default'     => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_footer_button_color', array(
        'label'	   => __( 'Button Color', 'properlite' ),
        'section'  => 'footer-custom',
        'settings' => 'properlite_footer_button_color',
		'priority' => 80 
    ))); 
	
	$wp_customize->add_setting( 'properlite_footer_button_hover_color', array(
        'default'     => '#444444', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_footer_button_hover_color', array(
        'label'	   => __( 'Button Hover Color', 'properlite' ),
        'section'  => 'footer-custom',
        'settings' => 'properlite_footer_button_hover_color', 
		'priority' => 90
    ))); 
    
	
//-------------------------------------------------------------------------------------------------------------------//
// Social Icons
//-------------------------------------------------------------------------------------------------------------------//


	$wp_customize->add_panel( 'social_panel', array(
    'priority'       => 38,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Social Media Icons', 'properlite' ),
    'description'    => __( 'Edit your social media icons', 'properlite' ),
	)); 
	
	//Social Section
	$wp_customize->add_section( 'properlite_settings', array(
            'title'          => __( 'Social Media Settings', 'properlite' ),
            'priority'       => 10,
			'panel' => 'social_panel',
    ) );
	
	//Hide Social Section 
	$wp_customize->add_setting('active_social',
	    array(
	        'sanitize_callback' => 'properlite_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 
    'active_social', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Social Media Icons', 'properlite' ),
        'section' => 'properlite_settings',  
		'priority'   => 10
    ));
	
	//social font size
    $wp_customize->add_setting( 
        'properlite_social_text_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '20',
        )
    );
	
    $wp_customize->add_control( 'properlite_social_text_size', array(
        'type'        => 'number', 
        'priority'    => 15,
        'section'     => 'properlite_settings', 
        'label'       => __('Social Icon Size', 'properlite'), 
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 32, 
            'step'  => 1,
            'style' => 'margin-bottom: 10px; padding: 10px;',
        ),
  	));
		
	//Social Icon Colors
	$wp_customize->add_setting( 'properlite_social_color', array( 
        'default'     => '#ffffff',  
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_social_color', array(
        'label'	   => __( 'Social Icon Color', 'properlite' ),
        'section'  => 'properlite_settings',
        'settings' => 'properlite_social_color', 
		'priority' => 20
    )));
	
	$wp_customize->add_setting( 'properlite_social_color_hover', array( 
        'default'     => '#999999',  
		'sanitize_callback' => 'sanitize_hex_color',  
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_social_color_hover', array(
        'label'	   => __( 'Social Icon Hover Color', 'properlite' ), 
        'section'  => 'properlite_settings',
        'settings' => 'properlite_social_color_hover', 
		'priority' => 30
    ))); 
	

//-------------------------------------------------------------------------------------------------------------------//
// General Colors
//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_setting( 'properlite_text_color', array(
        'default'     => '#404040',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_text_color', array(
        'label'	   => __( 'Text Color', 'properlite' ),
        'section'  => 'colors',
        'settings' => 'properlite_text_color',
		'priority' => 10 
    ))); 
	
    $wp_customize->add_setting( 'properlite_link_color', array( 
        'default'     => '#000000',   
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_link_color', array(
        'label'	   => __( 'Link Color', 'properlite'),
        'section'  => 'colors',
        'settings' => 'properlite_link_color', 
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'properlite_hover_color', array(
        'default'     => '#999999',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_hover_color', array(
        'label'	   => __( 'Hover Color', 'properlite' ), 
        'section'  => 'colors',
        'settings' => 'properlite_hover_color',
		'priority' => 35 
    )));
	
	$wp_customize->add_setting( 'properlite_site_title_color', array(
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
	
	 $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_site_title_color', array(
        'label'	   => __( 'Site Title Color', 'properlite' ),  
        'section'  => 'colors',
        'settings' => 'properlite_site_title_color',
		'priority' => 40
    )));
	
	
	
	//Page Colors
    $wp_customize->add_section( 'properlite_page_colors_section' , array(  
	    'title'       => __( 'Page Colors', 'properlite' ),
	    'priority'    => 20, 
	    'description' => __( 'Set your page colors.', 'properlite'),
		'panel' => 'properlite_colors_panel', 
	));
	
	$wp_customize->add_setting( 'properlite_page_header', array(
        'default'     => '#222222', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_page_header', array(
        'label'	   => __( 'Page Header Background Color', 'properlite' ),
        'section'  => 'properlite_page_colors_section',
        'settings' => 'properlite_page_header',
		'priority' => 35
    ))); 
	
	$wp_customize->add_setting( 'properlite_entry', array(
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_entry', array(
        'label'	   => __( 'Entry Title Color', 'properlite' ), 
        'section'  => 'properlite_page_colors_section',
        'settings' => 'properlite_entry',  
		'priority' => 55
    )));
	
	$wp_customize->add_setting( 'properlite_custom_color', array( 
        'default'     => '#111111', 
		'sanitize_callback' => 'sanitize_hex_color',
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_custom_color', array(
        'label'	   => __( 'Button Color', 'properlite' ), 
        'section'  => 'properlite_page_colors_section',
        'settings' => 'properlite_custom_color', 
		'priority' => 65
    )));
	
	$wp_customize->add_setting( 'properlite_custom_color_hover', array( 
        'default'     => '#444444', 
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_custom_color_hover', array(
        'label'	   => __( 'Button Hover Color', 'properlite' ), 
        'section'  => 'properlite_page_colors_section',
        'settings' => 'properlite_custom_color_hover', 
		'priority' => 75
    )));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Fonts
//-------------------------------------------------------------------------------------------------------------------//	
	
    $wp_customize->add_section(
        'properlite_typography',
        array(
            'title' => __('Fonts', 'properlite' ),   
            'priority' => 45, 
    ));
	
    $font_choices = 
        array(
			' ', 
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',
			'Oswald:400,700' => 'Oswald',
			'Montserrat:400,700' => 'Montserrat',
			'Raleway:400,700' => 'Raleway',
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt',
    );
	
	//body font size
    $wp_customize->add_setting(
        'properlite_body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
        )
    );
	
    $wp_customize->add_control( 'properlite_body_size', array(
        'type'        => 'number', 
        'priority'    => 10,
        'section'     => 'properlite_typography',
        'label'       => __('Body Font Size', 'properlite'), 
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 28,
            'step'  => 1,
            'style' => 'margin-bottom: 10px; padding: 10px;',
        ),
  	));
    
    $wp_customize->add_setting(
        'headings_fonts',
        array(
            'sanitize_callback' => 'properlite_sanitize_fonts',
    ));
    
    $wp_customize->add_control(
        'headings_fonts',
        array(
            'type' => 'select',
			'default'           => '20', 
            'description' => __('Select your desired font for the headings. Playfair Display is the default Heading font.', 'properlite'),
            'section' => 'properlite_typography',
            'choices' => $font_choices
    ));
    
    $wp_customize->add_setting(
        'body_fonts',
        array(
            'sanitize_callback' => 'properlite_sanitize_fonts',
    ));
    
    $wp_customize->add_control(
        'body_fonts',
        array(
            'type' => 'select',
			'default'           => '30', 
            'description' => __( 'Select your desired font for the body. Source Sans Pro is the default Body font.', 'properlite' ), 
            'section' => 'properlite_typography',  
            'choices' => $font_choices 
    ));
	

//-------------------------------------------------------------------------------------------------------------------//
// Blog Layout
//-------------------------------------------------------------------------------------------------------------------//

    $wp_customize->add_section( 'properlite_layout_section' , array( 
	    'title'       => __( 'Blog', 'properlite' ),
	    'priority'    => 38, 
	    'description' => 'Change how properlite displays posts', 
	));
	
	// Blog Title
	$wp_customize->add_setting( 'properlite_blog_title',
	    array(
	        'sanitize_callback' => 'properlite_sanitize_text', 
			'default' => 'Our Latest News',  
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'properlite_blog_title', array(
		'label'    => __( 'Posts Page Title', 'properlite' ),
		'section'  => 'properlite_layout_section', 
		'settings' => 'properlite_blog_title',
		'priority'   => 10 
	))); 
	
	//Blog Background
	$wp_customize->add_setting( 'properlite_blog_bg', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'properlite_blog_bg', array( 
		'label'    => __( 'Blog Header Background Image', 'properlite' ),
		'section'  => 'properlite_layout_section',
		'settings' => 'properlite_blog_bg',   
		'priority'   => 20
	)));
	
	//Blog Colors
	$wp_customize->add_setting( 'properlite_archive_hover', array( 
        'default'     => '#f9f9f9',  
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_archive_hover', array(
        'label'	   => __( 'Blog Archive Hover Background', 'properlite' ),
        'section'  => 'properlite_layout_section',
        'settings' => 'properlite_archive_hover', 
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'properlite_archive_border', array( 
        'default'     => '#ededed', 
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_archive_border', array(
        'label'	   => __( 'Blog Archive Border Color', 'properlite' ),
        'section'  => 'properlite_layout_section',
        'settings' => 'properlite_archive_border',
		'priority' => 30
    )));
	
	//Animations
	$wp_customize->add_section( 'properlite_animations' , array(  
	    'title'       => __( 'Animation Effects', 'properlite' ), 
	    'priority'    => 50,  
	    'description' => __( 'Get yourself animated or disable it.', 'properlite' ), 
	)); 
	
    $wp_customize->add_setting(
        'properlite_animate',
        array(
            'sanitize_callback' => 'properlite_sanitize_checkbox',
            'default' => 0,
    ));
	
    $wp_customize->add_control( 
        'properlite_animate',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box if you want to disable the animations.', 'properlite'),
            'section' => 'properlite_animations', 
            'priority' => 1,           
    ));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Plugin Options
//-------------------------------------------------------------------------------------------------------------------//


	$wp_customize->add_panel( 'properlite_plugin_panel', array(
    'priority'       => 42, 
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'ModernThemes Plugin Options', 'properlite' ),
    'description'    => __( 'If you have installed any of our <a href="http://modernthemes.net/plugins/">ModernThemes content plugins</a>, use this section to edit theme-specific options. Our plugins are styled different from theme to theme, so you can use this area to customize the content to match your theme.', 'properlite' ),
	)); 
	
	
	//Services Plugins 
	$wp_customize->add_section( 'properlite_plugin_services_colors' , array(  
	    'title'       => __( 'Services', 'properlite' ), 
	    'priority'    => 10, 
	    'description' => __( 'If you have installed the Services plugin from our <a href="http://modernthemes.net/plugins/">ModernThemes content plugins</a>, use this section to edit theme-specific colors. Our plugins are styled different from theme to theme, so you can use this area to customize the content to match your theme.', 'properlite'), 
		'panel' => 'properlite_plugin_panel',
	));

	
	$wp_customize->add_setting( 'properlite_plugin_service_page_icon_color', array( 
		'default' => '#404040',
		'sanitize_callback' => 'sanitize_hex_color',
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_service_page_icon_color', array(
        'label'	   => __( 'Service Icon', 'properlite' ), 
        'section'  => 'properlite_plugin_services_colors',
        'settings' => 'properlite_plugin_service_page_icon_color', 
		'priority' => 110
    ))); 
	
	
	$wp_customize->add_setting( 'properlite_plugin_service_page_icon_bg_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_service_page_icon_bg_color', array(
        'label'	   => __( 'Service Icon Background', 'properlite' ), 
        'section'  => 'properlite_plugin_services_colors',
        'settings' => 'properlite_plugin_service_page_icon_bg_color', 
		'priority' => 115 
    ))); 
	
	$wp_customize->add_setting( 'properlite_plugin_service_page_icon_border_color', array(	
		'default' => '#404040',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_service_page_icon_border_color', array(
        'label'	   => __( 'Service Icon Border', 'properlite' ), 
        'section'  => 'properlite_plugin_services_colors',
        'settings' => 'properlite_plugin_service_page_icon_border_color', 
		'priority' => 118
    )));
	
	//Projects Plugins 
	$wp_customize->add_section( 'properlite_plugin_projects_colors' , array(  
	    'title'       => __( 'Projects', 'properlite' ), 
	    'priority'    => 20, 
	    'description' => __( 'If you have installed the Projects plugin from our <a href="http://modernthemes.net/plugins/">ModernThemes content plugins</a>, use this section to edit theme-specific colors. Our plugins are styled different from theme to theme, so you can use this area to customize the content to match your theme.', 'properlite'), 
		'panel' => 'properlite_plugin_panel',
	));
	
	$wp_customize->add_setting( 'properlite_plugin_project_hover_color', array( 
        'default'     => '#151515',  
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_project_hover_color', array(
        'label'	   => __( 'Hover Background', 'properlite' ), 
        'section'  => 'properlite_plugin_projects_colors',
        'settings' => 'properlite_plugin_project_hover_color', 
		'priority' => 10 
    ))); 
	
	$wp_customize->add_setting( 'properlite_plugin_project_hover_text_color', array( 
        'default'     => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_project_hover_text_color', array(
        'label'	   => __( 'Hover Text', 'properlite' ), 
        'section'  => 'properlite_plugin_projects_colors',
        'settings' => 'properlite_plugin_project_hover_text_color', 
		'priority' => 20 
    ))); 
	
	//Team Members Plugins 
	$wp_customize->add_section( 'properlite_plugin_team_colors' , array(  
	    'title'       => __( 'Team Members', 'properlite' ), 
	    'priority'    => 30, 
	    'description' => __( 'If you have installed the Team Members plugin from our <a href="http://modernthemes.net/plugins/">ModernThemes content plugins</a>, use this section to edit theme-specific colors. Our plugins are styled different from theme to theme, so you can use this area to customize the content to match your theme.', 'properlite'), 
		'panel' => 'properlite_plugin_panel',
	));
	
	$wp_customize->add_setting( 'properlite_plugin_team_icon', array( 
        'default'     => '#1f2023',  
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_team_icon', array(
        'label'	   => __( 'Team Member Icon Color', 'properlite' ), 
        'section'  => 'properlite_plugin_team_colors',
        'settings' => 'properlite_plugin_team_icon', 
		'priority' => 10 
    ))); 
	
	$wp_customize->add_setting( 'properlite_plugin_team_icon_border', array( 
        'default'     => '#1f2023',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_team_icon_border', array(
        'label'	   => __( 'Team Member Icon Border', 'properlite' ),
        'section'  => 'properlite_plugin_team_colors',
        'settings' => 'properlite_plugin_team_icon_border',
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'properlite_plugin_team_icon_hover', array(
        'default'     => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_team_icon_hover', array(
        'label'	   => __( 'Team Member Icon Hover', 'properlite' ), 
        'section'  => 'properlite_plugin_team_colors',
        'settings' => 'properlite_plugin_team_icon_hover', 
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'properlite_plugin_team_icon_bg_hover', array(
        'default'     => '#1f2023',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_team_icon_bg_hover', array(
        'label'	   => __( 'Team Member Icon Background Hover', 'properlite' ), 
        'section'  => 'properlite_plugin_team_colors',
        'settings' => 'properlite_plugin_team_icon_bg_hover', 
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'properlite_plugin_team_divider', array(
        'default'     => '#222222',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_team_divider', array(
        'label'	   => __( 'Team Member Divider', 'properlite' ), 
        'section'  => 'properlite_plugin_team_colors',
        'settings' => 'properlite_plugin_team_divider',  
		'priority' => 50 
    ))); 
	
	
	//Testimonials Plugins 
	$wp_customize->add_section( 'properlite_plugin_testimonial_colors' , array(  
	    'title'       => __( 'Testimonials', 'properlite' ), 
	    'priority'    => 40, 
	    'description' => __( 'If you have installed the Testimonials plugin from our <a href="http://modernthemes.net/plugins/">ModernThemes content plugins</a>, use this section to edit theme-specific colors. Our plugins are styled different from theme to theme, so you can use this area to customize the content to match your theme.', 'properlite'), 
		'panel' => 'properlite_plugin_panel', 
	));
	
	$wp_customize->add_setting( 'properlite_plugin_testimonial_bg', array( 
        'default'     => '#ffffff',  
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_testimonial_bg', array(
        'label'	   => __( 'Content Background', 'properlite' ), 
        'section'  => 'properlite_plugin_testimonial_colors',
        'settings' => 'properlite_plugin_testimonial_bg', 
		'priority' => 10 
    ))); 
	
	$wp_customize->add_setting( 'properlite_plugin_testimonial_text_color', array( 
        'default'     => '#404040',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_testimonial_text_color', array(
        'label'	   => __( 'Text Color', 'properlite' ), 
        'section'  => 'properlite_plugin_testimonial_colors',
        'settings' => 'properlite_plugin_testimonial_text_color', 
		'priority' => 20 
    )));
	
	//Font Style
	$wp_customize->add_setting( 'properlite_plugin_testimonial_font_style', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'properlite_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'properlite_plugin_testimonial_font_style', array(
		'label'    => __( 'Font Style', 'properlite' ),
		'section'  => 'properlite_plugin_testimonial_colors',
		'settings' => 'properlite_plugin_testimonial_font_style',
		'type'     => 'radio',
		'priority'   => 30, 
		'choices'  => array(
			'option1' => 'Italic',
			'option2' => 'Normal',
			),
	)));
	
	//Skills Plugins 
	$wp_customize->add_section( 'properlite_plugin_skills_colors' , array(  
	    'title'       => __( 'Skill Bars', 'properlite' ), 
	    'priority'    => 50, 
	    'description' => __( 'If you have installed the Skill Bars plugin from our <a href="http://modernthemes.net/plugins/">ModernThemes content plugins</a>, use this section to edit theme-specific colors. Our plugins are styled different from theme to theme, so you can use this area to customize the content to match your theme.', 'properlite'), 
		'panel' => 'properlite_plugin_panel', 
	));
	
	$wp_customize->add_setting( 'properlite_plugin_skill_color', array( 
        'default'     => '#040404',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_skill_color', array(
        'label'	   => __( 'Skill Bar Color', 'properlite' ), 
        'section'  => 'properlite_plugin_skills_colors', 
        'settings' => 'properlite_plugin_skill_color', 
		'priority' => 20
    )));
	
	$wp_customize->add_setting( 'properlite_plugin_skill_bg_color', array( 
        'default'     => '#dddddd', 
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_skill_bg_color', array(
        'label'	   => __( 'Skill Bar Background', 'properlite' ), 
        'section'  => 'properlite_plugin_skills_colors', 
        'settings' => 'properlite_plugin_skill_bg_color', 
		'priority' => 20 
    ))); 
	
	//Details Plugins 
	$wp_customize->add_section( 'properlite_plugin_detail_colors' , array(  
	    'title'       => __( 'Details', 'properlite' ), 
	    'priority'    => 60, 
	    'description' => __( 'If you have installed the Details Odometer plugin from our <a href="http://modernthemes.net/plugins/">ModernThemes content plugins</a>, use this section to edit theme-specific colors. Our plugins are styled different from theme to theme, so you can use this area to customize the content to match your theme.', 'properlite'), 
		'panel' => 'properlite_plugin_panel', 
	));
	
	$wp_customize->add_setting( 'properlite_plugin_detail_icon_color', array( 
        'default'     => '#404040',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_detail_icon_color', array(
        'label'	   => __( 'Icon Color', 'properlite' ), 
        'section'  => 'properlite_plugin_detail_colors', 
        'settings' => 'properlite_plugin_detail_icon_color', 
		'priority' => 10 
    )));
	
	$wp_customize->add_setting( 'properlite_plugin_detail_text_color', array( 
        'default'     => '#404040', 
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_detail_text_color', array(
        'label'	   => __( 'Number Color', 'properlite' ),
        'section'  => 'properlite_plugin_detail_colors', 
        'settings' => 'properlite_plugin_detail_text_color', 
		'priority' => 30 
    ))); 
	
	
	//Columns Plugins 
	$wp_customize->add_section( 'properlite_plugin_columns_colors' , array(  
	    'title'       => __( 'Home Page Columns', 'properlite' ), 
	    'priority'    => 70, 
	    'description' => __( 'If you have installed the Home Page Columns plugin from our <a href="http://modernthemes.net/plugins/">ModernThemes content plugins</a>, use this section to edit theme-specific colors. Our plugins are styled different from theme to theme, so you can use this area to customize the content to match your theme.', 'properlite'), 
		'panel' => 'properlite_plugin_panel', 
	));
	
	$wp_customize->add_setting( 'properlite_plugin_columns_icon_color', array( 
        'default'     => '#404040',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_columns_icon_color', array(
        'label'	   => __( 'Icon Color', 'properlite' ), 
        'section'  => 'properlite_plugin_columns_colors', 
        'settings' => 'properlite_plugin_columns_icon_color', 
		'priority' => 10 
    )));
	
	$wp_customize->add_setting( 'properlite_plugin_columns_link_color', array( 
        'default'     => '#000000', 
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_columns_link_color', array(
        'label'	   => __( 'Link Color', 'properlite' ),
        'section'  => 'properlite_plugin_columns_colors', 
        'settings' => 'properlite_plugin_columns_link_color', 
		'priority' => 40
    ))); 
	
	$wp_customize->add_setting( 'properlite_plugin_columns_hover_color', array(  
        'default'     => '#999999',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_columns_hover_color', array(
        'label'	   => __( 'Hover Color', 'properlite' ),
        'section'  => 'properlite_plugin_columns_colors', 
        'settings' => 'properlite_plugin_columns_hover_color', 
		'priority' => 50
    ))); 
	
	
	//News Plugins 
	$wp_customize->add_section( 'properlite_plugin_news_colors' , array(  
	    'title'       => __( 'Home Posts', 'properlite' ), 
	    'priority'    => 80, 
	    'description' => __( 'Edit your MT - Home Posts options', 'properlite'), 
		'panel' => 'properlite_plugin_panel', 
	));

	
	$wp_customize->add_setting( 'properlite_plugin_news_bg_color', array( 
        'default'     => '#f5f5f3',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_news_bg_color', array(
        'label'	   => __( 'Background Color', 'properlite' ), 
        'section'  => 'properlite_plugin_news_colors', 
        'settings' => 'properlite_plugin_news_bg_color', 
		'priority' => 10 
    )));
	
	$wp_customize->add_setting( 'properlite_plugin_news_text_color', array( 
        'default'     => '#252525',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_news_text_color', array(
        'label'	   => __( 'Title Color', 'properlite' ), 
        'section'  => 'properlite_plugin_news_colors', 
        'settings' => 'properlite_plugin_news_text_color', 
		'priority' => 20
    )));
	
	$wp_customize->add_setting( 'properlite_plugin_news_date_color', array( 
        'default'     => '#636363',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_news_date_color', array(
        'label'	   => __( 'Date Color', 'properlite' ), 
        'section'  => 'properlite_plugin_news_colors', 
        'settings' => 'properlite_plugin_news_date_color', 
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'properlite_plugin_news_button_color', array( 
        'default'     => '#111111',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_news_button_color', array(
        'label'	   => __( 'Button Color', 'properlite' ), 
        'section'  => 'properlite_plugin_news_colors', 
        'settings' => 'properlite_plugin_news_button_color',
		'priority' => 40
    )));
	
	$wp_customize->add_setting( 'properlite_plugin_news_button_text_color', array( 
        'default'     => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_news_button_text_color', array(
        'label'	   => __( 'Button Text Color', 'properlite' ), 
        'section'  => 'properlite_plugin_news_colors', 
        'settings' => 'properlite_plugin_news_button_text_color',
		'priority' => 50
    )));
	
	$wp_customize->add_setting( 'properlite_plugin_news_button_hover_color', array( 
        'default'     => '#444444',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'properlite_plugin_news_button_hover_color', array(
        'label'	   => __( 'Button Hover Color', 'properlite' ), 
        'section'  => 'properlite_plugin_news_colors', 
        'settings' => 'properlite_plugin_news_button_hover_color',
		'priority' => 50 
    )));
	
	//Font Style
	$wp_customize->add_setting( 'properlite_plugin_news_text_style', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'properlite_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'properlite_plugin_news_text_style', array(
		'label'    => __( 'Text Align', 'properlite' ),
		'section'  => 'properlite_plugin_news_colors',
		'settings' => 'properlite_plugin_news_text_style',
		'type'     => 'radio', 
		'priority'   => 60, 
		'choices'  => array(
			'option1' => 'Left',
			'option2' => 'Center', 
			),
	)));
	
	
}
add_action( 'customize_register', 'properlite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function properlite_customize_preview_js() {
	wp_enqueue_script( 'properlite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'properlite_customize_preview_js' );
