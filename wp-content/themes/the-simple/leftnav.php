<?php
/*
Template Name: Left Navigation
*/
$simple_redata =  simple_redata_variable();
do_action( 'simple_routing_template' , 'page' );
$simple_current_view = simple_rewrite_simple_current_view('page');

$id = simple_get_post_id(); 

if(function_exists('redux_post_meta'))
    $replaced = redux_post_meta('simple_redata',(int) $id);

if(isset($replaced) && !empty($replaced))
    foreach($replaced as $key => $value){
        $simple_redata[$key] = $value;
}

get_header();

get_template_part('includes/view/page_header'); ?>
    
<section id="content" class="composer_content" style="background-color:<?php echo (!empty($simple_redata['page_content_background']))?esc_attr($simple_redata['page_content_background']):'#ffffff'; ?>;">
       
        <div class="container sidebar-left" id="blog">
            <div class="row">

                <div class="span3">
                    <ul class="side-nav">
                        <?php if(is_page('$post->post_parent')): ?><?php endif; ?>
                        <li <?php if(is_page($post->post_parent)): ?>class="current_page_item"<?php endif; ?>>
                            <a href="<?php echo esc_url(get_permalink($post->post_parent)); ?>" title="Back to Parent Page"><?php echo get_the_title($post->post_parent); ?></a>
                        </li>
                               
                        <?php 
                            if($post->post_parent) {
                                $children = wp_list_pages("title_li=&child_of=".simple_get_post_top_ancestor_id()."&echo=0");
                              
                            }else{
                                $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
                            }
                            if ($children) { 
                        ?>
                                <ul>
                                  
                                  <?php echo  wp_kses_data($children, '', ''); ?>

                                </ul>

                            <?php } ?>
                    </ul>
                </div>
           
                <div class="span9">
                    
                    <?php get_template_part( 'includes/view/loop', 'page' ); ?>

                </div>
                
                <?php
                
                wp_reset_postdata();    

                ?>

            </div>
        </div>

</section>


<?php get_footer(); ?>