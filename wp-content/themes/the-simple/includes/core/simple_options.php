<?php
/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
 * */

if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "simple_redata";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );


    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */
    

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'simple_redata', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => __('The Simple', 'the-simple'),
                'page_title' => __('The Simple', 'the-simple'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'async_typography'  => false,      
                'google_api_key' => 'AIzaSyDNS4R2BxpPspB31mZPnGvelSPSXvggI4I', // Must be defined to add google fonts to the typography module
                //'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'              => 'the-simple', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                //'footer_credit'       => '', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => false, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );        
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
    
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.     
            $args['share_icons'][] = array(
                'url' => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon' => 'el-icon-github'
                    // 'img' => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $args['share_icons'][] = array(
                'url' => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon' => 'el-icon-facebook'
            );
            $args['share_icons'][] = array(
                'url' => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon' => 'el-icon-twitter'
            );
            $args['share_icons'][] = array(
                'url' => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon' => 'el-icon-linkedin'
            );



            // Panel Intro text -> before the form
            if (!isset($args['global_variable']) || $args['global_variable'] !== false) {
                if (!empty($args['global_variable'])) {
                    $v = $args['global_variable'];
                } else {
                    $v = str_replace("-", "_", $args['opt_name']);
                }
                $args['intro_text'] = sprintf('<p>'.__('The Simple ofers a wide range of website tempaltes.', 'the-simple').' </p>', $v);
            } else {
                $args['intro_text'] = '<p>'.__('The Simple ofers a wide range of website tempaltes. ', 'the-simple').'</p>';
            }

            // Add content after the form.
            $args['footer_text'] = __('', 'the-simple');


            Redux::setArgs( $opt_name, $args );

            Redux::setSection( $opt_name, array(
                'title' => __('General Options', 'the-simple'),
                'desc' => __('In this section you can customize basic options like logo, responsive etc...', 'the-simple'),
                'icon' => 'el-icon-cogs',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields' => array(
                    
                    array(
                        'id' => 'responsive_bool',
                        'type' => 'switch',
                        'title' => __('Responsive Layout', 'the-simple'),
                        'subtitle' => __('Switch on to active responsive layout', 'the-simple'),
                        "default" => 1,
                    ),

                    array(
                        'id' => 'logo',
                        'type' => 'media',
                        'title' => __('Upload Logo', 'the-simple'),
                        'desc' => __('Upload here the logo that is placed in top of the page ', 'the-simple'),
                        'subtitle' => __('Upload any media using the WordPress native uploader', 'the-simple'),
                        'default' => array('url' => get_template_directory_uri().'/img/logo.png'),
                    ),

                    array(
                        'id' => 'logo_light',
                        'type' => 'media',
                        'title' => __('Upload Logo Light', 'the-simple'),
                        'desc' => __('Upload here the logo that is placed in top of the page (Light Version) ', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        'default' => array('url' => get_template_directory_uri().'/img/logo_light.png'),
                    ),

                    array(
                        'id' => 'logo_height',
                        'type' => 'dimensions', 
                        'output' => array('#logo img'),
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => false,
                        'title' => __('Logo Height', 'the-simple'),
                        'subtitle' => __('units: px', 'the-simple'),
                        'desc' => __('', 'the-simple'),
                        'default' => array('height' => 25)
                    ),


                    array(
                        'id' => 'nicescroll',
                        'type' => 'switch',
                        'title' => __('Smooth Scroll', 'the-simple'),
                        'subtitle' => __('Switch on to active smooth scrolling', 'the-simple'),
                        "default" => 0,
                    ),

                    array(
                        'id' => 'simple_page_transition',
                        'type' => 'switch',
                        'title' => __('Page Transition', 'the-simple'),
                        'subtitle' => __('Switch on to active smooth page transition', 'the-simple'),
                        "default" => 0,
                    ),

                    array(
                        'id' => 'page_transition_in',
                        'type' => 'select',
                        'title' => __('Page Transition In Effect', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        'required' => array('simple_page_transition', 'equals', '1'),
                        'options' => array('fade-in' => 'fade-in',
                                           'fade-in-up-sm' => 'fade-in-up-sm',
                                           'fade-in-up' => 'fade-in-up',
                                           'fade-in-up-lg' => 'fade-in-up-lg',
                                           'fade-in-down-sm' => 'fade-in-down-sm',
                                           'fade-in-down-lg' => 'fade-in-down-lg',
                                           'fade-in-down' => 'fade-in-down',
                                           'fade-in-left-sm' => 'fade-in-left-sm',
                                           'fade-in-left' => 'fade-in-left',
                                           'fade-in-left-lg' => 'fade-in-left-lg',
                                           'fade-in-right-sm' => 'fade-in-right-sm',
                                           'fade-in-right' => 'fade-in-right',
                                           'fade-in-right-lg' => 'fade-in-right-lg',), //Must provide key => value pairs for select options
                        'default' => 'fade-in'
                    ), 

                    array(
                        'id' => 'page_transition_in_duration',
                        'type' => 'text',
                        'title' => __('Page Transition In Duration', 'the-simple'),
                        'required' => array('simple_page_transition', 'equals', '1'),
                        'default' => '1000'
                    ),

                    array(
                        'id' => 'page_transition_out',
                        'type' => 'select',
                        'title' => __('Page Transition In Effect', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        'required' => array('simple_page_transition', 'equals', '1'),
                        'options' => array('fade-out' => 'fade-out',
                                           'fade-out-up-sm' => 'fade-out-up-sm',
                                           'fade-out-up' => 'fade-out-up',
                                           'fade-out-up-lg' => 'fade-out-up-lg',
                                           'fade-out-down-sm' => 'fade-out-down-sm',
                                           'fade-out-down-lg' => 'fade-out-down-lg',
                                           'fade-out-down' => 'fade-out-down',
                                           'fade-out-left-sm' => 'fade-out-left-sm',
                                           'fade-out-left' => 'fade-out-left',
                                           'fade-out-left-lg' => 'fade-out-left-lg',
                                           'fade-out-right-sm' => 'fade-out-right-sm',
                                           'fade-out-right' => 'fade-out-right',
                                           'fade-out-right-lg' => 'fade-out-right-lg',), //Must provide key => value pairs for select options
                        'default' => 'fade-out'
                    ), 

                    array(
                        'id' => 'page_transition_out_duration',
                        'type' => 'text',
                        'title' => __('Page Transition OUT Duration', 'the-simple'),
                        'required' => array('simple_page_transition', 'equals', '1'),
                        'default' => '1000'
                    ),

                    array(
                        'id' => 'section-special-pages-start',
                        'type' => 'section',
                        'title' => __('Select Special Pages', 'the-simple'),
                        'indent' => true // Indent all options below until the next 'section' option is set.
                    ),


                    array(
                        'id' => 'frontpage',
                        'type' => 'select',
                        'data' => 'pages',
                        'default' => '0',
                        'title' => __('Select Frontpage', 'the-simple'),
                        'subtitle' => __('Frontpage is the page that you want to show in the home', 'the-simple'),
                        'desc' => __('Select one of the created pages to use it as frontpage', 'the-simple'),
                    ),


                    array(
                        'id' => 'blogpage',
                        'type' => 'select',
                        'data' => 'pages',
                        'default' => '0',
                        'title' => __('Select Blog Page', 'the-simple'),
                        'subtitle' => __('Blogpage is the page that you want to show the blog posts', 'the-simple'),
                        'desc' => __('Select one of the created pages to use as blog', 'the-simple'),
                    ),

                    array(
                        'id' => 'comingsoon_page',
                        'type' => 'select',
                        'data' => 'pages',
                        'default' => '0',
                        'title' => __('Select Coming Soon Page', 'the-simple'),
                        'subtitle' => __('Select one page that you want to use as comingsoon or maintenance page', 'the-simple'),
                        'desc' => __('', 'the-simple'),
                    ),

                    array(
                        'id' => 'section-special-pages-end',
                        'type' => 'section',
                        'indent' => false // Indent all options below until the next 'section' option is set.
                    ),

                    array(
                        'id' => '404_error_message',
                        'type' => 'editor',
                        'title' => __('404 error message', 'the-simple'),
                        'subtitle' => __('Text to be placed in 404 page', 'the-simple'),
                        'default' => 'Sorry but the page you are looking for has not been found. Try checking the URL for errors, then bit the refresh button on your browser',
                    ),

                    array(
                                'id' => 'bg_image_404',
                                'type' => 'background',
                                'output' => '.bg_image_404',
                                'title' => __('404 Page background', 'the-simple'),
                                'subtitle' => __('404 page background with image, color, etc.', 'the-simple'),
                                'default' => array('background-color' => '#f5f5f5')
                            ),

                    array(
                        'id' => 'section-code-start',
                        'type' => 'section',
                        'title' => __('Tracking Code / Custom CSS / Custom JS', 'the-simple'),
                        'indent' => true // Indent all options below until the next 'section' option is set.
                    ),


                    array(
                        'id' => 'tracking_code',
                        'type' => 'ace_editor',
                        'title' => __('Tracking Code', 'the-simple'),
                        'subtitle' => __('Paste your JS code here.', 'the-simple'),
                        'mode' => 'text',
                        'theme' => 'chrome',
                        'desc' => 'Paste your Google Analytics or other tracking code here. This will be added into the footer.',
                        'default' => "/*jQuery(document).ready(function(){\n\n});*/"
                    ),

                    array(
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'title' => __('Custom CSS Code', 'the-simple'),
                        'subtitle' => __('Paste your CSS code here.', 'the-simple'),
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'desc' => 'Add custom css code to theme.',
                        'default' => "/*#header{\nmargin: 0 auto;\n}*/"
                    ),
                    array(
                        'id' => 'custom_js',
                        'type' => 'ace_editor',
                        'title' => __('Custom JS Code', 'the-simple'),
                        'subtitle' => __('Paste your JS code here.', 'the-simple'),
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                        'desc' => '.',
                        'default' => "/*jQuery(document).ready(function(){\n\n});*/"
                    ),

                    array(
                        'id' => 'section-code-end',
                        'type' => 'section',
                        'indent' => false // Indent all options below until the next 'section' option is set.
                    ),

                ),
            ));

            

            Redux::setSection( $opt_name, array(
                'type' => 'divide',
           ));



            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-website',
                'title' => __('Header Options', 'the-simple'),
                'fields' => array(
                    
                    array(
                        'id' => 'section-header-opts-start',
                        'type' => 'section',
                        'title' => __('General', 'the-simple'),
                        'indent' => true // Indent all options below until the next 'section' option is set.
                    ),


                    /*array(
                        'id' => 'header_presets',
                        'type' => 'image_select',
                        'title' => __('Header Predefined Styles', 'the-simple'),
                        'presets'  => true,
                        'subtitle' => __('Select one of our predefined header styles and some options will change', 'the-simple'),
                        'options' => array(
                            'h1' => array(
                                'alt' => 'Header 1', 
                                'img' => '',
                                'presets' => array(
                                    
                                    'header_style' => 'header_4'
                                )

                            ),
                            'h2' => array(
                                'alt' => 'Header 2', 
                                'img' => 'http://localhost/test/wp-content/themes//images/patterns/header1.jpg',
                                'presets' => array(
                                    
                                    'header_style' => 'header_6'
                                )

                            )  
                        ),
                        'default' => 'header_1'
                    ),*/

                    array(
                        'id' => 'header_style',
                        'type' => 'select',
                        'title' => __('Header Style', 'the-simple'),
                        'subtitle' => __('Select the style for the header', 'the-simple'),
                        'options' => array('header_1' => 'Simple style','header_13' => 'Simple header with centered menu', 'header_2' => 'With border top', 'header_3' => 'Modern Style', 'header_4' => 'Menu Item with BG', 'header_5' => 'Fullscreen Overlay', 'header_6' => 'Below the logo navigation with bg', 'header_7' => 'Left / Right Side Header', 'header_8' => 'Menu Item with border bottom', 'header_9' => 'Menu link underline', 'header_10' => 'Centered Logo and Navigation', 'header_11' => 'Logo in center and 2 navigations in sides', 'header_12' => 'Navigation with border separators, below logo'), //Must provide key => value pairs for select options
                        'default' => 'header_1'
                    ), 

                    array(
                        'id' => 'header_transparency',
                        'type' => 'switch',
                        'title' => __('Make Transparency Header', 'the-simple'),
                        'subtitle' => 'If you active this option the header should be shown on top of the slider',
                        'default' => 1,
                        'required' => array('header_style', 'equals', array('header_1', 'header_4', 'header_5', 'header_11') ),
                    ),

                    array(

                        'id' => 'header_shapes',
                        'type' => 'select',
                        'title' => __('Make the header with different shape', 'the-simple'),
                        'subtitle' => 'Set the header shape you want for your website',
                        'options' => array('polygon' => 'Polygon', 'polygon_upper' => 'Polygon Upper', 'normal' => 'Normal'),
                        'default' => 'normal',
                        'required' => array('header_transparency', 'equals', '1')
                    ),

                    array(

                        'id' => 'header_gradient_transparency',
                        'type' => 'switch',
                        'title' => __('Gradient transparency for the header', 'the-simple'),
                        'subtitle' => '',
                        'default' => 0,
                        'required' => array('header_transparency', 'equals', '1')

                    ),

                    array(
                        'id' => 'header_overlay_color',
                        'type' => 'color_rgba',
                        'output' => array('.overlay_menu'),
                        'title' => __('Menu Overlay Fullscreen BG Color', 'the-simple'),
                        'mode' => 'background-color', 
                        'default'  => array(
                            'color' => '#000000', 
                            'alpha' => '0.95'
                        ),
                        'required' => array('header_style', 'equals', 'header_5'),
                        'validate' => 'colorrgba',
                    ),

                    array(
                        'id' => 'header_navigation',
                        'type' => 'color_rgba',
                        'output' => array('.header_6 .full_nav_menu, .header_6 #navigation'),
                        'title' => __('Header 6 Navigation BG Color', 'the-simple'),
                        'mode' => 'background-color',  
                        'default'  => array(
                            'color' => '#000000', 
                            'alpha' => '1.00'
                        ),
                        'required' => array('header_style', 'equals', 'header_6'),
                        'validate' => 'colorrgba',
                    ),


                    array(
                        'id' => 'headernavsix_font_hover',
                        'type' => 'color_rgba',
                        'output' => array('.header_6 nav li > a:hover, .header_6 nav li.current-menu-item > a, .header_6 nav li.current-menu-parent > a'),
                        'title' => __('Header 6 Navigation Hover Color', 'the-simple'),
                        'mode' => 'color',  
                        'default'  => array(
                            'color' => '#f7f7f7', 
                            'alpha' => '1.00'
                        ),
                        'required' => array('header_style', 'equals', 'header_6'),
                        'validate' => 'colorrgba',
                    ),



                    array(
                        'id' => 'header_6_nav_height',
                        'type' => 'dimensions',
                        'output' => array('.header_6 #navigation'), 
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => false,
                        'title' => __('Header 6 Navigation Height', 'the-simple'),
                        'required' => array('header_style', 'equals', 'header_6'),
                        'subtitle' => __('units: px', 'the-simple'),
                        'desc' => __('', 'the-simple'),
                        'default' => array('height' => 45)
                    ),

                    array(
                        'id' => 'header_6_transparent',
                        'type' => 'switch',
                        'title' => __('Make transparent this header', 'the-simple'),
                        'subtitle' => __('Switch On to enable transparency', 'the-simple'),
                        'default' => 0,
                        'required' => array('header_style', 'equals', 'header_6'),
                    ),



                    array(
                        'id' => 'header_7_width',
                        'type' => 'dimensions',
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => true,
                        'height' => false,
                        'title' => __('Header 7 Side Menu Width', 'the-simple'),
                        'required' => array('header_style', 'equals', 'header_7'),
                        'subtitle' => __('units: px', 'the-simple'),
                        'desc' => __('', 'the-simple'),
                        'default' => array('width' => 280)
                    ),

                    array(
                        'id' => 'header_7_padding',
                        'type' => 'spacing',
                        'mode' => 'padding', // absolute, padding, margin, defaults to padding
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'title' => __('Header 7 Side Menu Inner Padding', 'the-simple'),
                        'subtitle' => __('Adjust side menu padding ', 'the-simple'),
                        'required' => array('header_style', 'equals', 'header_7'),
                        'desc' => __('Unit: px', 'the-simple'),
                        'default' => array('padding-left' => '20px', 'padding-right' => "20px", 'padding-top' => "20px", 'padding-bottom' => "20px")
                    ),
                    
                    array( 
                        'id' => 'header_7_margin',
                        'type' => 'spacing',
                        'mode' => 'margin', // absolute, padding, margin, defaults to padding
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        'bottom' => false,
                        'left' => false,
                        'right' => false,
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'title' => __('Header 7 Side Menu Inner Margin beetwen logo/menu/widgets', 'the-simple'),
                        'subtitle' => __('Adjust margin beetween side menu elements logog/menu/widgets ', 'the-simple'),
                        'required' => array('header_style', 'equals', 'header_7'),
                        'desc' => __('Unit: px', 'the-simple'),
                        'default' => array('margin-top' => '40px')
                    ),

                    array(
                        'title'     => __( 'Header 7 Side Menu Position', 'the-simple' ),
                        'desc'      => __( 'Select the fixed position for the side navigation', 'the-simple' ),
                        'id'        => 'header_7_position',
                        'type'      => 'image_select',
                        'required' => array('header_style', 'equals', 'header_7'),
                        'customizer'=> array(),
                        'default' => 'left',
                        'options'   => array(
                            'left' => ReduxFramework::$_url . 'assets/img/2cl.png',
                            'right'  => ReduxFramework::$_url . 'assets/img/2cr.png'
                        )
                    ),


                    array(
                        'id' => 'header_7_border', 
                        'type' => 'switch',
                        'title' => __('Add border to side header style', 'the-simple'),
                        'subtitle' => __('Border for side left/right header style', 'the-simple'),
                        'desc' => __('', 'the-simple'),
                        'required' => array('header_style', 'equals', 'header_7'),
                        'default' => 0// 1 = on | 0 = off
                    ),

                    array(
                        'id' => 'header_7_border_top', 
                        'type' => 'switch',
                        'title' => __('Add colored border in top of Header', 'the-simple'),
                        'subtitle' => __('Border with theme color in top of Left/Right header', 'the-simple'),
                        'desc' => __('', 'the-simple'),
                        'required' => array('header_style', 'equals', 'header_7'),
                        'default' => 0// 1 = on | 0 = off
                    ),

                    array(
                        'id' => 'header_7_transparent_padding', 
                        'type' => 'switch',
                        'title' => __('Transparent with padding header', 'the-simple'),
                        'subtitle' => __('Transparent Left/Right header above the content with padding ', 'the-simple'),
                        'desc' => __('', 'the-simple'),
                        'required' => array('header_style', 'equals', 'header_7'),
                        'default' => 0// 1 = on | 0 = off
                    ),


                    array(
                        'id' => 'header_10_border', 
                        'type' => 'switch',
                        'title' => __('Border Top & bottom for navigation', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        'desc' => __('', 'the-simple'),
                        'required' => array('header_style', 'equals', 'header_10'),
                        'default' => 1// 1 = on | 0 = off
                    ),
                    



                    array(
                        'id' => 'header_height',
                        'type' => 'dimensions',
                        'output' => array('header#header .row-fluid .span12, .header_wrapper, .snap_header'),
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => false,
                        'title' => __('Header Height', 'the-simple'),
                        'subtitle' => __('units: px', 'the-simple'),
                        'desc' => __('', 'the-simple'),
                        'default' => array('height' => 100)
                    ),
                    
                    
                    array(
                        'id' => 'header_background',
                        'type' => 'color_rgba', 
                        'mode' => 'background-color',
                        'transparent' => true,
                        'validate' => 'colorrgba',
                        'output' => array('.header_1 header#header, .header_2 header#header, .header_3.header_wrapper header > .container,  .header_4 header#header,  .header_5 header#header, .header_6 header#header, .header_7.header_wrapper, .header_8.header_wrapper, .header_9.header_wrapper, .header_10.header_wrapper, .header_10 .full_nav_menu, .header_11.header_wrapper, .header_12.header_wrapper'),
                        'title' => __('Background', 'the-simple'),
                        'subtitle' => __('Header background with image, color, etc.', 'the-simple'),
                        'default' => array(
                            'color' => '#fff',
                            'alpha' => '0.0'
                        ),
                    ),

                    array(
                        'id' => 'show_search', 
                        'type' => 'checkbox',
                        'title' => __('Show Search', 'the-simple'),
                        'subtitle' => __('Show search in the right of header', 'the-simple'),
                        'desc' => __('Check this if you want the search field in the right part of the header', 'the-simple'),
                        'default' => '1'// 1 = on | 0 = off
                    ),

                    array(
                        'id' => 'show_cart', 
                        'type' => 'checkbox',
                        'title' => __('Show Cart Icon', 'the-simple'),
                        'subtitle' => __('Show cart in the right of header', 'the-simple'),
                        'desc' => __('Check this if you want the cart in the right part of the header (woocommerce must be installed)', 'the-simple'),
                        'default' => '1'// 1 = on | 0 = off
                    ),

                    array(
                        'id' => 'show_ver_separator', 
                        'type' => 'checkbox',
                        'title' => __('Show vertical separator on the header', 'the-simple'),
                        'subtitle' => __('Show or remove verical seperator between the icons on the right like search, cart  ', 'the-simple'),
                        'desc' => __('Show or remove verical seperator between the icons on the right like search, cart', 'the-simple'),
                        'default' => '1'// 1 = on | 0 = off
                    ),

                    array(
                        'id' => 'header_container_full', 
                        'type' => 'checkbox',
                        'title' => __('Remove container from header', 'the-simple'),
                        'subtitle' => __('Cant use with left menu', 'the-simple'),
                        'desc' => __('By checking this the header container should be removed and transformed in fullwidth header', 'the-simple'),
                        'default' => '0'// 1 = on | 0 = off
                    ),

                    array(
                        'id' => 'show_button', 
                        'type' => 'checkbox',
                        'title' => __('Add button to header', 'the-simple'),
                        'subtitle' => __('Add a button in header after the menu', 'the-simple'),
                        'desc' => __('', 'the-simple'),
                        'default' => '0'// 1 = on | 0 = off
                    ),



                    array(
                        'id' => 'header_button',
                        'type' => 'text',
                        'title' => __('Header Button', 'the-simple'),
                        'required' => array('show_button', 'equals', '1'),
                        'default' => 'Donate Now'
                    ),

                    array(
                        'id' => 'header_button_link',
                        'type' => 'text', 
                        'title' => __('Header Button Link', 'the-simple'),
                        'required' => array('show_button', 'equals', '1'),
                        'default' => '#'
                    ),

                     array(

                        'id' => 'header_button_margin_top',     
                        'type' => 'spacing',
                        'output' => array('.header_button'), // An array of CSS selectors to apply this font style to
                        'mode' => 'margin', // absolute, padding, margin, defaults to padding
                        'top' => true, // Have one field that applies to all
                        'left'=> true,
                        'bottom'=> true,
                        'right' => true,
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'title' => __('Header Button Margin', 'the-simple'),
                        'subtitle' => __('Adjust margin of header button ', 'the-simple'),
                        'desc' => __('Unit: px', 'the-simple'),
                        'default' => array('margin-left' => '0px', 'margin-right' => "0px"),
                        'required' => array('show_button', 'equals', '1'),
                        
                    ),


                    array( 
                        'id'       => 'header_border_bottom',
                        'type'     => 'switch',
                        'title'    => __('Header Borders', 'the-simple'),
                        
                        'desc'     => __('Add Borders for header', 'the-simple'),
                        'default'  =>0
                    ),

                    array( 
                        'id'       => 'header_border_bottom_content',
                        'type'     => 'switch',
                        'title'    => __('Header Border Bottom', 'the-simple'),
                        
                        'desc'     => __('Add Border Bottom for header', 'the-simple'),
                        'default'  =>0
                    ),

                    array(
                        'id' => 'header_shadow', 
                        'type' => 'select',
                        'title' => __('Header Shadow', 'the-simple'),
                        'subtitle' => __('Select one shadow style or leave it without shadow', 'the-simple'),
                        'desc' => __('Isnt compatible with all headers', 'the-simple'),
                        'options' => array('no_shadow' => 'Without Shadow', 'full' => 'Fullwidth light shadow', 'shadow1' => 'Shadow1', 'shadow2' => 'Shadow2', 'shadow3' => 'Shadow3'), //Must provide key => value pairs for select options
                        'required' => array('header_style', 'equals', array('header_2', 'header_8', 'header_12')),
                        'default' => 'no_shadow'// 1 = on | 0 = off
                    ),

                    array(
                        'id' => 'responsive_menu_dropdown',
                        'type' => 'switch',
                        'title' => __('Show Responsive Menu Dropdown', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        "default" => 1,
                    ),
                    array(
                                'id' => 'responsive_menu_style',
                                'type' => 'select',
                                'title' => __('Responsive menu style', 'the-simple'),
                                'subtitle' => __('', 'the-simple'),
                                'options' => array('normal' => 'Standard', 'sidemenu' => 'Side menu'), //Must provide key => value pairs for select options
                                'required' => array('responsive_menu_dropdown', 'equals', 1),
                                'default' => 'normal'
                            ),

                    array(
                        'id' => 'header_responsive_tools',
                        'type' => 'switch',
                        'title' => __('Show header tools in responsive (Mobile)', 'the-simple'),
                        'subtitle' => __('Extra Nav, Shop Cart etc...', 'the-simple'),
                        "default" => 0,

                    ),
                )
           ));

                    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-website',
                        'title' => __('Menu Options', 'the-simple'),
                        'fields' => array(
                            array(
                                'id' => 'menu_font_style',
                                'type' => 'typography',
                                'title' => __('Menu Item Typography', 'the-simple'),
                                //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                                'font-backup' => false, // Select a backup non-google font in addition to a google font
                                'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
                                'font-weight'=>true,
                                'subsets'=>false, // Only appears if google is true and subsets not set to false
                                //'font-size'=>false,
                                'line-height'=>true,
                                //'word-spacing'=>true, // Defaults to false
                                'letter-spacing'=>true, // Defaults to false
                                //'color'=>false,
                                //'preview'=>false, // Disable the previewer 
                                'text-align' => true,
                                'text-transform' => true,
                                'output' => array('nav .menu > li > a, nav .menu > li.hasSubMenu:after', 'header#header .header_tools .vert_mid > a:not(#trigger-overlay), header#header .header_tools, header#header .header_tools .cart .cart_icon, .header_tools .right_search'), // An array of CSS selectors to apply this font style to dynamically
                                'units' => 'px', // Defaults to px
                                'subtitle' => __('Select the appropiate font style for the menu', 'the-simple'),
                                'default' => array(
                                    'color' => "#222",
                                    'font-weight' => '400',
                                    'font-family' => 'Lato',
                                    'google' => true,
                                    'font-size' => '13px',
                                    'line-height' => '20px',
                                    'text-align' => 'center',
                                    'font-style' => 'normal',
                                    'text-transform' => 'uppercase',
                                    'letter-spacing' => '1px'
                                ),
                            ),

                            array(
                                'id' => 'menu_padding',
                                'type' => 'spacing',
                                'output' => array('nav .menu > li'), // An array of CSS selectors to apply this font style to
                                'mode' => 'padding', // absolute, padding, margin, defaults to padding
                                'top' => false, // Disable the top
                                //'right' => false, // Disable the right
                                'bottom' => false, // Disable the bottom
                                //'left' => false, // Disable the left
                                //'all' => true, // Have one field that applies to all
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                //'display_units' => 'false', // Set to false to hide the units if the units are specified
                                'title' => __('Menu Items padding', 'the-simple'),
                                'subtitle' => __('Adjust padding beetwen menu items ', 'the-simple'),
                                'desc' => __('Unit: px', 'the-simple'),
                                'default' => array('padding-left' => '5px', 'padding-right' => "5px")
                            ),


                            array(
                                'id' => 'menu_margin',
                                'type' => 'spacing',
                                'output' => array('nav .menu > li'), // An array of CSS selectors to apply this font style to
                                'mode' => 'margin', // absolute, padding, margin, defaults to padding
                                'top' => false, // Disable the top
                                //'right' => false, // Disable the right
                                'bottom' => false, // Disable the bottom
                                //'left' => false, // Disable the left
                                //'all' => true, // Have one field that applies to all
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                //'display_units' => 'false', // Set to false to hide the units if the units are specified
                                'title' => __('Menu Items Margin', 'the-simple'),
                                'subtitle' => __('Adjust margin beetwen menu items ', 'the-simple'),
                                'desc' => __('Unit: px', 'the-simple'),
                                'default' => array('margin-left' => '0px', 'margin-right' => "0px")
                            ), 
                        ),
                        'subsection' => true
                    ));
                    
                    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-website',
                        'title' => __('Dropdown Options', 'the-simple'),
                        'fields' => array(
                            array(
                                'id' => 'dropdown_width',
                                'type' => 'dimensions',
                                'output' => array('nav .menu > li > ul.sub-menu', 'nav .menu > li > ul.sub-menu ul'),
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                'height' => false,
                                'title' => __('Dropdown Width', 'the-simple'),
                                'subtitle' => __('units: px', 'the-simple'),
                                'desc' => __('', 'the-simple'),
                                'default' => array('width' => 220)
                            ),

                            array(
                                'id' => 'background_dropdown',
                                'type' => 'color_rgba',
                                'mode' => 'background-color',
                                'output' => array('nav .menu li > ul', '.simple_custom_menu_mega_menu', '.menu-small', '.header_tools .cart .content, .snap-drawer-left'),
                                'title' => __('Dropdown Background Color', 'the-simple'),
                                'subtitle' => __('Background Color for the dropdown in the menu', 'the-simple'),
                                'default'  => array(
                                    'color' => '#111111',  
                                    'alpha' => '0.93'
                                ),
                                'validate' => 'colorrgba'
                            ),

                            array(
                                'id' => 'dropdown_border_color',
                                'type' => 'color',
                                'output' => array('nav .simple_custom_menu_mega_menu > ul > li'),
                                'title' => __('Dropdown Right Border color', 'the-simple'),
                                'subtitle' => __('Dropdown right border color for navigation', 'the-simple'),
                                'default' => '#282828'
                            ),

                            array( 
                                'id' => 'dropdown_font',
                                'type' => 'typography',
                                'title' => __('Dropdown typography', 'the-simple'),
                                'font-family' => false,
                                'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                                'font-backup' => false, // Select a backup non-google font in addition to a google font
                                'font-size'=>true,
                                'line-height'=>false,
                                'font-weight' => false,
                                'font-style' => false,
                                'letter-spacing'=>true, // Defaults to false
                                'color'=>true,
                                'preview' => false,
                                'text-align' => false,
                                'text-transform' => true,
                                'units' => 'px', // Defaults to px
                                'subtitle' => __('Select the appropiate font style for the megamenu column title', 'the-simple'),
                                'output' => 'nav .menu li > ul.sub-menu li, .menu-small ul li a, .header_tools .cart',
                                'default' => array(
                                    'color' => "#9e9e9e",
                                    'font-size' => '13px',
                                    'letter-spacing' => '0.5px',
                                    'text-transform' => 'capitalize'
                                ),
                            ),

                            array( 
                                'id' => 'megamenu_title',
                                'type' => 'typography',
                                'title' => __('Megamenu title', 'the-simple'),
                                'font-family' => false,
                                'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                                'font-backup' => false, // Select a backup non-google font in addition to a google font
                                'font-size'=>true,
                                'line-height'=>false,
                                'font-weight' => true,
                                'font-style' => false,
                                'letter-spacing'=>true, // Defaults to false
                                'color'=>true,
                                'preview' => false,
                                'text-align' => false,
                                'text-transform' => true,
                                'units' => 'px', // Defaults to px
                                'subtitle' => __('Select the appropiate font style for the megamenu column title', 'the-simple'),
                                'output' => 'nav .simple_custom_menu_mega_menu ul>li h6, .menu-small ul.menu .simple_custom_menu_mega_menu h6, .menu-small ul.menu > li > a ',
                                'default' => array(
                                    'color' => "#fff",
                                    'font-size' => '14px',
                                    'font-weight' => '600',
                                    'letter-spacing' => '1px',
                                    'text-transform' => 'uppercase'
                                ),
                            ),

                            array(
                                'id' => 'cart_dropdown_button',
                                'type' => 'select',
                                'title' => __('Cart Dropdown in header button style', 'the-simple'),
                                'subtitle' => __('', 'the-simple'),
                                'options' => array('dark' => 'Dark', 'light' => 'Light'), //Must provide key => value pairs for select options
                                'default' => 'dark'
                            ),
                        ),
                        'subsection' => true
                    ));

                    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-website',
                        'title' => __('Top Widgetized Area', 'the-simple'),
                        'fields' => array(
                            array(
                                'id' => 'top_navigation',
                                'type' => 'switch',
                                'title' => __('Show Top Navigation', 'the-simple'),
                                'subtitle' => __('Switch On to enable top navigation', 'the-simple'),
                                'default' => 0// 1 = on | 0 = off
                            ),

                            array(
                                'id' => 'top_navigation_transparency',
                                'type' => 'switch',
                                'title' => __('Make Transparency TOP WIDGETIZED', 'the-simple'),
                                'subtitle' => 'If you active this option the header should be shown on top of the slider',
                                'default' => 0,
                                'required' => array('header_style', 'equals', array('header_1', 'header_2', 'header_4', 'header_5', 'header_11', 'header_12') ),
                            ),
                            array(
                                'id' => 'topnav_bg',
                                'type' => 'color',
                                'mode' => 'background-color',
                                'output' => array('.top_nav'),
                                'title' => __('Background Color', 'the-simple'),
                                'subtitle' => __('', 'the-simple'),
                                'default' => '#f5f5f5',
                                'validate' => 'color',
                            ),


                            array( 
                                'id'       => 'topnav_border_top',
                                'type'     => 'border',
                                'title'    => __('Top Navigation Border Top', 'the-simple'),
                                'subtitle' => __('', 'the-simple'),
                                'output'   => array('.top_nav'),
                                'right'    => false,
                                'bottom'   => false, 
                                'left'     => false,
                                'color'    => true,
                                'style'    => true,
                                'desc'     => __('Add Border top for the top navigation', 'the-simple'),
                                'default'  => array(
                                    'color'  => '', 
                                    'border-style'  => 'solid',
                                    'border-top'    => '0px',
                                )
                            ),

                            array( 
                                'id'       => 'topnav_border_bottom',
                                'type'     => 'border',
                                'title'    => __('Top Navigation Border Bottom', 'the-simple'),
                                'subtitle' => __('', 'the-simple'),
                                'output'   => array('.top_nav'),
                                'right'    => false,
                                'top'   => false, 
                                'left'     => false,
                                'color'    => true,
                                'style'    => true,
                                'desc'     => __('Add Border bottom for the top navigation', 'the-simple'),
                                'default'  => array(
                                    'color'  => '#f2f2f2', 
                                    'border-style'  => 'solid',
                                    'border-bottom'    => '0px',
                                )
                            ),

                            array( 
                                'id'       => 'topnav_border_bottom_container',
                                'type'     => 'border',
                                'title'    => __('Top Navigation Border Bottom in Container', 'the-simple'),
                                'subtitle' => __('', 'the-simple'),
                                'output'   => array('.top_nav .container'),
                                'right'    => false,
                                'top'   => false, 
                                'left'     => false,
                                'color'    => true,
                                'style'    => true,
                                'desc'     => __('Add Border bottom for the top navigation container', 'the-simple'),
                                'default'  => array(
                                    'color'  => '#f2f2f2', 
                                    'border-style'  => 'solid',
                                    'border-bottom'    => '0px',
                                )
                            ),

                            array(
                                'id' => 'topnav_font_style',
                                'type' => 'typography',
                                'title' => __('Typography', 'the-simple'),
                                //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                                'font-backup' => true, // Select a backup non-google font in addition to a google font
                                //'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
                                //'subsets'=>false, // Only appears if google is true and subsets not set to false
                                //'font-size'=>false,
                                'line-height'=>false,
                                //'word-spacing'=>true, // Defaults to false
                                //'letter-spacing'=>true, // Defaults to false 
                                //'color'=>false,
                                //'preview'=>false, // Disable the previewer
                                'text-align' => false,
                                'output' => array('.top_nav'),
                                'units' => 'px', // Defaults to px
                                'subtitle' => __('Select the appropiate font style for top nav', 'the-simple'),
                                'default' => array(
                                    'color' => "#999",
                                    'font-family' => 'Open Sans',
                                    'google' => true,
                                    'font-size' => '11px'
                                ),
                            ),

                            array(
                                'id' => 'topnav_height',
                                'type' => 'dimensions', 
                                'output' => array('.top_nav, .top_nav .widget'),
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                'width' => false,
                                'title' => __('Top Nav Height', 'the-simple'),
                                'subtitle' => __('units: px', 'the-simple'),
                                'desc' => __('', 'the-simple'),
                                'default' => array('height' => 40)
                            ),
                        ),
                        'subsection' => true
                   ));

                    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-website',
                        'title' => __('Default Page Header', 'the-simple'),
                        'fields' => array(
                            array(
                                'id' => 'page_header_bool',
                                'type' => 'switch',
                                'title' => __('Active Page Header', 'the-simple'),
                                'subtitle' => __('Switch On to enable page header for pages, posts (For each post or page you can add custom options)', 'the-simple'),
                                'default' => 1// 1 = on | 0 = off
                            ),

                            array(
                                'id' => 'page_header_height',
                                'type' => 'dimensions',
                                'output' => array('.header_page'),
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                'width' => false,
                                'title' => __('Page Header Height', 'the-simple'),
                                'subtitle' => __('units: px', 'the-simple'),
                                'desc' => __('', 'the-simple'),
                                'default' => array('height' => 100)
                            ),

                            array(
                                'id' => 'page_header_style',
                                'type' => 'select',
                                'title' => __('Page header style', 'the-simple'),
                                'subtitle' => __('Select the style for the default page header', 'the-simple'),
                                'options' => array('normal' => 'Basic (Left with breadcrumbs)', 'centered' => 'Centered'), //Must provide key => value pairs for select options
                                'default' => 'normal'
                            ),

                            array(
                                'id' => 'page_header_f_color',
                                'type' => 'color',
                                'output' => array('.header_page'),
                                'title' => __('Page header font color', 'the-simple'),
                                'subtitle' => __('Select the color for the title or breadcrumbs in page header', 'the-simple'),
                                'default' => '#333',
                                'validate' => 'color',
                            ),

                            array(
                                'id' => 'page_header_background',
                                'type' => 'background',
                                'output' => array('.header_page'),
                                'title' => __('Page header background', 'the-simple'),
                                'subtitle' => __('Page Header background with image, color, etc.', 'the-simple'),
                                'default' => array('background-color' => '#f5f5f5')
                            ),

                            array( 
                                'id'       => 'page_header_border',
                                'type'     => 'border',
                                'title'    => __('Page header Border Bottom', 'the-simple'),
                                'subtitle' => __('', 'the-simple'),
                                'output'   => array('.header_page, #slider-fullwidth'),
                                'right'    => false,
                                'top'   => false, 
                                'left'     => false,
                                'color'    => true,
                                'style'    => true,
                                'desc'     => __('Add Border bottom for page header', 'the-simple'),
                                'default'  => array(
                                    'color'  => '', 
                                    'border-style'  => 'solid',
                                    'border-bottom'    => '0px'
                                )
                            ),
                        ),
                        'subsection' => true
                    ));
                    Redux::setSection( $opt_name, array(
                        'icon' => 'el-icon-website',
                        'title' => __('Sticky Nav', 'the-simple'),
                        'fields' => array(
                            array(
                                'id' => 'sticky',
                                'type' => 'switch',
                                'title' => __('Sticky Header', 'the-simple'),
                                'subtitle' => __('Switch on to active sticky header (fixed position on header)', 'the-simple'),
                                "default" => 0,
                            ),
                            array(
                                'id' => 'sticky_header_height',
                                'type' => 'dimensions',
                                'output' => array('.sticky_header header#header .row-fluid .span12', '.sticky_header .header_wrapper'),
                                'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                'width' => false,
                                'title' => __('Sticky Header Height', 'the-simple'),
                                'subtitle' => __('units: px', 'the-simple'),
                                'desc' => __('', 'the-simple'),
                                'default' => array('height' => 60)
                            ),
                            
                            array(
                                'id' => 'sticky_header_background',
                                'type' => 'color_rgba',
                                'mode' => 'background-color',
                                'transparent' => true,
                                'validate' => 'colorrgba',
                                'output' => array('.sticky_header header#header'),
                                'title' => __('Sticky Background', 'the-simple'),
                                'subtitle' => __('Header background with image, color, etc.', 'the-simple'),
                                'default' => array(
                                    'color' => '#fff',
                                    'alpha' => '0.80'
                                ),
                            ),

                            array(
                                'id' => 'sticky_logo',
                                'type' => 'switch',
                                'title' => __('Sticky Logo', 'the-simple'),
                                'subtitle' => __('Remove the Logo from the main Header and shows only on stiky', 'the-simple'),
                                "default" => 0,
                                'required' => array('sticky', 'equals', 1),
                            ),
                        ),
                        'subsection' => true
                   ));
            

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Styling Options', 'the-simple'),
                'fields' => array(
                    array(
                        'id' => 'primary_color', 
                        'type' => 'color',
                        'output' => array('.header_11 nav li > a:hover, .header_11 nav li.current-menu-item > a, .header_11 nav li.current-menu-parent > a ','.header_10 nav li > a:hover, .header_10 nav li.current-menu-item > a, .header_10 nav li.current-menu-parent > a ','.header_9 nav li > a:hover, .header_9 nav li.current-menu-item > a, .header_9 nav li.current-menu-parent > a ','.header_8 nav li > a:hover, .header_8 nav li.current-menu-item > a, .header_8 nav li.current-menu-parent > a ','.header_7 nav li > a:hover, .header_7 nav li.current-menu-item > a, .header_7 nav li.current-menu-parent > a ','.header_5 nav li > a:hover, .header_5 nav li.current-menu-item > a, .header_5 nav li.current-menu-parent > a ','.header_3 nav li > a:hover, .header_3 nav li.current-menu-item > a, .header_3 nav li.current-menu-parent > a ','.header_2 nav li > a:hover, .header_2 nav li.current-menu-item > a, .header_2 nav li.current-menu-parent > a ', '.simple_slider .swiper-slide .buttons.colors-light a.colored:hover *',  '.services_steps .icon_wrapper i', '.testimonial_carousel .item .param span', '.services_large .icon_wrapper i', '.animated_counter i', '.services_medium.style_1 i', '.services_small dt i', '.single_staff .social_widget li a:hover i', '.single_staff .position', '.list li.titledesc dl dt i', '.list li.simple i', '.page_parents li a:hover', '#portfolio-filter ul li.active a','.content_portfolio.fullwidth #portfolio-filter ul li.active a', 'a:hover', '.header_1 nav li.current-menu-item > a','.blog-article h1 a:hover, .blog-article.timeline-style .content .quote i', '.header_1 nav li.current-menu-item:after', '.header_1 nav li > a:hover', '.header_1 nav li:hover:after', 'header#header .header_tools > a:hover', 'footer#footer a:hover', 'aside ul li:hover:after', '.highlights', '.blog-article .tags'),
                        'title' => __('Primary Color', 'the-simple'),
                        'subtitle' => __('Color for links, highlighted text and other', 'the-simple'),
                        'default' => '#3cc7c6',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'body_font_color',
                        'type' => 'color',
                        'output' => array('body'),
                        'title' => __('Body Font Color', 'the-simple'),
                        'subtitle' => __('Base font color for the main content, in light sections', 'the-simple'),
                        'default' => '#9e9e9e',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'link_font_color',
                        'type' => 'color',
                        'output' => array('a'),
                        'title' => __('Link Font Color', 'the-simple'),
                        'subtitle' => __('Font color of hyperlinks in the page', 'the-simple'),
                        'default' => '#9e9e9e',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'link_font_color_hover',
                        'type' => 'color',
                        'output' => array('a:hover'),
                        'title' => __('Link Font Color on hover', 'the-simple'),
                        'subtitle' => __('Font color of hyperlinks on hover in the page', 'the-simple'),
                        'default' => '#3cc7c6',
                        'validate' => 'color',
                    ),

                   


                    array(
                        'id' => 'headings_font_color',
                        'type' => 'color',
                        'output' => array('h1,h2,h3,h4,h5,h6', '.portfolio_single ul.info li .title, .skill_title'),
                        'title' => __('Headings Font Color', 'the-simple'),
                        'subtitle' => __('Base font color for headings, in light sections', 'the-simple'),
                        'default' => '#444444',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'base_border_color',
                        'type' => 'color',
                        'title' => __('Base Border Color', 'the-simple'),
                        'subtitle' => __('Base border color around the theme', 'the-simple'), 
                        'default' => '#e7e7e7',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'highlighted_background_main',
                        'type' => 'color',
                        'output' => array('.p_pagination .pagination span','.testimonial_cycle .item p', '#portfolio-filter ul li.active, #faq-filter ul li.active, .accordion.style_1 .accordion-heading .accordion-toggle, .accordion.style_2 .accordion-heading .accordion-toggle, .services_medium.style_1 .icon_wrapper, .skill'),
                        'title' => __('Highlighted Background', 'the-simple'),
                        'subtitle' => __('Highlighted Background in main content, white sections', 'the-simple'), 
                        'mode' => 'background-color',
                        'default' => '#f5f5f5',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'body_background',
                        'type' => 'background',
                        'output' => array('body, html, .top_space, .bottom_space', '.viewport'),
                        'title' => __('Background', 'the-simple'),
                        'subtitle' => __('Add a background to body', 'the-simple'),
                        'default' => 'transparent',
                    ),

                    array(
                        'id' => 'page_content_background_overall',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'output' => array('#content'),
                        'title' => __('Content Background', 'the-simple'),
                        'subtitle' => __('Add a background to content', 'the-simple'),
                        'default' => 'transparent',
                    ),
                    



                )
            ));
            
            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Default Page Header', 'the-simple'),
                'fields' => array(
                        array( 
                            'id' => 'page_header_normal_typography',
                            'type' => 'typography',
                            'title' => __('Normal Style No Subtitle Title Typography', 'the-simple'),
                            'font-family' => false,
                            'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>false,
                            'font-weight' => true,
                            'font-style' => false,
                            'letter-spacing'=>false, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true,
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.normal h1',
                            'default' => array(
                                'font-size' => '32px',
                                'font-weight' => '300',
                                'text-transform' => 'none'
                            ),
                        ),

                        array( 
                            'id' => 'page_header_normal_typography_subtitle_title',
                            'type' => 'typography',
                            'title' => __('Normal Style With Subtitle Title Typography', 'the-simple'),
                            'font-family' => false,
                            'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>false,
                            'font-weight' => true,
                            'font-style' => false,
                            'letter-spacing'=>false, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true,
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.with_subtitle.normal .titles h1',
                            'default' => array(
                                'font-size' => '32px',
                                'font-weight' => '300',
                                'text-transform' => 'none' 
                            ),
                        ),
                        
                        array( 
                            'id' => 'page_header_normal_typography_subtitle_subtitle',
                            'type' => 'typography',
                            'title' => __('Normal Style With Subtitle Subtitle Typography', 'the-simple'),
                            'font-family' => false,
                            'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>false,
                            'font-weight' => true,
                            'font-style' => false,
                            'letter-spacing'=>false, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true,
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.with_subtitle.normal .titles h3',
                            'default' => array(
                                'font-size' => '15px',
                                'font-weight' => '400',
                                'text-transform' => 'none' 
                            ),
                        ),

                        array( 
                            'id' => 'page_header_centered_typography_nosub_title',
                            'type' => 'typography',
                            'title' => __('Centered Style No Subtitle Title Typography', 'the-simple'),
                            'font-family' => false,
                            'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>true,
                            'font-weight' => true,
                            'font-style' => true,
                            'letter-spacing'=>false, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true,
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.centered h1, .header_page.left h1',
                            'default' => array(
                                'font-size' => '70px',
                                'font-weight' => '300',
                                'text-transform' => 'none',
                                'line-height' => '80px',
                                'font-style' => 'normal'

                            ),
                        ),

                        array( 
                            'id' => 'page_header_centered_typography_subtitle_title',
                            'type' => 'typography',
                            'title' => __('Centered Style With Subtitle Title Typography', 'the-simple'),
                            'font-family' => false,
                            'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>true,
                            'font-weight' => true,
                            'font-style' => false,
                            'letter-spacing'=>true, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true, 
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.with_subtitle.centered .titles h1, .header_page.with_subtitle.left .titles h1',
                            'default' => array(
                                'font-size' => '70px',
                                'font-weight' => '300',
                                'text-transform' => 'none',
                                'letter-spacing' => '1px',
                                'line-height' => '80px',
                                

                            ),
                        ),

                        array( 
                            'id' => 'page_header_centered_typography_subtitle_subtitle',
                            'type' => 'typography',
                            'title' => __('Centered Style With Subtitle Subtitle Typography', 'the-simple'),
                            'font-family' => true,
                            'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                            'font-backup' => false, // Select a backup non-google font in addition to a google font
                            'font-size'=>true,
                            'line-height'=>true, 
                            'font-weight' => false,
                            'font-style' => false,
                            'letter-spacing'=>false, // Defaults to false
                            'color'=>false,
                            'preview' => false,
                            'text-align' => false,
                            'text-transform' => true,
                            'units' => 'px', // Defaults to px
                            'output' => '.header_page.with_subtitle.centered .titles h3, .header_page.with_subtitle.left .titles h3',
                            'default' => array(
                                'font-size' => '20px',
                                'font-family' => 'Raleway',
                                'font-weight' => '400', 
                                'text-transform' => 'capitalize',
                                'line-height' => '30px',
                             

                            ),
                        ),
                        
                        array(
                                'id' => 'page_header_design_style',
                                'type' => 'select',
                                'title' => __('Page Header Design Style', 'the-simple'),
                                'subtitle' => __('Select the design style for the default page header', 'the-simple'),
                                'options' => array('normal' => 'Basic no padding and background, with little border', 'padd' => 'With padding and background'), //Must provide key => value pairs for select options
                                'default' => 'normal'
                        ),

                        array(
                            'id' => 'page_header_padd_bg_title',
                            'title' => __('Page Header with padding style title bg color', 'the-simple'),
                            'mode' => 'background-color',
                            'type' => 'color_rgba',
                            'default'  => array(
                                'color' => '#000', 
                                'alpha' => '0.70'
                            ),
                            'required' => array('page_header_design_style', 'equals', 'padd'),
                            'validate' => 'colorrgba',
                        ),
                        array(
                            'id' => 'page_header_padd_bg_subtitle',
                            'title' => __('Page Header with padding style subtitle bg color', 'the-simple'),
                            'mode' => 'background-color',
                            'type' => 'color_rgba',
                            'default'  => array(
                                'color' => '#fff', 
                                'alpha' => '0.70'
                            ),
                            'required' => array('page_header_design_style', 'equals', 'padd'),
                            'validate' => 'colorrgba',
                        ),
                        array(
                            'id' => 'page_header_padd_bg_subtitle_font',
                            'title' => __('Page Header with padding style subtitle font color', 'the-simple'),
                            'mode' => 'color',
                            'type' => 'color',
                            'default'  => '#222',
                            'required' => array('page_header_design_style', 'equals', 'padd'),
                            'validate' => 'color',
                        )
                ),
                'subsection' => true
           ));

             Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Footer Styling', 'the-simple'),
                'fields' => array(
                    array( 
                        'id' => 'fppter_headings_typography',
                        'type' => 'typography',
                        'title' => __('Footer Headings Typography', 'the-simple'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color'=>true,
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => 'footer#footer .widget-title',
                        'default' => array(
                            'color' => '#f2f2f2',
                            'font-weight' => '600', 
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '2px'
                        ),
                    ),

                    array(
                        'id' => 'footer_body_color',
                        'type' => 'color',
                        'output' => array('footer#footer, footer#footer .contact_information dd .title'),
                        'title' => __('Footer Body Font Color', 'the-simple'),
                        'subtitle' => __('Select the font color for text in footer' ,  'the-simple'),
                        'default' => '#888888',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'footer_links_color',
                        'type' => 'color',
                        'output' => array('footer#footer a, footer#footer .contact_information dd p'),
                        'title' => __('Footer links font Color', 'the-simple'),
                        'subtitle' => __('Select the font color for links' ,  'the-simple'),
                        'default' => '#bbbbbb',
                        'validate' => 'color',
                    ),
                    
                    array(
                        'id' => 'footer_background_color',
                        'type' => 'background',
                        'output' => array('footer#footer .inner'),
                        'title' => __('Footer Background', 'the-simple'),
                        'subtitle' => __('Background for the footer main part' ,  'the-simple'), 
                        'default' => array('background-color' => '#262626')
                    ),

                    array(
                        'id' => 'copyright_background_color',
                        'type' => 'color',
                        'output' => array('#copyright, footer .widget_recent_comments li, footer .tagcloud a'),
                        'title' => __('Copyright Background Color', 'the-simple'),
                        'subtitle' => __('Color for the latest part of the footer' ,  'the-simple'), 
                        'mode' => 'background-color',
                        'default' => '#212121',
                        'validate' => 'color',
                    ),

                    array( 
                        'id'       => 'footer_border_top',
                        'type'     => 'border',
                        'title'    => __('Footer Border Top', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        'output'   => array('footer#footer, #copyright'),
                        'right'    => false,
                        'top'      => true, 
                        'left'     => false,
                        'bottom'   => false,
                        'color'    => true,
                        'style'    => true, 
                        'desc'     => __('Add Border top for footer', 'the-simple'),
                        'default'  => array(
                            'color'  => '', 
                            'border-style'  => 'solid',
                            'border-top'    => '0px'
                        )
                    ),

                    array(
                        'id' => 'footer_social_icons_bg',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'output' => array('.footer_social_icons.circle li'),
                        'title' => __('Social Icons Circle BG', 'the-simple'),
                        'subtitle' => __('Circle background color' ,  'the-simple'),
                        'default' => '#333333',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'footer_social_icons_font_color',
                        'type' => 'color',
                        'output' => array('.footer_social_icons.circle li a i'),
                        'title' => __('Social Icons Circle Icon Color', 'the-simple'),
                        'subtitle' => __('Circle icon color' ,  'the-simple'),
                        'default' => '#777777',
                        'validate' => 'color',
                    ),


                ),
                'subsection' => true
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Blog Styling', 'the-simple'),
                'fields' => array(
                    array( 
                        'id' => 'blog_title_typography',
                        'type' => 'typography',
                        'title' => __('Blog Title Typography', 'the-simple'),
                        'font-family' => true,
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>true, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true,
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.blog-article.standard-style .content h1, .blog-article.alternate-style .content h1, .blog-article.timeline-style .content h1, .blog-article.fullscreen-single h1',
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-weight' => '400',
                            'color' => '#444444',
                            'text-transform' => 'capitalize', 
                            'line-height' => '30px',
                            'font-size' => '28px'
                        ),
                    ),
                    
                    array( 
                        'id' => 'blog_info_typography',
                        'type' => 'typography',
                        'title' => __('Blog Info List Typography', 'the-simple'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>true,  
                        'font-weight' => false, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true,
                        'preview' => false, 
                        'text-align' => false,
                        'text-transform' => false, 
                        'units' => 'px', // Defaults to px
                        'output' => '.blog-article.alternate-style .info, .blog-article.timeline-style .info, .blog-article.standard-style .info, .blog-article.grid-style .info, .fullscreen-single .info, .recent_news .blog-item .info, .latest_blog .blog-item .info ',
                        'default' => array(
                            'color' => '#9e9e9e',
                            'font-size' => '13px',
                            'line-height' => '20px' 
                        ),
                    ),

                    array( 
                        'id' => 'blog_info_typography_icon',
                        'type' => 'typography',
                        'title' => __('Blog Info List Icon Size', 'the-simple'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false,  
                        'font-weight' => false, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => false,
                        'preview' => false, 
                        'text-align' => false,
                        'text-transform' => false, 
                        'units' => 'px', // Defaults to px
                        'output' => '.blog-article.alternate-style .info i, .blog-article.timeline-style .info i, .blog-article.standard-style .info i, .blog-article.grid-style .info, .fullscreen-single .info i, .latest_blog .blog-item .info i, .recent_news .blog-item .info i ',
                        'default' => array(
                            'font-size' => '13px'
                        ),
                    ),

                    array(
                        'id' => 'timeline_box_shadow',
                        'type' => 'switch',
                        'title' => __('Active Timeline (or for masonry) Box Shadow', 'the-simple'),
                        "default" => 1,
                    ),
                    array(
                        'id' => 'timeline_bg_color',
                        'type' => 'color',
                        'output' => array('.blog-article.timeline-style .post_box, .blog-article.grid-style .gridbox'),
                        'title' => __('Timeline (or masonry) post box bg color', 'the-simple'),
                        'mode' => 'background-color',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'fullscreen_blog_box_bg', 
                        'output' => array('.fullscreen-blog-article .content'),
                        'title' => __('Fullscreen Blog Content Box BG', 'the-simple'),
                        'mode' => 'background-color',
                        'type' => 'color_rgba',
                        'default'  => array(
                            'color' => '#ffffff', 
                            'alpha' => '0.00'
                        ),
                        'validate' => 'colorrgba',
                    )
                ),
                'subsection' => true
           ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Sidebar Styling', 'the-simple'),
                'fields' => array(
                    array( 
                        'id' => 'sidebar_widget_title',
                        'type' => 'typography',
                        'title' => __('Widget Title', 'the-simple'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>true, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true,
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => 'aside .widget-title, .portfolio_single h4',
                        'default' => array(
                            'font-weight' => '600',
                            'color' => '#444444',
                            'font-size' => '15px',
                            'text-transform' => 'uppercase', 
                            'line-height' => '20px',
                            'letter-spacing' => '1px'
                        ),
                    ),
                    
                    array(
                        'id' => 'sidebar_widget_title_margin',
                        'type' => 'spacing',
                        'output' => array('aside .widget-title'), // An array of CSS selectors to apply this font style to
                        'mode' => 'margin', // absolute, padding, margin, defaults to padding
                        'top' => false, // Disable the top
                        'right' => false, // Disable the right
                        'bottom' => true, // Disable the bottom
                        'left' => false, // Disable the left
                        //'all' => true, // Have one field that applies to all 
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'title' => __('Widget Title Margin Bottom', 'the-simple'),
                        'desc' => __('Unit: px', 'the-simple'),
                        'default' => array('margin-bottom' => '24px')
                    ),

                    array(
                        'id' => 'sidebar_widget_margin',
                        'type' => 'spacing',
                        'output' => array('aside .widget'), // An array of CSS selectors to apply this font style to
                        'mode' => 'margin', // absolute, padding, margin, defaults to padding
                        'top' => false, // Disable the top
                        'right' => false, // Disable the right
                        'bottom' => true, // Disable the bottom
                        'left' => false, // Disable the left
                        //'all' => true, // Have one field that applies to all
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'title' => __('Widget Margin Bottom', 'the-simple'),
                        'desc' => __('Unit: px', 'the-simple'),
                        'default' => array('margin-bottom' => '35px')
                    ),
                    
                    array(
                        'id' => 'sidebar_tagcloud_bg',
                        'type' => 'color',
                        'output' => array('aside .tagcloud a'),
                        'title' => __('Sidebar Tagcloud Background', 'the-simple'),
                        'mode' => 'background-color',
                        'default' => '#fff',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'sidebar_tagcloud_border',
                        'type'     => 'border',
                        'title'    => __('Sidebar Tagcloud Border', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        'output'   => array('aside .tagcloud a'),
                        'right'    => true,
                        'top'      => true, 
                        'left'     => true,
                        'bottom'   => true,
                        'color'    => true,
                        'style'    => true, 
                        'desc'     => __('Add Border top for footer', 'the-simple'),
                        'default'  => array(
                            'color'  => '#e5e5e5', 
                            'border-style'  => 'solid',
                            'border-width'    => '1px'
                        )
                    ),

                    array(
                        'id' => 'sidebar_tagcloud_color',
                        'type' => 'color',
                        'output' => array('aside .tagcloud a'),
                        'title' => __('Sidebar Tagcloud Font color', 'the-simple'),
                        'mode' => 'color',
                        'default' => '#444',
                        'validate' => 'color',
                    )

                ), 
                'subsection' => true
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Sliders Styling', 'the-simple'),
                'fields' => array(
                    array(
                        'id' => 'simple_slider_wrapper_bg',
                        'type' => 'color',
                        'output' => array('.simple_slider_wrapper'),
                        'title' => __('Simple Slider Wrapper Background Color', 'the-simple'),
                        'mode' => 'background-color',
                        'default' => '#222',
                        'validate' => 'color'
                    ),
                ),
                'subsection' => true
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Filters Styling', 'the-simple'),
                'fields' => array(
                    array( 
                        'id' => 'portfolio_filter_basic_typography',
                        'type' => 'typography',
                        'title' => __('Portfolio Filter & FAQ Filter Basic Typography', 'the-simple'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true,
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '#portfolio-filter ul li a, #faq-filter ul li a',
                        'default' => array(
                            'font-weight' => '400',
                            'font-size' => '14px',
                            'color' => '#757575',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '1px'
                        ),
                    ),
                    
                    array(
                        'id' => 'portfolio_filter_basic_typography_active',
                        'type' => 'color',
                        'output' => array('#portfolio-filter ul li.active a, #portfolio-filter ul li a:hover, #faq-filter ul li.active a, #faq-filter ul li a:hover'),
                        'title' => __('Portfolio Filter & FAQ Filter Basic Typography (Active)', 'the-simple'),
                        'mode' => 'color',
                        'default' => '#222',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'portfolio_filter_full_bg',
                        'type' => 'color',
                        'output' => array('.content_portfolio.fullwidth .filter-row'),
                        'title' => __('Portfolio Filter Fullwidth Background Color', 'the-simple'),
                        'mode' => 'background-color',
                        'default' => '#222',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'portfolio_filter_full_link_color',
                        'type' => 'color_rgba',
                        'output' => array('.content_portfolio.fullwidth #portfolio-filter ul li a'),
                        'title' => __('Portfolio Filter Fullwidth Item color', 'the-simple'),
                        'mode' => 'color',
                        'default'  => array(
                            'color' => '#ffffff', 
                            'alpha' => '0.80'
                        ),
                        'validate' => 'colorrgba',
                    ),

                    array(
                        'id' => 'portfolio_filter_full_link_color_hover',
                        'type' => 'color_rgba',
                        'output' => array('.content_portfolio.fullwidth #portfolio-filter ul li a:hover'),
                        'title' => __('Portfolio Filter Fullwidth Item hover color ', 'the-simple'),
                        'mode' => 'color',
                        'default'  => array(
                            'color' => '#ffffff', 
                            'alpha' => '1.00'
                        ),
                        'validate' => 'colorrgba',
                    ),

                ),
                'subsection' => true,
           ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Portfolio Styling', 'the-simple'),
                'fields' => array(
                    array(
                        'id' => 'portfolio_overlay_bg',
                        'type' => 'color_rgba',
                        'output' => array('.portfolio-item.overlayed .tpl2 .bg'),
                        'title' => __('Portfolio Overlay BG Color ', 'the-simple'),
                        'mode' => 'background-color',
                        'default'  => array(
                            'color' => '#3cc7c6',  
                            'alpha' => '0.82'
                        ),
                        'validate' => 'colorrgba',
                    ),
                    array( 
                        'id' => 'portfolio_overlay_title',
                        'type' => 'typography',
                        'title' => __('Portfolio Overlay Title Typography', 'the-simple'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true,
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.portfolio-item.overlayed h4',
                        'default' => array(
                            'font-weight' => '600',
                            'color' => '#fff',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '1px'
                        ),
                    ),

                    array( 
                        'id' => 'portfolio_overlay_subtitle',
                        'type' => 'typography',
                        'title' => __('Portfolio Overlay Subtitle Typography', 'the-simple'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.portfolio-item.overlayed h6',
                        'default' => array(
                            'font-size' => '14px',
                            'font-weight' => '300',
                            'color' => '#fff',
                            'text-transform' => 'none'
                        ),
                    ),
                    
                    array(
                        'id' => 'portfolio_grayscale_bg',
                        'type' => 'color',
                        'output' => array('.portfolio-item.grayscale .project'),
                        'title' => __('Portfolio Grayscale Background', 'the-simple'),
                        'mode' => 'background-color',
                        'default' => '#fff',
                        'validate' => 'color',
                    ),

                    array( 
                        'id' => 'portfolio_grayscale_title',
                        'type' => 'typography',
                        'title' => __('Portfolio Grayscale Title Typography', 'the-simple'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => false,
                        'units' => 'px', // Defaults to px
                        'output' => '.portfolio-item.grayscale .project h5',
                        'default' => array(
                            'color' => '',
                            'font-weight' => '400'
                        ),
                    ),
 
                    array(
                        'id' => 'portfolio_grayscale_subtitle',
                        'type' => 'color',
                        'output' => array('.portfolio-item.grayscale .project h6'),
                        'title' => __('Portfolio Grayscale Subtitle Color', 'the-simple'),
                        'mode' => 'color',
                        'default' => '#bebebe',
                        'validate' => 'color',
                    ),

                    array(
                        'id' => 'portfolio_basic_overlay_bg',
                        'type' => 'color_rgba',
                        'output' => array('.portfolio-item.basic .bg'),
                        'title' => __('Portfolio Basic Overlay Background', 'the-simple'),
                        'mode' => 'background-color',
                        'default' => array(
                            'color' => '#3cc7c6',
                            'alpha' => '0.80'
                        ),
                        'validate' => 'colorrgba',
                    ),

                    array(
                        'id' => 'portfolio_basic_overlay_icon_color',
                        'type' => 'color',
                        'output' => '.portfolio-item.basic .link',
                        'title' => __('Portfolio Basic Icon Color', 'the-simple'),
                        'mode' => 'color',
                        'default' => '#3cc7c6',
                        'validate' => 'color',
                    ),

                    array( 
                        'id' => 'portfolio_basic_title',
                        'type' => 'typography',
                        'title' => __('Portfolio Basic Title Typography', 'the-simple'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => true,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.portfolio-item.basic .show_text h5',
                        'default' => array(
                            'color' => '#222',
                            'font-weight' => '600',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '1px',
                            'text-align' => 'center'
                        ),
                    ),

                    array( 
                        'id' => 'portfolio_basic_subtitle',
                        'type' => 'typography',
                        'title' => __('Portfolio Basic Subtitle Typography', 'the-simple'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => true,
                        'text-transform' => false,
                        'units' => 'px', // Defaults to px
                        'output' => '.portfolio-item.basic .show_text h6',
                        'default' => array(
                            'color' => '#565656',
                            'font-weight' => '300',
                            'text-align' => 'center'
                        ),
                    ),

                    

                ),
                'subsection' => true,
            ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Elements Styling', 'the-simple'),
                'fields' => array(
                    array( 
                        'id' => 'toggle_title_typography',
                        'type' => 'typography',
                        'title' => __('Toggle title typography', 'the-simple'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.accordion.style_2 .accordion-heading .accordion-toggle, .accordion.style_1 .accordion-heading .accordion-toggle, .accordion.style_3 .accordion-heading .accordion-toggle',
                        'default' => array(
                            'color' => '#555',
                            'font-weight' => '600',
                            'font-size' => '13px',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '1px'
                        ),
                    ),

                    array(

                        'id' => 'tooggle_bg_color',
                        'type' => 'background',
                        'output' => '.accordion-heading',
                        'title' => __('Set the accordion background color', 'the-simple'),
                        'default' => '#f6f6f6'

                        ),

                    array(

                        'id' => 'toggle_active_color',
                        'type' => 'color',
                        'output' => ' .accordion.style_2 .accordion-heading.in_head .accordion-toggle, .accordion.style_3 .accordion-heading.in_head .accordion-toggle',
                        'title' => __('Activated Toggle Font Color', 'the-simple'),
                        'mode' => 'color',
                        'default' => '#3cc7c6',
                        'validate' => 'color',
                    ),

                    array(

                        'id' => 'tabs_background_color',
                        'type' => 'background',
                        'output' => '.tabbable.tabs-top.style_1 .nav.nav-tabs li.active a',
                        'title' => __('Set the tabs active state background color', 'the-simple'),
                        'default' => 'transparent',  

                    ),

                    array(

                        'id' => 'tabs_font_color',
                        'type' => 'color',
                        'output' => '.tabbable.tabs-top.style_1 .nav.nav-tabs li.active a',
                        'title' => __('Set the tabs active font color', 'the-simple'),
                        'default' => '#fff'


                    ),

                    array( 
                        'id' => 'block_title_column_title',
                        'type' => 'typography',
                        'title' => __('Block Title Element (Column) Title', 'the-simple'),
                        'font-family' => true,
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'line-height' => true,
                        'preview' => false,
                        'text-align' => true,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.block_title.column_title h1',
                        'default' => array(
                            'color' => '#222',
                            'font-family' => 'Lato',
                            'font-weight' => '300',
                            'text-transform' => 'none',
                            'letter-spacing' => '0px',
                            'line-height' => '48px',
                            'text-align' => 'left'
                        ),
                    ),
                    
                    array( 
                        'id' => 'block_title_column_subtitle',
                        'type' => 'typography',
                        'title' => __('Block Title Element (Column) Subtitle', 'the-simple'),
                        'font-family' => true,
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => true,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.block_title.column_title h4',
                        'default' => array(
                            'color' => '#888',
                            'font-weight' => '300',
                            'text-transform' => 'none',
                            'text-align' => 'left',
                            'font-family'=>'Lato'
                        ),
                    ),
                    
                    array( 
                        'id' => 'block_title_section_title',
                        'type' => 'typography',
                        'title' => __('Block Title Element (Section) Title', 'the-simple'),
                        'font-family' => true,
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>false,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'line-height' => true,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.block_title.section_title h1',
                        'default' => array(
                            'color' => '#333',
                            'font-family' => 'lato',
                            'font-size' => '20px',
                            'font-weight' => '300',
                            'text-transform' => 'capitalize',
                            'line-height' => '50px',
                            'letter-spacing' => '1px'
                        ),
                    ),
                    
                    array( 
                        'id' => 'block_title_section_desc',
                        'type' => 'typography',
                        'title' => __('Block Title Element (Section) Desc', 'the-simple'),
                        'font-family' => true,
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'line-height' => true,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.block_title.section_title p',
                        'default' => array(
                            'font-family' => 'Lato',
                            'color' => '#777',
                            'font-weight' => '300',
                            'text-transform' => '',
                            'line-height' => '28px',
                            'font-size' => '20px',
                            'letter-spacing' => '0.5px'
                        ),
                    ),

                    array( 
                        'id' => 'animated_counter_typ',
                        'type' => 'typography',
                        'title' => __('Animated Counters Typography', 'the-simple'),
                        'font-family' => true,
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'line-height' => true,
                        'text-align' => false,
                        'text-transform' => false,
                        'units' => 'px', // Defaults to px
                        'output' => '.odometer',
                        'default' => array(
                            'color' => '#333333',
                            'font-weight' => '300',
                            'font-size' => '38px',
                            'line-height' => '48px',
                            'letter-spacing' => '2px',
                            'font-family' => 'Lato'
                        ),
                    ),
                    array( 
                        'id' => 'testimonial_text',
                        'type' => 'typography',
                        'title' => __('Testimonial typography', 'the-simple'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>false, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => false,
                        'line-height' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.testimonial_carousel .item p',
                        'default' => array(
                            'color' => '#444',
                            'font-weight' => '400',
                            'font-size' => '17px',
                            'line-height' => '30px'
                        ),
                    ),

                    array( 
                        'id' => 'textbar_title_typography',
                        'type' => 'typography',
                        'title' => __('Textbar title typography', 'the-simple'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.textbar h2',
                        'default' => array(
                            'color' => '#222',
                            'font-weight' => '300',
                            'font-size' => '28px',
                            'text-transform' => 'none',
                            'letter-spacing' => '0px'
                        ),
                    ),
                    array(
                        'id' => 'contact_border',
                        'type' => 'color',
                        'output' => '',
                        'title' => __('Contact Form Elements Border', 'the-simple'),
                        'default' => '#ececec',
                        'validate' => 'color',
                    )
                ),
                'subsection' => true
           ));

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Buttons Styling', 'the-simple'),
                'fields' => array(
                    array(
                        'id'       => 'overall_button_style',
                        'type'     => 'select',
                        'multi'    => true,
                        'options'  => array(
                            'default' => 'Default (Border and Effect)',
                            'business' => 'Business',
                            'no_padding' => 'Without padding',
                            'rounded' => 'Rounded',
                            'big' => 'Big and Shadow',
                            'with_icon' => 'With Icon in the left',
                            'gradient' => 'Gradient'
                        ),
                        'default'  => array('default'),
                        'title'    => __('Overall Button Style', 'the-simple')
                    ),


                    array( 
                        'id' => 'button_typography',
                        'type' => 'typography',
                        'title' => __('Overall button typography', 'the-simple'),
                        'font-family' => false,
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-size'=>true,
                        'line-height'=>false, 
                        'font-weight' => true, 
                        'font-style' => false,
                        'letter-spacing'=>true, // Defaults to false
                        'color' => true, 
                        'preview' => false,
                        'text-align' => false,
                        'text-transform' => true,
                        'units' => 'px', // Defaults to px
                        'output' => '.btn-bt',
                        'default' => array(
                            'color' => '#3cc7c6',
                            'font-weight' => '500',
                            'font-size' => '13px',
                            'text-transform' => 'uppercase',
                            'letter-spacing' => '2px'
                        )
                    ),
                    array(
                        'id' => 'button_background_color',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Overall button background', 'the-simple'),
                        'default'  => array(
                            'color' => '#ffffff',  
                            'alpha' => '0.00'
                        ),
                        'validate' => 'colorrgba'
                    ),
                    array(
                        'id' => 'button_border_color',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Overall button border', 'the-simple'),
                        'default'  => array(
                            'color' => '#3cc7c6', 
                            'alpha' => '1.00'
                        ),
                        'validate' => 'colorrgba'
                    ),
                    array(
                        'id' => 'button_hover_font_color',
                        'type' => 'color',
                        'output' => '',
                        'title' => __('Overall button hover Font Color', 'the-simple'),
                        'default' => '#fff',
                        'validate' => 'color'
                    ),

                    array(
                        'id' => 'button_hover_background',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Overall button hover bg', 'the-simple'),
                        'default'  => array(
                            'color' => '#3cc7c6', 
                            'alpha' => '0.75'
                        ),
                        'validate' => 'colorrgba'
                    ), 

                    array(
                        'id' => 'button_hover_border',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Overall button hover border', 'the-simple'),
                        'default'  => array(
                            'color' => '#3cc7c6', 
                            'alpha' => '1.00'
                        ),
                        'validate' => 'colorrgba'
                    ),

                    array(
                        'id' => 'button_light_font_color',
                        'type' => 'color',
                        'output' => '',
                        'title' => __('Light button Font Color', 'the-simple'),
                        'default' => '#fff',
                        'validate' => 'color'
                    ),

                    array(
                        'id' => 'button_light_background',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Light button bg', 'the-simple'),
                        'default'  => array(
                            'color' => '#fff', 
                            'alpha' => '0.00'
                        ),
                        'validate' => 'colorrgba'
                    ), 

                    array(
                        'id' => 'button_light_border',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Light button border', 'the-simple'),
                        'default'  => array(
                            'color' => '#fff', 
                            'alpha' => '0.40'
                        ),
                        'validate' => 'colorrgba'
                    ),

                    array(
                        'id' => 'button_light_hover_font_color',
                        'type' => 'color',
                        'output' => '',
                        'title' => __('Light button hover Font Color', 'the-simple'),
                        'default' => '#3cc7c6',
                        'validate' => 'color'
                    ),

                    array(
                        'id' => 'button_light__hover_background',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Light button hover bg', 'the-simple'),
                        'default'  => array(
                            'color' => '#fff', 
                            'alpha' => '1.00'
                        ),
                        'validate' => 'colorrgba'
                    ), 

                    array(
                        'id' => 'button_light_hover_border',
                        'type' => 'color_rgba',
                        'output' => '',
                        'title' => __('Light button hover border', 'the-simple'),
                        'default'  => array(
                            'color' => '#fff', 
                            'alpha' => '1.00'
                        ),
                        'validate' => 'colorrgba'
                    ),
                ),
                'subsection' => true
            ));     

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Shop Styling', 'the-simple'),
                'fields' => array(
                    
                    array(
                        'id' => 'shop_single_title',
                        'type' => 'typography',
                        'title' => __('Shop Single Product Title', 'the-simple'),
                        'compiler'=>false, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'=>false, // Only appears if google is true and subsets not set to false
                        'font-size'=>false,
                        'font-family' => false,
                        'text-transform' => true,
                        'line-height'=>false,
                        //'word-spacing'=>true, // Defaults to false
                        'letter-spacing'=>true, // Defaults to false
                        'color'=>false,
                        //'preview'=>false, // Disable the previewer
                        'text-align' => false,
                        'font-weight' => true,
                        'all-styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('.woocommerce #content div.product .product_title, .woocommerce div.product .product_title, .woocommerce-page #content div.product .product_title, .woocommerce-page div.product .product_title, .woocommerce ul.products li.product h6, .woocommerce-page ul.products li.product h6'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for single product title', 'the-simple'),
                        'default' => array(
                            'font-weight' => '300',
                            'letter-spacing' => '1',
                            'text-transform' => 'capitalize'
                        ),
                    ),

                    array(
                        'id' => 'shop_product_overlay',
                        'type' => 'color_rgba',
                        'title' => __('Shop item overlay', 'the-simple'),
                        'mode' => 'background-color', 
                        'output' => array('.woocommerce ul.products li.product:hover .overlay'), 
                        'default'  => array(
                            'color' => '#fffffff', 
                            'alpha' => '0.80'
                        ),
                        'validate' => 'colorrgba',
                    ),
                ),
                'subsection' => true
            ));
                   
            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-text-width',
                'title' => __('Typography Options', 'the-simple'),
                'fields' => array(
                    array(
                        'id' => 'body_typography',
                        'type' => 'typography',
                        'title' => __('Body Font Style', 'the-simple'),
                        'compiler'=>false, 
                        'google' => true, 
                        'font-backup' => true,
                        'font-style'=>true, 
                        'line-height'=>true,
                        'text-align' => false,
                        'font-weight' => true,
                        'letter-spacing' => true,
                        'all-styles' => true,
                        'output' => array('body'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for the body text', 'the-simple'),
                        'default' => array(
                            'color' => "#999999",
                            'font-family' => 'Lato',
                            'google' => true,
                            'line-height' => '26px',
                            'font-size' => '16px',
                            'font-weight' => '400',
                            'letter-spacing' => '0px'
                        ),
                    ),

                    
                    array(
                        'id' => 'headings_font_type',
                        'type' => 'typography',
                        'title' => __('Headings font type', 'the-simple'),
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => true,
                        'font-style' => true,
                        'letter-spacing' => true,
                        'subsets' => false,
                        'font-size' => false,
                        'line-height'=>false,
                        'color'=>false,
                        'font-family' => true,
                        'text-align' => false,
                        'all-styles' => true,
                        'compiler' => false,
                        'output' => array('h1,h2,h3,h4,h5,h6', '.skill_title', '.tabbable.tabs-top.style_1 .nav.nav-tabs li a, .blog-article.timeline-style .timeline .date .month'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for the body text', 'the-simple'),
                        'default' => array(
                            'font-family' => 'Lato',
                            'letter-spacing' => '1px',
                            'google' => true,
                            'font-weight' => '400'
                        ),
                    ),


                    array(
                        'id' => 'heading_1_font',
                        'type' => 'typography',
                        'title' => __('Heading 1 Font style', 'the-simple'),
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'font-style' => false,
                        'line-height'=>true,
                        'color'=>false,
                        'font-family' => false,
                        'preview'=>false,
                        'text-align' => false,
                        'output' => array('h1'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for the h1 text', 'the-simple'),
                        'default' => array(
                            'line-height' => '50px',
                            'google' => true,
                            'font-size' => '45px'
                        ),
                    ),
                    array(
                        'id' => 'heading_2_font',
                        'type' => 'typography',
                        'title' => __('Heading 2 Font style', 'the-simple'),
                        //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'font-style' => false,
                        'line-height'=>true,
                        'color'=>false,
                        'font-family' => false,
                        'text-align' => false,
                        'preview'=>false,
                        'output' => array('h2'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for this heading', 'the-simple'),
                        'default' => array(
                            'line-height' => '28px',
                            'google' => true,
                            'font-size' => '22px'
                        ),
                    ),
                    array(
                        'id' => 'heading_3_font',
                        'type' => 'typography',
                        'title' => __('Heading 3 Font style', 'the-simple'),
                        //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'line-height'=>true,
                        'font-style' => false,
                        'color'=>false,
                        'preview'=>false,
                        'font-family' => false,
                        'text-align' => false,
                        'output' => array('h3'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for this heading', 'the-simple'),
                        'default' => array(
                            'line-height' => '26px',
                            'google' => true,
                            'font-size' => '20px'
                        ),
                    ),
                    array(
                        'id' => 'heading_4_font',
                        'type' => 'typography',
                        'title' => __('Heading 4 Font style', 'the-simple'),
                        //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'line-height'=>true,
                        'font-style' => false,
                        'color'=>false,
                        'font-family' => false,
                        'preview'=>false,
                        'text-align' => false,
                        'output' => array('h4'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for this heading', 'the-simple'),
                        'default' => array(
                            'line-height' => '24px',
                            'google' => true,
                            'font-size' => '17px'
                        ),
                    ),
                    array(
                        'id' => 'heading_5_font',
                        'type' => 'typography',
                        'title' => __('Heading 5 Font style', 'the-simple'),
                        //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'line-height'=>true,
                        'font-style' => false,
                        'color'=>false,
                        'font-family' => false,
                        'preview'=>false,
                        'text-align' => false,
                        'output' => array('h5'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for this heading', 'the-simple'),
                        'default' => array(
                            'line-height' => '22px',
                            'google' => true,
                            'font-size' => '16px'
                        ),
                    ),
                    array(
                        'id' => 'heading_6_font',
                        'type' => 'typography',
                        'title' => __('Heading 6 Font style', 'the-simple'),
                        //'compiler'=>true, // Use if you want to hook in your own CSS compiler
                        'google' => false, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => false, // Select a backup non-google font in addition to a google font
                        'font-weight' => false,
                        'line-height'=>true,
                        'font-style' => false,
                        'color'=>false,
                        'font-family' => false,
                        'text-align' => false,
                        'preview'=>false,
                        'output' => array('h6'), 
                        'units' => 'px',
                        'subtitle' => __('Select the appropiate font style for this heading', 'the-simple'),
                        'default' => array(
                            'line-height' => '20px',
                            'google' => true,
                            'font-size' => '14px'
                        ),
                    ),
                )
           ));
            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-adjust-alt',
                'title' => __('Footer Options', 'the-simple'),
                'fields' => array(
                    array(
                        'id'       => 'footer_columns',
                        'type'     => 'image_select',
                        'title'    => __('Footer Columns', 'the-simple'), 
                        'subtitle' => __('Select how many columns do you want for the footer. Choose between 1, 2, 3 or 4 column layout.', 'the-simple'),
                        'options'  => array(
                            '1'      => array(
                                'alt'   => '1 Column', 
                                'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                            ),
                            '2'      => array(
                                'alt'   => '2 Columns', 
                                'img'   => ReduxFramework::$_url.'assets/img/2-col-portfolio.png'
                            ),
                            '3'      => array(
                                'alt'   => '3 Columns', 
                                'img'  => ReduxFramework::$_url.'assets/img/3-col-portfolio.png'
                            ),
                            '4'      => array(
                                'alt'   => '4 Columns', 
                                'img'   => ReduxFramework::$_url.'assets/img/4-col-portfolio.png'
                            ),
                            '5'      => array(
                                'alt'   => '5 Columns', 
                                'img'   => ReduxFramework::$_url.'assets/img/5-col-portfolio.png'
                            )
                        ),
                        'default' => '5'
                    ),
                    array(
                        'id' => 'footer_container_full', 
                        'type' => 'checkbox',
                        'title' => __('Remove container from footer', 'the-simple'),
                        'desc' => __('By checking this the footer container should be removed and transformed in fullwidth footer', 'the-simple'),
                        'default' => '0'// 1 = on | 0 = off
                    ),
                    
                    array(
                        'id' => 'copyright_text',
                        'type' => 'editor',
                        'title' => __('Copyright Text in the end of footer', 'the-simple'),
                        'subtitle' => __('Text have to be placed in the copyright bar', 'the-simple'),
                        'default' => '@2017 The Simple - Multi-Purpose theme from <a href="'.esc_url("http://ellethemes.com").'">Elle Themes</a>, builded with <a href="#">WordPress</a>',
                    ),

                    array(
                        'id' => 'show_footer',
                        'type' => 'switch',
                        'title' => __('Show Footer', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        "default" => 1,
                    ),

                    array(
                        'id' => 'show_copyright',
                        'type' => 'switch',
                        'title' => __('Show Copyright', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        "default" => 1,
                    ),

                )
            ));

            

            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-file-edit',
                'title' => __('Blog Config', 'the-simple'),
                'fields' => array(
                    array(
                        'id' => 'blog_style',
                        'type' => 'select',
                        'title' => __('Blog Style', 'the-simple'),
                        'subtitle' => __('Select the blog style to be used', 'the-simple'),
                        'options' => array('normal' => 'Normal', 'timeline' => 'Timeline', 'alternate' => 'Alternate', 'grid' => 'Masonry', 'fullscreen' => 'Fullscreen Innovative'), //Must provide key => value pairs for select options
                        'default' => 'normal'
                    ),

                    array(
                        'id' => 'blog_grid_col',
                        'title' => __( 'Blog Masonry Columns', 'the-simple' ),
                        'desc' => 'Number of columns for the layout',
                        'type' => 'image_select',
                        'options'  => array(
                                '2'      => array(
                                    'alt'   => '2 Columns', 
                                    'img'   => ReduxFramework::$_url.'assets/img/2-col-portfolio.png'
                                ),
                                '3'      => array(
                                    'alt'   => '3 Columns', 
                                    'img'  => ReduxFramework::$_url.'assets/img/3-col-portfolio.png'
                                ),
                                '4'      => array(
                                    'alt'   => '4 Columns', 
                                    'img'   => ReduxFramework::$_url.'assets/img/4-col-portfolio.png'
                                ),
                            ),
                        'default' => '3',
                        'required' => array('blog_style', 'equals', 'grid')
                    ),

                    array(
                        'title'     => __( 'Layout', 'the-simple' ),
                        'desc'      => __( 'Select main content and sidebar arrangement.', 'the-simple' ),
                        'id'        => 'bloglayout',
                        'default'   => 'fullwidth',
                        'type'      => 'image_select',
                        'customizer'=> array(),
                        'options'   => array( 
                            'fullwidth'     => ReduxFramework::$_url . 'assets/img/1c.png',
                            'sidebar_right' => ReduxFramework::$_url . 'assets/img/2cr.png',
                            'sidebar_left'  => ReduxFramework::$_url . 'assets/img/2cl.png'
                        )
                    ),

                    array(
                        'title'     => __( 'Single Post Layout', 'the-simple' ),
                        'desc'      => __( 'Select the default single post sidebar position', 'the-simple' ),
                        'id'        => 'singlebloglayout',
                        'default'   => 'sidebar_right',
                        'type'      => 'image_select',
                        'customizer'=> array(),
                        'options'   => array( 
                            'fullwidth'     => ReduxFramework::$_url . 'assets/img/1c.png',
                            'sidebar_right' => ReduxFramework::$_url . 'assets/img/2cr.png',
                            'sidebar_left'  => ReduxFramework::$_url . 'assets/img/2cl.png'
                        )
                    ),
                    array(
                        'id' => 'post_like',
                        'type' => 'switch',
                        'title' => __('Active Post Like', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        "default" => 0,
                    ),

                    array(
                        'id' => 'social_shares',
                        'type' => 'switch',
                        'title' => __('Social Shares on Posts', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        "default" => 1,
                    ),

                    array(
                        'id' => 'blog_pagination',
                        'type' => 'select',
                        'title' => __('Select the pagination method', 'the-simple'),
                        'options' => array('no_pagination' => 'Without pagination', 'with_pagination' => 'With Pagination', 'infinite_scroll' => 'Infinite Scroll'),
                        'default' => 'with_pagination'
                    ),

                    array(
                        'id' => 'blog_info_author',
                        'type' => 'switch',
                        'title' => __('Show author at blog post', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        "default" => 1,
                    ),
                    array(
                        'id' => 'blog_info_date',
                        'type' => 'switch',
                        'title' => __('Show date at blog post', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        "default" => 1,
                    ),
                    array(
                        'id' => 'blog_info_comments',
                        'type' => 'switch',
                        'title' => __('Show comments count at blog post', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        "default" => 1,
                    ),
                    array(
                        'id' => 'blog_info_tags',
                        'type' => 'switch',
                        'title' => __('Show tags at blog post', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        "default" => 1,
                    ),

                )
            ));

            
            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-view-mode',
                'title' => __('Portfolio Config', 'the-simple'),
                'fields' => array(
                    array(
                        'id' => 'portfolio_slug',
                        'type' => 'text',
                        'title' => __('Portfolio Slug', 'the-simple'),
                        'default' => 'simple_portfolio'
                    ),
                    array(
                        'id'=>'single_portfolio_custom_params',
                        'type' => 'multi_text',
                        'title' => __('Custom fields Parameters', 'the-simple'),
                        'subtitle' => __('Create unlimited custom fields. Add values in respetive single portfolio', 'the-simple') 
                    ),
                    array(
                        'id' => 'portfolio_post_like',
                        'type' => 'switch',
                        'title' => __('Active Portfolio Item Like', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        "default" => 0,
                    ),
                )
            ));


            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-fullscreen',
                'title' => __('Layout', 'the-simple'),
                'fields' => array(
                    array(
                        'id' => 'site_layout',
                        'type' => 'select',
                        'title' => __('Overall site layout', 'the-simple'),
                        'subtitle' => __('Select overall ste pages layout', 'the-simple'),
                        'options' => array('fullwidth' => 'Fullwidth', 'boxed' => 'Boxed'), //Must provide key => value pairs for select options
                        'default' => 'fullwidth'
                    ),

                    array(
                        'title'     => __( 'Pages Default Layout', 'the-simple' ),
                        'desc'      => __( 'Select default layout for pages. You can overwrite it in Page Options', 'the-simple' ),
                        'id'        => 'page_overall_layout',
                        'default'   => 'fullwidth',
                        'type'      => 'image_select',
                        'customizer'=> array(),
                        'options'   => array( 
                            'fullwidth'     => ReduxFramework::$_url . 'assets/img/1c.png',
                            'sidebar_right' => ReduxFramework::$_url . 'assets/img/2cr.png',
                            'sidebar_left'  => ReduxFramework::$_url . 'assets/img/2cl.png'
                        )
                    ),
                    

                    array(
                        'id' => 'page_container_width',
                        'type' => 'dimensions', 
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => true,
                        'height' => false,
                        'title' => __('Page Container Width', 'the-simple'),
                        'subtitle' => __('units: px', 'the-simple'),
                        'desc' => __('', 'the-simple'),
                        'default' => array('width' => '1200px')
                    ),

                    array(
                        'id' => 'page_container_width_percent',
                        'type' => 'dimensions',
                        'units' => '%', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => true,
                        'height' => false,
                        'title' => __('Page Container Width with percentage', 'the-simple'),
                        'subtitle' => __('units: px', 'the-simple'),
                        'desc' => __('If you set the width in percentage, the page container width in pixel should be used as max-width', 'the-simple'),
                        'default' => array('width' => '87%')
                    ),

                    array(
                        'id' => 'boxed_container_width',
                        'type' => 'dimensions', 
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => true,
                        'height' => false,
                        'title' => __('Boxed Container Width', 'the-simple'),
                        'subtitle' => __('units: px', 'the-simple'),
                        'desc' => __('', 'the-simple'),
                        'required' => array('site_layout', 'equals', 'boxed'),
                        'default' => array('width' => '1100px'),

                    ),

                    array(
                        'id' => 'boxed_container_width_percent',
                        'type' => 'dimensions',
                        'units' => '%', // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                        'width' => true,
                        'height' => false,
                        'title' => __('Boxed Container Width with percentage', 'the-simple'),
                        'subtitle' => __('units: px', 'the-simple'),   
                        'required' => array('site_layout', 'equals', 'boxed'),
                        'desc' => __('If you set the width in percentage, the boxed container width in pixel should be used as max-width', 'the-simple'),
                        'default' => array('width' => '87%')
                    ),

                    array(
                        'title'=> __( 'Boxed Container Margin', 'the-simple' ),
                        'desc' => __( 'Boxed Container Top/Bottom Margin', 'the-simple' ),
                        'id'   => 'boxed_container_margin',
                        'type' => 'spacing',
                        'mode' => 'margin', // absolute, padding, margin, defaults to padding
                        'right' => false, // Disable the right
                        'left' => false, // Disable the left
                        //'all' => true, // Have one field that applies to all
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'default' => array('margin-bottom' => '30px', 'margin-top' => '30px'),
                        'required' => array('site_layout', 'equals', 'boxed')
                    ),

                    array(
                        'id' => 'boxed_shadow',
                        'type' => 'switch',
                        'title' => __('Boxed Container Shadow', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        'required' => array('site_layout', 'equals', 'boxed'),
                        "default" => 1,
                    ),

                    array(
                        'id'       => 'boxed_border',
                        'type'     => 'border',
                        'title'    => __('Boxed Container Border', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        'output'   => array('.boxed_layout'),
                        'all'      => true,
                        'color'    => true,
                        'style'    => true, 
                        'required' => array('site_layout', 'equals', 'boxed'),
                        'desc'     => __('Add Border for boxed container', 'the-simple'),
                        'default'  => array(
                            'color'  => '#e7e7e7', 
                            'border-style'  => 'solid',
                            'border'    => '0px'
                        )
                    ),

                    array(
                        'id' => 'extra_navigation',
                        'type' => 'switch',
                        'title' => __('Extra Side Navigation', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        "default" => 1,
                    ),

                    array(
                        'title'     => __( 'Extra Navigation Position', 'the-simple' ),
                        'desc'      => __( 'Select the default single post sidebar position', 'the-simple' ),
                        'id'        => 'extra_navigation_position',
                        'default'   => 'right',
                        'type'      => 'image_select',
                        'customizer'=> array(), 
                        'options'   => array( 
                            'left'     => ReduxFramework::$_url . 'assets/img/2cl.png',
                            'right' => ReduxFramework::$_url . 'assets/img/2cr.png'
                        ),
                        'required' => array('extra_navigation', 'equals', 1),
                    ),

                    array(
                        'title'=> __( 'Page Builder Row Margin Bottom', 'the-simple' ),
                        'desc' => __( 'Margin bottom for the ROW in Page builder', 'the-simple' ),
                        'id'   => 'row_margin_bottom',
                        'type' => 'spacing',
                        'output' => array('.wpb_row.section-style, .wpb_row.standard_section'),
                        'mode' => 'margin', // absolute, padding, margin, defaults to padding
                        'top' => false, // Disable the top
                        'right' => false, // Disable the right
                        'bottom' => true, // Disable the bottom
                        'left' => false, // Disable the left
                        //'all' => true, // Have one field that applies to all
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'default' => array('margin-bottom' => '70px')
                    ),

                    array(
                        'title'=> __( 'Inner Page Content Padding', 'the-simple' ),
                        'desc' => __( 'Change padding of the inner page content', 'the-simple' ),
                        'id'   => 'content_padding',
                        'type' => 'spacing',
                        'output' => array('#content'), 
                        'mode' => 'padding', // absolute, padding, margin, defaults to padding
                        'top' => true, // Disable the top
                        'right' => false, // Disable the right
                        'bottom' => true, // Disable the bottom
                        'left' => false, // Disable the left
                        //'all' => true, // Have one field that applies to all
                        'units' => 'px', // You can specify a unit value. Possible: px, em, %
                        //'units_extended' => 'true', // Allow users to select any type of unit
                        //'display_units' => 'false', // Set to false to hide the units if the units are specified
                        'default' => array('padding-bottom' => '70px','padding-top' => '70px')
                    ),
                    array(
                        'id' => 'outter_padding',
                        'type' => 'switch',
                        'title' => __('Add a outter padding', 'the-simple'),
                        'subtitle' => __('', 'the-simple'),
                        "default" => 0
                    )
                    
                )
           ));


            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-heart',
                'title' => __('Clients', 'the-simple'),
                'fields' => array(
                    array(
                        'id'       => 'clients_dark',
                        'type'     => 'slides',
                        'title'    => __('Add/Edit Clients Dark Version', 'the-simple'),
                        'subtitle' => __('Upload clients logo here', 'the-simple')
                    ),

                    array(
                        'id'       => 'clients_light',
                        'type'     => 'slides',
                        'title'    => __('Add/Edit Clients Light Version', 'the-simple'),
                        'subtitle' => __('Upload clients logo here', 'the-simple')
                    ),

                )
            ));


            Redux::setSection( $opt_name, array(
                'icon' => 'el-icon-twitter',
                'title' => __('Social Media', 'the-simple'),
                'fields' => array(
                    array(
                        'id'       => 'facebook',
                        'type'     => 'text',
                        'title'    => __('Facebook Link', 'the-simple')
                    ),
                    array(
                        'id'       => 'twitter',
                        'type'     => 'text',
                        'title'    => __('Twitter Link', 'the-simple')
                    ),
                    array(
                        'id'       => 'flickr',
                        'type'     => 'text',
                        'title'    => __('Flickr Link', 'the-simple')
                    ),
                    array(
                        'id'       => 'foursquare',
                        'type'     => 'text',
                        'title'    => __('Foursquare Link', 'the-simple')
                    ),
                    array(
                        'id'       => 'google',
                        'type'     => 'text',
                        'title'    => __('Google Plus Link', 'the-simple')
                    ),
                    array(
                        'id'       => 'dribbble',
                        'type'     => 'text',
                        'title'    => __('Dribbble Link', 'the-simple')
                    ),
                    array(
                        'id'       => 'linkedin',
                        'type'     => 'text',
                        'title'    => __('Linkedin Link', 'the-simple')
                    ),

                    array(
                        'id'       => 'youtube',
                        'type'     => 'text',
                        'title'    => __('Youtube Link', 'the-simple')
                    ),

                    array(
                        'id'       => 'instagram',
                        'type'     => 'text',
                        'title'    => __('Instagram Link', 'the-simple')
                    ),

                    array(
                        'id'       => 'pinterest',
                        'type'     => 'text',
                        'title'    => __('Pinterest Link', 'the-simple')
                    ),

                    array(
                        'id'       => 'email',
                        'type'     => 'text',
                        'title'    => __('Email Link', 'the-simple')
                    ),
                )
            ));

            Redux::setSection( $opt_name, array( 
                'icon' => 'el-icon-indent-right',
                'title' => __('Custom Sidebars', 'the-simple'),
                'fields' => array(
                    array(
                        'id'       => 'pages_sidebar',
                        'type'     => 'select',
                        'multi'    => true,
                        'data'     => 'pages',
                        'title'    => __('Pages custom sidebars', 'the-simple'),
                        'subtitle' => __('Select all pages that you want a custom sidebar (widgetized area)', 'the-simple')
                    ),

                    array(
                        'id'       => 'categories_sidebar',
                        'type'     => 'select',
                        'multi'    => true,
                        'data'     => 'categories',
                        'title'    => __('Categories custom sidebars', 'the-simple'),
                        'subtitle' => __('Select all categories that you want a custom sidebar (widgetized area)', 'the-simple')
                    ),

                )
            ));

            if(!defined('SIMPLE_BASE_URL' ) ) define( 'SIMPLE_BASE_URL', get_template_directory_uri().'/'); 

            Redux::setSection( $opt_name, array( 
                'icon' => 'el-icon-magic',
                'title' => __('Import / Export (Dummy Data)', 'the-simple'),
                'fields' => array(
                    array(
                        'id'       => 'codeless_import_export',
                        'type'     => 'codeless_import', 
                        'data'     => array(
                            array('name' => 'Business Corporate', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/default.jpg', 'folder' => 'default', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Business Simple', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/business_simple.jpg', 'folder' => 'business_simple', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Business Agency', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/business_agency.jpg', 'folder' => 'business_agency', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Business App', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/business_app.jpg', 'folder' => 'business_app', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Business Parallax', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/business_parallax.jpg', 'folder' => 'business_parallax', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Business SEO', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/business_seo.jpg', 'folder' => 'business_seo', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Business Minimal', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/business_minimal.jpg', 'folder' => 'business_minimal', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Business Startup', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/business_startup.jpg', 'folder' => 'business_startup', 'parts' => '1', 'zip' => 'none'),

                            array('name' => 'Business Simple Agency', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/business_simpleagency.jpg', 'folder' => 'business_simpleagency', 'parts' => '1', 'zip' => 'none'),
                            
                            array('name' => 'Business Restaurant', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/business_restaurant.jpg', 'folder' => 'business_restaurant', 'parts' => '1', 'zip' => 'none'),

                            array('name' => 'Portfolio Simple', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/portfolio_simple.jpg', 'folder' => 'portfolio_simple', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Portfolio Left Navigation', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/portfolio_leftnav.jpg', 'folder' => 'portfolio_leftnav' , 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Portfolio Video', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/portfolio_video.jpg', 'folder' => 'portfolio_video', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Portfolio Personal', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/portfolio_personal.jpg', 'folder' => 'portfolio_personal', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Portfolio Studio', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/portfolio_studio.jpg', 'folder' => 'portfolio_studio', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Portfolio OnePage', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/portfolio_onepage.jpg', 'folder' => 'portfolio_onepage', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Portfolio Minimal', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/portfolio_minimal.jpg', 'folder' => 'portfolio_minimal', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Portfolio Fullscreen', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/portfolio_fullscreen.jpg', 'folder' => 'portfolio_fullscreen', 'parts' => '1', 'zip' => 'none'),

                            array('name' => 'Blog Simple', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/blog_simple.jpg', 'folder' => 'blog_simple', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Blog Magazine', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/blog_magazine.jpg', 'folder' => 'blog_magazine', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Blog Personal', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/blog_personal.jpg', 'folder' => 'blog_personal', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Masonry', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/blog_masonry.jpg', 'folder' => 'blog_masonry', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Blog FullScreen', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/blog_fullscreen.jpg', 'folder' => 'blog_fullscreen', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Blog Timeline', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/blog_timeline.jpg', 'folder' => 'blog_timeline', 'parts' => '1', 'zip' => 'none'),

                            array('name' => 'Shop Classic', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/shop_classic.jpg', 'folder' => 'shop_classic', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Shop Fullwidth', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/shop_fullwidth.jpg', 'folder' => 'shop_fullwidth', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Shop Boxed', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/shop_boxed.jpg', 'folder' => 'shop_boxed', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Shop Simple', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/shop_simple.jpg', 'folder' => 'shop_simple', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Shop Fullscreen', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/shop_fullscreen.jpg', 'folder' => 'shop_fullscreen', 'parts' => '1', 'zip' => 'none'),
                            array('name' => 'Shop Minimal', 'image' => SIMPLE_BASE_URL . 'includes/dummy_data/img/shop_minimal.jpg', 'folder' => 'shop_minimal', 'parts' => '1', 'zip' => 'none')
                            
                            
                        ),
                        'default' => 'default',
                        'title'    => __('Simple Import', 'the-simple'),
                        'subtitle' => __('', 'the-simple')
                    )
                )
            ));


           /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */
    /*
    *
    * --> Action hook examples
    *
    */
    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );
    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);
    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );
    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );
    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');
    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
           
            echo "</pre>";
            print_r($options); //Option values
            print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }
    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;
            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }
            $return['value'] = $value;
            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }
            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }
            return $return;
        }
    }
    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }
    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'the-simple' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'the-simple' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );
            return $sections;
        }
    }
    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;
            return $args;
        }
    }
    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';
            return $defaults;
        }
    }
    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );
                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }

function simple_styleswitch_opt($options){
            
            if(!empty($_COOKIE) && is_array($_COOKIE))
                
                foreach($_COOKIE as $opt_key => $value){
                    $opt_key = explode('-__-', $opt_key);
                    if($opt_key[1] == 'default'){
                        $opt_key = $opt_key[2];
                        if(isset($options[$opt_key])){
                            $value = json_decode( base64_decode($value), true );
                            if(is_array($value)){
                                foreach($value as $k => $v){
                                    $options[$opt_key][$k] = $v; 
                                } 
                            }else{
                                $options[$opt_key] = $value;
                            } 

                        }
                    }
                    
                }

            return $options;
        }

        function simple_styleswitch_redata(){
            global $redata;
            if(!empty($_COOKIE) && is_array($_COOKIE))
                
                foreach($_COOKIE as $opt_key => $value){
                    $opt_key = explode('-__-', $opt_key);
                    if($opt_key[1] == 'default'){
                        $opt_key = $opt_key[2];
                        if(isset($redata[$opt_key])){
                            $value = json_decode( base64_decode($value), true );
                            if(is_array($value)){
                                foreach($value as $k => $v){
                                    $redata[$opt_key][$k] = $v; 
                                } 
                            }else{
                                $redata[$opt_key] = $value;
                            }

                        }
                    }
                }
        }