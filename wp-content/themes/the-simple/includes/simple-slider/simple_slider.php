<?php

global $simple_redata;

class SimpleSlider {

	private $slider_id;
	private $height;

	var $output = array();

	function __construct($slider_id) {
		$this->slider_id = $slider_id;
		$this->createSlider();
		$this->getAllSlides();
		$this->closeSlider();
	}

	function createSlider(){
		global $simple_redata;
		if(isset($simple_redata['simple_slider_height']) && $simple_redata['simple_slider_height'] != '100%')
			$height = $simple_redata['simple_slider_height'];
		elseif(! isset($simple_redata['simple_slider_height']))
			$height = '450';
		else
			$height = 'fullscreen'; 

		$this->height = $height;

		$extra_class = '';
		if($simple_redata['slider_parallax']) 
			$extra_class .= ' parallax_slider';
		if($simple_redata['slider_shapes'] != 'normal')
			$extra_class .= ' '.$simple_redata['slider_shapes'];

		$speed = 10000;
		
		if(isset($simple_redata['simple_slider_speed']) && !empty($simple_redata['simple_slider_speed']) )
			$speed = $simple_redata['simple_slider_speed'];
	
		$output = '<div class="simple_slider_swiper '.esc_attr($extra_class).'" style="'.(($height == 'fullscreen')?'':'height:'.$height.'px').'">';
			$output .= '<div class="loading"><i class="moon-spinner icon-spin"></i></div>';
			$output .= '<div class="simple_slider_wrapper" data-start="transform: translateY(0px);" data-'.(($height == 'fullscreen')?'1440':$height).'="transform: translateY(-500px);">';
				$output .= '<div class="simple-slider-container swiper-parent swiper_slider simple_slider" data-speed="'.$speed.'"  data-slidenumber="1" data-height="'.esc_attr($height).'">';
                	$output .= '<div class="pagination-parent nav-thumbflip nav-slider">
                					<a class="prev" href="">
										<span class="icon-wrap"><i class="lnr lnr-chevron-left"></i></span>
										<div class="text">'.__('PREV','the-simple').'</div>
									</a>
									<a class="next" href="">
										<span class="icon-wrap"><i class="lnr lnr-chevron-right"></i></span>
										<div class="text">'.__('NEXT','the-simple').'</div>
									</a>
								</div>';
			        $output .= '<div class="swiper-wrapper">';
 
        $this->output[] = $output;
	}

	function closeSlider(){
		$output='';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>'; 
        $this->output[] = $output; 
	}

	function getAllSlides(){
		$term = get_term($this->slider_id, 'slider');
		$args = (array(
	        'post_type' => 'slide',
			'slider' => $term->slug,
			'posts_per_page' => -1
	    ));

	    $query = new WP_Query($args);

	    if ($query->have_posts()) :

    		while ($query->have_posts()) : $query->the_post();

    			$id = get_the_ID();
    			$title = get_the_title();

    			$this->output[] = $this->renderSlide();

    		endwhile;

    	endif;

    	wp_reset_postdata();

	}

	function renderSlide(){
		global $simple_redata;
		$extra_style = $extra_class = ' ';
		if($simple_redata['slide_background_type'] == 'image'){ 
			$extra_style .= $this->createBackgroundStyle(); 
		} 

		$title_style = $this->createTitleStyle();
		$description_style = $this->createDescriptionStyle();
		$image_style = $this->createImageStyle();
		$content_position = $this->contentPosition();
		

		$output = '<div class="swiper-slide" style="'.$extra_style.'" data-color="'.esc_attr($simple_redata['slider_menu_nav_colors']).'">';
			
			if(!isset($simple_redata['remove_container']) || !$simple_redata['remove_container'])
			$output .= '<div class="container">';  
				$output .= '<div class="content '.esc_attr($content_position['class']).'" style="'.$content_position['style'].'" data-start="opacity:1;" data-'.(($this->height == 'fullscreen')?'1000':$this->height-200).'="opacity: 0;">'; 
					
					if($simple_redata['slide_image_switch'])
						$output .= '<img style="'.$image_style.'" src="'.$simple_redata['slide_image_top']['url'].'" alt="" class="'.$simple_redata['slide_image_alignment'].'" />';

					$output .= '<h1 class="animated with_animation" data-maxfont="'.esc_attr($simple_redata['slide_title_style']['font-size']).'" data-animation="'.esc_attr($simple_redata['slide_title_animation']).'" style="'.$title_style.'">'.$simple_redata['slide_title'].'</h1>';
					if(!empty($simple_redata['slide_description']))
						$output .= '<p class="animated with_animation" data-maxfont="'.esc_attr($simple_redata['slide_description_style']['font-size']).'" data-animation="'.esc_attr($simple_redata['slide_description_animation']).'"  style="'.$description_style.'">'.$simple_redata['slide_description'].'</p>';
					if(!empty($simple_redata['slide_button1']) || !empty($simple_redata['slide_button2']) ):
						$output .= '<div class="buttons animated with_animation colors-'.esc_attr($simple_redata['slide_buttons_colors']).' align-'.esc_attr($simple_redata['slide_description_style']['text-align']).'" data-animation="fadeIn">';
							if(!empty($simple_redata['slide_button1']))
								$output .= '<a class="btn-bt '.esc_attr($simple_redata['overall_button_style'][0]).' '.esc_attr($simple_redata['slide_button1_style']).'" href="'.esc_url($simple_redata['slide_button1_link']).'"><span>'.$simple_redata['slide_button1'].'</span><i class="linea-arrows-right"></i></a>';
							if(!empty($simple_redata['slide_button2']))
								$output .= '<a class="btn-bt '.esc_attr($simple_redata['overall_button_style'][0]).' '.esc_attr($simple_redata['slide_button2_style']).'" href="'.esc_url($simple_redata['slide_button2_link']).'"><span>'.$simple_redata['slide_button2'].'</span><i class="linea-arrows-right"></i></a>';
						$output .= '</div>';
					endif;
				$output .= '</div>';
			if(!isset($simple_redata['remove_container']) || !$simple_redata['remove_container'])
			$output .= '</div>';

			if($simple_redata['slide_background_type'] == 'video')
				$output .= $this->createVideoMarkup();
			if(!empty($simple_redata['slide_bg_overlay']) )
				$output .= '<div class="bg-overlay" style="background:'.esc_attr($simple_redata['slide_bg_overlay']['color']).'; opacity:'.esc_attr($simple_redata['slide_bg_overlay']['alpha']).';"></div>';

		$output .= '</div>';

		return $output;
	}

	function createBackgroundStyle(){
		global $simple_redata;
		$extra_style = '';
		if(!empty($simple_redata['slide_background_image']))
			foreach($simple_redata['slide_background_image'] as $key => $value){
				if($key != 'media' && $key != 'background-image')
					$extra_style .= ' '. $key . ': '.$value.'; ';
			}

		if(!empty($simple_redata['slide_background_image']['background-image'])){
			$extra_style .= " background-image: url('".esc_url($simple_redata['slide_background_image']['background-image'])."'); ";
		}

		return $extra_style;
	}

	function createTitleStyle(){
		global $simple_redata;

		$title_style = ' font-family: '. esc_attr($simple_redata['slide_title_style']['font-family']).'; ';
		$title_style .= ' font-weight: '. esc_attr($simple_redata['slide_title_style']['font-weight']).'; ';
		$title_style .= ' font-size: '. esc_attr($simple_redata['slide_title_style']['font-size']).'; ';
		$title_style .= ' text-align: '. esc_attr($simple_redata['slide_title_style']['text-align']).'; ';
		$title_style .= ' line-height: '. esc_attr($simple_redata['slide_title_style']['line-height']).'; ';
		$title_style .= ' letter-spacing: '.esc_attr($simple_redata['slide_title_style']['letter-spacing']).'; ';
		$title_style .= ' text-transform: '. esc_attr($simple_redata['slide_title_style']['text-transform']).'; ';
		$title_style .= ' color: '. esc_attr($simple_redata['slide_title_style']['color']).'; '; 
		$title_style .= ' background-color: '.(is_array($simple_redata['slide_title_bg'])?'rgba('.implode(',', simple_hexToRgb($simple_redata['slide_title_bg']['color'])).', '.$simple_redata['slide_title_bg']['alpha'].')':$simple_redata['slide_title_bg'] ).'; ';
		$title_style .= ' padding-left: '. esc_attr($simple_redata['slide_title_padding']['padding-left']).'; '; 
		$title_style .= ' padding-right: '. esc_attr($simple_redata['slide_title_padding']['padding-right']).'; ';
		$title_style .= ' padding-top: '. esc_attr($simple_redata['slide_title_padding']['padding-top']).'; '; 
		$title_style .= ' padding-bottom: '. esc_attr($simple_redata['slide_title_padding']['padding-bottom']).'; '; 
		return $title_style;
	}

	function createDescriptionStyle(){
		global $simple_redata;
		
		$title_style = ' font-family: '. esc_attr($simple_redata['slide_description_style']['font-family']).'; ';
		$title_style .= ' font-weight: '. esc_attr($simple_redata['slide_description_style']['font-weight']).'; ';
		$title_style .= ' font-size: '. esc_attr($simple_redata['slide_description_style']['font-size']).'; ';
		$title_style .= ' text-align: '. esc_attr($simple_redata['slide_description_style']['text-align']).'; ';
		$title_style .= ' line-height: '. esc_attr($simple_redata['slide_description_style']['line-height']).'; ';
		$title_style .= ' text-transform: '. esc_attr($simple_redata['slide_description_style']['text-transform']).'; ';
		$title_style .= ' color: '. esc_attr($simple_redata['slide_description_style']['color']).'; ';

		return $title_style;
	}

	function createImageStyle(){
		global $simple_redata;
		
		$image_style = ' width: '. esc_attr($simple_redata['slide_image_dimension']['width']).'; ';
		$image_style .= ' height: '. esc_attr($simple_redata['slide_image_dimension']['height']).'; ';

		return $image_style;
	}

	function contentPosition(){
		global $simple_redata;

		$extra = array();
		$extra['style'] = '';
		$extra['class'] = '';

		if($simple_redata['slide_content_position'] == 'none'){
			$extra['style'] = 'position:absolute; top:'.esc_attr($simple_redata['slide_content_position_absolute']['top']).'; ';
			$extra['style'] .= 'left:'.esc_attr($simple_redata['slide_content_position_absolute']['left']).'; ';
			$extra['style'] .= 'right:'.esc_attr($simple_redata['slide_content_position_absolute']['right']).'; ';
			$extra['style'] .= 'bottom:'.esc_attr($simple_redata['slide_content_position_absolute']['bottom']).'; ';
		}

		if($simple_redata['slide_content_position'] == 'vertical_centered'){
			$extra['class'] = ' vertical_centered ';
			$extra['style'] .= ' position:absolute;left:'.esc_attr($simple_redata['slide_content_position_absolute']['left']).'; ';
			$extra['style'] .= ' right:'.esc_attr($simple_redata['slide_content_position_absolute']['right']).'; ';
		}

		if($simple_redata['slide_content_position'] == 'horizontal_centered'){
			$extra['class'] = ' horizontal_centered ';
			$extra['style'] .= ' top:'.esc_attr($simple_redata['slide_content_position_absolute']['top']).'; ';
			$extra['style'] .= ' bottom:'.esc_attr($simple_redata['slide_content_position_absolute']['bottom']).'; ';
		}

		$width = 'auto';

		if(strpos($simple_redata['slide_content_width'], 'px' ) !== false )
			$width = substr($simple_redata['slide_content_width'], 0, -2);

		if($simple_redata['slide_content_position'] == 'in_middle'){
			$extra['class'] = ' vertical_centered ';
			$extra['style'] .= 'position:absolute; left:50%; margin-left: -'.($width/2).'px; ';
		}

		$extra['style'] .= ' width:'.esc_attr($simple_redata['slide_content_width']).'; ';

		return $extra;
	}

	function createVideoMarkup(){
		global $simple_redata;
		$video_markup = '<div class="video-wrap">';
		$extra_mobile_cl = '';
			if(!empty($simple_redata['slide_mobile_video']['url']) ):
				$video_markup .= '<span class="video_replace_mobile" style="background-image:url('.esc_url($simple_redata['slide_mobile_video']['url']).' );"></span>';
				$extra_mobile_cl = 'remove_on_mobile';
			endif;
			$video_markup .= '<video class="'.$extra_mobile_cl.'" id="video_background" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0"> ';
				
				if(!empty($simple_redata['slide_webm_video']))
	        		$video_markup .= '<source src="'.esc_url($simple_redata['slide_webm_video']).'" type="video/webm">'; 
	            
	            if(!empty($simple_redata['slide_mp4_video']))
	            	$video_markup .= '<source src="'.esc_url($simple_redata['slide_mp4_video']).'" type="video/mp4">';
	            
	            if(!empty($simple_redata['slide_ogg_video']))
	            	$video_markup .= '<source src="'.esc_url($simple_redata['slide_ogg_video']).'" type="video/ogg">';  

	            $video_markup .= 'Video not supported';
	        $video_markup .= '</video>';
        $video_markup .= '</div>';

        return $video_markup;
	}

	function output(){
		echo implode("\n\n", $this->output);
	}

}

?>