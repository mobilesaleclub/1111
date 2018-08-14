<?php

$simple_redata = simple_redata_variable();

do_action('simple_excecute_query_var_action','loop-index');

if (have_posts()) :
    
    while (have_posts()) : the_post();
        
        $post_id    = get_the_ID();
        $title      = get_the_title();
        $font_color = ($simple_redata['page_header_menu_color'] == 'auto')? '':'background--'.$simple_redata['page_header_menu_color'];
        
         $count = 0;

        $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => $post->ID ));

        if(count($comment_entries) > 0){

            foreach($comment_entries as $comment){

                if($comment->comment_approved)

                    $count++;

            }

        }

         $post_categories = wp_get_post_categories( $post_id );
        $cats = '';
            
        foreach($post_categories as $c){
            $cat = get_category( $c );
            $cats .= ' <a href='.get_category_link($cat->cat_ID).'>'.$cat->name.'</a>,';
        }
        $cats = substr(trim($cats), 0, -1);

        ?> 
        <article id="post-<?php echo the_ID(); ?>" <?php echo post_class('blog-article fullscreen-single '.$font_color.' intro-effect-push'); ?>>
			<div class="header_fullscreen_single">
				<div class="bg-img" style="background-image:url(<?php echo esc_url(simple_image_by_id(get_post_thumbnail_id(), '', 'url')) ?>)"></div>
				<div class="title">
					<h1><?php echo esc_html($title) ?></h1>
				</div>
			</div>
			<button class="trigger"><span>Trigger</span></button>
			<div class="title">
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

			</div>
			<div class="content">
				<div class="text">
					<?php the_content() ?>
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
                        </div>
                        

                     </div>
			</div>

        </article>
		<div class="content">
        <?php comments_template( '/includes/view/blog/comments.php');  ?>
        </div>
		<?php

    endwhile;
endif;


?>

