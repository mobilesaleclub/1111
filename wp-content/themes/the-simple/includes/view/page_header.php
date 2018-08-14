<?php
    global $simple_redata;

    $id = simple_get_post_id();
    $replaced = array();
    if((int) $id != 0 && function_exists('redux_post_meta'))
        $replaced = redux_post_meta('simple_redata',(int) $id);
    

    if(isset($replaced) && !empty($replaced))
        foreach($replaced as $key => $value){
            $simple_redata[$key] = $value;
        }

    $title = get_the_title($id);
    if(is_search())
        $title = __('Search Results', 'the-simple');
    if(is_404()) 
        $title = __('404 Not Found', 'the-simple');

    $page_parents = simple_page_parents();
    $extra_class = '';

    if(function_exists('is_product_category') && is_product_category()){
        global $wp_query;
        // get the query object
        $cat_obj = $wp_query->get_queried_object();   
        if($cat_obj)
            $title = $cat_obj->name;
    }

    if($simple_redata['page_header_bool']):   
        $extra_class .= $simple_redata['page_header_style'];

    if(isset($simple_redata['page_header_background']['background-image']) && $simple_redata['page_header_background']['background-image'] != '')
        $extra_class .= ' without_shadow';

    if(isset($simple_redata['page_header_background']['background-attachment']) && $simple_redata['page_header_background']['background-attachment'] != 'fixed')
        $extra_class .= ' no_parallax'; 


        $extra_class .= ' with_subtitle'; 

    if($simple_redata['page_header_design_style'] == 'padd')
        $extra_class .= ' with_padding_style';


    if($simple_redata['page_header_background'] == '' && $simple_redata['page_header_style'] == 'centered'){
      if($simple_redata['page_header_menu_color'] == 'dark'){
        $extra_class .= ' default_dark';
      }
      if($simple_redata['page_header_menu_color'] == 'light'){
        $extra_class .= ' default_light';
      }
    }
    ?>

    <!-- Page Head -->
    <div class="header_page <?php echo esc_attr($extra_class) ?>">
             <?php 

             if(isset($simple_redata['page_header_background']['background-image']) && $simple_redata['page_header_background']['background-image'] != '' && isset($simple_redata['page_header_background']['background-color']) && $simple_redata['page_header_background']['background-color'] != ''): ?>
                <?php $rgb_color = simple_hexToRgb($simple_redata['page_header_background']['background-color']);  ?>
                <div class="overlay" style="background:rgba(<?php echo esc_attr($rgb_color['r']) ?>, <?php echo esc_attr($rgb_color['g']) ?>, <?php echo esc_attr($rgb_color['b']) ?>, 0.5)"></div>
             <?php endif; ?> 
             <div class="container">
                    
                   
                    <div class="titles">
              

                         <?php if(is_page($id)): ?>
                             <h1><?php echo esc_html($title) ?></h1> 


                         <?php endif; ?>

                         <?php if (is_single() && function_exists('is_product') && is_product() || is_singular( array( 'portfolio', 'staff', 'testimonial', 'faq' ) )){ ?>
                                            <h1><?php echo esc_html($title) ?></h1> 
                         <?php }elseif(is_single($id) && is_singular( 'post' )){ ?>
                                <h1><?php echo __('Blog', 'the-simple');?></h1>
                         <?php } ?>

                         <?php  if(is_home($id)){ ?>
                             <h1><?php echo __('Blog', 'the-simple') ?></h1> 
                        <?php }elseif(is_home($id) && is_front_page()){ ?>
                             <h1><?php echo __('Home', 'the-simple') ?></h1>     
                         <?php }; if(is_archive($id)): ?>
                                <h1><?php the_archive_title(); ?></h1> 
                         <?php endif;if(is_search($id)):?> 
                              <h1><?php echo __('Search Results', 'the-simple') ?></h1> 
                          <?php endif; ?>
                         

                        <?php if($simple_redata['subtitle_bool']): ?>
                            <span class="divider">
                            <span class="line"></span>
                            <span class="line right"></span>
                            </span>
                            <h3><?php echo esc_html($simple_redata['subtitle']) ?></h3>
                        <?php endif; ?>

                    </div>
              

                    <?php if($simple_redata['page_header_style'] == 'normal'): ?>
                    <div class="breadcrumbss">
                        
                        <ul class="page_parents pull-right">
                            <li><?php echo __('You are here', 'the-simple')?>: </li>
                            <li class="home"><a href="<?php echo esc_url(home_url('/')) ?>"><?php echo __('Home', 'the-simple')?></a></li>
                            
                            <?php for($i = count($page_parents) - 1; $i >= 0; $i-- ){ ?>

                            <li><a href="<?php echo esc_url(get_permalink($page_parents[$i])) ?>"><?php echo esc_html(get_the_title($page_parents[$i])) ?> </a></li>

                            <?php }  ?>
                           
                            <?php if(is_archive($id)){ ?>
                           
                                <li class="active"><a href="<?php echo esc_url(get_category_link($id)) ?>"> <?php the_archive_title() ?></a></li>

                            <?php }elseif(is_single($id) || is_page($id) ){ ?>

                                <li class="active"><a href="<?php echo esc_url(get_permalink()) ?>"><?php 
                            
                                echo esc_html($title); ?></a></li>
                            
                            <?php }elseif(is_home() && is_front_page()){ ?>
                                    <li class="active"><?php echo __('Front Page', 'the-simple' );   ?> </li>

                             <?php }elseif(is_home()){ ?>
                                      <li class="active"><?php echo __('Blog', 'the-simple' );  
                                     ?></li> 
                            <?php }elseif(is_search()){ ?>

                                    <li class="active"><?php echo __('Search Results', 'the-simple' );   ?>

                              <?php  } ?>



                            
                                

                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            
    </div> 
   
    
    <?php endif; ?>