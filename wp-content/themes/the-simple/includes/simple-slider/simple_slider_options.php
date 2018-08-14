<?php

$redux_opt_name = "simple_redata";


/*--------------------------------------APOLLON SLIDER-----------------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "cl_add_simple_slider_metaboxes" ) ):
    function cl_add_simple_slider_metaboxes($metaboxes) {

        $slide_background = array(
            'title'         => __('Background', 'the-simple'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'slide_background_type',
                    'title' => __( 'Background Type', 'the-simple' ),
                    'desc' => 'Select the type of the background',
                    'type' => 'select',
                    'options' => array('image' => 'Image / Color', 'video' => 'Video'),
                    'default' => 'image'
                ),

                array(
                    'id' => 'slide_background_image',
                    'type' => 'background',
                    'title' => __('Background Image / Color', 'the-simple'),
                    'subtitle' => __('Page Header background with image', 'the-simple'),
                    'default' => '',
                    'required' => array('slide_background_type','=','image')
                ),

                array(
                    'id' => 'slide_mp4_video',
                    'type' => 'text',
                    'title' => __('MP4 video Url', 'the-simple'),
                    'default' => '',
                    'required' => array('slide_background_type','=','video'),
                ), 

                array(
                    'id' => 'slide_webm_video',
                    'type' => 'text',
                    'title' => __('Webm video Url', 'the-simple'),
                    'default' => '',
                    'required' => array('slide_background_type','=','video'),
                ), 

                array(
                    'id' => 'slide_ogg_video',
                    'type' => 'text',
                    'title' => __('OGG video Url', 'the-simple'),
                    'default' => '',
                    'required' => array('slide_background_type','=','video'),
                ), 

                array(
                    'id' => 'slide_mobile_video',
                    'type' => 'media',
                    'title' => __('Image to replace video on mobile', 'the-simple'),
                    'default' => '',
                    'required' => array('slide_background_type','=','video'),
                ), 

                array(
                    'id'=>'slide_bg_overlay',
                    'type' => 'color_rgba', 
                    'title' => __('Background Color Overlay', 'the-simple'),
                    'subtitle'=> __('Use a bg overlay', 'the-simple'),
                    'default'  => array(
                        'color' => '', 
                        'alpha' => '1.0'
                    )
                )

            ),
        );


        $slide_content = array(
            'title'         => __('Content', 'the-simple'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                
                array(
                    'id' => 'slide_title',
                    'type' => 'textarea',
                    'title' => __('Title', 'the-simple')
                ),

                array(
                    'id'          => 'slide_title_style',
                    'type'        => 'typography', 
                    'title'       => __('Title Style', 'the-simple'),
                    'google'      => true, 
                    'font-backup' => false,
                    'font-style'  => false,
                    'text-transform' => true,
                    'letter-spacing' => true,
                    'text-align' => true, 
                    'units'       =>'px',
                    'default'     => array(
                        'color'       => '#222', 
                        'font-style'  => '700', 
                        'text-align'  => 'center', 
                        'font-family' => 'Open Sans', 
                        'google'      => true,
                        'font-size'   => '33px', 
                        'line-height' => '40',
                        'letter-spacing' => '1.8px'
                    )
                ),

                array(
                        'id' => 'slide_title_bg',
                        'type' => 'color_rgba',
                        'title' => __('Title Background', 'the-simple'),
                        'mode' => 'background-color', 
                        'default'  => array(
                            'color' => '#000000', 
                            'alpha' => '0'
                        ),
                        'validate' => 'colorrgba',
                ),

                array(
                    'id' => 'slide_title_padding',
                    'type' => 'spacing',
                    'mode' => 'padding', // absolute, padding, margin, defaults to padding
                    'units' => 'px', // You can specify a unit value. Possible: px, em, %
                    'title' => __('Title Padding', 'the-simple'),
                    'subtitle' => __(' ', 'the-simple'),
                    'desc' => __('Unit: px', 'the-simple'),
                    'default' => array('padding-left' => '0px', 'padding-right' => "0px", 'padding-top' => "0px", 'padding-bottom' => "0px")
                ),

                array(
                    'id' => 'slide_title_animation',
                    'title' => __( 'Title animation', 'the-simple' ),
                    'desc' => 'Select type of animation',
                    'type' => 'select',
                    'options' => simple_animations(),
                    'default' => 'fadeInDown'
                ),

                array(
                    'id' => 'slide_description',
                    'type' => 'textarea',
                    'title' => __('Description', 'the-simple')
                ),

                array(
                    'id'          => 'slide_description_style',
                    'type'        => 'typography', 
                    'title'       => __('Description Style', 'the-simple'),
                    'google'      => true, 
                    'font-backup' => false,
                    'font-style'  => false,
                    'text-transform' => true,
                    'text-align' => true,
                    'units'       =>'px',
                    'default'     => array(
                        'color'       => '#666', 
                        'font-style'  => '400',
                        'text-align'  => 'center', 
                        'font-family' => 'Open Sans', 
                        'google'      => true,
                        'font-size'   => '20px', 
                        'line-height' => '32'
                    )
                ),

                array(
                    'id' => 'slide_description_animation',
                    'title' => __( 'Description animation', 'the-simple' ),
                    'desc' => 'Select type of animation',
                    'type' => 'select',
                    'options' => array('fadeInDown' => 'fadeInDown', 'fadeInUp' => 'fadeInUp'),
                    'default' => 'fadeInDown'
                ),

                array(
                    'id' => 'slide_image_switch',
                    'type' => 'switch',
                    'title' => __('Image On Top', 'the-simple'),
                    'subtitle' => __('Add an image on top of texts', 'the-simple'),
                    "default" => 0
                ),

                array(
                    'id'       => 'slide_image_top',
                    'type'     => 'media', 
                    'url'      => true,
                    'title'    => __('Image Media w/ URL', 'the-simple'),
                    'default'  => array(
                        'url'=>''
                    ),
                    'required' => array('slide_image_switch', 'equals', 1)
                ),

                array(
                    'id' => 'slide_image_alignment',
                    'title' => __( 'Image Alignment', 'the-simple' ),
                    'desc' => 'Select the position of the image',
                    'type' => 'select',
                    'options' => array('center' => 'Center', 'left' => 'Left', 'right' => 'Right'),
                    'default' => 'center',
                    'required' => array('slide_image_switch', 'equals', 1),
                 ),

                array(
                    'id'       => 'slide_image_dimension',
                    'type'     => 'dimensions',
                    'units'    => array('px'),
                    'title'    => __('Image Dimensions (Width/Height)', 'the-simple'),
                    'default'  => array(
                        'Width'   => '200', 
                        'Height'  => '100'
                    ),
                    'required' => array('slide_image_switch', 'equals', 1),
                ),

                array(
                    'id' => 'slide_button1',
                    'type' => 'text',
                    'title' => __('Button Label', 'the-simple'),
                    'subtitle' => __('First Button Label & Link', 'the-simple')
                ),

                array(
                    'id' => 'slide_button1_link',
                    'type' => 'text',
                    'title' => __('Button Link', 'the-simple')
                ),

                array(
                    'id' => 'slide_button1_style',
                    'title' => __( 'Button Style', 'the-simple' ),
                    'desc' => 'Select type of button',
                    'type' => 'select',
                    'options' => array('bordered' => 'Only border', 'colored' => 'Button with bg color'),
                    'default' => 'bordered'
                 ),

                array(
                    'id' => 'slide_button2',
                    'type' => 'text',
                    'title' => __('Button Label', 'the-simple'),
                    'subtitle' => __('Second Button Label & Link (Leave Blank if you want to use only one button)', 'the-simple')
                ),

                array(
                    'id' => 'slide_button2_link',
                    'type' => 'text',
                    'title' => __('Button Link', 'the-simple')
                ),

                array(
                    'id' => 'slide_button2_style',
                    'title' => __( 'Button Style', 'the-simple' ),
                    'desc' => 'Select type of button',
                    'type' => 'select',
                    'options' => array('bordered' => 'Only border', 'colored' => 'Button with bg color'),
                    'default' => 'bordered'
                 ),

                array(
                    'id' => 'slide_buttons_colors',
                    'title' => __( 'Overall Buttons Colors', 'the-simple' ),
                    'desc' => 'Select type of colors',
                    'type' => 'select',
                    'options' => array('light' => 'Light, for dark backgrounds', 'dark' => 'Dark, for light backgrounds'),
                    'default' => 'light'
                 ),

            ),
        );

        $slide_layout = array(
            'title'         => __('Layout', 'the-simple'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                 array(
                    'id' => 'slide_content_position',
                    'title' => __( 'Content Position', 'the-simple' ),
                    'desc' => 'Select the position for the content part',
                    'type' => 'select',
                    'options' => array('vertical_centered' => 'Vertical Centered', 'horizontal_centered' => 'Horizontal Centered', 'in_middle' => 'In Middle of slide (Horizontal and Vertical)', 'none' => 'Use only absolute position'),
                    'default' => 'in_middle'
                 ),

                 array(
                    'id'             => 'slide_content_position_absolute',
                    'type'           => 'spacing',
                    'mode'           => 'absolute',
                    'units'          => array('px'),
                    'units_extended' => 'false',
                    'title'          => __('Content custom absolute position', 'the-simple'),
                    'subtitle'       => __('Add absolute positioning', 'the-simple'),
                    'desc'           => __('In case you select vertical centered, top and bottom positions are fixed. The same for horizontal centered, left and right are fixed. Them are not considerated. If you want to use only absolute positions (Left, Right, Top, Bottom) select (Use only absolute position) ', 'the-simple'),
                    'default'            => array(
                        'top'    => '',
                        'bottom' => '',
                        'left'   => '',
                        'right'  => ''  
                    )
                ),
                
                array(
                    'id' => 'slide_content_width',
                    'type' => 'text',
                    'title' => __('Content Width', 'the-simple'),
                    'subtitle' => __('Examples: auto, 100px, 50%', 'the-simple'),
                    'default' => '700px'
                ),

                array(
                    'id' => 'remove_container',
                    'type' => 'switch',
                    'title' => __('Remove Site Container from slider', 'the-simple'),
                    'subtitle' => __('By switching this you can remove the slider container and the content should be shown from the left to the right of the screen.', 'the-simple'),
                    "default" => 0,
                ),

                array(
                    'id' => 'slider_menu_nav_colors',
                    'type' => 'select', 
                    'title' => __('Menu & Slider Navigation Color', 'the-simple'),
                    'subtitle' => __('Select Light for light colors in header, white logo and light slider nav', 'the-simple'),
                    'options' => array('dark' => 'Light logo, menu, slider navigations', 'light' => 'Dark logo, menu, slider navigations'), //Must provide key => value pairs for select options
                    'default' =>  'light'
                ),
            )
        );

        

        $simple_slider = array();
        $simple_slider[] = $slide_background;
        $simple_slider[] = $slide_content;
        $simple_slider[] = $slide_layout;
        $metaboxes[] = array(
            'id'            => 'simple-slider',
            'title'         => __( 'Simple Slide Options', 'the-simple' ),
            'post_types'    => array( 'slide'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $simple_slider,
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'cl_add_simple_slider_metaboxes');
endif;

/*--------------------------------------END APOLLON SLIDER-------------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/



?>