<?php

// You may replace $redux_opt_name with a string if you wish. If you do so, change loader.php
// as well as all the instances below.
$redux_opt_name = "simple_redata";


/*--------------------------------------SINGLE PORTFOLIO METABOXES------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "cl_add_single_portfolio_metaboxes" ) ):
    function cl_add_single_portfolio_metaboxes($metaboxes) {
        global $simple_redata;
        $custom_fieldss = $simple_redata['single_portfolio_custom_params'];

        $portfolio_options = array();

        $page_style = array(
            'title'         => __('Page Style', 'the-simple'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'single_custom_link_switch',
                    'type' => 'switch',
                    'title' => __('Overwrite the link with your custom link', 'the-simple'),
                    'default' => 0// 1 = on | 0 = off
                ),
                array(
                    'id' => 'single_custom_link',
                    'title' => __( 'Add Custom Link', 'the-simple' ),
                    'type' => 'text',
                    'required' => array('single_custom_link_switch', '=', 1 )
                ), 
                array(
                    'id' => 'single_portfolio_style',
                    'title' => __( 'Select the style of the single portfolio', 'the-simple' ),
                    'desc' => 'Please select the style for the portfolio',
                    'type' => 'select',
                    'multi' => false,
                    'default' => 'container',
                    'options' => array('gallery' => 'Gallery Grid', 'floating' => 'Floating Sidebar', 'fullwidth' => 'Fullwidth Slider / Image / Video', 'container' => 'In Container Slider / Image / Video')
                ),
                array(
                    'id' => 'single_portfolio_content_position_floating',
                    'title' => __( 'Content Position', 'the-simple' ),
                    'desc' => 'Select the position for the content',
                    'type' => 'select',
                    'options' => array('left' => 'Left', 'right' => 'Right'),
                    'default' => 'right',
                    'required' => array('single_portfolio_style','=', 'floating')
                ),
                array(
                    'id' => 'single_portfolio_content_position_container',
                    'title' => __( 'Content Position', 'the-simple' ),
                    'desc' => 'Select the position for the content',
                    'type' => 'select',
                    'options' => array('left' => 'Left', 'right' => 'Right', 'bottom' => 'Bottom'),
                    'default' => 'right',
                    'required' => array('single_portfolio_style','=', 'container')
                ),
                array(
                    'id' => 'single_portfolio_media',
                    'title' => __( 'Media Type', 'the-simple' ),
                    'desc' => 'use feature image, video or slideshow. If you choose slideshow, add images in the gallery below',
                    'type' => 'select',
                    'options' => array('featured' => 'Featured Image', 'video' => 'Video', 'slideshow' => 'Slideshow'),
                    'default' => 'featured',
                    'required' => array('single_portfolio_style', '=', array('fullwidth', 'container') )
                ),
                array(
                    'id' => 'single_portfolio_video',
                    'title' => __( 'Video', 'the-simple' ),
                    'desc' => 'Youtube or vimeo video link or iframe',
                    'type' => 'text',
                    'required' => array('single_portfolio_media', '=', 'video' )
                ), 

                array(
                    'id' => 'single_portfolio_gallery',
                    'type' => 'slides',
                    'title' => __('Add/Edit Slides', 'the-simple'),
                    'subtitle' => __('Add new or edit existing slider images', 'the-simple'),
                    
                ),

                array(
                    'id' => 'single_portfolio_active_comments',
                    'type' => 'switch',
                    'title' => __('Switch On if you want comments functionality', 'the-simple'),
                    'default' => 0// 1 = on | 0 = off
                ),


                 
            ),
        );
        $description_fields = simple_getPortfolioFields();

        $custom_fields = array(
            'title'         => __('Custom Fields', 'the-simple'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id'=>'single_portfolio_custom_fields',
                    'type' => 'multi_text',
                    'title' => __('Custom fields Values', 'the-simple'),
                    'subtitle' => __('Create unlimited custom fields in Theme Options. Leave empty if you dont want to display this custom field', 'the-simple').'<br /><br />Fields:<br />'.trim($description_fields)
                ),
                 
            ),
        );


        $portfolio_options[] = $page_style;
        $portfolio_options[] = $custom_fields;


        $metaboxes[] = array(
            'id'            => 'portfolio-options',
            'title'         => __( 'Single Portfolio Options', 'the-simple' ),
            'post_types'    => array( 'portfolio'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $portfolio_options,
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'cl_add_single_portfolio_metaboxes');
endif;

/*--------------------------------------END SINGLE PORTFOLIO METABOXES--------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/




/*--------------------------------------PORTFOLIO METABOXES-------------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "cl_add_portfolio_metaboxes" ) ):
    function cl_add_portfolio_metaboxes($metaboxes) {
        
        $portfolio_options = array();

        $portfolio_options[] = array(
            //'title'         => __('General Settings', 'the-simple'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'portfolio_categories',
                    'title' => __( 'Portfolio Categories', 'the-simple' ),
                    'desc' => 'Please select the categories of portfolio items to connect with this page',
                    'type' => 'select',
                    'multi' => true,
                    'data' => 'categories',
                    'args' => array('orderby'=>'name', 'hide_empty'=> 0, 'taxonomy' => 'portfolio_entries')
                ),
                array(
                    'id' => 'portfolio_mode',
                    'title' => __( 'Portfolio Mode', 'the-simple' ),
                    'desc' => 'Select one mode to display items',
                    'type' => 'select',
                    'options' => array('grid' => 'Grid', 'masonry' => 'masonry'),
                    'default' => 'grid'
                ),
                array(
                    'id' => 'portfolio_columns',
                    'title' => __( 'Portfolio Columns', 'the-simple' ),
                    'desc' => 'Number of columns for the layout',
                    'type' => 'image_select',
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
                    'default' => '3'
                ),
                array(
                    'id' => 'portfolio_style',
                    'title' => __( 'Portfolio Style', 'the-simple' ),
                    'desc' => 'Select one style to display items',
                    'type' => 'select',
                    'options' => array('overlayed' => 'Overlayed with base color and zoom effect', 'grayscale' => 'Grayscale (Colored on hover)', 'basic' => 'Basic with Title and Description', 'chrome' => 'With Chrome Browser PNG'),
                    'default' => 'overlayed'
                ),
                array(
                    'id' => 'portfolio_layout',
                    'title' => __( 'Portfolio Layout', 'the-simple' ),
                    'desc' => 'The grid layout',
                    'type' => 'select',
                    'options' => array('in_container' => 'Centered grid in container', 'fullwidth' => 'Fullwidth'),
                    'default' => 'in_container'
                ),
                array(
                    'id' => 'portfolio_space',
                    'title' => __( 'Portfolio Space', 'the-simple' ),
                    'desc' => 'Space beetwen portfolio items',
                    'type' => 'select',
                    'options' => array( 'normal' => 'Normal grid space', 'no_space' => 'Without space'),
                    'default' => 'normal'
                ),
                array(
                    'id' => 'portfolio_content',
                    'title' => __( 'Portfolio Content Position', 'the-simple' ),
                    'desc' => 'Add this page content (Visual Composer Content) on top or bottom of grid ?',
                    'type' => 'select',
                    'options' => array('top' => 'Top', 'bottom' => 'Bottom'),
                    'default' => 'top'
                ),
                array(
                    'id' => 'portfolio_pagination',
                    'type' => 'select',
                    'title' => __('Select the pagination method', 'the-simple'),
                    'options' => array('no_pagination' => 'Without pagination', 'with_pagination' => 'With Pagination'),
                    'default' => 'with_pagination'
                ),
                array(
                    'id' => 'portfolio_filters',
                    'type' => 'select',
                    'title' => __('Select the portfolio filter style', 'the-simple'),
                    'options' => array('normal' => 'Normal', 'in_grid' => 'In Grid'),
                    'default' => 'normal'
                )
            ),
        );


        $metaboxes[] = array(
            'id'            => 'portfolio-options',
            'title'         => __( 'Portfolio Options', 'the-simple' ),
            'post_types'    => array( 'page'),
            'page_template' => array('portfolio.php'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $portfolio_options,
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'cl_add_portfolio_metaboxes');
endif;

/*--------------------------------------END PORTFOLIO METABOXES---------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/


/*------------------------------------------LAYOUT OPTIONS--------------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "cl_add_layout_metaboxes" ) ):
    function cl_add_layout_metaboxes($metaboxes) {
        global $simple_redata;
        $layoutOptions = array();
        $layoutOptions[] = array(
            //'title' => __('Home Settings', 'the-simple'),
            'icon_class' => 'icon-large',
            'icon' => 'el-icon-home',
            'fields' => array(
                array(
                    'id' => 'overwrite_layout',
                    'type' => 'switch',
                    'title' => __('Overwrite the default post layout', 'the-simple'),
                    'subtitle' => __('Do you want to overwrite the default layout for this post?', 'the-simple'),
                    'default' => 0// 1 = on | 0 = off
                ),
                array(
                    'title'     => __( 'Layout', 'the-simple' ),
                    'desc'      => __( 'Select main content and sidebar arrangement.', 'the-simple' ),
                    'id'        => 'layout',
                    'default'   => 'fullwidth',
                    'type'      => 'image_select',
                    'customizer'=> array(),
                    'options'   => array( 
                        'fullwidth'     => ReduxFramework::$_url . 'assets/img/1c.png',
                        'sidebar_right' => ReduxFramework::$_url . 'assets/img/2cr.png',
                        'sidebar_left'  => ReduxFramework::$_url . 'assets/img/2cl.png',
                        'dual'          => ReduxFramework::$_url . 'assets/img/3cm.png'
                    ),
                    'required' => array('overwrite_layout', 'equals', 1)
                ),

                array(
                    'id' => 'left_sidebar_dual',
                    'type' => 'select',
                    'title' => __('Left Sidebar', 'the-simple'),
                    'subtitle' => __('', 'the-simple'),
                    'data' => 'sidebar',
                    'required' => array('layout','=','dual')
                ),

                array(
                    'id' => 'right_sidebar_dual',
                    'type' => 'select',
                    'title' => __('Right Sidebar', 'the-simple'),
                    'subtitle' => __('', 'the-simple'),
                    'data' => 'sidebar',
                    'required' => array('layout','=','dual')
                ),


            )
        );
      
        $metaboxes[] = array(
            'id' => 'demo-layout2',
            //'title' => __('Cool Options', 'the-simple'),
            'post_types' => array('page', 'post', 'product'),
            //'page_template' => array('page-test.php'),
            //'post_format' => array('image'),
            'position' => 'side', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            'sections' => $layoutOptions
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'cl_add_layout_metaboxes');
endif;

/*------------------------------------------END LAYOUT OPTIONS----------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------GENERAL SETTINGS----------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "cl_add_general_metaboxes" ) ):
    function cl_add_general_metaboxes($metaboxes) {
        global $simple_redata;

        $sections = array();


        /*----------------------------------------------PAGE HEADER-------------------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/

        $page_header_section = array(
            'title' => __('Page Header Options', 'the-simple'),
            'desc' => __('In this section you can create custom page header only for this page. If you want to change or to view the default page header options', 'the-simple').' <a href="'.admin_url().'admin.php?page=_options&tab=2">click here</a>',
            'icon' => 'el-icon-home',
            'fields' => array(  

                            array(
                                'id' => 'page_header_overwrite',
                                'type' => 'switch',
                                'title' => __('Overwrite the default page options', 'the-simple'),
                                'subtitle' => __('Do you want to overwrite the default page options in Theme Options ?', 'the-simple'),
                                'default' => 0// 1 = on | 0 = off
                            ),

                            array(
                                'id' => 'page_header_bool',
                                'type' => 'switch',
                                'title' => __('Active Page Header', 'the-simple'),
                                'subtitle' => __('Switch On to enable page header for pages, posts (For each post or page you can add custom options)', 'the-simple'),
                                'default' => $simple_redata['page_header_bool'],// 1 = on | 0 = off
                                'required' => array('page_header_overwrite','=','1')
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
                                'default' => $simple_redata['page_header_height'],
                                'required' => array('page_header_overwrite','=','1')
                            ),

                            array(
                                'id' => 'page_header_style',
                                'type' => 'select',
                                'title' => __('Page header style', 'the-simple'),
                                'subtitle' => __('Select the style for the default page header', 'the-simple'),
                                'options' => array('normal' => 'Basic (Left with breadcrumbs)', 'centered' => 'Centered',  'left' => 'Left'), //Must provide key => value pairs for select options
                                'default' =>  $simple_redata['page_header_style'],
                                'required' => array('page_header_overwrite','=','1')
                            ),

                            array(
                                'id' => 'subtitle_bool',
                                'type' => 'switch',
                                'title' => __('Subtitle for this page ?', 'the-simple'),
                                'default' => 0,
                                'required' => array('page_header_overwrite','equals','1')
                            ),

                            array(
                                'id' => 'subtitle',
                                'type' => 'text',
                                'title' => __('Subtitle for this page', 'the-simple'),
                                'subtitle' => __('Add a subtitle here', 'the-simple'),
                                'desc' => __('Show after the main title  ', 'the-simple'),
                                'default' => 'A sample page description',
                                'required' => array(array('page_header_overwrite','=','1'), array('subtitle_bool','=', '1'))
                            ),

                            array(
                                'id' => 'page_header_f_color',
                                'type' => 'color',
                                'output' => array('.header_page'),
                                'title' => __('Page header font color', 'the-simple'),
                                'subtitle' => __('Select the color for the title or breadcrumbs in page header', 'the-simple'),
                                'default' => $simple_redata['page_header_f_color'],
                                'validate' => 'color',
                                'required' => array('page_header_overwrite','=','1')
                            ),

                            array(
                                'id' => 'page_header_background',
                                'type' => 'background',
                                'output' => array('.header_page'),
                                'title' => __('Page header background', 'the-simple'),
                                'subtitle' => __('Page Header background with image, color, etc.', 'the-simple'),
                                'default' => $simple_redata['page_header_background'],
                                'required' => array('page_header_overwrite','=','1')
                            )

            )
         );


        /*----------------------------------------------END PAGE HEADER---------------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/


        /*----------------------------------------------SLIDER OPTIONS----------------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/

        $layers = array();
        // Get WPDB Object
        global $wpdb;
     
        // Table name
        $table_name = $wpdb->prefix . "layerslider";
        $sql = $wpdb->prepare('show tables like %s', array($table_name));
        if($wpdb->get_var($sql) == $table_name) {
        // Get sliders
            $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                        WHERE flag_hidden = '0' AND flag_deleted = '0'
                                        ORDER BY date_c ASC LIMIT 100" );
           

        
            foreach($sliders as $key => $item) {
         
                $layers[$item->id-1] = $item->name;
            }
        }



        $revsliders = array();
        // Get WPDB Object
        global $wpdb;
     
        // Table name
        $table_name = $wpdb->prefix . "revslider_sliders";
     
        $sql = $wpdb->prepare('show tables like %s', array($table_name));
        if($wpdb->get_var($sql) == $table_name) {
           
            $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                            ORDER BY id ASC LIMIT 100" );   
            if(count($sliders) > 0):
                foreach($sliders as $key => $item) {
                    $revsliders[$item->alias] = $item->title;
                }

            endif;
        }


        $slider_section = array(

            'title' => __('Sliders Options', 'the-simple'),
            'icon' => 'el-icon-home',
            'fields' => array(
                            array(
                                'id' => 'slider_type',
                                'type' => 'select',
                                'title' => __('Select Slider Type', 'the-simple'),
                                'subtitle' => __('Select one of the listed sliders', 'the-simple'),
                                'options' => array('none'=>'None', 'the-simple' => 'Simple Slider', 'flexslider' => 'Flexslider', 'revolution' => 'Revolution Slider', 'layerslider' => 'Layerslider', 'simple_news' => 'News Slider', 'gallery_carousel' => 'Gallery Carousel'), //Must provide key => value pairs for select options
                                'default' =>  'none'
                            ),

                            array(
                                'id' => 'gallery',
                                'type' => 'slides',
                                'title' => __('Add/Edit Slides', 'the-simple'),
                                'subtitle' => __('Add new or edit existing slider images', 'the-simple'),
                                'required' => array('slider_type', '=', array('flexslider', 'gallery_carousel'))
                            ),

                            array(
                                'id' => 'gallery_effect',
                                'type' => 'select',
                                'title' => __('Gallery Carousel Effect', 'the-simple'),
                                'subtitle' => __('', 'the-simple'),
                                'default' => 'the-simple',
                                'options' => array('the-simple' => 'the-simple', 'grayscale' => 'Grayscale', 'opacity' => 'With Opacity'),
                                'required' => array('slider_type', '=', 'gallery_carousel')
                            ),

                            array( 
                                'id' => 'revslider',
                                'type' => 'select',
                                'title' => __('Select one of the created revolution sliders.', 'the-simple'),
                                'subtitle' => __('', 'the-simple'),
                                'options' => $revsliders, //Must provide key => value pairs for select options
                                'default' =>  'none',
                                'required' => array('slider_type', '=', 'revolution')
                            ),

                            array(
                                'id' => 'layerslider',
                                'type' => 'select',
                                'title' => __('Select one of the created layer sliders.', 'the-simple'),
                                'subtitle' => __('', 'the-simple'),
                                'options' => $layers, //Must provide key => value pairs for select options
                                'default' =>  'none',
                                'required' => array('slider_type', '=', 'layerslider')
                            ),

                            array(
                                'id' => 'simple_slider',
                                'type' => 'select',
                                'title' => __('Select one of the created simpleliders.', 'the-simple'),
                                'subtitle' => __('', 'the-simple'),
                                'data' => 'categories',
                                'args' => array('orderby'=>'date', 'hide_empty'=> 0, 'taxonomy' => 'slider'),
                                'required' => array('slider_type', '=', 'the-simple')
                            ),

                             array(
                                'id' => 'simple_slider_speed',
                                'type' => 'text',
                                'title' => __('Simple Slider Speed', 'the-simple'),
                                'subtitle' => __('', 'the-simple'),
                                'default' => '10000',
                                'required' => array('slider_type', '=', 'the-simple' )
                            ),

                            array(
                                'id' => 'simple_slider_height',
                                'type' => 'text',
                                'title' => __('Slider height', 'the-simple'),
                                'subtitle' => __('Write 100% for fullscreen or for example 600 (without px) for custom', 'the-simple'),
                                'required' => array('slider_type', '=', array('the-simple', 'gallery_carousel') )
                            ),

                            array(
                                'id' => 'simple_news_featured_1',
                                'type' => 'select',
                                'title' => __('Select the first featured post', 'the-simple'),
                                'subtitle' => __('', 'the-simple'),
                                'data' => 'post',
                                'args' => array('orderby'=>'date', 'posts_per_page' => -1),
                                'required' => array('slider_type', '=', 'simple_news')
                            ),

                            array(
                                'id' => 'simple_news_featured_2',
                                'type' => 'select',
                                'title' => __('Select the second featured post', 'the-simple'),
                                'subtitle' => __('', 'the-simple'),
                                'data' => 'post',
                                'args' => array('orderby'=>'date', 'posts_per_page' => -1),
                                'required' => array('slider_type', '=', 'simple_news')
                            ),

                            array(
                                'id' => 'slider_layout',
                                'type' => 'select',
                                'title' => __('Select Slider layout', 'the-simple'),
                                'subtitle' => __('', 'the-simple'),
                                'options' => array('boxed'=>'Boxed', 'fullwidth' => 'Fullwidth'), //Must provide key => value pairs for select options
                                'default' =>  'boxed',
                                'required' => array('slider_type', '!=', 'none')
                            ),
                            array(
                                'id' => 'slider_fixed',
                                'type' => 'switch',
                                'title' => __('Active Fixed Slider', 'the-simple'),
                                'subtitle' => __('', 'the-simple'),
                                'default' =>  0,
                                'required' => array('slider_type', '!=', 'none')
                            ),  

                            array(
                                'id'=>'slider_parallax',
                                'type' => 'switch', 
                                'title' => __('Active Parallax', 'the-simple'),
                                'subtitle'=> __('Look, it\'s on!', 'the-simple'),
                                "default"       => 0,
                            ),      

                            array(

                                'id' => 'slider_shapes',
                                'type' => 'select',
                                'title' => __('Slider Shapes', 'the-simple'),
                                'subtitle' => __('You can set different designs for your slider', 'the-simple'),
                                'options' => array('normal'=>'Normal', 'angled' => 'Angled', 'polygon' => 'Polygon', 'polygon_upper'=> 'Polygon Upper'),
                                'default' => 'normal',
                                'required' => array('slider_type', '!=', 'none')


                            ),

                            array(
                                'id'=>'slider_onmobile_remove',
                                'type' => 'switch', 
                                'title' => __('Remove Sliders from Mobile Phone View', 'the-simple'),
                                'subtitle'=> __('Check this option if you want to remove sliders from mobile view for this page.', 'the-simple'),
                                "default"       => 0,
                            ), 
            )

        );

        /*----------------------------------------------END SLIDER OPTIONS------------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/


        /*----------------------------------------------PAGE OPTIONS & STYLE----------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/

        $page_opt_style = array(

            'title' => __('Page Options & Style', 'the-simple'),
            'icon' => 'el-icon-home',
            'fields' => array(
                            array(
                                'id' => 'page_content_background',
                                'type' => 'color',
                                'output' => array('#content', '.fullscreen-single', '.fullscreen-single .content'),
                                'title' => __('Page Content Background', 'the-simple'),
                                'subtitle' => __('Background color of content in this page ' , 'the-simple'), 
                                'mode' => 'background-color',
                                'default' => $simple_redata['page_content_background'],
                                'validate' => 'color',
                            ),
                            array(
                                'id' => 'fixed_header_page', 
                                'type' => 'switch',
                                'title' => __('Fixed header', 'the-simple'),
                                'subtitle' => __('Check this to activate fixed header', 'the-simple'),
                                'desc' => __('After activate this, the header will be fixed position, transparent above the content.', 'the-simple'),
                                'default' => '0'// 1 = on | 0 = off
                            ),
                            array(
                                'id' => 'page_header_menu_color',
                                'type' => 'select',
                                'title' => __('Header Color Style for Header 1', 'the-simple'),
                                'subtitle' => __('Select Light for light colors in header and white logo', 'the-simple'),
                                'options' => array('light' => 'Dark version header', 'dark' => 'Light version header', 'auto' => 'Auto check (Works only with background images)' ), //Must provide key => value pairs for select options
                                'default' =>  'light'
                            ),

                            array(
                                'id' => 'one_page_active', 
                                'type' => 'switch',
                                'title' => __('Use menu as one page menu', 'the-simple'),
                                'subtitle' => __('Check this to activate one page menu', 'the-simple'),
                                'desc' => __('After activate this, to the sections of visual composer add a class attribute for ex: "services" and set the link of the menu item: #services', 'the-simple'),
                                'default' => '0'// 1 = on | 0 = off
                            ),

                            array(
                                'id' => 'fullscreen_sections_active', 
                                'type' => 'switch',
                                'title' => __('Fullscreen Sections Sliding', 'the-simple'),
                                'subtitle' => __('Check to use visual sections as fullscreen sections', 'the-simple'),
                                'desc' => __('', 'the-simple'),
                                'default' => '0'// 1 = on | 0 = off
                            ),

                            array(
                                'id'=>'use_featured_image_as_photo',
                                'type' => 'switch', 
                                'title' => __('Use Featured Image as Photo', 'the-simple'),
                                'subtitle'=> __('', 'the-simple'),
                                "default"       => 1,
                            )



            )

        );


        /*----------------------------------------------END PAGE OPTIONS & STYLE------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/


        $sections[] = $page_header_section;   // PAge Header Added
        $sections[] = $slider_section;   // Slider Added
        $sections[] = $page_opt_style; // Page Options and Style Added

        $single_portfolio = array();
        $single_portfolio[] = $page_header_section;
        $single_portfolio[] = $page_opt_style;

        $metaboxes[] = array(
            'id' => 'general_settings',
            'title' => __('General Settings', 'the-simple'),
            'post_types' => array('page','post'),
            'position' => 'normal', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            'sections' => $sections
        );
        $metaboxes[] = array(
            'id' => 'general_settings',
            'title' => __('General Settings', 'the-simple'),
            'post_types' => array('portfolio'),
            'position' => 'normal', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            'sections' => $single_portfolio 
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'cl_add_general_metaboxes');
endif;

/*----------------------------------------------END GENERAL SETTINGS-----------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/


/*---------------------------------------------------- STAFF -----------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "cl_add_staff_metaboxes" ) ):
    function cl_add_staff_metaboxes($metaboxes) {

        $staff_options = array();

        $staff_options[] = array(
            //'title'         => __('General Settings', 'the-simple'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'staff_position',
                    'title' => __( 'Staff Position', 'the-simple' ),
                    'desc' => 'Write here the position for this staff member into your business',
                    'type' => 'text'
                ),
                array(
                    'id' => 'facebook_link',
                    'title' => __( 'Facebook Link', 'the-simple' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => '#'
                ),
                array(
                    'id' => 'twitter_link',
                    'title' => __( 'Twitter Link', 'the-simple' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => '#'
                ),
                array(
                    'id' => 'google_link',
                    'title' => __( 'Google Link', 'the-simple' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => '#'
                ),
                array(
                    'id' => 'pinterest_link',
                    'title' => __( 'Pinterest Link', 'the-simple' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => ''
                ),
                array(
                    'id' => 'linkedin_link',
                    'title' => __( 'Linkedin Link', 'the-simple' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => ''
                ),
                array(
                    'id' => 'instagram_link',
                    'title' => __( 'Instagram Link', 'the-simple' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => ''
                ),
                array(
                    'id' => 'mail_link',
                    'title' => __( 'Mail Link', 'the-simple' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => ''
                ),
            ),
        );


        $metaboxes[] = array(
            'id'            => 'staff-options',
            'title'         => __( 'Portfolio Options', 'the-simple' ),
            'post_types'    => array( 'staff'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $staff_options,
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'cl_add_staff_metaboxes');
endif;

/*-------------------------------------------------- END STAFF ---------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/


/*------------------------------------------------- TESTIMONIAL --------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "cl_add_testimonial_metaboxes" ) ):
    function cl_add_testimonial_metaboxes($metaboxes) {

        $testimonial_options = array();

        $testimonial_options[] = array(
            //'title'         => __('General Settings', 'the-simple'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'staff_position',
                    'title' => __( 'Staff Position', 'the-simple' ),
                    'desc' => 'Write here the position for this testimonial post',
                    'type' => 'text'
                )
            ),
        );


        $metaboxes[] = array(
            'id'            => 'testimonial-options',
            'title'         => __( 'Testimonial Options', 'the-simple' ),
            'post_types'    => array( 'testimonial'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $testimonial_options,
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'cl_add_testimonial_metaboxes');
endif;

/*-------------------------------------------------- END Testimonial ---------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------------*/


/*--------------------------------------BLOG POST METABOXES--------------------------------------------------*/
/*-----------------------------------------------------------------------------------------------------------*/
if ( !function_exists( "cl_add_blog_post_metaboxes" ) ):
    function cl_add_blog_post_metaboxes($metaboxes) {
        $blog_options = array();
        
        $blog_options[] = array(
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'fullscreen_post_style',
                    'title' => __( 'Active Fullscreen Innovative Single Post', 'the-simple' ),
                    'desc' => 'Use this option if you active the fullscreen blog',
                    'type' => 'switch', 
                    'default' => 0 
                ),
                array(
                    'id' => 'fullscreen_post_effect',
                    'title' => __( 'Fullscreen Post Effect', 'the-simple' ),
                    'desc' => 'Use this option if you active the fullscreen blog',
                    'type' => 'select',
                    'options' => simple_animations(), 
                    'default' => 'fadeInLeft' 
                ),
                array(
                    'id' => 'fullscreen_post_delay',
                    'type' => 'text',
                    'title' => __('Fullscreen Post Effect Delay', 'the-simple'),
                    'default' => '200'
                ),
                array(
                    'id' => 'fullscreen_post_position',
                    'title' => __( 'Fullscreen Post Position', 'the-simple' ),
                    'desc' => 'Position of the content in the fullscreen section',
                    'type' => 'select',
                    'default' => 'left',
                    'options' => array('left' => 'Left', 'right' => 'Right')
                ),
                array(
                    'id' => 'future_date_events',
                    'title' => __( 'Future date for upcoming events', 'the-simple' ),
                    'desc' => '',
                    'type' => 'text',
                    'placeholder' => 'Click to enter a date'
                )      
            ) 
        );



        $metaboxes[] = array(
            'id'            => 'blog-options',
            'title'         => __( 'Blog Options', 'the-simple' ),
            'post_types'    => array( 'post'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'low', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $blog_options
        );

        $post_format = array();
        
        $post_format[] = array(
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'media_post_link',
                    'title' => __( 'Video / Audio Link or Iframe', 'the-simple' ),
                    'desc' => 'Insert here link / Iframe for video or audio',
                    'type' => 'textarea', 
                    'default' => '' 
                )          
            ) 
        );

        $metaboxes[] = array(
            'id'            => 'blog-post-format',
            'title'         => __( 'Blog Post Format', 'the-simple' ),
            'post_types'    => array( 'post'),
            'post_format'   => array('video', 'audio'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $post_format
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'cl_add_blog_post_metaboxes');
endif;

/*--------------------------------------END BLOG POST METABOXES---------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

// The loader will load all of the extensions automatically based on your $redux_opt_name
//require_once(get_template_directory(). '/admin/loader/loader.php');