<?php

$simple_redata = simple_redata_variable();
do_action( 'simple_routing_template' , 'page' );
$simple_current_view = simple_rewrite_simple_current_view('page');
$id = simple_get_post_id(); 
if(function_exists('redux_post_meta'))
    $replaced = redux_post_meta('simple_redata',(int) $id);

if(isset($replaced) && !empty($replaced))
    foreach($replaced as $key => $value){
        $simple_redata[$key] = $value;
    }
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

<?php if(!$simple_redata['fullscreen_sections_active']): ?>    
    
<section id="content" class="composer_content" style="background-color:<?php echo (!empty($simple_redata['page_content_background']))?esc_attr($simple_redata['page_content_background']):'#ffffff'; ?>;">
        <?php if($spancontent != 12 || !is_vc()){ ?>
        <div class="container <?php  echo esc_attr($layout) ?>" id="blog">
            <div class="row">
            <?php if($layout == 'sidebar_left' || $layout == 'dual') get_sidebar() ?>   
                <div class="span<?php echo esc_attr($spancontent) ?>">
                    
                    <?php get_template_part( 'includes/view/loop', 'page' ); ?>
                    <!--heck if page has comments-->
                    <?php if (comments_open()):?>
                        <div class="comments">
                        <?php comments_template( '/includes/view/blog/comments.php');  ?>
                        </div>
                        
                    <?php endif;?>
                </div>
                <?php
                
               wp_reset_postdata();    
    
                if($layout == 'sidebar_right' || $layout == 'dual') if($layout != 'dual') get_sidebar(); else get_sidebar('dual');

                ?>

            </div>
        </div>
        <?php }else{ ?>

            <?php get_template_part( 'includes/view/loop', 'page' ); wp_reset_postdata(); ?>            
             
        <?php } ?>



</section>

<?php else: ?>
    
    <div id="fullpage">
        <?php get_template_part( 'includes/view/loop', 'page' ); wp_reset_postdata(); ?>
    </div>

<?php endif; ?>


<?php get_footer(); ?>