<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $image
 * @var $video
 * @var $alignment
 * @var $width
 * @var $animation
 * @var $link
 * @var shadow
 * Shortcode class
 * @var  WPBakeryShortCode_Media
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts ); 
        
        if(isset($shadow) && $shadow == 'yes')
            $shadow_box = ' shadow_box';

		$output = '<div class="wpb_content_element media media_el '.esc_attr($shadow).' animate_onoffset">';
        $width_style="";
        if($alignment == 'center')
            $width_style = 'style="width:'.$width.'px;position:relative; left:50%; margin-left:-'.($width/2).'px;" ';
        if($type == 'image'){
            if(isset($image)){
            	if(!empty($image)) {
            
	                if(strpos($image, "http://") !== false){
	                    $image = $image;
	                } else {
	                    $bg_image_src = wp_get_attachment_image_src($image, 'full');
	                    $image = $bg_image_src[0];
	                }
	            }
                $output .= '<img src="'.esc_url($image).'" alt="" class="type_image media_animation animation_'.esc_attr($animation).' alignment_'.esc_attr($alignment).'" '.$width_style.' />';
            }
        }

        if($type == 'video'){
            $output .= '<div class="video_embeded" '.$width_style.'>';
            if(isset($video)){
                global $wp_embed;
                $output .= $wp_embed->run_shortcode('[embed class="animation_'.$animation.' video alignment_'.$alignment.' '.$width_style.'"]'.trim($video).'[/embed]');
            }
            $output .= '</div>';
        }

     
        
        $output .= '</div>';
        echo $output; 
?>