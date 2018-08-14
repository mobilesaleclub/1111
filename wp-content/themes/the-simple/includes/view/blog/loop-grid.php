<?php

global $simple_redata, $for_element;

do_action('simple_excecute_query_var_action','loop-index');

if (have_posts()) :

    ?>
    <div id="blogmasonry" class="<?php if(isset($simple_redata['blog_grid_col'])) echo 'cols'.$simple_redata['blog_grid_col']; else echo 'cols3';  ?>">
        <div class="row filterable">
            <div class="grid-size"></div>
    <?php

    while (have_posts()) : the_post();



        $post_id    = get_the_ID();

        $title      = get_the_title();

        $content    = get_the_content();

        $content    = str_replace(']]>', ']]&gt;', apply_filters('the_content', $content ));

                

        $post_format = get_post_format($post_id);

        if(strlen($post_format) == 0)

            $post_format = 'standart';

        $count = 0;

        $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => $post->ID ));

        if(count($comment_entries) > 0){

            foreach($comment_entries as $comment){

                if($comment->comment_approved)

                    $count++;

            }

        }


        $tags = get_the_tags();
        $tag_out = ''; $num=count($tags); $i=0; if($tags) foreach($tags as $tag): if(++$i === $num){$tag_out .= $tag->name;} else {$tag_out .= $tag->name.', ';}  endforeach;
        
        $no_shadow = '';
        if(!$simple_redata['timeline_box_shadow'])
            $no_shadow = 'no_shadow';

        ?>

        

        <article id="post-<?php echo the_ID(); ?>" <?php echo post_class('row-fluid blog-article grid-style '.$no_shadow.' normal'); ?>>                    
            
            <div class="gridbox">
            
         <?php if($post_format == 'standart'){
                $icon_class="pencil";
            }elseif($post_format == 'audio'){
                $icon_class="music";
            }elseif($post_format == 'soundcloud'){
                $icon_class="music";
            }elseif($post_format == 'video'){
                $icon_class="play";
            }elseif($post_format == 'quote'){
                $icon_class="quote-left";
            }elseif($post_format == 'gallery'){
                $icon_class="image";
            }elseif($post_format == 'image'){
                $icon_class="images";
            }


         ?>



                <div class="media">
                   
                    <?php if($post_format == 'audio'){

                        echo do_shortcode('[soundcloud]'.get_the_excerpt().'[/soundcloud]');

                    }elseif(get_post_thumbnail_id()){ ?>
                        <a href="<?php echo esc_url(get_permalink()) ?>"><div class="overlay"><div class="post_type_circle"><i class="lnr lnr-chevron-right"></i></div></div></a>
                        <img src="<?php echo esc_url(simple_image_by_id(get_post_thumbnail_id(), '', 'url')) ?>" alt="">
                                                        
                    <?php }elseif($post_format == 'gallery'){

                            $slider = new simple_slideshow(get_the_ID(), 'flexslider');

                            if($slider && $slider->slide_number > 0){
                                
                                $slider->img_size = 'port3';
                                $sliderHtml = $slider->render_slideshow();
                                echo $sliderHtml;

                            }

                    }elseif($post_format == 'video'){

                            $video = ""; 

                            $link = $simple_redata['media_post_link'];

                            if(simple_backend_is_file( $link, 'html5video')){

                                $video = simple_html5_video_embed($link);

                            }
                            else if(strpos($link,'<iframe') !== false)
                            {
                                $video = $link;
                            }
                            else
                            {
                                global $wp_embed;
                                $video = $wp_embed->run_shortcode("[embed]".trim($link)."[/embed]");
                            }

                            if(strpos($video, '<a') === 0)
                            {
                                $video = '<iframe src="'.esc_url($link).'"></iframe>';
                            } 

                            echo $video;

                    } ?>
                
                </div>

                <div class="content">
                    <?php if($post_format == 'quote'){ ?>

                        <ul class="info">
                        <?php if($simple_redata['blog_info_author']): ?>
                        <li><?php _e('Posted by', 'the-simple') ?> <?php echo get_the_author() ?></li> 
                        <?php endif; ?>
                        <?php if($simple_redata['blog_info_date']): ?>
                        <li><?php _e('On', 'the-simple') ?> <?php echo get_the_date() ?></li>                           
                        <?php endif; ?>

                        <?php if($simple_redata['blog_info_comments']): ?>                   
                                <li><i class="icon-comment-o"></i><?php echo esc_attr($count) ?> <i class="lnr lnr-chat"></i></li>
                            <?php endif; ?>
                        
                        <?php if($simple_redata['post_like'] && function_exists('getPostLikeLink')): ?>  
                    <div class="post-like"><?php echo getPostLikeLink( get_the_ID() ); ?></div>
                    <?php endif; ?>
                    </ul>

                        <div class="quote">
                            <i class="moon-quotes-left"></i>
                            <a href="<?php echo get_permalink() ?>"><p><?php echo get_the_content() ?></p></a>
                            <span class="author"><?php echo esc_html(get_the_title()) ?></span>
                        </div>

                    <?php }else{ ?>

                    <h1><a href="<?php echo esc_url(get_permalink()) ?>"><?php echo esc_html(get_the_title()) ?></a></h1>
                    <ul class="info">
                        <?php if($simple_redata['blog_info_author']): ?>
                        <li><?php _e('Posted by', 'the-simple') ?> <?php echo get_the_author() ?></li> 
                        <?php endif; ?>
                        <?php if($simple_redata['blog_info_date']): ?>
                        <li><?php _e('On', 'the-simple') ?> <?php echo get_the_date() ?></li>                           
                        <?php endif; ?>

                        <?php if($simple_redata['blog_info_comments']): ?>                   
                                <li><i class="icon-comment-o"></i><?php echo esc_attr($count) ?> <i class="lnr lnr-chat"></i></li>
                            <?php endif; ?>
                        
                        <?php if($simple_redata['post_like'] && function_exists('getPostLikeLink')): ?>  
                    <div class="post-like"><?php echo getPostLikeLink( get_the_ID() ); ?></div>
                    <?php endif; ?>
                        
                    </ul>

                    <div class="text">
                        <?php   if($post_format == 'video' || $post_format == 'audio')
                                    echo simple_text_limit(get_the_content(), 20);
                                else
                                    echo get_the_excerpt();    
                        ?>
                    </div>
                   
                    
                    <?php } ?>

                </div>
            </div>
        </article>

    <?php endwhile; ?>

    </div>
</div> 
    
    <?php if(!is_single() && (!isset($for_element) || !$for_element)): ?>

        <?php simple_pagination_display(); ?>
    
    <?php endif; ?>

<?php endif;

?>