<?php

$simple_redata = simple_redata_variable(); 
$simple_current_view = simple_rewrite_simple_current_view('single_blog');

$spancontent = 12;

$layout = $simple_redata['singlebloglayout'];

if($simple_redata['overwrite_layout'])
    $layout = $simple_redata['layout'];

if($layout == 'fullwidth')
    $spancontent = 12;
else if($layout == 'dual')
    $spancontent = 6;
else
    $spancontent = 9;


$blog_page = $simple_redata['blogpage'];

get_header();

?>
   
<?php get_template_part('includes/view/page_header'); ?>
<?php if(!$simple_redata['fullscreen_post_style']): ?>
<section id="content" class="<?php echo esc_attr($layout) ?>"  style="background-color:<?php echo (!empty($simple_redata['page_content_background']))?esc_attr($simple_redata['page_content_background']):'#ffffff'; ?>;">
        
        <div class="container" id="blog">
            <div class="row">

            <?php if($layout == 'sidebar_left' || $layout == 'dual') get_sidebar() ?>    

                <div class="span<?php echo esc_attr($spancontent) ?>">
                    
                    <?php get_template_part( 'includes/view/blog/loop', 'index' ); ?>
                    <?php comments_template( '/includes/view/blog/comments.php');  ?>
                </div>

            <?php wp_reset_postdata(); ?> 

            <?php if($layout == 'sidebar_right' || $layout == 'dual') if($layout != 'dual') get_sidebar(); else get_sidebar('dual'); ?>   

            </div>
        </div>
        
        

</section>
<?php endif; ?>
<?php if($simple_redata['fullscreen_post_style']): ?>
    <?php get_template_part('includes/view/blog/single', 'fullscreen'); ?>
<?php endif; ?>

 

<?php get_footer(); ?>