<?php  $simple_redata = simple_redata_variable(); ?>

<!DOCTYPE html>

<html <?php language_attributes(); ?> class="css3transitions">
 
<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>" />

    <!-- Responsive Meta -->
    <?php if($simple_redata['responsive_bool']): ?> <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> <?php endif; ?>

    <!-- Pingback URL -->
    <link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->

    <?php 
    // Google analytics
    $google_analytics = $simple_redata['tracking_code'];
    ?>
    <script type="text/javascript">
        <?php echo $google_analytics; ?>
    </script>
    
    <?php 
        $custom_js = $simple_redata['custom_js'];
        if(!empty($custom_js)):
    ?>
    
    <script type="text/javascript">
        <?php echo $custom_js ?>
    </script>
    
    <?php endif; ?>
    <?php     
    // Loaded all others styles and scripts.
    wp_head(); 


  
    ?>
   
</head>

<!-- End of Header -->

<body  <?php body_class(); ?>>



<?php if($simple_redata['show_search']): ?>
    <div class="search_bar">
    <div class="overlay-close"><i class="lnr lnr-cross"></i></div>
    <div class="container"><?php get_search_form() ?></div></div>
<?php endif; ?>

<?php if($simple_redata['extra_navigation']): ?>
    <div class="extra_navigation <?php echo esc_attr($simple_redata['extra_navigation_position']) ?>">
        <a href="#" class="close"></a>

        <div class="content"><?php if(is_active_sidebar("sidenav")) dynamic_sidebar( "sidenav" ); ?></div>
    </div>
<?php endif; ?>

<?php if($simple_redata['outter_padding']): ?>
    <div class="top_space"></div>
    <div class="bottom_space"></div>
<?php endif; ?>



<!-- check if siden menu in responsive is selected-->
<?php if($simple_redata['responsive_menu_dropdown'] && $simple_redata['responsive_menu_style'] == 'sidemenu'): ?>
    
    <?php get_template_part('includes/view/menu', 'small-side'); ?>

    <div id="snapcontent" class="">

<?php endif; ?>
<!-- end check if siden menu in responsive is selected-->

<div class="viewport  <?php echo esc_attr( simple_header_transitions('class') ) ?>" <?php echo simple_header_transitions('attr') ?> >

<!-- Used for boxed layout -->
<?php if($simple_redata['site_layout'] == 'boxed'): ?>
<!-- Boxed Layout Wrapper -->
<div class="boxed_layout">
<?php endif; ?>
    

<!-- Start Top Navigation -->
    <?php if($simple_redata['top_navigation'] && !$simple_redata['top_navigation_transparency']): ?>
    <div class="top_nav">
        
            <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <div class="pull-left">
                        <?php if(is_active_sidebar("Top Header Left")) dynamic_sidebar( "Top Header Left" ); ?>
                    </div>
                </div>
                <div class="span6">
                    <div class="pull-right">
                        <?php if(is_active_sidebar("Top Header Right")) dynamic_sidebar( "Top Header Right" ); ?>
                    </div>
                </div>
               
            </div>
            </div>

    </div>
    <?php endif; ?>

    <!-- End of Top Navigation -->

        
    <?php $header_class = $simple_redata['header_style'];?>
<?php $bgCheck = esc_attr(simple_header_bgCheck()); ?>
    <?php 

        if(!empty($simple_redata['header_shapes']))
            $header_shapes = $simple_redata['header_shapes']; ?>

    <?php if($simple_redata['header_style'] == 'header_1' || $simple_redata['header_style'] == 'header_4' || $simple_redata['header_style'] == 'header_5' || $simple_redata['header_style'] == 'header_11' || $simple_redata['header_style'] == 'header_7'){
        if((int) simple_get_post_id() != 0 && function_exists('redux_post_meta'))
            $page_header_menu_color = redux_post_meta('simple_redata',(int) simple_get_post_id(), 'page_header_menu_color');
        else
            $page_header_menu_color = 'light';

        if(isset($page_header_menu_color) && !empty($page_header_menu_color))
            $bgCheck = ($page_header_menu_color =='auto') ? '' : 'background--'.$page_header_menu_color; 
        else
            $bgCheck = 'background--light';
    } 
    ?>

    
    
    <?php if($simple_redata['header_6_transparent'] && $header_class == 'header_6'): ?>    
    
    <!-- Header 6 Wrapper -->
    <div class="header_6_wrapper">
     
    <?php endif; ?> 

    <?php 
            $header_gradient='';
        if($simple_redata['header_gradient_transparency'] == 1): 
             $header_gradient = ' header_gradient';
          endif;
    ?>

    <?php if(!empty($simple_redata['header_border_bottom']) && $simple_redata['header_border_bottom'] == 1 ){
             $header_border = ' header_borders';
         }
          else $header_border = '';

          if(!empty($simple_redata['header_border_bottom_content']) && $simple_redata['header_border_bottom_content'] == 1){
             $header_border_bottom = ' header_borders_bottom';
         }
          else $header_border_bottom = '';

    ?>

    <!-- Header BEGIN -->
    
    <div  class="header_wrapper <?php echo esc_attr($header_border) ?> <?php echo esc_attr($header_border_bottom) ?> <?php echo esc_attr($header_class) ?>  <?php echo esc_attr($header_shapes); ?> <?php echo esc_attr($header_gradient) ?> <?php echo esc_attr($bgCheck) ?> <?php if($header_class == 'header_7') echo 'pos--'.esc_attr($simple_redata['header_7_position']) ?> <?php if($header_class == 'header_7' && esc_attr($simple_redata['header_7_transparent_padding'])) echo 'transparent_padding'?>">
        
        <!-- Start Top Navigation -->
        <?php simple_header_topnav_transparent(); ?>
        <!-- End of Top Navigation -->

        <header id="header" class="">
            <?php if(!$simple_redata['header_container_full']): ?>
            <div class="container">
            <?php endif; ?>
        	   <div class="row-fluid">
                    <div class="span12">
                        

                        <?php if($header_class == 'header_11'): ?>
                        <div class="centered_header">
                            <nav class="left">
                                <?php 
                                    $args = array("theme_location" => "left", "container" => false, "fallback_cb" => 'simple_default_menu');
                                    wp_nav_menu($args);  
                                ?> 
                            </nav>
                        <?php endif; ?>

                        <!-- Logo -->
                        <?php if(!isset($css_class)) $css_class=''; ?>
                        <div id="logo" class="<?php echo esc_attr($css_class) ?>">
                            <?php echo simple_logo() ?>  
                        </div>
                        <!-- #logo END -->

                        <?php if($header_class == 'header_11'): ?>
                            <nav class="right">
                                <?php 
                                    $args = array("theme_location" => "right", "container" => false, "fallback_cb" => 'simple_default_menu');
                                    wp_nav_menu($args);  
                                ?> 
                            </nav>
                        </div>
                        <?php endif; ?>

                        <?php if($header_class == 'header_5' || $simple_redata['show_search'] || class_exists('Woocommerce') || $simple_redata['extra_navigation']): ?>
                        <!-- Tools -->
                            <div class="header_tools">
                                <div class="vert_mid">
                                    <?php if($header_class == 'header_5'): ?>
                                    <a class="open_full_menu" id="trigger-overlay1" href="#">
                                        <i class="lnr lnr-menu"></i>
                                    </a>  
                                    <?php endif; ?>

                                    <?php if($simple_redata['show_search']): ?>
                                    <a class="right_search open_search_button" id="trigger-overlay" href="#">
                                       <i class="lnr lnr-magnifier"></i>
                                    </a>
                                    <?php endif; ?>

                                    <?php if(class_exists('Woocommerce') && $simple_redata['show_cart']): ?>
                                    
                                        <?php get_template_part('includes/view/woocommerce', 'cart'); ?>

                                    <?php endif; ?>

                                    <?php if($simple_redata['extra_navigation']): ?>
                                    <a class="extra_navigation_button" href="#">
                                        <i class="lnr lnr-menu"></i>
                                    </a>  
                                    <?php endif; ?>  
                                </div>
                            </div>
                        <!-- End Tools-->
                        <?php endif; ?>

                        <?php if($simple_redata['show_button']): ?>
                        <!-- Header Button -->
                        
                            <a href="<?php echo esc_attr($simple_redata['header_button_link']) ?>" class="btn-bt <?php echo esc_attr($simple_redata['overall_button_style'][0]) ?> header_button"><?php echo esc_attr($simple_redata['header_button']) ?></a> 

                        <!-- End Header Button -->
                        <?php endif; ?>

                        <!-- Navigation -->

    			        <?php if($header_class == 'header_5'): ?>
                            <div class="header_5_fullwrapper overlay_menu overlay-hugeinc dl-menuwrapper"  id='dl-menu'>
                                <button type="button" class="overlay-close dl-trigger"><i class="lnr lnr-cross"></i></button>
                                <nav>
                                        <?php 
                                            $args = array("theme_location" => "main", "container" => false, "fallback_cb" => 'simple_default_menu');
                                            wp_nav_menu($args);  
                                        ?> 
                                </nav>
                            </div>
                        <?php endif; ?> 
                        
                        <?php if($header_class == 'header_1' || $header_class == 'header_2' || $header_class == 'header_3' || $header_class == 'header_4' || $header_class == 'header_7' || $header_class == 'header_8' || $header_class == 'header_9' || $header_class == 'header_13'): ?>	
                        
                        <?php if($header_class == 'header_7') $css_class .= ' pos_'.$simple_redata['header_7_position'].' ' ?>
                        <div id="navigation" class="nav_top pull-right  <?php echo esc_attr($css_class) ?>">
                            <nav>
                            <?php 
                                $args = array("theme_location" => "main", "container" => false, "fallback_cb" => 'simple_default_menu');
                                wp_nav_menu($args);  
                            ?> 
                            </nav>
                        </div>
                        <?php endif; ?> 

                        <!-- #navigation -->

                         <!-- End custom menu here -->
                        <?php if($simple_redata['responsive_menu_dropdown']  && $simple_redata['responsive_menu_style']=='normal'): ?>
    		    	         <a href="#" id="open-left" class="mobile_small_menu open"></a>
                        <?php endif; ?>

                         <?php if($simple_redata['responsive_menu_dropdown']  && $simple_redata['responsive_menu_style']=='sidemenu'): ?>
                             <a href="#" id="open-left" class="mobile_small_sidemenu"></a>
                        <?php endif; ?>
                        
                        <?php if($header_class == 'header_6' || $header_class == 'header_7' || $header_class == 'header_12'): ?>
                            <div class="header_widgetized">
                                <?php if(is_active_sidebar('Header Widgetized Area')) dynamic_sidebar('Header Widgetized Area'); ?>
                            </div>
                        <?php endif; ?>
                        


                    </div>
                </div>
                <?php if($header_class == 'header_3'): ?>
                    <?php if($simple_redata['responsive_menu_dropdown'] && $simple_redata['responsive_menu_style']=='normal'): ?>
                    <!-- Responsive Menu -->
                    <div class="row-fluid">
                        <?php get_template_part('includes/view/menu', 'small'); ?> 
                    </div>
                    <!-- End Responsive Menu -->
                    <?php endif; ?>
                <?php endif; ?>
                
            <?php if(!$simple_redata['header_container_full']): ?>
            </div>  
            <?php endif; ?>
            <?php if($header_class != 'header_3'): ?>
            
            <?php if($simple_redata['responsive_menu_dropdown'] && $simple_redata['responsive_menu_style']=='normal'): ?>
            <!-- Responsive Menu -->
                <div class="row-fluid">
                    <?php get_template_part('includes/view/menu', 'small'); ?> 
                </div>
            <!-- End Responsive Menu -->
            <?php endif; ?>
            <?php endif; ?>
        </header>

    </div>
    <?php if($header_class == 'header_6' || $header_class == 'header_10' || $header_class == 'header_12'): ?> 
    <div class="full_nav_menu">  
        <div class="container">
            <div id="navigation" class="nav_top pull-right  <?php echo esc_attr($css_class) ?>">
                <nav>
                    <?php 
                        $args = array("theme_location" => "main", "container" => false, "fallback_cb" => 'simple_default_menu');
                        wp_nav_menu($args);  
                    ?> 
                </nav>
            </div>
            <?php if($header_class == 'header_12'): ?>
                <div class="after_navigation_widgetized">
                    <?php if(is_active_sidebar('After Navigation Area')) dynamic_sidebar('After Navigation Area'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if($simple_redata['header_6_transparent'] && $header_class == 'header_6'): ?>    
    </div>
    <!-- Close Header 6 Wrapper -->
    <?php endif; ?> 

    <?php if(!function_exists('redux_post_meta'))

            $fullscreen_post_style = 0;

          else  

            $fullscreen_post_style = redux_post_meta('simple_redata',(int) simple_get_post_id(), 'fullscreen_post_style');  ?>

    <?php if( (int) simple_get_post_id() != 0 && !$fullscreen_post_style): ?>
    
  
    <div class="top_wrapper">
    <?php endif; ?>
        <?php get_template_part('includes/view/sliders_output'); ?>

<!-- .header -->