<?php

 $simple_redata = simple_redata_variable();
 $simple_current_view =  simple_current_view();
$extra_class ='';
$id = simple_get_post_id(); 

if(function_exists('redux_post_meta'))
    $replaced = redux_post_meta('simple_redata',(int) $id);

if(isset($replaced) && !empty($replaced))
    foreach($replaced as $key => $value){
        $simple_redata[$key] = $value;
    }

do_action( 'simple_routing_template' , 'page' );
$simple_current_view = 'woocommerce';
$layout = $simple_redata['page_overall_layout'];
if($simple_redata['overwrite_layout'])
    $layout = $simple_redata['layout'];

if($layout == 'fullwidth')
    $spancontent = 12;
else if($layout == 'dual')
    $spancontent = 6;
else
    $spancontent = 9;


get_header(); 

get_template_part('includes/view/page_header'); ?>
        
<?php if($spancontent != 12) $extra_class .= ' with_sidebar'; ?>
<section id="content" class="composer_content <?php echo esc_attr($extra_class) ?>" style="background-color:<?php echo (!empty($simple_redata['page_content_background']))?esc_attr($simple_redata['page_content_background']):'#ffffff'; ?>;">
        <div class="container <?php  echo esc_attr($simple_redata['layout']); ?>" id="blog">
            <div class="row">
            <?php if($layout == 'sidebar_left' || $layout == 'dual') get_sidebar() ?>  
                <div class="span<?php echo esc_attr($spancontent) ?>">
                    
                    <?php simple_woocommerce_content() ?> 

                </div>
                <?php
                
                wp_reset_postdata();
    
                if($layout == 'sidebar_right' || $layout == 'dual') if($layout != 'dual') get_sidebar(); else get_sidebar('dual'); ?>

            </div>
        </div>
</section>

<?php get_footer(); ?>