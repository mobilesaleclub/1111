<?php

if(function_exists('register_sidebar')){
    
    function simple_register_sidebars_init(){
        global $simple_redata;
        
        register_sidebar(array(
            'name' => __('Sidebar Blog', 'the-simple'),
            'id' => 'sidebar-blog',
            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
            'after_widget' => '</div>', 
            'before_title' => '<h5 class="widget-title">', 
            'after_title' => '</h5>'
        ));
      
        register_sidebar(array(
                'name' => __('Sidebar Pages', 'the-simple'),
                'id' => 'sidebar-pages',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h5 class="widget-title">', 
                'after_title' => '</h5>'
        ));
        register_sidebar(array(
                'name' => __('Sidebar Portfolio', 'the-simple'),
                'id' => 'sidebar-portfolio',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h5 class="widget-title">', 
                'after_title' => '</h5>'
        ));

        register_sidebar(array( 
                'name' => __('Top Header Left', 'the-simple'),
                'id' => 'top-header-left',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '', 
                'after_title' => ''
        ));

        register_sidebar(array(
                'name' => __('Top Header Right', 'the-simple'),
                'id' => 'top-header-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '', 
                'after_title' => ''
        ));

        if(isset($simple_redata['footer_columns'])):
            $footer_columns = $simple_redata['footer_columns'];
            
            for ($i = 1; $i <= $footer_columns; $i++)
            {
                register_sidebar(array(
                    'name' => 'Footer - column'.$i,
                    'id' => 'footer-column-'.$i,
                    'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                    'after_widget' => '</div>', 
                    'before_title' => '<h5 class="widget-title">', 
                    'after_title' => '</h5>', 
                ));
            }
        endif;

        register_sidebar(array(
                'name' => __('Copyright Footer Sidebar', 'the-simple'),
                'id' => 'copyright',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '', 
                'after_title' => ''
        ));
        
            

        if(isset($simple_redata['pages_sidebar'])):    
            $id_array = $simple_redata['pages_sidebar'];
                if(isset($id_array[0]))
                {
                    foreach ($id_array as $page_id)
                    {   
                        
                        if($page_id != "")
                        register_sidebar(array(
                            'name' => __('Page','the-simple').': '.get_the_title($page_id).'',
                            'id' => 'page-'.get_the_title($page_id),
                            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                            'after_widget' => '</div>', 
                            'before_title' => '<h6 class="widget-title">', 
                    'after_title' => '</h6>'
                        ));
                    
                    
                    }
                }
        endif;
                
            
            
        if(isset($simple_redata['categories_sidebar'])):       
            $id_array = $simple_redata['categories_sidebar'];
        
            if(isset($id_array[0]))
            {
                foreach ($id_array as $cat_id)
                {   
                    
                    if($cat_id != "")
                    register_sidebar(array(
                        'name' => __('Category','the-simple').': '.get_the_category_by_ID($cat_id).'',
                        'id' => 'category-'.get_the_category_by_ID($cat_id),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                        'after_widget' => '</div>', 
                        'before_title' => '<h6 class="widget-title">', 
                        'after_title' => '</h6>'        )); 
                
                
              }
           }
        endif;




        if(isset($simple_redata['extra_navigation']) && $simple_redata['extra_navigation']){
            register_sidebar(array(
                'name' => __('Extra Side Navigation', 'the-simple'),
                'id' => 'sidenav',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h5 class="widget-title">', 
                'after_title' => '</h5>'
            ));
        }

        if(class_exists('Woocommerce')){
            register_sidebar(array(
                'name' => __('Sidebar Woocommerce', 'the-simple'),
                'id' => 'woocommerce',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h5 class="widget-title">',   
                'after_title' => '</h5>'
            ));
        }

        if(isset($simple_redata['header_style']) && ($simple_redata['header_style'] == 'header_6' || $simple_redata['header_style'] == 'header_7' || $simple_redata['header_style'] == 'header_12') || 1 == 1 ){
            register_sidebar(array(
                'name' => __('Header Widgetized Area', 'the-simple'),
                'id' => 'header-widgetized-area',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h5 class="widget-title">',   
                'after_title' => '</h5>'
            ));
        }

        if(isset($simple_redata['header_style']) && ($simple_redata['header_style'] == 'header_12') ){
            register_sidebar(array(
                'name' => __('After Navigation Area', 'the-simple'),
                'id' => 'after-navigation-area',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h5 class="widget-title">',   
                'after_title' => '</h5>'
            ));
        }

    }
    add_action( 'widgets_init', 'simple_register_sidebars_init' );
        
}

?>