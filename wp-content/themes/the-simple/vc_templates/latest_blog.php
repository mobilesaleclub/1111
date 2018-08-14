<?php 
    /**
 * Shortcode attributes
 * @var $atts
 * @var $dynamic_from_where
 * @var $carousel
 * @var $post_selected
 * @var $dynamic_cat
 * @var $style
 * @var $posts_per_page
 * Shortcode class
 * @var  WPBakeryShortCode_Latest_blog
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
global $simple_redata;
        $output = '<div class="latest_blog wpb_content_element '.esc_attr($style).'">';

        $all_posts=10;
        if($style == 'the-simple')
            $text_limit = 23;
        else
            $text_limit = 20;



       if($dynamic_from_where == 'all_cat'){
            $query_post = array('posts_per_page'=> $all_posts, 'post_type'=> 'post' ,  'cache_results'  => false);    

        }elseif($dynamic_from_where == 'one_post'){
           $query_post = array('p'=> $post_selected);   

        }else{
           $query_post = array('posts_per_page'=> $all_posts, 'post_type'=> 'post', 'cat' => $dynamic_cat, 'cache_results'  => false ); 
        }
        
        $queries = new WP_Query($query_post);

        if($queries->have_posts()){
            global $wp_query; 
          
            if($carousel == 'yes'){
                $output .= '<div class="blog_slider owl-carousel owl-theme"  data-slidenr="'.(((int)$queries->found_posts > (int)$posts_per_page)?$posts_per_page:$queries->found_posts).'">'; 
                    
            }else{
                $output .= '<div class="row no_carousel">';
            }
            while ($queries->have_posts()) : $queries->the_post();
                        
                        $post_format = get_post_format(get_the_ID());
                        
                        $post_categories = wp_get_post_categories( get_the_ID() );
                        $cats = '';
                        foreach($post_categories as $c){
                            $cat = get_category( $c );
                            $cats .= ' '.$cat->name.',';
                        }


                        /* Count comments*/
                        $cats = substr(trim($cats), 0, -1);

                        $count = 0;

                        $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => get_the_ID() ));

                        if(count($comment_entries) > 0){

                            foreach($comment_entries as $comment){

                                if($comment->comment_approved)

                                    $count++;

                            }

                        }

                        $output .= '<div class="'.( ($carousel == 'yes')?'':'' ).' blog-article grid-style blog-item  '.(($dynamic_from_where == 'one_post')?'single':'').'">'; 
                            //$output .= '<div class="gridbox">';
                                $output .= '<div class="media">';
                                if(function_exists('redux_post_meta'))
                                    $link = redux_post_meta('simple_redata',get_the_ID() ,'media_post_link');
                                else
                                    $link = '';

                                if($post_format == 'audio'){

                                    $output .= do_shortcode('[soundcloud]'.$link.'[/soundcloud]');

                                }elseif(get_post_thumbnail_id()){

                                     $output .= '<a href="'. esc_url(get_permalink()) .'"><div class="overlay"><div class="post_type_circle"><i class="lnr lnr-magnifier"></i></div></div></a>';
                       
                                    $output .= '<img src="'.esc_url(simple_image_by_id(get_post_thumbnail_id(), 'simple_port3', 'url')).'" alt="">';
                                                                    
                                }elseif($post_format == 'gallery'){

                                        $slider = new simple_slideshow(get_the_ID(), 'flexslider');

                                        if($slider && $slider->slide_number > 0){
                                            
                                            $slider->img_size = 'simple_port3';
                                            $sliderHtml = $slider->render_slideshow();
                                            $output .= $sliderHtml;

                                        }

                                }elseif($post_format == 'video'){

                                        $video = ""; 

                                        

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

                                        $output .= $video;

                                }
                            
                                $output .= '</div>';
                                $output .= '<div class="content">';
                                    
                                
                                $output .= '<h3><a href="'.get_permalink().'">'.esc_html(get_the_title()).'</a></h3>';
                                $output .= '<ul class="info">';
                                    $output .= '<li>'.__('Posted by', 'the-simple').' '.get_the_author().'</li>'; 
                                    $output .= '<li>'.__('On', 'the-simple').' '.get_the_date().'</li>';   
                                $output .= '</ul>';

                                    $output .= '<div class="text">';
                                        $output .= simple_text_limit(get_the_excerpt(), 22);
                                    $output .= '</div>';
                                    /*Read more button, comments and likes*/
                                    $output .= '<a href="'. get_permalink() .'" class="btn-bt '. esc_attr($simple_redata["overall_button_style"][0]) .'"><span>'.__("Read More", "the-simple") .'</span><i class="lnr lnr-arrow-right"></i></a>';?>

                                     <?php if($simple_redata['blog_info_comments']){                  
                                    $output .= '<div class="latest_post_comments"><i class="icon-comment-o"></i>'. $count .' </div>';?>
                                    <?php } ?>
                        
                                    <?php if($simple_redata['post_like'] && function_exists('getPostLikeLink')){
                                $output .= '<div class="post-like">'.getPostLikeLink( get_the_ID() ) .'</div>';?>
                                <?php } ?>

                               <?php  //$output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
            endwhile;
           
            if($carousel == 'yes'){
                $output .= '</div>';
             }else{
                $output .= '</div>';
            }
         wp_reset_postdata();
        }
       
        $output .= '</div>';

         

        echo $output;
?>