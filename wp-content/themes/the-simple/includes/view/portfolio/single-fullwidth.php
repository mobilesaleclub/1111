<?php

global $simple_redata;
do_action('simple_excecute_query_var_action','loop-single_portfolio_bottom');

?>

<div class="media">
    <?php if($simple_redata['single_portfolio_media'] == 'featured'): ?>
        <div class="featured" style="background-image:url('<?php echo esc_url(simple_image_by_id(get_post_thumbnail_id(), '', 'url'))  ?>');"></div>
    <?php endif; ?>
    <?php 
        if($simple_redata['single_portfolio_media'] == 'slideshow'): 
            $slider = new simple_slideshow(get_the_ID(), 'flexslider');
            $slider->slides = $simple_redata['single_portfolio_gallery'];
            $slider->slide_number = count($simple_redata['single_portfolio_gallery']);
            if($slider && $slider->slide_number > 0){  
                $slider->img_size = '';
                $sliderHtml = $slider->render_slideshow();
                echo $sliderHtml;
            }
        endif; 
    ?>
    <?php 
        if($simple_redata['single_portfolio_media'] == 'video'){
            
            $video = ""; 
        }
                           
    ?>
</div>
<div class="container">
    <div class="row-fluid content">
        <div class="span9">
            <h4><?php _e('Project Description', 'the-simple') ?></h4>
            <?php the_content(); ?>
        </div>
        <div class="span3">
            <h4><?php _e('Project Details', 'the-simple') ?></h4>

            <ul class="info">
                <?php if(!empty($simple_redata['single_portfolio_custom_params']) ): for($i = 0; $i < count($simple_redata['single_portfolio_custom_params']); $i++): ?>
                    <?php if(isset($simple_redata['single_portfolio_custom_fields'][$i]) && !empty($simple_redata['single_portfolio_custom_fields'][$i]) ): ?>
                        <li><span class="title"><?php echo esc_attr($simple_redata['single_portfolio_custom_params'][$i]) ?></span><span><?php echo esc_attr($simple_redata['single_portfolio_custom_fields'][$i]) ?></span></li>
                    <?php endif; ?>
                <?php endfor;  endif; ?>
                <?php if($simple_redata['portfolio_post_like']): ?>   
                    <li class="post-like"><?php echo getPostLikeLink( get_the_ID() ); ?></li> 
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <?php if($simple_redata['single_portfolio_active_comments']) comments_template( '/includes/view/blog/comments.php');  ?>
</div>
