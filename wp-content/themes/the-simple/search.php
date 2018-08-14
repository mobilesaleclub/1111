<?php
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

<section id="content" class="<?php echo esc_attr($simple_redata['bloglayout']) ?>">
        
        <div class="container" id="blog">
            <div class="row">

            <?php if($simple_redata['bloglayout'] == 'sidebar_left') get_sidebar() ?>   

                <div class="span<?php echo esc_attr($spancontent) ?>">
                <?php
                    if(have_posts()):
                        if($blog_style == 'grid')
                            get_template_part( 'includes/view/blog/loop', 'grid' ); 
                        elseif($blog_style == 'alternate')
                            get_template_part( 'includes/view/blog/loop', 'second-style' );
                        elseif($blog_style == 'timeline')
                            get_template_part( 'includes/view/blog/loop', 'timeline' );
                        else
                            get_template_part( 'includes/view/blog/loop', 'index' );
                    else:       
                ?>
                    <h3 style="font-weight:normal;"><?php esc_html_e('Your search did not match any entries', 'the-simple') ?></h3>
                    <p></p>
                    <p><?php esc_html_e('Suggestions', 'the-simple') ?>:</p>
                    <ul style="margin-left:40px">
                        <li><?php esc_html_e('Make sure all words are spelled correctly', 'the-simple') ?>.</li>
                        <li><?php esc_html_e('Try different keywords', 'the-simple') ?>.</li>
                        <li><?php esc_html_e('Try more general keywords', 'the-simple') ?>.</li>
                    </ul>
                <?php endif; ?>
                </div>

            <?php wp_reset_postdata(); ?> 

            <?php if($simple_redata['bloglayout'] == 'sidebar_right') get_sidebar() ?>  

            </div>
        </div> 
        

        

</section>
<?php get_footer(); ?>