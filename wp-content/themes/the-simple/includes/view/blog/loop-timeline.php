<?php

global $simple_redata;

do_action('simple_excecute_query_var_action','loop-index');

echo '<span class="timeline-border"></span>';

if (have_posts()) :



	while (have_posts()) : the_post();



        $post_id    = get_the_ID();

        $title   	= get_the_title();

        $content 	= get_the_content();

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
                                   

        ?>

        

        <article id="post-<?php echo the_ID(); ?>" <?php echo post_class('row-fluid blog-article timeline-style normal'); ?>>                    

            
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

            $post_categories = wp_get_post_categories( $post_id );
        $cats = '';
            
        foreach($post_categories as $c){
            $cat = get_category( $c );
            $cats .= ' <a href='.get_category_link($cat->cat_ID).'>'.$cat->name.'</a>,';
        }
        $cats = substr(trim($cats), 0, -1);
	     ?>

             <div class="timeline">
                      
                    <div class="date"><span class="day"><?php $d= 'd'; the_time($d) ?></span><span class="month"><?php $M='M'; the_time($M) ?></span></div>
                    

             </div>
            
             <div class="post_box <?php if($simple_redata['timeline_box_shadow']) echo 'box_shadow'; ?>">

                <div class="media">
                
                    <?php if($post_format == 'audio'){

                        echo do_shortcode('[soundcloud]'.get_the_excerpt().'[/soundcloud]');

                    }elseif(get_post_thumbnail_id()){ ?>
                        <a href="<?php echo get_permalink() ?>"><div class="overlay"><div class="post_type_circle"><i class="lnr lnr-magnifier"></i></div></div></a>
                        <img src="<?php echo esc_url(simple_image_by_id(get_post_thumbnail_id(), 'simple_blog', 'url')) ?>" alt="">
                                                        
                    <?php }elseif($post_format == 'gallery'){

                            $slider = new simple_slideshow(get_the_ID(), 'flexslider');

                            if($slider && $slider->slide_number > 0){
                                
                                $slider->img_size = 'simple_blog';
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
                            
                            <li><div class="categories"> <?php _e('In', 'the-simple') ?> <?php echo wp_kses($cats, '', ''); ?></div></li>
                        
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

                        <li><div class="categories"> <?php _e('In', 'the-simple') ?> <?php echo wp_kses($cats, '', ''); ?></div></li>
                        
                        <?php if($simple_redata['blog_info_comments']): ?>                   
                                <li><i class="icon-comment-o"></i><?php echo esc_attr($count) ?> <i class="lnr lnr-chat"></i></li>
                            <?php endif; ?>
                        
                        <?php if($simple_redata['post_like'] && function_exists('getPostLikeLink')): ?>  
                    <div class="post-like"><?php echo getPostLikeLink( get_the_ID() ); ?></div>
                    <?php endif; ?>
                        
                    </ul>

                    <div class="text">
                        <?php   if($post_format == 'video' || $post_format == 'audio')
                                    echo simple_text_limit(get_the_content(), 60);
                                else
                                    echo get_the_excerpt();    
                        ?>
                    </div>
                    <div class="extra_info">
                    <?php if(!is_single()): ?>
                    <a href="<?php echo get_permalink() ?>" class="btn-bt <?php echo esc_attr($simple_redata['overall_button_style'][0]) ?>"><span><?php _e('Read More', 'the-simple') ?></span><i class="lnr lnr-arrow-right"></i></a>
                    <?php endif; ?>
                    <?php if(is_single()): ?>
                    <?php if($simple_redata['blog_info_tags']): ?>
                        <?php if(!empty($tag_out) ): ?>
                                <div class="tags"><?php the_tags(  __('Tags', 'the-simple').": " , ', ', '<br />' ); ?></div>
                        <?php endif; ?>     
                        <?php endif; ?>
                    <?php endif; ?>
                    
                        <?php if($simple_redata['social_shares']): ?>
                            <?php 
                                
                                $google_plus_shares = '<a href="https://plus.google.com/share?url='.esc_url(get_permalink()).'" target="_blank">'; 
                                $facebook_shares = '<a href="http://www.facebook.com/sharer.php?u='.esc_url(get_permalink()).'" target="_blank">';
                                $twitter_shares = '<a href="http://twitter.com/home?status='.get_the_title().' '.esc_url(get_permalink()).'" target="_blank">';
                                $linkedin_shares = '<a href="http://linkedin.com/shareArticle?mini=true&amp;url='.esc_url(get_permalink()).'&title='.get_the_title().'" target="_blank">';
                                $reddit_shares = '<a href="http://reddit.com/submit?url='.esc_url(get_permalink()).'&title='.get_the_title().'" target="_blank">';
                                $tumblr_shares = '<a href="http://www.tumblr.com/share/link?url='.esc_url(get_permalink()).'&name='.get_the_title().'" target="_blank">';
                                $pinterest_shares ='<a href="http://pinterest.com/pin/create/button/?url='.esc_url(get_permalink()).'&description='.get_the_title().'&media='.esc_url(wp_get_attachment_url(get_post_thumbnail_id())).'" target="_blank">';
                                $digg_shares ='<a href="http://www.digg.com/submit?url='.esc_url(get_permalink()).' " target="_blank">';
                                $mail_shares = '<a href="mailto:?subject='.get_the_title().'&body='.esc_url(get_permalink()).'">';

                                ?>
                                
                                <div class="shares_container">
                                <div class="shares_title"><?php _e('Share: ', 'the-simple') ?> </div>
                                    <ul class="shares">                 
                                        <li class="facebook"><?php echo $facebook_shares; ?><i class="moon-facebook"></i></a></li>
                                        <li class="twitter"><?php echo $twitter_shares; ?><i class="moon-twitter"></i></a></li>
                                        <li class="google"><?php echo $google_plus_shares; ?><i class="moon-google"></i></a></li>
                                        <li class="tumblr"><?php echo $tumblr_shares; ?><i class="moon-tumblr"></i></a></li>    
                                    </ul>
                                    <!--<div class="share_link"><a href="#"><i class="moon-share-2"></i></a></div>-->
                                </div>
                        <?php endif; ?>
                    <?php } ?>

                </div>


             </div>

        </article>

    <?php endwhile; ?>
    
    <?php if(!is_single()): ?>

        <?php simple_pagination_display(); ?>
    
    <?php endif; ?>

<?php endif;

?>