<?php
/*
Template Name: Archive
*/

$simple_redata = simple_redata_variable();

$simple_current_view = simple_rewrite_simple_current_view('blog');

$spancontent = 12;

if($simple_redata['bloglayout'] == 'fullwidth')
    $spancontent = 12;
else
    $spancontent = 9;

$blog_page = $simple_redata['blogpage'];

get_header();

?>
 
<?php $blog_style = $simple_redata['blog_style']; ?>
   
<?php get_template_part('includes/view/page_header'); ?>
    
<section id="content" class="<?php echo esc_attr($simple_redata['bloglayout']) ?>"  style="background-color:<?php echo (!empty($simple_redata['page_content_background']))?esc_attr($simple_redata['page_content_background']):'#ffffff'; ?>;">
        <div class="container" id="blog">
            <div class="row">

            <?php if($simple_redata['bloglayout'] == 'sidebar_left') get_sidebar() ?>   

                <div class="span<?php echo esc_attr($spancontent) ?>">
                <?php
                    if($blog_style == 'grid')
                        get_template_part( 'includes/view/blog/loop', 'grid' ); 
                    elseif($blog_style == 'alternate')
                        get_template_part( 'includes/view/blog/loop', 'second-style' );
                    elseif($blog_style == 'masonry')
                        get_template_part( 'includes/view/blog/loop', 'masonry' );
                    elseif($blog_style == 'timeline')
                        get_template_part( 'includes/view/blog/loop', 'timeline' );
                    else
                        get_template_part( 'includes/view/blog/loop', 'index' );
                ?>

            </div>

            <?php wp_reset_postdata(); ?> 

            <?php if($simple_redata['bloglayout'] == 'sidebar_right') get_sidebar() ?>  

            </div>
        </div>
</section>

<?php get_footer(); ?>