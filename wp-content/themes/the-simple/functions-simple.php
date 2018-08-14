<?php
/*--------------------- Create Author Box ----------------------------------- */

function simple_author_box(){
  $output = '<dl class="author_box dl-horizontal">';
    $output .= '<dt>'.get_avatar(get_the_author_meta( 'ID' ), 64).'</dt>';
    $output .= '<dd>';
      $output .= '<h5>'.__('About', 'the-simple').' '.get_the_author().'</h5>';
      $output .= '<p>'.get_the_author_meta('description').'</p>';
    $output .= '</dd>';
  $output .= '</dl>';

  return $output;
}

/*--------------------- End Create Author Box  ------------------------------- */


if (class_exists('WPBakeryVisualComposerAbstract')) {
  function simple_vc_iconselect($settings, $value) {
     $dependency = '';
    
    $output = '';
 
    $output .= '<select id="iconselect" name="'.esc_attr($settings['param_name']).'" class="iconselect wpb_vc_param_value '.esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'_field"  ' . $dependency . '>';
        $icons = simple_icons();
        foreach($icons as $icon => $i){
          $selected = '';
          if($value == $icon)
            $selected = 'selected="selected"';
          $output .= '<option value="'.esc_attr($icon).'" '.$selected.'>'.$icon.'</option>';
        }
    $output .= '</select>';

    
    return $output;  
  }

  WpbakeryShortcodeParams::addField('iconselect', 'simple_vc_iconselect', get_template_directory_uri().'/js/jquery.fonticonpicker.min.js');  

}


/*--------------------- Pagination Function ---------------------------------- */

function simple_pagination($pages = '', $range = 2){
    
    $showitems = ($range * 2)+1;  

     global $paged;
     if(!empty($paged)){
        if(isset($GLOBALS['paged']) && !empty($GLOBALS['paged']))
           $paged = $GLOBALS['paged'];
      }else{
        $paged = 1;
      }
         
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {  
                 $next_link = '';
                 if($paged + 1 == $i)
                  $next_link = 'next_link';
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive ".$next_link." \">".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}

/*--------------------- End Pagination Function ---------------------------------- */

/* -------------------- Pagination Display --------------------------------------- */
function simple_pagination_display(){
  global $simple_redata, $simple_current_view;
  $show = '';
  $infinite = '';
  $show_p='';

  if( ($simple_current_view == 'blog' && $simple_redata['blog_pagination'] == 'no_pagination') || ($simple_current_view == 'portfolio' && $simple_redata['portfolio_pagination'] == 'no_pagination') )
    $show = 'hide_this';

  if(($simple_current_view == 'blog' && $simple_redata['blog_pagination'] == 'infinite_scroll' ) || ($simple_current_view == 'portfolio' && $simple_redata['portfolio_pagination'] == 'infinite_scroll') )
    $infinite = 'infinite_scroll_pag';


  echo '<div class="p_pagination '.$show.' '.$infinite.'">';
  if( ($simple_current_view == 'blog' && $simple_redata['blog_pagination'] == 'load_more' ) || ($simple_current_view == 'portfolio' && $simple_redata['portfolio_pagination'] == 'load_more') )
    echo '<a href="#" class="btn-bt '.$simple_redata['overall_button_style'][0].' load_more_button">'.__('Load More', 'the-simple').'</a>';
  
  if( ($simple_current_view == 'blog' && $simple_redata['blog_pagination'] != 'with_pagination') || ($simple_current_view == 'portfolio' && $simple_redata['portfolio_pagination'] != 'with_pagination') )
  $show_p = 'hide_this';



  echo '<div class="with_pagination '.$show_p.'">'; 
  simple_pagination();
  echo '</div>';
  echo '</div>';

}

/* -------------------- End Pagination Display ----------------------------------- */



/*--------------------- Default Menu Items ------------------------------------- */
/* When no menu has selected */

if(!function_exists('simple_default_menu')){
  
    function simple_default_menu($args){
        
      $current = "";
      if (is_front_page())
        $current = "class='current-menu-item'";
      
      echo "<ul class='menu'>";

        echo "<li $current><a href='".esc_url(home_url('/'))."'>".__('Home' , 'the-simple')."</a></li>";
        wp_list_pages('title_li=&sort_column=menu_order&number=2&depth=0');

      echo "</ul>";

    }
}

/*--------------------- End Default Menu Items --------------------------------- */




/*--------------------- Check for custom sidebars in options ------------------- */

function simple_check_custom_sidebar($type){
global $simple_redata, $simple_current_view;
    $id_array = '';

    if($type == 'page' && isset($simple_redata['pages_sidebar']) && !empty($simple_redata['pages_sidebar']))
    {
        $id_array = $simple_redata['pages_sidebar'];
    }
    else if($type == 'cat' && isset($simple_redata['categories_sidebar']) && !empty($simple_redata['categories_sidebar']))
    {
        $id_array = $simple_redata['categories_sidebar'];
    }

    if(is_array($id_array))

    {
        if(is_page($id_array))
        {  
          
          return get_the_title();
        }
        else if(is_category($id_array))
        {
            return single_cat_title( "", false );
        }
    }
}

/*--------------------- End Check for custom sidebars in options ---------------- */




/* -------------------- Get Logo Image ------------------------------------------ */

if(!function_exists('simple_logo'))
{

    function simple_logo($default = "")
    {
        global $simple_redata;
        
        $output = '';
        if(!empty($simple_redata['logo']['url']) || !empty($simple_redata['logo_light']['url']) )
        {

            if(!empty($simple_redata['logo']['url']))
              $logo = "<img class='dark' src=".esc_url($simple_redata['logo']['url'])." alt='' />";
            if(!empty($simple_redata['logo_light']['url']))
              $logo_light = "<img class='light' src=".esc_url($simple_redata['logo_light']['url'])." alt='' />";
            
            $logo = "<a href='".esc_url(home_url('/'))."'>".$logo.$logo_light."</a>";
        }
        else
        { 
            $logo = get_bloginfo('name');
            if($default != '') $logo = "<img src=".esc_url($default)." alt='' title='$logo'/>";
            $logo = "<a href='".esc_url(home_url('/'))."'>".$logo."</a>";
        }
    
        return $logo;
    }
}

/* -------------------- End Get Logo Image ------------------------------------------ */








/* -------------------- Get Page Parents -------------------------------------------- */

function simple_page_parents() {
    global $post, $wp_query, $wpdb;
    
    if((int) simple_get_post_id() != 0){
      $post = $wp_query->post;

      $parent_array = array();
      $current_page = $post->ID;
      $parent = 1;
      while($parent) {
      $sql = $wpdb->prepare("SELECT ID, post_parent FROM $wpdb->posts WHERE ID = %d; ", array($current_page) );
      $page_query = $wpdb->get_row($sql);
      $parent = $current_page = $page_query->post_parent;
      if($parent)
          $parent_array[] = $page_query->post_parent;
      }

      return $parent_array;
    }
    
}

/* -------------------- End Get Page Parents -------------------------------------------- */



/* -------------------- Set VC config file ---------------------------------------------- */

if(function_exists('vc_set_as_theme')) 
  vc_set_as_theme();

if (class_exists('WPBakeryVisualComposerAbstract')) {
  function simple_active_vc(){
    require_once  get_template_directory().'/includes/core/simple_elements.php';
  }
  add_action('init','simple_active_vc', 5 );
}

/* -------------------- End Set VC config file ------------------------------------------ */



/* ------------------- Add Body Classes ----------------------------------*/

add_filter('body_class', 'simple_header_class');
function simple_header_class($classes = ''){
  global $simple_redata;
  $header_class = $simple_redata['header_style']; 

  $classes[] = $header_class;
  if($simple_redata['comingsoon_page'] != '')
    if($simple_redata['comingsoon_page'] == get_the_ID() ):
      $classes[] = 'comingsoon_page ';
    endif;

  return $classes; 
}
add_filter('body_class', 'simple_page_header_fixed_class');
function simple_page_header_fixed_class($classes = ''){
  global $simple_redata;
  $header_class = $simple_redata['fixed_header_page']; 
if($header_class == 1)
  $classes[] = 'fixed_header_page';

  return $classes; 
}

add_filter('body_class', 'simple_outter_padding');
function simple_outter_padding($classes = ''){
    global $simple_redata;

    if(isset($simple_redata['outter_padding']) && $simple_redata['outter_padding'])
      $classes[] = 'outter_padding';
    return $classes;
}

add_filter('body_class', 'simple_slider_class');
function simple_slider_class($classes = ''){

  $slider = new simple_slideshow(simple_get_post_id());
  if($slider && $slider->slide_number > 0 && $slider->slide_type != '' && $slider->slide_type != 'none'){
    if($slider->options['slideshow_layout'] == 'boxed')
      $classes[] = 'fixed_slider';
    else
      $classes[] = 'fullwidth_slider_page';   
  }
  return $classes;
}

add_filter('body_class', 'simple_sticky_logo');
function simple_sticky_logo($classes = ''){
  global $simple_redata;
  if($simple_redata['sticky_logo']){
      $classes[] = 'logo_only_sticky';
  }
  return $classes;
}


add_filter('body_class', 'simple_page_header_class');
function simple_page_header_class($classes = ''){

    if(function_exists('redux_post_meta')){
      $page_header_bool =redux_post_meta('simple_redata',(int) simple_get_post_id(), 'page_header_bool');
      $page_header_style = redux_post_meta('simple_redata',(int) simple_get_post_id(), 'page_header_style');
    }else{
      $page_header_bool = 0;
      $page_header_style = 'none';

    }
    

    if( (int) simple_get_post_id() != 0){ 
    
     
      if(($page_header_bool) || is_404() || is_search() || is_archive() )
          $classes[] = 'page_header_yes';

      if( $page_header_bool && $page_header_style == 'centered')
          $classes[] = 'page_header_centered';  
        if( $page_header_bool && $page_header_style == 'left')
          $classes[] = 'page_header_left';  
    }
    return $classes;

}


add_filter('body_class', 'simple_nicescroll_class');
function simple_nicescroll_class($classes = ''){
    global $simple_redata;
    if($simple_redata['nicescroll'])
        $classes[] = 'nicescroll';
    return $classes;

}

add_filter('body_class', 'simple_fullpage_onepage');
function simple_fullpage_onepage($classes = ''){
    global $simple_redata;
    if($simple_redata['blog_style'] == 'fullscreen' && (simple_get_post_id() == $simple_redata['blogpage'] || simple_get_post_id() == '3311'))
      $classes[] =' fullpage_onepage'; 
    return $classes;

}

add_filter('body_class', 'simple_page_header_color');
function simple_page_header_color($classes = ''){

    if(!function_exists('redux_post_meta'))
        $page_header_menu_color = 'light';
    else
        $page_header_menu_color = redux_post_meta('simple_redata',(int) simple_get_post_id(), 'page_header_menu_color');

    if( (int) simple_get_post_id() != 0 ){ 

      if($page_header_menu_color == 'auto')
        $classes[] =' auto_color_check';  
    }
    return $classes;
}

add_filter('body_class', 'simple_one_page_active');
function simple_one_page_active($classes = ''){
    if( (int) simple_get_post_id() != 0 && function_exists('redux_post_meta') ){ 
      if(redux_post_meta('simple_redata',(int) simple_get_post_id(), 'one_page_active'))
        $classes[] = 'one_page';  
    }
    return $classes;
}

add_filter('body_class', 'simple_sticky_active');
function simple_sticky_active($classes = ''){
    global $simple_redata;

    if($simple_redata['sticky'])
      $classes[] = 'sticky_active';
    return $classes;
}

add_filter('body_class', 'simple_shadow');
function simple_shadow($classes = ''){
    global $simple_redata;

    if(isset($simple_redata['header_shadow']) && $simple_redata['header_shadow'] != 'no_shadow')
      $classes[] = 'header_shadow_'.$simple_redata['header_shadow'];
    return $classes;
}

add_filter('body_class', 'simple_fullwidthheader');
function simple_fullwidthheader($classes = ''){
    global $simple_redata;

    if(isset($simple_redata['header_container_full']) && $simple_redata['header_container_full'])
      $classes[] = 'fullwidth_header';
    return $classes;
}

add_filter('body_class', 'simple_fullwidthfooter');
function simple_fullwidthfooter($classes = ''){
    global $simple_redata;

    if(isset($simple_redata['footer_container_full']) && $simple_redata['footer_container_full'])
      $classes[] = 'fullwidth_footer';
    return $classes;
}

add_filter('body_class', 'simple_header_transparent');
function simple_header_transparent($classes = ''){
    global $simple_redata;
    
    if(isset($simple_redata['header_transparency']) && $simple_redata['header_transparency'])
      $classes[] = 'header_transparency';
    return $classes; 
}
/* transparent left/right header*/
add_filter('body_class', 'simple_header_transparent_padding');
function simple_header_transparent_padding($classes = ''){
    global $simple_redata;
    
    if($simple_redata['header_style'] == 'header_7' && $simple_redata['header_7_transparent_padding'])
      $classes[] = 'transparent_padding';
    return $classes; 
}

/* snap Drawer */
add_filter('body_class', 'simple_snapdrawer');
function simple_snapdrawer($classes = ''){
    global $simple_redata;

    if($simple_redata['responsive_menu_dropdown'] && $simple_redata['responsive_menu_style']=='sidemenu')
        $classes[] = 'sidemenu';
    return $classes;
}




add_filter('body_class', 'simple_header_remove_slider_mobile');
function simple_header_remove_slider_mobile($classes = ''){
  global $simple_redata;
  if((int) simple_get_post_id() != 0 && function_exists('redux_post_meta'))
      $slider_onmobile_remove = redux_post_meta('simple_redata',(int) simple_get_post_id(), 'slider_onmobile_remove');
  else
      $slider_onmobile_remove = 0;

  if($slider_onmobile_remove)
    $classes[] = 'remove_slider_onmobile';
  return $classes;

}

/* ------------------- End Add Body Classes ----------------------------------*/

/* ------------------- Page transition effect ----------------------------------*/

function simple_header_transitions($type){
  global $simple_redata;
  
  $transition['class'] = '';
  $transition['attr'] = '';

  if($simple_redata['simple_page_transition']):
    $transition['attr'] = 'data-animsition-in-class="'.esc_attr($simple_redata['page_transition_in']).'" data-animsition-in-duration="'.esc_attr($simple_redata['page_transition_in_duration']).'" data-animsition-out-class="'.esc_attr($simple_redata['page_transition_out']).'" data-animsition-out-duration="'.esc_attr($simple_redata['page_transition_out_duration']).'"';
    $transition['class'] = 'animsition';
  endif;

  if($type == 'class')
    return $transition['class'];

  if($type == 'attr')
    return $transition['attr'];
}


/* ------------------- MasonryWidthCustom ----------------------------------- */

function simple_getRandomWeightedElement(array $weightedValues) {
    $rand = mt_rand(1, (int) array_sum($weightedValues));

    foreach ($weightedValues as $key => $value) {
      $rand -= $value;
      if ($rand <= 0) {
        return $key;
      }
    }
}

/* ------------------- End Masonry WidthCustom ------------------------------ */


/* ------------------- Color Lighter Darker --------------------------------- */

function simple_adjustBrightness($hex, $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Format the hex color string
    if(is_array($hex) ) $hex = $hex['color'];
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Get decimal values
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));

    // Adjust number of steps and keep it inside 0 to 255
    $r = max(0,min(255,$r + $steps));
    $g = max(0,min(255,$g + $steps));  
    $b = max(0,min(255,$b + $steps));

    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

    return '#'.$r_hex.$g_hex.$b_hex;
}

/* ------------------- End Color Lighter Darker ----------------------------- */

/* ------------------- Get top ancestor_id ------------------------------------ */

if(!function_exists('simple_get_post_top_ancestor_id')){

    function simple_get_post_top_ancestor_id(){
        global $post;
        
        if($post->post_parent){
            $ancestors = array_reverse(get_post_ancestors($post->ID));
            return $ancestors[0];
        }
        
        return $post->ID;
    }
}


/* ------------------- Simple Animations Array -----------------------------*/

function simple_animations(){
    return array(
                    'none'  => 'None',
                    'flash' => 'flash',
                    'bounce' => 'bounce',
                    'shake' => 'shake',
                    'tada' => 'tada',
                    'wobble' => 'wobble',
                    'pulse' => 'pulse',
                    'flip' => 'flip',
                    'flipInX' => 'flipInX',
                    'flipOutX' => 'flipOutX',
                    'flipInY' => 'flipInY',
                    'flipOutY' => 'flipOutY',
                    'fadeIn' => 'fadeIn',
                    'fadeInUp' => 'fadeInUp',
                    'fadeInDown' => 'fadeInDown',
                    'fadeInLeft' => 'fadeInLeft',
                    'fadeInRight' => 'fadeInRight',
                    'fadeInUpBig' => 'fadeInUpBig',
                    'fadeInDownBig' => 'fadeInDownBig',
                    'fadeInLeftBig' => 'fadeInLeftBig',
                    'fadeInRightBig' => 'fadeInRightBig',
                    'fadeOut' => 'fadeOut',
                    'fadeOutUp' => 'fadeOutUp',
                    'fadeOutDown' => 'fadeOutDown',
                    'fadeOutLeft' => 'fadeOutLeft',
                    'fadeOutRight' => 'fadeOutRight',
                    'fadeOutUpBig' => 'fadeOutUpBig',
                    'fadeOutDownBig' => 'fadeOutDownBig',
                    'fadeOutLeftBig' => 'fadeOutLeftBig',
                    'fadeOutRightBig' => 'fadeOutRightBig',
                    'slideInDown' => 'slideInDown',
                    'slideInLeft' => 'slideInLeft',
                    'slideInRight' => 'slideInRight',
                    'slideOutUp' => 'slideOutUp',
                    'slideOutLeft' => 'slideOutLeft',
                    'slideOutRight' => 'slideOutRight',
                    'bounceIn' => 'bounceIn',
                    'bounceInDown' => 'bounceInDown',
                    'bounceInUp' => 'bounceInUp',
                    'bounceInLeft' => 'bounceInLeft',
                    'bounceInRight' => 'bounceInRight',
                    'bounceOut' => 'bounceOut',
                    'bounceOutDown' => 'bounceOutDown',
                    'bounceOutUp' => 'bounceOutUp',
                    'bounceOutLeft' => 'bounceOutLeft',
                    'bounceOutRight' => 'bounceOutRight',
                    'rotateIn' => 'rotateIn',
                    'rotateInDownLeft' => 'rotateInDownLeft',
                    'rotateInDownRight' => 'rotateInDownRight',
                    'rotateInUpLeft' => 'rotateInUpLeft',
                    'rotateInUpRight' => 'rotateInUpRight',
                    'rotateOut' => 'rotateOut',
                    'rotateOutDownLeft' => 'rotateOutDownLeft',
                    'rotateOutDownRight' => 'rotateOutDownRight',
                    'rotateOutUpLeft' => 'rotateOutUpLeft',
                    'rotateOutUpRight' => 'rotateOutUpRight',
                    'lightSpeedIn' => 'lightSpeedIn',
                    'lightSpeedOut' => 'lightSpeedOut',
                    'hinge' => 'hinge',
                    'rollIn' => 'rollIn',
                    'rollOut' => 'rollOut');
    
}


function simple_getPortfolioFields(){
  $simple_redata = get_option( 'simple_redata' );
  $description_fields = '';
  if(!empty($simple_redata['single_portfolio_custom_params']) ): 
      for($i = 0; $i < count($simple_redata['single_portfolio_custom_params']); $i++):
          $description_fields .= ($i+1).". ".$simple_redata['single_portfolio_custom_params'][$i]."<br />  ";
      endfor;
  endif;

  return $description_fields;
}



set_time_limit(0);



function simple_default_redata(){

  global $simple_redata;

if(!class_exists('ElleFramework')){
  $simple_redata = array (
    'responsive_bool' => 1,
    'logo' => 
    array (
      'url' => get_template_directory_uri().'/img/logo.png',
    ),
    'logo_light' => 
    array (
      'url' => get_template_directory_uri().'/img/logo_light.png',
    ),
    'logo_height' => 
    array (
      'height' => 25,
    ),
    'nicescroll' => 0,
    'simple_page_transition' => 0,
    'page_transition_in' => 'fade-in',
    'page_transition_in_duration' => '1000',
    'page_transition_out' => 'fade-out',
    'page_transition_out_duration' => '1000',
    'frontpage' => '0',
    'blogpage' => '0',
    'comingsoon_page' => '0',
    '404_error_message' => 'Sorry but the page you are looking for has not been found. Try checking the URL for errors, then bit the refresh button on your browser',
    'bg_image_404' => 
    array (
      'background-color' => '#f5f5f5',
    ),
    'tracking_code' => '/*jQuery(document).ready(function(){

  });*/',
    'custom_css' => '/*#header{
  margin: 0 auto;
  }*/',
    'custom_js' => '/*jQuery(document).ready(function(){

  });*/',
    'header_style' => 'header_1',
    'header_transparency' => 1,
    'header_shapes' => 'normal',
    'header_gradient_transparency' => 0,
    'header_overlay_color' => 
    array (
      'color' => '#000000',
      'alpha' => '0.95',
    ),
    'header_navigation' => 
    array (
      'color' => '#000000',
      'alpha' => '1.00',
    ),
    'header_6_nav_height' => 
    array (
      'height' => 45,
    ),
    'header_6_transparent' => 0,
    'header_7_width' => 
    array (
      'width' => 280,
    ),
    'header_7_padding' => 
    array (
      'padding-left' => '20px',
      'padding-right' => '20px',
      'padding-top' => '20px',
      'padding-bottom' => '20px',
    ),
    'header_7_margin' => 
    array (
      'margin-top' => '40px',
    ),
    'header_7_position' => 'left',
    'header_7_border' => 0,
    'header_7_border_top' => 0,
    'header_7_transparent_padding' => 0,
    'header_10_border' => 1,
    'header_height' => 
    array (
      'height' => 100,
    ),
    'header_background' => 
    array (
      'color' => '#fff',
      'alpha' => '0.0',
    ),
    'show_search' => '1',
    'show_cart' => '1',
    'header_container_full' => '0',
    'show_button' => '0',
    'header_button' => 'Donate Now',
    'header_button_link' => '#',
    'header_border_bottom' => 0,
    'header_border_bottom_content' => 0,
    'header_shadow' => 'no_shadow',
    'responsive_menu_dropdown' => 1,
    'responsive_menu_style' => 'normal',
    'header_responsive_tools' => 0,
    'menu_font_style' => 
    array (
      'color' => '#222',
      'font-weight' => '400',
      'font-family' => 'Lato',
      'google' => true,
      'font-size' => '13px',
      'line-height' => '20px',
      'text-align' => 'center',
      'font-style' => 'normal',
      'text-transform' => 'uppercase',
      'letter-spacing' => '1px',
    ),
    'menu_padding' => 
    array (
      'padding-left' => '5px',
      'padding-right' => '5px',
    ),
    'menu_margin' => 
    array (
      'margin-left' => '0px',
      'margin-right' => '0px',
    ),
    'dropdown_width' => 
    array (
      'width' => 220,
    ),
    'background_dropdown' => 
    array (
      'color' => '#111111',
      'alpha' => '0.93',
    ),
    'dropdown_border_color' => '#282828',
    'dropdown_font' => 
    array (
      'color' => '#9e9e9e',
      'font-size' => '13px',
      'letter-spacing' => '0.5px',
      'text-transform' => 'capitalize',
    ),
    'megamenu_title' => 
    array (
      'color' => '#fff',
      'font-size' => '14px',
      'font-weight' => '600',
      'letter-spacing' => '1px',
      'text-transform' => 'uppercase',
    ),
    'cart_dropdown_button' => 'dark',
    'top_navigation' => 0,
    'top_navigation_transparency' => 0,
    'topnav_bg' => '#f5f5f5',
    'topnav_border_top' => 
    array (
      'color' => '',
      'border-style' => 'solid',
      'border-top' => '0px',
    ),
    'topnav_border_bottom' => 
    array (
      'color' => '#f2f2f2',
      'border-style' => 'solid',
      'border-bottom' => '0px',
    ),
    'topnav_border_bottom_container' => 
    array (
      'color' => '#f2f2f2',
      'border-style' => 'solid',
      'border-bottom' => '0px',
    ),
    'topnav_font_style' => 
    array (
      'color' => '#999',
      'font-family' => 'Open Sans',
      'google' => true,
      'font-size' => '11px',
    ),
    'topnav_height' => 
    array (
      'height' => 40,
    ),
    'page_header_bool' => 1,
    'page_header_height' => 
    array (
      'height' => 100,
    ),
    'page_header_style' => 'normal',
    'page_header_f_color' => '#333',
    'page_header_background' => 
    array (
      'background-color' => '#f5f5f5',
    ),
    'page_header_border' => 
    array (
      'color' => '',
      'border-style' => 'solid',
      'border-bottom' => '0px',
    ),
    'sticky' => 1,
    'sticky_header_height' => 
    array (
      'height' => 60,
    ),
    'sticky_header_background' => 
    array (
      'color' => '#fff',
      'alpha' => '0.80',
    ),
    'sticky_logo' => 0,
    'primary_color' => '#3cc7c6',
    'body_font_color' => '#565656',
    'headings_font_color' => '#444444',
    'base_border_color' => '#e7e7e7',
    'highlighted_background_main' => '#f5f5f5',
    'body_background' => 'transparent',
    'page_content_background_overall' => 'transparent',
    'page_header_normal_typography' => 
    array (
      'font-size' => '32px',
      'font-weight' => '300',
      'text-transform' => 'none',
    ),
    'page_header_normal_typography_subtitle_title' => 
    array (
      'font-size' => '32px',
      'font-weight' => '300',
      'text-transform' => 'none',
    ),
    'page_header_normal_typography_subtitle_subtitle' => 
    array (
      'font-size' => '15px',
      'font-weight' => '400',
      'text-transform' => 'none',
    ),
    'page_header_centered_typography_nosub_title' => 
    array (
      'font-size' => '70px',
      'font-weight' => '300',
      'text-transform' => 'none',
      'line-height' => '80px',
      'font-style' => 'normal',
    ),
    'page_header_centered_typography_subtitle_title' => 
    array (
      'font-size' => '70px',
      'font-weight' => '300',
      'text-transform' => 'none',
      'letter-spacing' => '1px',
      'line-height' => '80px',
    ),
    'page_header_centered_typography_subtitle_subtitle' => 
    array (
      'font-size' => '20px',
      'font-family' => 'Raleway',
      'font-weight' => '400',
      'text-transform' => 'capitalize',
      'line-height' => '30px',
    ),
    'page_header_design_style' => 'normal',
    'page_header_padd_bg_title' => 
    array (
      'color' => '#000',
      'alpha' => '0.70',
    ),
    'page_header_padd_bg_subtitle' => 
    array (
      'color' => '#fff',
      'alpha' => '0.70',
    ),
    'page_header_padd_bg_subtitle_font' => '#222',
    'fppter_headings_typography' => 
    array (
      'color' => '#f2f2f2',
      'font-weight' => '600',
      'text-transform' => 'uppercase',
      'letter-spacing' => '2px',
    ),
    'footer_body_color' => '#888888',
    'footer_links_color' => '#bbbbbb',
    'footer_background_color' => 
    array (
      'background-color' => '#262626',
    ),
    'copyright_background_color' => '#212121',
    'footer_border_top' => 
    array (
      'color' => '',
      'border-style' => 'solid',
      'border-top' => '0px',
    ),
    'footer_social_icons_bg' => '#333333',
    'footer_social_icons_font_color' => '#777777',
    'blog_title_typography' => 
    array (
      'font-family' => 'Lato',
      'font-weight' => '400',
      'color' => '#444444',
      'text-transform' => 'capitalize',
      'line-height' => '30px',
      'font-size' => '28px',
    ),
    'blog_info_typography' => 
    array (
      'color' => '#999999',
      'font-size' => '12px',
      'line-height' => '20px',
    ),
    'blog_info_typography_icon' => 
    array (
      'font-size' => '13px',
    ),
    'timeline_box_shadow' => 1,
    'timeline_bg_color' => '#ffffff',
    'fullscreen_blog_box_bg' => 
    array (
      'color' => '#ffffff',
      'alpha' => '0.00',
    ),
    'sidebar_widget_title' => 
    array (
      'font-weight' => '600',
      'color' => '#444444',
      'font-size' => '15px',
      'text-transform' => 'uppercase',
      'line-height' => '20px',
      'letter-spacing' => '1px',
    ),
    'sidebar_widget_title_margin' => 
    array (
      'margin-bottom' => '24px',
    ),
    'sidebar_widget_margin' => 
    array (
      'margin-bottom' => '35px',
    ),
    'sidebar_tagcloud_bg' => '#fff',
    'sidebar_tagcloud_border' => 
    array (
      'color' => '#e5e5e5',
      'border-style' => 'solid',
      'border-width' => '1px',
    ),
    'sidebar_tagcloud_color' => '#444',
    'simple_slider_wrapper_bg' => '#222',
    'portfolio_filter_basic_typography' => 
    array (
      'font-weight' => '400',
      'font-size' => '14px',
      'color' => '#757575',
      'text-transform' => 'uppercase',
      'letter-spacing' => '1px',
    ),
    'portfolio_filter_basic_typography_active' => '#222',
    'portfolio_filter_full_bg' => '#222',
    'portfolio_filter_full_link_color' => 
    array (
      'color' => '#ffffff',
      'alpha' => '0.80',
    ),
    'portfolio_filter_full_link_color_hover' => 
    array (
      'color' => '#ffffff',
      'alpha' => '1.00',
    ),
    'portfolio_overlay_bg' => 
    array (
      'color' => '#3cc7c6',
      'alpha' => '0.82',
    ),
    'portfolio_overlay_title' => 
    array (
      'font-weight' => '600',
      'color' => '#fff',
      'text-transform' => 'uppercase',
      'letter-spacing' => '1px',
    ),
    'portfolio_overlay_subtitle' => 
    array (
      'font-size' => '14px',
      'font-weight' => '300',
      'color' => '#fff',
      'text-transform' => 'none',
    ),
    'portfolio_grayscale_bg' => '#fff',
    'portfolio_grayscale_title' => 
    array (
      'color' => '',
      'font-weight' => '400',
    ),
    'portfolio_grayscale_subtitle' => '#bebebe',
    'portfolio_basic_overlay_bg' => 
    array (
      'color' => '#3cc7c6',
      'alpha' => '0.80',
    ),
    'portfolio_basic_overlay_icon_color' => '#3cc7c6',
    'portfolio_basic_title' => 
    array (
      'color' => '#222',
      'font-weight' => '600',
      'text-transform' => 'uppercase',
      'letter-spacing' => '1px',
      'text-align' => 'center',
    ),
    'portfolio_basic_subtitle' => 
    array (
      'color' => '#565656',
      'font-weight' => '300',
      'text-align' => 'center',
    ),
    'toggle_title_typography' => 
    array (
      'color' => '#555',
      'font-weight' => '600',
      'font-size' => '13px',
      'text-transform' => 'uppercase',
      'letter-spacing' => '1px',
    ),
    'tooggle_bg_color' => '#f6f6f6',
    'toggle_active_color' => '#3cc7c6',
    'tabs_background_color' => 'transparent',
    'tabs_font_color' => '#fff',
    'block_title_column_title' => 
    array (
      'color' => '#222',
      'font-family' => 'Lato',
      'font-weight' => '300',
      'text-transform' => 'none',
      'letter-spacing' => '0px',
      'line-height' => '48px',
      'text-align' => 'left',
    ),
    'block_title_column_subtitle' => 
    array (
      'color' => '#888',
      'font-weight' => '300',
      'text-transform' => 'none',
      'text-align' => 'left',
      'font-family' => 'Lato',
    ),
    'block_title_section_title' => 
    array (
      'color' => '#333',
      'font-family' => 'lato',
      'font-size' => '20px',
      'font-weight' => '300',
      'text-transform' => 'capitalize',
      'line-height' => '50px',
      'letter-spacing' => '1px',
    ),
    'block_title_section_desc' => 
    array (
      'font-family' => 'Lato',
      'color' => '#777',
      'font-weight' => '300',
      'text-transform' => '',
      'line-height' => '28px',
      'font-size' => '20px',
      'letter-spacing' => '0.5px',
    ),
    'animated_counter_typ' => 
    array (
      'color' => '#333333',
      'font-weight' => '300',
      'font-size' => '38px',
      'line-height' => '48px',
      'letter-spacing' => '2px',
      'font-family' => 'Lato',
    ),
    'testimonial_text' => 
    array (
      'color' => '#444',
      'font-weight' => '400',
      'font-size' => '17px',
      'line-height' => '30px',
    ),
    'textbar_title_typography' => 
    array (
      'color' => '#222',
      'font-weight' => '300',
      'font-size' => '28px',
      'text-transform' => 'none',
      'letter-spacing' => '0px',
    ),
    'contact_border' => '#ececec',
    'overall_button_style' => 
    array (
      0 => 'default',
    ),
    'button_typography' => 
    array (
      'color' => '#3cc7c6',
      'font-weight' => '500',
      'font-size' => '13px',
      'text-transform' => 'uppercase',
      'letter-spacing' => '2px',
    ),
    'button_background_color' => 
    array (
      'color' => '#ffffff',
      'alpha' => '0.00',
    ),
    'button_border_color' => 
    array (
      'color' => '#3cc7c6',
      'alpha' => '1.00',
    ),
    'button_hover_font_color' => '#fff',
    'button_hover_background' => 
    array (
      'color' => '#3cc7c6',
      'alpha' => '0.75',
    ),
    'button_hover_border' => 
    array (
      'color' => '#3cc7c6',
      'alpha' => '1.00',
    ),
    'button_light_font_color' => '#fff',
    'button_light_background' => 
    array (
      'color' => '#fff',
      'alpha' => '0.00',
    ),
    'button_light_border' => 
    array (
      'color' => '#fff',
      'alpha' => '0.40',
    ),
    'button_light_hover_font_color' => '#3cc7c6',
    'button_light__hover_background' => 
    array (
      'color' => '#fff',
      'alpha' => '1.00',
    ),
    'button_light_hover_border' => 
    array (
      'color' => '#fff',
      'alpha' => '1.00',
    ),
    'shop_single_title' => 
    array (
      'font-weight' => '300',
      'letter-spacing' => '1',
      'text-transform' => 'capitalize',
    ),
    'shop_product_overlay' => 
    array (
      'color' => '#fffffff',
      'alpha' => '0.80',
    ),
    'body_typography' => 
    array (
      'color' => '#999999',
      'font-family' => 'Lato',
      'google' => true,
      'line-height' => '26px',
      'font-size' => '16px',
      'font-weight' => '400',
      'letter-spacing' => '0px',
    ),
    'headings_font_type' => 
    array (
      'font-family' => 'Lato',
      'letter-spacing' => '1px',
      'google' => true,
      'font-weight' => '400',
    ),
    'heading_1_font' => 
    array (
      'line-height' => '50px',
      'google' => true,
      'font-size' => '45px',
    ),
    'heading_2_font' => 
    array (
      'line-height' => '28px',
      'google' => true,
      'font-size' => '22px',
    ),
    'heading_3_font' => 
    array (
      'line-height' => '26px',
      'google' => true,
      'font-size' => '20px',
    ),
    'heading_4_font' => 
    array (
      'line-height' => '24px',
      'google' => true,
      'font-size' => '17px',
    ),
    'heading_5_font' => 
    array (
      'line-height' => '22px',
      'google' => true,
      'font-size' => '16px',
    ),
    'heading_6_font' => 
    array (
      'line-height' => '20px',
      'google' => true,
      'font-size' => '14px',
    ),
    'footer_columns' => '5',
    'footer_container_full' => '0',
    'copyright_text' => '@2017 The Simple - Multi-Purpose theme from <a href="'.esc_url('http://ellethemes.com').'">Elle Themes</a>, builded with <a href="#">WordPress</a>',
    'show_footer' => 1,
    'show_copyright' => 1,
    'blog_style' => 'normal',
    'blog_grid_col' => '3',
    'bloglayout' => 'fullwidth',
    'singlebloglayout' => 'sidebar_right',
    'post_like' => 0,
    'social_shares' => 1,
    'blog_pagination' => 'with_pagination',
    'blog_info_author' => 1,
    'blog_info_date' => 1,
    'blog_info_comments' => 1,
    'blog_info_tags' => 1,
    'portfolio_slug' => 'simple_portfolio',
    'portfolio_post_like' => 0,
    'site_layout' => 'fullwidth',
    'page_overall_layout' => 'fullwidth',
    'page_container_width' => 
    array (
      'width' => '1200px',
    ),
    'page_container_width_percent' => 
    array (
      'width' => '87%',
    ),
    'boxed_container_width' => 
    array (
      'width' => '1100px',
    ),
    'boxed_container_width_percent' => 
    array (
      'width' => '87%',
    ),
    'boxed_container_margin' => 
    array (
      'margin-bottom' => '30px',
      'margin-top' => '30px',
    ),
    'boxed_shadow' => 1,
    'boxed_border' => 
    array (
      'color' => '#e7e7e7',
      'border-style' => 'solid',
      'border' => '0px',
    ),
    'extra_navigation' => 1,
    'extra_navigation_position' => 'right',
    'row_margin_bottom' => 
    array (
      'margin-bottom' => '70px',
    ),
    'content_padding' => 
    array (
      'padding-bottom' => '70px',
      'padding-top' => '70px',
    ),
    'outter_padding' => 0,
    'codeless_import_export' => 'default',
    'slide_background_type' => 'image',
    'slide_background_image' => '',
    'slide_mp4_video' => '',
    'slide_webm_video' => '',
    'slide_ogg_video' => '',
    'slide_mobile_video' => '',
    'slide_bg_overlay' => 
    array (
      'color' => '',
      'alpha' => '1.0',
    ),
    'slide_title' => '',
    'slide_title_style' => 
    array (
      'color' => '#222',
      'font-style' => '700',
      'text-align' => 'center',
      'font-family' => 'Open Sans',
      'google' => true,
      'font-size' => '33px',
      'line-height' => '40',
      'letter-spacing' => '1.8px',
    ),
    'slide_title_bg' => 
    array (
      'color' => '#000000',
      'alpha' => '0',
    ),
    'slide_title_padding' => 
    array (
      'padding-left' => '0px',
      'padding-right' => '0px',
      'padding-top' => '0px',
      'padding-bottom' => '0px',
    ),
    'slide_title_animation' => 'fadeInDown',
    'slide_description' => '',
    'slide_description_style' => 
    array (
      'color' => '#666',
      'font-style' => '400',
      'text-align' => 'center',
      'font-family' => 'Open Sans',
      'google' => true,
      'font-size' => '20px',
      'line-height' => '32',
    ),
    'slide_description_animation' => 'fadeInDown',
    'slide_image_switch' => 0,
    'slide_image_top' => 
    array (
      'url' => '',
    ),
    'slide_image_alignment' => 'center',
    'slide_image_dimension' => 
    array (
      'Width' => '200',
      'Height' => '100',
    ),
    'slide_button1' => '',
    'slide_button1_link' => '',
    'slide_button1_style' => 'bordered',
    'slide_button2' => '',
    'slide_button2_link' => '',
    'slide_button2_style' => 'bordered',
    'slide_buttons_colors' => 'light',
    'slide_content_position' => 'in_middle',
    'slide_content_position_absolute' => 
    array (
      'top' => '',
      'bottom' => '',
      'left' => '',
      'right' => '',
    ),
    'slide_content_width' => '700px',
    'remove_container' => 0,
    'slider_menu_nav_colors' => 'light',
    'single_custom_link_switch' => 0,
    'single_custom_link' => '',
    'single_portfolio_style' => 'container',
    'single_portfolio_content_position_floating' => 'right',
    'single_portfolio_content_position_container' => 'right',
    'single_portfolio_media' => 'featured',
    'single_portfolio_video' => '',
    'single_portfolio_gallery' => '',
    'single_portfolio_active_comments' => 0,
    'single_portfolio_custom_fields' => '',
    'portfolio_categories' => '',
    'portfolio_mode' => 'grid',
    'portfolio_columns' => '3',
    'portfolio_style' => 'overlayed',
    'portfolio_layout' => 'in_container',
    'portfolio_space' => 'normal',
    'portfolio_content' => 'top',
    'portfolio_pagination' => 'with_pagination',
    'portfolio_filters' => 'normal',
    'overwrite_layout' => 0,
    'layout' => 'fullwidth',
    'left_sidebar_dual' => '',
    'right_sidebar_dual' => '',
    'page_header_overwrite' => 0,
    'subtitle_bool' => 0,
    'subtitle' => 'A sample page description',
    'slider_type' => 'none',
    'gallery' => '',
    'gallery_effect' => 'the-simple',
    'revslider' => 'none',
    'layerslider' => 'none',
    'simple_slider' => '',
    'simple_slider_speed' => '10000',
    'simple_slider_height' => '',
    'simple_news_featured_1' => '',
    'simple_news_featured_2' => '',
    'slider_layout' => 'boxed',
    'slider_fixed' => 0,
    'slider_parallax' => 0,
    'slider_shapes' => 'normal',
    'slider_onmobile_remove' => 0,
    'page_content_background' => '',
    'fixed_header_page' => '0',
    'page_header_menu_color' => 'light',
    'one_page_active' => '0',
    'fullscreen_sections_active' => '0',
    'use_featured_image_as_photo' => 1,
    'staff_position' => '',
    'facebook_link' => '#',
    'twitter_link' => '#',
    'google_link' => '#',
    'pinterest_link' => '',
    'linkedin_link' => '',
    'instagram_link' => '',
    'mail_link' => '',
    'fullscreen_post_style' => 0,
    'fullscreen_post_effect' => 'fadeInLeft',
    'fullscreen_post_delay' => '200',
    'fullscreen_post_position' => 'left',
    'future_date_events' => '',
    'media_post_link' => '',
    '_publicize_pending' => '1',
    '_wp_page_template' => 'default',
    'original_post_id' => '1080',
    '_wp_old_slug' => '1080',
  );
  }
}



function simple_icons(){
   $fa_icons = array(

      'icon-glass' => 'icon-glass',

      'icon-music' => 'icon-music',

      'icon-search' => 'icon-search',

      'icon-envelope-alt' => 'icon-envelope-alt',

      'icon-heart' => 'icon-heart',

      'icon-star' => 'icon-star',

      'icon-star-empty' => 'icon-star-empty',

      'icon-user' => 'icon-user',

      'icon-film' => 'icon-film',

      'icon-th-large' => 'icon-th-large',

      'icon-th' => 'icon-th',

      'icon-th-list' => 'icon-th-list',

      'icon-ok' => 'icon-ok',

      'icon-remove' => 'icon-remove',

      'icon-zoom-in' => 'icon-zoom-in',

      'icon-zoom-out' => 'icon-zoom-out',

      'icon-off' => 'icon-off',

      'icon-signal' => 'icon-signal',

      'icon-cog' => 'icon-cog',

      'icon-trash' => 'icon-trash',

      'icon-home' => 'icon-home',

      'icon-file-alt' => 'icon-file-alt',

      'icon-time' => 'icon-time',

      'icon-road' => 'icon-road',

      'icon-download-alt' => 'icon-download-alt',

      'icon-download' => 'icon-download',

      'icon-upload' => 'icon-upload',

      'icon-inbox' => 'icon-inbox',

      'icon-play-circle' => 'icon-play-circle',

      'icon-repeat' => 'icon-repeat',

      'icon-refresh' => 'icon-refresh',

      'icon-list-alt' => 'icon-list-alt',

      'icon-lock' => 'icon-lock',

      'icon-flag' => 'icon-flag',

      'icon-headphones' => 'icon-headphones',

      'icon-volume-off' => 'icon-volume-off',

      'icon-volume-down' => 'icon-volume-down',

      'icon-volume-up' => 'icon-volume-up',

      'icon-qrcode' => 'icon-qrcode',

      'icon-barcode' => 'icon-barcode',

      'icon-tag' => 'icon-tag',

      'icon-tags' => 'icon-tags',

      'icon-book' => 'icon-book',

      'icon-bookmark' => 'icon-bookmark',

      'icon-print' => 'icon-print',

      'icon-camera' => 'icon-camera',

      'icon-font' => 'icon-font',

      'icon-bold' => 'icon-bold',

      'icon-italic' => 'icon-italic',

      'icon-text-height' => 'icon-text-height',

      'icon-text-width' => 'icon-text-width',

      'icon-align-left' => 'icon-align-left',

      'icon-align-center' => 'icon-align-center',

      'icon-align-right' => 'icon-align-right',

      'icon-align-justify' => 'icon-align-justify',

      'icon-list' => 'icon-list',

      'icon-indent-left' => 'icon-indent-left',

      'icon-indent-right' => 'icon-indent-right',

      'icon-facetime-video' => 'icon-facetime-video',

      'icon-picture' => 'icon-picture',

      'icon-pencil' => 'icon-pencil',

      'icon-map-marker' => 'icon-map-marker',

      'icon-adjust' => 'icon-adjust',

      'icon-tint' => 'icon-tint',

      'icon-edit' => 'icon-edit',

      'icon-share' => 'icon-share',

      'icon-check' => 'icon-check',

      'icon-move' => 'icon-move',

      'icon-step-backward' => 'icon-step-backward',

      'icon-fast-backward' => 'icon-fast-backward',

      'icon-backward' => 'icon-backward',

      'icon-play' => 'icon-play',

      'icon-pause' => 'icon-pause',

      'icon-stop' => 'icon-stop',

      'icon-forward' => 'icon-forward',

      'icon-fast-forward' => 'icon-fast-forward',

      'icon-step-forward' => 'icon-step-forward',

      'icon-eject' => 'icon-eject',

      'icon-chevron-left' => 'icon-chevron-left',

      'icon-chevron-right' => 'icon-chevron-right',

      'icon-plus-sign' => 'icon-plus-sign',

      'icon-minus-sign' => 'icon-minus-sign',

      'icon-remove-sign' => 'icon-remove-sign',

      'icon-ok-sign' => 'icon-ok-sign',

      'icon-question-sign' => 'icon-question-sign',

      'icon-info-sign' => 'icon-info-sign',

      'icon-screenshot' => 'icon-screenshot',

      'icon-remove-circle' => 'icon-remove-circle',

      'icon-ok-circle' => 'icon-ok-circle',

      'icon-ban-circle' => 'icon-ban-circle',

      'icon-arrow-left' => 'icon-arrow-left',

      'icon-arrow-right' => 'icon-arrow-right',

      'icon-arrow-up' => 'icon-arrow-up',

      'icon-arrow-down' => 'icon-arrow-down',

      'icon-share-alt' => 'icon-share-alt',

      'icon-resize-full' => 'icon-resize-full',

      'icon-resize-small' => 'icon-resize-small',

      'icon-plus' => 'icon-plus',

      'icon-minus' => 'icon-minus',

      'icon-asterisk' => 'icon-asterisk',

      'icon-exclamation-sign' => 'icon-exclamation-sign',

      'icon-gift' => 'icon-gift',

      'icon-leaf' => 'icon-leaf',

      'icon-fire' => 'icon-fire',

      'icon-eye-open' => 'icon-eye-open',

      'icon-eye-close' => 'icon-eye-close',

      'icon-warning-sign' => 'icon-warning-sign',

      'icon-plane' => 'icon-plane',

      'icon-calendar' => 'icon-calendar',

      'icon-random' => 'icon-random',

      'icon-comment' => 'icon-comment',

      'icon-magnet' => 'icon-magnet',

      'icon-chevron-up' => 'icon-chevron-up',

      'icon-chevron-down' => 'icon-chevron-down',

      'icon-retweet' => 'icon-retweet',

      'icon-shopping-cart' => 'icon-shopping-cart',

      'icon-folder-close' => 'icon-folder-close',

      'icon-folder-open' => 'icon-folder-open',

      'icon-resize-vertical' => 'icon-resize-vertical',

      'icon-resize-horizontal' => 'icon-resize-horizontal',

      'icon-bar-chart' => 'icon-bar-chart',

      'icon-twitter-sign' => 'icon-twitter-sign',

      'icon-facebook-sign' => 'icon-facebook-sign',

      'icon-camera-retro' => 'icon-camera-retro',

      'icon-key' => 'icon-key',

      'icon-cogs' => 'icon-cogs',

      'icon-comments' => 'icon-comments',

      'icon-thumbs-up-alt' => 'icon-thumbs-up-alt',

      'icon-thumbs-down-alt' => 'icon-thumbs-down-alt',

      'icon-star-half' => 'icon-star-half',

      'icon-heart-empty' => 'icon-heart-empty',

      'icon-signout' => 'icon-signout',

      'icon-linkedin-sign' => 'icon-linkedin-sign',

      'icon-pushpin' => 'icon-pushpin',

      'icon-external-link' => 'icon-external-link',

      'icon-signin' => 'icon-signin',

      'icon-trophy' => 'icon-trophy',

      'icon-github-sign' => 'icon-github-sign',

      'icon-upload-alt' => 'icon-upload-alt',

      'icon-lemon' => 'icon-lemon',

      'icon-phone' => 'icon-phone',

      'icon-check-empty' => 'icon-check-empty',

      'icon-bookmark-empty' => 'icon-bookmark-empty',

      'icon-phone-sign' => 'icon-phone-sign',

      'icon-twitter' => 'icon-twitter',

      'icon-facebook' => 'icon-facebook',

      'icon-github' => 'icon-github',

      'icon-unlock' => 'icon-unlock',

      'icon-credit-card' => 'icon-credit-card',

      'icon-rss' => 'icon-rss',

      'icon-hdd' => 'icon-hdd',

      'icon-bullhorn' => 'icon-bullhorn',

      'icon-bell' => 'icon-bell',

      'icon-certificate' => 'icon-certificate',

      'icon-hand-right' => 'icon-hand-right',

      'icon-hand-left' => 'icon-hand-left',

      'icon-hand-up' => 'icon-hand-up',

      'icon-hand-down' => 'icon-hand-down',

      'icon-circle-arrow-left' => 'icon-circle-arrow-left',

      'icon-circle-arrow-right' => 'icon-circle-arrow-right',

      'icon-circle-arrow-up' => 'icon-circle-arrow-up',

      'icon-circle-arrow-down' => 'icon-circle-arrow-down',

      'icon-globe' => 'icon-globe',

      'icon-wrench' => 'icon-wrench',

      'icon-tasks' => 'icon-tasks',

      'icon-filter' => 'icon-filter',

      'icon-briefcase' => 'icon-briefcase',

      'icon-fullscreen' => 'icon-fullscreen',

      'icon-group' => 'icon-group',

      'icon-link' => 'icon-link',

      'icon-cloud' => 'icon-cloud',

      'icon-beaker' => 'icon-beaker',

      'icon-cut' => 'icon-cut',

      'icon-copy' => 'icon-copy',

      'icon-paper-clip' => 'icon-paper-clip',

      'icon-save' => 'icon-save',

      'icon-sign-blank' => 'icon-sign-blank',

      'icon-reorder' => 'icon-reorder',

      'icon-list-ul' => 'icon-list-ul',

      'icon-list-ol' => 'icon-list-ol',

      'icon-strikethrough' => 'icon-strikethrough',

      'icon-underline' => 'icon-underline',

      'icon-table' => 'icon-table',

      'icon-magic' => 'icon-magic',

      'icon-truck' => 'icon-truck',

      'icon-pinterest' => 'icon-pinterest',

      'icon-pinterest-sign' => 'icon-pinterest-sign',

      'icon-google-plus-sign' => 'icon-google-plus-sign',

      'icon-google-plus' => 'icon-google-plus',

      'icon-money' => 'icon-money',

      'icon-caret-down' => 'icon-caret-down',

      'icon-caret-up' => 'icon-caret-up',

      'icon-caret-left' => 'icon-caret-left',

      'icon-caret-right' => 'icon-caret-right',

      'icon-columns' => 'icon-columns',

      'icon-sort' => 'icon-sort',

      'icon-sort-down' => 'icon-sort-down',

      'icon-sort-up' => 'icon-sort-up',

      'icon-envelope' => 'icon-envelope',

      'icon-linkedin' => 'icon-linkedin',

      'icon-undo' => 'icon-undo',

      'icon-legal' => 'icon-legal',

      'icon-dashboard' => 'icon-dashboard',

      'icon-comment-alt' => 'icon-comment-alt',

      'icon-comments-alt' => 'icon-comments-alt',

      'icon-bolt' => 'icon-bolt',

      'icon-sitemap' => 'icon-sitemap',

      'icon-umbrella' => 'icon-umbrella',

      'icon-paste' => 'icon-paste',

      'icon-lightbulb' => 'icon-lightbulb',

      'icon-exchange' => 'icon-exchange',

      'icon-cloud-download' => 'icon-cloud-download',

      'icon-cloud-upload' => 'icon-cloud-upload',

      'icon-user-md' => 'icon-user-md',

      'icon-stethoscope' => 'icon-stethoscope',

      'icon-suitcase' => 'icon-suitcase',

      'icon-bell-alt' => 'icon-bell-alt',

      'icon-coffee' => 'icon-coffee',

      'icon-food' => 'icon-food',

      'icon-file-text-alt' => 'icon-file-text-alt',

      'icon-building' => 'icon-building',

      'icon-hospital-o' => 'icon-hospital-o', 

      'icon-ambulance' => 'icon-ambulance',

      'icon-medkit' => 'icon-medkit',

      'icon-fighter-jet' => 'icon-fighter-jet',

      'icon-beer' => 'icon-beer',

      'icon-h-sign' => 'icon-h-sign',

      'icon-plus-sign-alt' => 'icon-plus-sign-alt',

      'icon-double-angle-left' => 'icon-double-angle-left',

      'icon-double-angle-right' => 'icon-double-angle-right',

      'icon-double-angle-up' => 'icon-double-angle-up',

      'icon-double-angle-down' => 'icon-double-angle-down',

      'icon-angle-left' => 'icon-angle-left',

      'icon-angle-right' => 'icon-angle-right',

      'icon-angle-up' => 'icon-angle-up',

      'icon-angle-down' => 'icon-angle-down',

      'icon-desktop' => 'icon-desktop',

      'icon-laptop' => 'icon-laptop',

      'icon-tablet' => 'icon-tablet',

      'icon-mobile-phone' => 'icon-mobile-phone',

      'icon-circle-blank' => 'icon-circle-blank',

      'icon-quote-left' => 'icon-quote-left',

      'icon-quote-right' => 'icon-quote-right',

      'icon-spinner' => 'icon-spinner',

      'icon-circle' => 'icon-circle',

      'icon-reply' => 'icon-reply',

      'icon-github-alt' => 'icon-github-alt',

      'icon-folder-close-alt' => 'icon-folder-close-alt',

      'icon-folder-open-alt' => 'icon-folder-open-alt',

      'icon-expand-alt' => 'icon-expand-alt',

      'icon-collapse-alt' => 'icon-collapse-alt',

      'icon-smile' => 'icon-smile',

      'icon-frown' => 'icon-frown',

      'icon-meh' => 'icon-meh',

      'icon-gamepad' => 'icon-gamepad',

      'icon-keyboard' => 'icon-keyboard',

      'icon-flag-alt' => 'icon-flag-alt',

      'icon-flag-checkered' => 'icon-flag-checkered',

      'icon-terminal' => 'icon-terminal',

      'icon-code' => 'icon-code',

      'icon-reply-all' => 'icon-reply-all',

      'icon-mail-reply-all' => 'icon-mail-reply-all',

      'icon-star-half-empty' => 'icon-star-half-empty',

      'icon-location-arrow' => 'icon-location-arrow',

      'icon-crop' => 'icon-crop',

      'icon-code-fork' => 'icon-code-fork',

      'icon-unlink' => 'icon-unlink',

      'icon-question' => 'icon-question',

      'icon-info' => 'icon-info',

      'icon-exclamation' => 'icon-exclamation',

      'icon-superscript' => 'icon-superscript',

      'icon-subscript' => 'icon-subscript',

      'icon-eraser' => 'icon-eraser',

      'icon-puzzle-piece' => 'icon-puzzle-piece',

      'icon-microphone' => 'icon-microphone',

      'icon-microphone-off' => 'icon-microphone-off',

      'icon-shield' => 'icon-shield',

      'icon-calendar-empty' => 'icon-calendar-empty',

      'icon-fire-extinguisher' => 'icon-fire-extinguisher',

      'icon-rocket' => 'icon-rocket',

      'icon-maxcdn' => 'icon-maxcdn',

      'icon-chevron-sign-left' => 'icon-chevron-sign-left',

      'icon-chevron-sign-right' => 'icon-chevron-sign-right',

      'icon-chevron-sign-up' => 'icon-chevron-sign-up',

      'icon-chevron-sign-down' => 'icon-chevron-sign-down',

      'icon-html5' => 'icon-html5',

      'icon-css3' => 'icon-css3',

      'icon-anchor' => 'icon-anchor',

      'icon-unlock-alt' => 'icon-unlock-alt',

      'icon-bullseye' => 'icon-bullseye',

      'icon-ellipsis-horizontal' => 'icon-ellipsis-horizontal',

      'icon-ellipsis-vertical' => 'icon-ellipsis-vertical',

      'icon-rss-sign' => 'icon-rss-sign',

      'icon-play-sign' => 'icon-play-sign',

      'icon-ticket' => 'icon-ticket',

      'icon-minus-sign-alt' => 'icon-minus-sign-alt',

      'icon-check-minus' => 'icon-check-minus',

      'icon-level-up' => 'icon-level-up',

      'icon-level-down' => 'icon-level-down',

      'icon-check-sign' => 'icon-check-sign',

      'icon-edit-sign' => 'icon-edit-sign',

      'icon-external-link-sign' => 'icon-external-link-sign',

      'icon-share-sign' => 'icon-share-sign',

      'icon-compass' => 'icon-compass',

      'icon-collapse' => 'icon-collapse',

      'icon-collapse-top' => 'icon-collapse-top',

      'icon-expand' => 'icon-expand',

      'icon-eur' => 'icon-eur',

      'icon-gbp' => 'icon-gbp',

      'icon-usd' => 'icon-usd',

      'icon-inr' => 'icon-inr',

      'icon-jpy' => 'icon-jpy',

      'icon-cny' => 'icon-cny',

      'icon-krw' => 'icon-krw',

      'icon-btc' => 'icon-btc',

      'icon-file' => 'icon-file',

      'icon-file-text' => 'icon-file-text',

      'icon-sort-by-alphabet' => 'icon-sort-by-alphabet',

      'icon-sort-by-alphabet-alt' => 'icon-sort-by-alphabet-alt',

      'icon-sort-by-attributes' => 'icon-sort-by-attributes',

      'icon-sort-by-attributes-alt' => 'icon-sort-by-attributes-alt',

      'icon-sort-by-order' => 'icon-sort-by-order',

      'icon-sort-by-order-alt' => 'icon-sort-by-order-alt',

      'icon-thumbs-up' => 'icon-thumbs-up',

      'icon-thumbs-down' => 'icon-thumbs-down',

      'icon-youtube-sign' => 'icon-youtube-sign',

      'icon-youtube' => 'icon-youtube',

      'icon-xing' => 'icon-xing',

      'icon-xing-sign' => 'icon-xing-sign',

      'icon-youtube-play' => 'icon-youtube-play',

      'icon-dropbox' => 'icon-dropbox',

      'icon-stackexchange' => 'icon-stackexchange',

      'icon-instagram' => 'icon-instagram',

      'icon-flickr' => 'icon-flickr',

      'icon-adn' => 'icon-adn',

      'icon-bitbucket' => 'icon-bitbucket',

      'icon-bitbucket-sign' => 'icon-bitbucket-sign',

      'icon-tumblr' => 'icon-tumblr',

      'icon-tumblr-sign' => 'icon-tumblr-sign',

      'icon-long-arrow-down' => 'icon-long-arrow-down',

      'icon-long-arrow-up' => 'icon-long-arrow-up',

      'icon-long-arrow-left' => 'icon-long-arrow-left',

      'icon-long-arrow-right' => 'icon-long-arrow-right',

      'icon-apple' => 'icon-apple',

      'icon-windows' => 'icon-windows',

      'icon-android' => 'icon-android',

      'icon-linux' => 'icon-linux',

      'icon-dribbble' => 'icon-dribbble',

      'icon-skype' => 'icon-skype',

      'icon-foursquare' => 'icon-foursquare',

      'icon-trello' => 'icon-trello',

      'icon-female' => 'icon-female',

      'icon-male' => 'icon-male',

      'icon-gittip' => 'icon-gittip',

      'icon-sun' => 'icon-sun',

      'icon-moon' => 'icon-moon',

      'icon-archive' => 'icon-archive',

      'icon-bug' => 'icon-bug',

      'icon-vk' => 'icon-vk',

      'icon-weibo' => 'icon-weibo',

      'icon-renren' => 'icon-renren',

      'icon-heartbeat' => 'icon-heartbeat'

  );

    

$steadysets = array(

      'steadysets-icon-type' => 'steadysets-icon-type',

      'steadysets-icon-box' => 'steadysets-icon-box',

      'steadysets-icon-archive' => 'steadysets-icon-archive',

      'steadysets-icon-envelope' => 'steadysets-icon-envelope',

      'steadysets-icon-email' => 'steadysets-icon-email',

      'steadysets-icon-files' => 'steadysets-icon-files',

      'steadysets-icon-uniE606' => 'steadysets-icon-uniE606',

      'steadysets-icon-connection-empty' => 'steadysets-icon-connection-empty',

      'steadysets-icon-connection-25' => 'steadysets-icon-connection-25',

      'steadysets-icon-connection-50' => 'steadysets-icon-connection-50',

      'steadysets-icon-connection-75' => 'steadysets-icon-connection-75',

      'steadysets-icon-connection-full' => 'steadysets-icon-connection-full',

      'steadysets-icon-microphone' => 'steadysets-icon-microphone',

      'steadysets-icon-microphone-off' => 'steadysets-icon-microphone-off',

      'steadysets-icon-book' => 'steadysets-icon-book',

      'steadysets-icon-cloud' => 'steadysets-icon-cloud',

      'steadysets-icon-book2' => 'steadysets-icon-book2',

      'steadysets-icon-star' => 'steadysets-icon-star',

      'steadysets-icon-phone-portrait' => 'steadysets-icon-phone-portrait',

      'steadysets-icon-phone-landscape' => 'steadysets-icon-phone-landscape',

      'steadysets-icon-tablet' => 'steadysets-icon-tablet',

      'steadysets-icon-tablet-landscape' => 'steadysets-icon-tablet-landscape',

      'steadysets-icon-laptop' => 'steadysets-icon-laptop',

      'steadysets-icon-uniE617' => 'steadysets-icon-uniE617',

      'steadysets-icon-barbell' => 'steadysets-icon-barbell',

      'steadysets-icon-stopwatch' => 'steadysets-icon-stopwatch',

      'steadysets-icon-atom' => 'steadysets-icon-atom',

      'steadysets-icon-syringe' => 'steadysets-icon-syringe',

      'steadysets-icon-pencil' => 'steadysets-icon-pencil',

      'steadysets-icon-chart' => 'steadysets-icon-chart',

      'steadysets-icon-bars' => 'steadysets-icon-bars',

      'steadysets-icon-cube' => 'steadysets-icon-cube',

      'steadysets-icon-image' => 'steadysets-icon-image',

      'steadysets-icon-crop' => 'steadysets-icon-crop',

      'steadysets-icon-graph' => 'steadysets-icon-graph',

      'steadysets-icon-select' => 'steadysets-icon-select',

      'steadysets-icon-bucket' => 'steadysets-icon-bucket',

      'steadysets-icon-mug' => 'steadysets-icon-mug',

      'steadysets-icon-clipboard' => 'steadysets-icon-clipboard',

      'steadysets-icon-lab' => 'steadysets-icon-lab',

      'steadysets-icon-bones' => 'steadysets-icon-bones',

      'steadysets-icon-pill' => 'steadysets-icon-pill',

      'steadysets-icon-bolt' => 'steadysets-icon-bolt',

      'steadysets-icon-health' => 'steadysets-icon-health',

      'steadysets-icon-map-marker' => 'steadysets-icon-map-marker',

      'steadysets-icon-stack' => 'steadysets-icon-stack',

      'steadysets-icon-newspaper' => 'steadysets-icon-newspaper',

      'steadysets-icon-uniE62F' => 'steadysets-icon-uniE62F',

      'steadysets-icon-coffee' => 'steadysets-icon-coffee',

      'steadysets-icon-bill' => 'steadysets-icon-bill',

      'steadysets-icon-sun' => 'steadysets-icon-sun',

      'steadysets-icon-vcard' => 'steadysets-icon-vcard',

      'steadysets-icon-shorts' => 'steadysets-icon-shorts',

      'steadysets-icon-drink' => 'steadysets-icon-drink',

      'steadysets-icon-diamond' => 'steadysets-icon-diamond',

      'steadysets-icon-bag' => 'steadysets-icon-bag',

      'steadysets-icon-calculator' => 'steadysets-icon-calculator',

      'steadysets-icon-credit-cards' => 'steadysets-icon-credit-cards',

      'steadysets-icon-microwave-oven' => 'steadysets-icon-microwave-oven',

      'steadysets-icon-camera' => 'steadysets-icon-camera',

      'steadysets-icon-share' => 'steadysets-icon-share',

      'steadysets-icon-bullhorn' => 'steadysets-icon-bullhorn',

      'steadysets-icon-user' => 'steadysets-icon-user',

      'steadysets-icon-users' => 'steadysets-icon-users',

      'steadysets-icon-user2' => 'steadysets-icon-user2',

      'steadysets-icon-users2' => 'steadysets-icon-users2',

      'steadysets-icon-unlocked' => 'steadysets-icon-unlocked',

      'steadysets-icon-unlocked2' => 'steadysets-icon-unlocked2',

      'steadysets-icon-lock' => 'steadysets-icon-lock',

      'steadysets-icon-forbidden' => 'steadysets-icon-forbidden',

      'steadysets-icon-switch' => 'steadysets-icon-switch',

      'steadysets-icon-meter' => 'steadysets-icon-meter',

      'steadysets-icon-flag' => 'steadysets-icon-flag',

      'steadysets-icon-home' => 'steadysets-icon-home',

      'steadysets-icon-printer' => 'steadysets-icon-printer',

      'steadysets-icon-clock' => 'steadysets-icon-clock',

      'steadysets-icon-calendar' => 'steadysets-icon-calendar',

      'steadysets-icon-comment' => 'steadysets-icon-comment',

      'steadysets-icon-chat-3' => 'steadysets-icon-chat-3',

      'steadysets-icon-chat-2' => 'steadysets-icon-chat-2',

      'steadysets-icon-chat-1' => 'steadysets-icon-chat-1',

      'steadysets-icon-chat' => 'steadysets-icon-chat',

      'steadysets-icon-zoom-out' => 'steadysets-icon-zoom-out',

      'steadysets-icon-zoom-in' => 'steadysets-icon-zoom-in',

      'steadysets-icon-search' => 'steadysets-icon-search',

      'steadysets-icon-trashcan' => 'steadysets-icon-trashcan',

      'steadysets-icon-tag' => 'steadysets-icon-tag',

      'steadysets-icon-download' => 'steadysets-icon-download',

      'steadysets-icon-paperclip' => 'steadysets-icon-paperclip',

      'steadysets-icon-checkbox' => 'steadysets-icon-checkbox',

      'steadysets-icon-checkbox-checked' => 'steadysets-icon-checkbox-checked',

      'steadysets-icon-checkmark' => 'steadysets-icon-checkmark',

      'steadysets-icon-refresh' => 'steadysets-icon-refresh',

      'steadysets-icon-reload' => 'steadysets-icon-reload',

      'steadysets-icon-arrow-right' => 'steadysets-icon-arrow-right',

      'steadysets-icon-arrow-down' => 'steadysets-icon-arrow-down',

      'steadysets-icon-arrow-up' => 'steadysets-icon-arrow-up',

      'steadysets-icon-arrow-left' => 'steadysets-icon-arrow-left',

      'steadysets-icon-settings' => 'steadysets-icon-settings',

      'steadysets-icon-battery-full' => 'steadysets-icon-battery-full',

      'steadysets-icon-battery-75' => 'steadysets-icon-battery-75',

      'steadysets-icon-battery-50' => 'steadysets-icon-battery-50',

      'steadysets-icon-battery-25' => 'steadysets-icon-battery-25',

      'steadysets-icon-battery-empty' => 'steadysets-icon-battery-empty',

      'steadysets-icon-battery-charging' => 'steadysets-icon-battery-charging',

      'steadysets-icon-uniE669' => 'steadysets-icon-uniE669',

      'steadysets-icon-grid' => 'steadysets-icon-grid',

      'steadysets-icon-list' => 'steadysets-icon-list',

      'steadysets-icon-wifi-low' => 'steadysets-icon-wifi-low',

      'steadysets-icon-folder-check' => 'steadysets-icon-folder-check',

      'steadysets-icon-folder-settings' => 'steadysets-icon-folder-settings',

      'steadysets-icon-folder-add' => 'steadysets-icon-folder-add',

      'steadysets-icon-folder' => 'steadysets-icon-folder',

      'steadysets-icon-window' => 'steadysets-icon-window',

      'steadysets-icon-windows' => 'steadysets-icon-windows',

      'steadysets-icon-browser' => 'steadysets-icon-browser',

      'steadysets-icon-file-broken' => 'steadysets-icon-file-broken',

      'steadysets-icon-align-justify' => 'steadysets-icon-align-justify',

      'steadysets-icon-align-center' => 'steadysets-icon-align-center',

      'steadysets-icon-align-right' => 'steadysets-icon-align-right',

      'steadysets-icon-align-left' => 'steadysets-icon-align-left',

      'steadysets-icon-file' => 'steadysets-icon-file',

      'steadysets-icon-file-add' => 'steadysets-icon-file-add',

      'steadysets-icon-file-settings' => 'steadysets-icon-file-settings',

      'steadysets-icon-mute' => 'steadysets-icon-mute',

      'steadysets-icon-heart' => 'steadysets-icon-heart',

      'steadysets-icon-enter' => 'steadysets-icon-enter',

      'steadysets-icon-volume-decrease' => 'steadysets-icon-volume-decrease',

      'steadysets-icon-wifi-mid' => 'steadysets-icon-wifi-mid',

      'steadysets-icon-volume' => 'steadysets-icon-volume',

      'steadysets-icon-bookmark' => 'steadysets-icon-bookmark',

      'steadysets-icon-screen' => 'steadysets-icon-screen',

      'steadysets-icon-map' => 'steadysets-icon-map',

      'steadysets-icon-measure' => 'steadysets-icon-measure',

      'steadysets-icon-eyedropper' => 'steadysets-icon-eyedropper',

      'steadysets-icon-support' => 'steadysets-icon-support',

      'steadysets-icon-phone' => 'steadysets-icon-phone',

      'steadysets-icon-email2' => 'steadysets-icon-email2',

      'steadysets-icon-volume-increase' => 'steadysets-icon-volume-increase',

      'steadysets-icon-wifi-full' => 'steadysets-icon-wifi-full'

  );



$linecons = array(

      'linecon-icon-heart' => 'linecon-icon-heart',

      'linecon-icon-cloud' => 'linecon-icon-cloud',

      'linecon-icon-star' => 'linecon-icon-star',

      'linecon-icon-tv' => 'linecon-icon-tv',

      'linecon-icon-sound' => 'linecon-icon-sound',

      'linecon-icon-video' => 'linecon-icon-video',

      'linecon-icon-trash' => 'linecon-icon-trash',

      'linecon-icon-user' => 'linecon-icon-user',

      'linecon-icon-key' => 'linecon-icon-key',

      'linecon-icon-search' => 'linecon-icon-search',

      'linecon-icon-eye' => 'linecon-icon-eye',

      'linecon-icon-bubble' => 'linecon-icon-bubble',

      'linecon-icon-stack' => 'linecon-icon-stack',

      'linecon-icon-cup' => 'linecon-icon-cup',

      'linecon-icon-phone' => 'linecon-icon-phone',

      'linecon-icon-news' => 'linecon-icon-news',

      'linecon-icon-mail' => 'linecon-icon-mail',

      'linecon-icon-like' => 'linecon-icon-like',

      'linecon-icon-photo' => 'linecon-icon-photo',

      'linecon-icon-note' => 'linecon-icon-note',

      'linecon-icon-food' => 'linecon-icon-food',

      'linecon-icon-t-shirt' => 'linecon-icon-t-shirt',

      'linecon-icon-fire' => 'linecon-icon-fire',

      'linecon-icon-clip' => 'linecon-icon-clip',

      'linecon-icon-shop' => 'linecon-icon-shop',

      'linecon-icon-calendar' => 'linecon-icon-calendar',

      'linecon-icon-wallet' => 'linecon-icon-wallet',

      'linecon-icon-vynil' => 'linecon-icon-vynil',

      'linecon-icon-truck' => 'linecon-icon-truck',

      'linecon-icon-world' => 'linecon-icon-world',

      'linecon-icon-clock' => 'linecon-icon-clock',

      'linecon-icon-paperplane' => 'linecon-icon-paperplane',

      'linecon-icon-params' => 'linecon-icon-params',

      'linecon-icon-banknote' => 'linecon-icon-banknote',

      'linecon-icon-data' => 'linecon-icon-data',

      'linecon-icon-music' => 'linecon-icon-music',

      'linecon-icon-megaphone' => 'linecon-icon-megaphone',

      'linecon-icon-study' => 'linecon-icon-study',

      'linecon-icon-lab' => 'linecon-icon-lab',

      'linecon-icon-location' => 'linecon-icon-location',

      'linecon-icon-display' => 'linecon-icon-display',

      'linecon-icon-diamond' => 'linecon-icon-diamond',

      'linecon-icon-pen' => 'linecon-icon-pen',

      'linecon-icon-bulb' => 'linecon-icon-bulb',

      'linecon-icon-lock' => 'linecon-icon-lock',

      'linecon-icon-tag' => 'linecon-icon-tag',

      'linecon-icon-camera' => 'linecon-icon-camera',

      'linecon-icon-settings' => 'linecon-icon-settings'

  );





  $moon = array(

                "moon-home" => "moon-home",

                "moon-home-2" => "moon-home-2",

                "moon-home-3" => "moon-home-3",

                "moon-home-4" => "moon-home-4",

                "moon-home-5" => "moon-home-5",

                "moon-home-6" => "moon-home-6",

                "moon-home-7" => "moon-home-7",

                "moon-home-8" => "moon-home-8",

                "moon-home-9" => "moon-home-9",

                "moon-home-10" => "moon-home-10",

                "moon-home-11" => "moon-home-11",

                "moon-office" => "moon-office",

                "moon-newspaper" => "moon-newspaper",

                "moon-pencil" => "moon-pencil",

                "moon-pencil-2" => "moon-pencil-2",

                "moon-pencil-3" => "moon-pencil-3",

                "moon-pencil-4" => "moon-pencil-4",

                "moon-pencil-5" => "moon-pencil-5",

                "moon-pencil-6" => "moon-pencil-6",

                "moon-quill" => "moon-quill",

                "moon-quill-2" => "moon-quill-2",

                "moon-quill-3" => "moon-quill-3",

                "moon-pen" => "moon-pen",

                "moon-pen-2" => "moon-pen-2",

                "moon-pen-3" => "moon-pen-3",

                "moon-pen-4" => "moon-pen-4",

                "moon-pen-5" => "moon-pen-5",

                "moon-marker" => "moon-marker",

                "moon-home-12" => "moon-home-12",

                "moon-marker-2" => "moon-marker-2",

                "moon-blog" => "moon-blog",

                "moon-blog-2" => "moon-blog-2",

                "moon-brush" => "moon-brush",

                "moon-palette" => "moon-palette",

                "moon-palette-2" => "moon-palette-2",

                "moon-eyedropper" => "moon-eyedropper",

                "moon-eyedropper-2" => "moon-eyedropper-2",

                "moon-droplet" => "moon-droplet",

                "moon-droplet-2" => "moon-droplet-2",

                "moon-droplet-3" => "moon-droplet-3",

                "moon-droplet-4" => "moon-droplet-4",

                "moon-paint-format" => "moon-paint-format",

                "moon-paint-format-2" => "moon-paint-format-2",

                "moon-image" => "moon-image",

                "moon-image-2" => "moon-image-2",

                "moon-image-3" => "moon-image-3",

                "moon-images" => "moon-images",

                "moon-image-4" => "moon-image-4",

                "moon-image-5" => "moon-image-5",

                "moon-image-6" => "moon-image-6",

                "moon-images-2" => "moon-images-2",

                "moon-image-7" => "moon-image-7",

                "moon-camera" => "moon-camera",

                "moon-camera-2" => "moon-camera-2",

                "moon-camera-3" => "moon-camera-3",

                "moon-camera-4" => "moon-camera-4",

                "moon-music" => "moon-music",

                "moon-music-2" => "moon-music-2",

                "moon-music-3" => "moon-music-3",

                "moon-music-4" => "moon-music-4",

                "moon-music-5" => "moon-music-5",

                "moon-music-6" => "moon-music-6",

                "moon-piano" => "moon-piano",

                "moon-guitar" => "moon-guitar",

                "moon-headphones" => "moon-headphones",

                "moon-headphones-2" => "moon-headphones-2",

                "moon-play" => "moon-play",

                "moon-play-2" => "moon-play-2",

                "moon-movie" => "moon-movie",

                "moon-movie-2" => "moon-movie-2",

                "moon-movie-3" => "moon-movie-3",

                "moon-film" => "moon-film",

                "moon-film-2" => "moon-film-2",

                "moon-film-3" => "moon-film-3",

                "moon-film-4" => "moon-film-4",

                "moon-camera-5" => "moon-camera-5",

                "moon-camera-6" => "moon-camera-6",

                "moon-camera-7" => "moon-camera-7",

                "moon-camera-8" => "moon-camera-8",

                "moon-camera-9" => "moon-camera-9",

                "moon-dice" => "moon-dice",

                "moon-gamepad" => "moon-gamepad",

                "moon-gamepad-2" => "moon-gamepad-2",

                "moon-gamepad-3" => "moon-gamepad-3",

                "moon-pacman" => "moon-pacman",

                "moon-spades" => "moon-spades",

                "moon-clubs" => "moon-clubs",

                "moon-diamonds" => "moon-diamonds",

                "moon-king" => "moon-king",

                "moon-queen" => "moon-queen",

                "moon-rock" => "moon-rock",

                "moon-bishop" => "moon-bishop",

                "moon-knight" => "moon-knight",

                "moon-pawn" => "moon-pawn",

                "moon-chess" => "moon-chess",

                "moon-bullhorn" => "moon-bullhorn",

                "moon-megaphone" => "moon-megaphone",

                "moon-new" => "moon-new",

                "moon-connection" => "moon-connection",

                "moon-connection-2" => "moon-connection-2",

                "moon-podcast" => "moon-podcast",

                "moon-radio" => "moon-radio",

                "moon-feed" => "moon-feed",

                "moon-connection-3" => "moon-connection-3",

                "moon-radio-2" => "moon-radio-2",

                "moon-podcast-2" => "moon-podcast-2",

                "moon-podcast-3" => "moon-podcast-3",

                "moon-mic" => "moon-mic",

                "moon-mic-2" => "moon-mic-2",

                "moon-mic-3" => "moon-mic-3",

                "moon-mic-4" => "moon-mic-4",

                "moon-mic-5" => "moon-mic-5",

                "moon-book" => "moon-book",

                "moon-book-2" => "moon-book-2",

                "moon-books" => "moon-books",

                "moon-reading" => "moon-reading",

                "moon-library" => "moon-library",

                "moon-library-2" => "moon-library-2",

                "moon-graduation" => "moon-graduation",

                "moon-file" => "moon-file",

                "moon-profile" => "moon-profile",

                "moon-file-2" => "moon-file-2",

                "moon-file-3" => "moon-file-3",

                "moon-file-4" => "moon-file-4",

                "moon-file-5" => "moon-file-5",

                "moon-file-6" => "moon-file-6",

                "moon-files" => "moon-files",

                "moon-file-plus" => "moon-file-plus",

                "moon-file-minus" => "moon-file-minus",

                "moon-file-download" => "moon-file-download",

                "moon-file-upload" => "moon-file-upload",

                "moon-file-check" => "moon-file-check",

                "moon-file-remove" => "moon-file-remove",

                "moon-file-7" => "moon-file-7",

                "moon-file-8" => "moon-file-8",

                "moon-file-plus-2" => "moon-file-plus-2",

                "moon-file-minus-2" => "moon-file-minus-2",

                "moon-file-download-2" => "moon-file-download-2",

                "moon-file-upload-2" => "moon-file-upload-2",

                "moon-file-check-2" => "moon-file-check-2",

                "moon-file-remove-2" => "moon-file-remove-2",

                "moon-file-9" => "moon-file-9",

                "moon-copy" => "moon-copy",

                "moon-copy-2" => "moon-copy-2",

                "moon-copy-3" => "moon-copy-3",

                "moon-copy-4" => "moon-copy-4",

                "moon-paste" => "moon-paste",

                "moon-paste-2" => "moon-paste-2",

                "moon-paste-3" => "moon-paste-3",

                "moon-stack" => "moon-stack",

                "moon-stack-2" => "moon-stack-2",

                "moon-stack-3" => "moon-stack-3",

                "moon-folder" => "moon-folder",

                "moon-folder-download" => "moon-folder-download",

                "moon-folder-upload" => "moon-folder-upload",

                "moon-folder-plus" => "moon-folder-plus",

                "moon-folder-plus-2" => "moon-folder-plus-2",

                "moon-folder-minus" => "moon-folder-minus",

                "moon-folder-minus-2" => "moon-folder-minus-2",

                "moon-folder8" => "moon-folder8",

                "moon-folder-remove" => "moon-folder-remove",

                "moon-folder-2" => "moon-folder-2",

                "moon-folder-open" => "moon-folder-open",

                "moon-folder-3" => "moon-folder-3",

                "moon-folder-4" => "moon-folder-4",

                "moon-folder-plus-3" => "moon-folder-plus-3",

                "moon-folder-minus-3" => "moon-folder-minus-3",

                "moon-folder-plus-4" => "moon-folder-plus-4",

                "moon-folder-remove-2" => "moon-folder-remove-2",

                "moon-folder-download-2" => "moon-folder-download-2",

                "moon-folder-upload-2" => "moon-folder-upload-2",

                "moon-folder-download-3" => "moon-folder-download-3",

                "moon-folder-upload-3" => "moon-folder-upload-3",

                "moon-folder-5" => "moon-folder-5",

                "moon-folder-open-2" => "moon-folder-open-2",

                "moon-folder-6" => "moon-folder-6",

                "moon-folder-open-3" => "moon-folder-open-3",

                "moon-certificate" => "moon-certificate",

                "moon-cc" => "moon-cc",

                "moon-tag" => "moon-tag",

                "moon-tag-2" => "moon-tag-2",

                "moon-tag-3" => "moon-tag-3",

                "moon-tag-4" => "moon-tag-4",

                "moon-tag-5" => "moon-tag-5",

                "moon-tag-6" => "moon-tag-6",

                "moon-tag-7" => "moon-tag-7",

                "moon-tags" => "moon-tags",

                "moon-tags-2" => "moon-tags-2",

                "moon-tag-8" => "moon-tag-8",

                "moon-barcode" => "moon-barcode",

                "moon-barcode-2" => "moon-barcode-2",

                "moon-qrcode" => "moon-qrcode",

                "moon-ticket" => "moon-ticket",

                "moon-cart" => "moon-cart",

                "moon-cart-2" => "moon-cart-2",

                "moon-cart-3" => "moon-cart-3",

                "moon-cart-4" => "moon-cart-4",

                "moon-cart-5" => "moon-cart-5",

                "moon-cart-6" => "moon-cart-6",

                "moon-cart-7" => "moon-cart-7",

                "moon-cart-plus" => "moon-cart-plus",

                "moon-cart-minus" => "moon-cart-minus",

                "moon-cart-add" => "moon-cart-add",

                "moon-cart-remove" => "moon-cart-remove",

                "moon-cart-checkout" => "moon-cart-checkout",

                "moon-cart-remove-2" => "moon-cart-remove-2",

                "moon-basket" => "moon-basket",

                "moon-basket-2" => "moon-basket-2",

                "moon-bag" => "moon-bag",

                "moon-bag-2" => "moon-bag-2",

                "moon-bag-3" => "moon-bag-3",

                "moon-coin" => "moon-coin",

                "moon-coins" => "moon-coins",

                "moon-credit" => "moon-credit",

                "moon-credit-2" => "moon-credit-2",

                "moon-calculate" => "moon-calculate",

                "moon-calculate-2" => "moon-calculate-2",

                "moon-support" => "moon-support",

                "moon-phone" => "moon-phone",

                "moon-phone-2" => "moon-phone-2",

                "moon-phone-3" => "moon-phone-3",

                "moon-phone-4" => "moon-phone-4",

                "moon-contact-add" => "moon-contact-add",

                "moon-contact-remove" => "moon-contact-remove",

                "moon-contact-add-2" => "moon-contact-add-2",

                "moon-contact-remove-2" => "moon-contact-remove-2",

                "moon-call-incoming" => "moon-call-incoming",

                "moon-call-outgoing" => "moon-call-outgoing",

                "moon-phone-5" => "moon-phone-5",

                "moon-phone-6" => "moon-phone-6",

                "moon-phone-hang-up" => "moon-phone-hang-up",

                "moon-phone-hang-up-2" => "moon-phone-hang-up-2",

                "moon-address-book" => "moon-address-book",

                "moon-address-book-2" => "moon-address-book-2",

                "moon-notebook" => "moon-notebook",

                "moon-envelop" => "moon-envelop",

                "moon-envelop-2" => "moon-envelop-2",

                "moon-mail-send" => "moon-mail-send",

                "moon-envelop-opened" => "moon-envelop-opened",

                "moon-envelop-3" => "moon-envelop-3",

                "moon-pushpin" => "moon-pushpin",

                "moon-location" => "moon-location",

                "moon-location-2" => "moon-location-2",

                "moon-location-3" => "moon-location-3",

                "moon-location-4" => "moon-location-4",

                "moon-location-5" => "moon-location-5",

                "moon-location-6" => "moon-location-6",

                "moon-location-7" => "moon-location-7",

                "moon-compass" => "moon-compass",

                "moon-compass-2" => "moon-compass-2",

                "moon-map" => "moon-map",

                "moon-map-2" => "moon-map-2",

                "moon-map-3" => "moon-map-3",

                "moon-map-4" => "moon-map-4",

                "moon-direction" => "moon-direction",

                "moon-history" => "moon-history",

                "moon-history-2" => "moon-history-2",

                "moon-clock" => "moon-clock",

                "moon-clock-2" => "moon-clock-2",

                "moon-clock-3" => "moon-clock-3",

                "moon-clock-4" => "moon-clock-4",

                "moon-watch" => "moon-watch",

                "moon-clock-5" => "moon-clock-5",

                "moon-clock-6" => "moon-clock-6",

                "moon-clock-7" => "moon-clock-7",

                "moon-alarm" => "moon-alarm",

                "moon-alarm-2" => "moon-alarm-2",

                "moon-bell" => "moon-bell",

                "moon-bell-2" => "moon-bell-2",

                "moon-alarm-plus" => "moon-alarm-plus",

                "moon-alarm-minus" => "moon-alarm-minus",

                "moon-alarm-check" => "moon-alarm-check",

                "moon-alarm-cancel" => "moon-alarm-cancel",

                "moon-stopwatch" => "moon-stopwatch",

                "moon-calendar" => "moon-calendar",

                "moon-calendar-2" => "moon-calendar-2",

                "moon-calendar-3" => "moon-calendar-3",

                "moon-calendar-4" => "moon-calendar-4",

                "moon-calendar-5" => "moon-calendar-5",

                "moon-print" => "moon-print",

                "moon-print-2" => "moon-print-2",

                "moon-print-3" => "moon-print-3",

                "moon-mouse" => "moon-mouse",

                "moon-mouse-2" => "moon-mouse-2",

                "moon-mouse-3" => "moon-mouse-3",

                "moon-mouse-4" => "moon-mouse-4",

                "moon-keyboard" => "moon-keyboard",

                "moon-keyboard-2" => "moon-keyboard-2",

                "moon-screen" => "moon-screen",

                "moon-screen-2" => "moon-screen-2",

                "moon-screen-3" => "moon-screen-3",

                "moon-screen-4" => "moon-screen-4",

                "moon-laptop" => "moon-laptop",

                "moon-mobile" => "moon-mobile",

                "moon-mobile-2" => "moon-mobile-2",

                "moon-tablet" => "moon-tablet",

                "moon-mobile-3" => "moon-mobile-3",

                "moon-tv" => "moon-tv",

                "moon-cabinet" => "moon-cabinet",

                "moon-archive" => "moon-archive",

                "moon-drawer" => "moon-drawer",

                "moon-drawer-2" => "moon-drawer-2",

                "moon-drawer-3" => "moon-drawer-3",

                "moon-box" => "moon-box",

                "moon-box-add" => "moon-box-add",

                "moon-box-remove" => "moon-box-remove",

                "moon-download" => "moon-download",

                "moon-upload" => "moon-upload",

                "moon-disk" => "moon-disk",

                "moon-cd" => "moon-cd",

                "moon-storage" => "moon-storage",

                "moon-storage-2" => "moon-storage-2",

                "moon-database" => "moon-database",

                "moon-database-2" => "moon-database-2",

                "moon-database-3" => "moon-database-3",

                "moon-undo" => "moon-undo",

                "moon-redo" => "moon-redo",

                "moon-rotate" => "moon-rotate",

                "moon-rotate-2" => "moon-rotate-2",

                "moon-flip" => "moon-flip",

                "moon-flip-2" => "moon-flip-2",

                "moon-unite" => "moon-unite",

                "moon-subtract" => "moon-subtract",

                "moon-interset" => "moon-interset",

                "moon-exclude" => "moon-exclude",

                "moon-align-left" => "moon-align-left",

                "moon-align-center-horizontal" => "moon-align-center-horizontal",

                "moon-align-right" => "moon-align-right",

                "moon-align-top" => "moon-align-top",

                "moon-align-center-vertical" => "moon-align-center-vertical",

                "moon-align-bottom" => "moon-align-bottom",

                "moon-undo-2" => "moon-undo-2",

                "moon-redo-2" => "moon-redo-2",

                "moon-forward" => "moon-forward",

                "moon-reply" => "moon-reply",

                "moon-reply-2" => "moon-reply-2",

                "moon-bubble" => "moon-bubble",

                "moon-bubbles" => "moon-bubbles",

                "moon-bubbles-2" => "moon-bubbles-2",

                "moon-bubble-2" => "moon-bubble-2",

                "moon-bubbles-3" => "moon-bubbles-3",

                "moon-bubbles-4" => "moon-bubbles-4",

                "moon-bubble-notification" => "moon-bubble-notification",

                "moon-bubbles-5" => "moon-bubbles-5",

                "moon-bubbles-6" => "moon-bubbles-6",

                "moon-bubble-3" => "moon-bubble-3",

                "moon-bubble-dots" => "moon-bubble-dots",

                "moon-bubble-4" => "moon-bubble-4",

                "moon-bubble-5" => "moon-bubble-5",

                "moon-bubble-dots-2" => "moon-bubble-dots-2",

                "moon-bubble-6" => "moon-bubble-6",

                "moon-bubble-7" => "moon-bubble-7",

                "moon-bubble-8" => "moon-bubble-8",

                "moon-bubbles-7" => "moon-bubbles-7",

                "moon-bubble-9" => "moon-bubble-9",

                "moon-bubbles-8" => "moon-bubbles-8",

                "moon-bubble-10" => "moon-bubble-10",

                "moon-bubble-dots-3" => "moon-bubble-dots-3",

                "moon-bubble-11" => "moon-bubble-11",

                "moon-bubble-12" => "moon-bubble-12",

                "moon-bubble-dots-4" => "moon-bubble-dots-4",

                "moon-bubble-13" => "moon-bubble-13",

                "moon-bubbles-9" => "moon-bubbles-9",

                "moon-bubbles-10" => "moon-bubbles-10",

                "moon-bubble-blocked" => "moon-bubble-blocked",

                "moon-bubble-quote" => "moon-bubble-quote",

                "moon-bubble-user" => "moon-bubble-user",

                "moon-bubble-check" => "moon-bubble-check",

                "moon-bubble-video-chat" => "moon-bubble-video-chat",

                "moon-bubble-link" => "moon-bubble-link",

                "moon-bubble-locked" => "moon-bubble-locked",

                "moon-bubble-star" => "moon-bubble-star",

                "moon-bubble-heart" => "moon-bubble-heart",

                "moon-bubble-paperclip" => "moon-bubble-paperclip",

                "moon-bubble-cancel" => "moon-bubble-cancel",

                "moon-bubble-plus" => "moon-bubble-plus",

                "moon-bubble-minus" => "moon-bubble-minus",

                "moon-bubble-notification-2" => "moon-bubble-notification-2",

                "moon-bubble-trash" => "moon-bubble-trash",

                "moon-bubble-left" => "moon-bubble-left",

                "moon-bubble-right" => "moon-bubble-right",

                "moon-bubble-up" => "moon-bubble-up",

                "moon-bubble-down" => "moon-bubble-down",

                "moon-bubble-first" => "moon-bubble-first",

                "moon-bubble-last" => "moon-bubble-last",

                "moon-bubble-replu" => "moon-bubble-replu",

                "moon-bubble-forward" => "moon-bubble-forward",

                "moon-bubble-reply" => "moon-bubble-reply",

                "moon-bubble-forward-2" => "moon-bubble-forward-2",

                "moon-user" => "moon-user",

                "moon-users" => "moon-users",

                "moon-user-plus" => "moon-user-plus",

                "moon-user-plus-2" => "moon-user-plus-2",

                "moon-user-minus" => "moon-user-minus",

                "moon-user-minus-2" => "moon-user-minus-2",

                "moon-user-cancel" => "moon-user-cancel",

                "moon-user-block" => "moon-user-block",

                "moon-users-2" => "moon-users-2",

                "moon-user-2" => "moon-user-2",

                "moon-users-3" => "moon-users-3",

                "moon-user-plus-3" => "moon-user-plus-3",

                "moon-user-minus-3" => "moon-user-minus-3",

                "moon-user-cancel-2" => "moon-user-cancel-2",

                "moon-user-block-2" => "moon-user-block-2",

                "moon-user-3" => "moon-user-3",

                "moon-user-4" => "moon-user-4",

                "moon-user-5" => "moon-user-5",

                "moon-user-6" => "moon-user-6",

                "moon-users-4" => "moon-users-4",

                "moon-user-7" => "moon-user-7",

                "moon-user-8" => "moon-user-8",

                "moon-users-5" => "moon-users-5",

                "moon-vcard" => "moon-vcard",

                "moon-tshirt" => "moon-tshirt",

                "moon-hanger" => "moon-hanger",

                "moon-quotes-left" => "moon-quotes-left",

                "moon-quotes-right" => "moon-quotes-right",

                "moon-quotes-right-2" => "moon-quotes-right-2",

                "moon-quotes-right-3" => "moon-quotes-right-3",

                "moon-busy" => "moon-busy",

                "moon-busy-2" => "moon-busy-2",

                "moon-busy-3" => "moon-busy-3",

                "moon-busy-4" => "moon-busy-4",

                "moon-spinner" => "moon-spinner",

                "moon-spinner-2" => "moon-spinner-2",

                "moon-spinner-3" => "moon-spinner-3",

                "moon-spinner-4" => "moon-spinner-4",

                "moon-spinner-5" => "moon-spinner-5",

                "moon-spinner-6" => "moon-spinner-6",

                "moon-spinner-7" => "moon-spinner-7",

                "moon-spinner-8" => "moon-spinner-8",

                "moon-spinner-9" => "moon-spinner-9",

                "moon-spinner-10" => "moon-spinner-10",

                "moon-spinner-11" => "moon-spinner-11",

                "moon-spinner-12" => "moon-spinner-12",

                "moon-microscope" => "moon-microscope",

                "moon-binoculars" => "moon-binoculars",

                "moon-binoculars-2" => "moon-binoculars-2",

                "moon-search" => "moon-search",

                "moon-search-2" => "moon-search-2",

                "moon-zoom-in" => "moon-zoom-in",

                "moon-zoom-out" => "moon-zoom-out",

                "moon-search-3" => "moon-search-3",

                "moon-search-4" => "moon-search-4",

                "moon-zoom-in-2" => "moon-zoom-in-2",

                "moon-zoom-out-2" => "moon-zoom-out-2",

                "moon-search-5" => "moon-search-5",

                "moon-expand" => "moon-expand",

                "moon-contract" => "moon-contract",

                "moon-scale-up" => "moon-scale-up",

                "moon-scale-down" => "moon-scale-down",

                "moon-expand-2" => "moon-expand-2",

                "moon-contract-2" => "moon-contract-2",

                "moon-scale-up-2" => "moon-scale-up-2",

                "moon-scale-down-2" => "moon-scale-down-2",

                "moon-fullscreen" => "moon-fullscreen",

                "moon-expand-3" => "moon-expand-3",

                "moon-contract-3" => "moon-contract-3",

                "moon-key" => "moon-key",

                "moon-key-2" => "moon-key-2",

                "moon-key-3" => "moon-key-3",

                "moon-key-4" => "moon-key-4",

                "moon-key-5" => "moon-key-5",

                "moon-keyhole" => "moon-keyhole",

                "moon-lock" => "moon-lock",

                "moon-lock-2" => "moon-lock-2",

                "moon-lock-3" => "moon-lock-3",

                "moon-lock-4" => "moon-lock-4",

                "moon-unlocked" => "moon-unlocked",

                "moon-lock-5" => "moon-lock-5",

                "moon-unlocked-2" => "moon-unlocked-2",

                "moon-wrench" => "moon-wrench",

                "moon-wrench-2" => "moon-wrench-2",

                "moon-wrench-3" => "moon-wrench-3",

                "moon-wrench-4" => "moon-wrench-4",

                "moon-settings" => "moon-settings",

                "moon-equalizer" => "moon-equalizer",

                "moon-equalizer-2" => "moon-equalizer-2",

                "moon-equalizer-3" => "moon-equalizer-3",

                "moon-cog" => "moon-cog",

                "moon-cogs" => "moon-cogs",

                "moon-cog-2" => "moon-cog-2",

                "moon-cog-3" => "moon-cog-3",

                "moon-cog-4" => "moon-cog-4",

                "moon-cog-5" => "moon-cog-5",

                "moon-cog-6" => "moon-cog-6",

                "moon-cog-7" => "moon-cog-7",

                "moon-factory" => "moon-factory",

                "moon-hammer" => "moon-hammer",

                "moon-tools" => "moon-tools",

                "moon-screwdriver" => "moon-screwdriver",

                "moon-screwdriver-2" => "moon-screwdriver-2",

                "moon-wand" => "moon-wand",

                "moon-wand-2" => "moon-wand-2",

                "moon-health" => "moon-health",

                "moon-aid" => "moon-aid",

                "moon-patch" => "moon-patch",

                "moon-bug" => "moon-bug",

                "moon-bug-2" => "moon-bug-2",

                "moon-inject" => "moon-inject",

                "moon-inject-2" => "moon-inject-2",

                "moon-construction" => "moon-construction",

                "moon-cone" => "moon-cone",

                "moon-pie" => "moon-pie",

                "moon-pie-2" => "moon-pie-2",

                "moon-pie-3" => "moon-pie-3",

                "moon-pie-4" => "moon-pie-4",

                "moon-pie-5" => "moon-pie-5",

                "moon-pie-6" => "moon-pie-6",

                "moon-pie-7" => "moon-pie-7",

                "moon-stats" => "moon-stats",

                "moon-stats-2" => "moon-stats-2",

                "moon-stats-3" => "moon-stats-3",

                "moon-bars" => "moon-bars",

                "moon-bars-2" => "moon-bars-2",

                "moon-bars-3" => "moon-bars-3",

                "moon-bars-4" => "moon-bars-4",

                "moon-bars-5" => "moon-bars-5",

                "moon-bars-6" => "moon-bars-6",

                "moon-stats-up" => "moon-stats-up",

                "moon-stats-down" => "moon-stats-down",

                "moon-stairs-down" => "moon-stairs-down",

                "moon-stairs-down-2" => "moon-stairs-down-2",

                "moon-chart" => "moon-chart",

                "moon-stairs" => "moon-stairs",

                "moon-stairs-2" => "moon-stairs-2",

                "moon-ladder" => "moon-ladder",

                "moon-cake" => "moon-cake",

                "moon-gift" => "moon-gift",

                "moon-gift-2" => "moon-gift-2",

                "moon-balloon" => "moon-balloon",

                "moon-rating" => "moon-rating",

                "moon-rating-2" => "moon-rating-2",

                "moon-rating-3" => "moon-rating-3",

                "moon-podium" => "moon-podium",

                "moon-medal" => "moon-medal",

                "moon-medal-2" => "moon-medal-2",

                "moon-medal-3" => "moon-medal-3",

                "moon-medal-4" => "moon-medal-4",

                "moon-medal-5" => "moon-medal-5",

                "moon-crown" => "moon-crown",

                "moon-trophy" => "moon-trophy",

                "moon-trophy-2" => "moon-trophy-2",

                "moon-trophy-star" => "moon-trophy-star",

                "moon-diamond" => "moon-diamond",

                "moon-diamond-2" => "moon-diamond-2",

                "moon-glass" => "moon-glass",

                "moon-glass-2" => "moon-glass-2",

                "moon-bottle" => "moon-bottle",

                "moon-bottle-2" => "moon-bottle-2",

                "moon-mug" => "moon-mug",

                "moon-food" => "moon-food",

                "moon-food-2" => "moon-food-2",

                "moon-hamburger" => "moon-hamburger",

                "moon-cup" => "moon-cup",

                "moon-cup-2" => "moon-cup-2",

                "moon-leaf" => "moon-leaf",

                "moon-leaf-2" => "moon-leaf-2",

                "moon-apple-fruit" => "moon-apple-fruit",

                "moon-tree" => "moon-tree",

                "moon-tree-2" => "moon-tree-2",

                "moon-paw" => "moon-paw",

                "moon-steps" => "moon-steps",

                "moon-flower" => "moon-flower",

                "moon-rocket" => "moon-rocket",

                "moon-meter" => "moon-meter",

                "moon-meter2" => "moon-meter2",

                "moon-meter-slow" => "moon-meter-slow",

                "moon-meter-medium" => "moon-meter-medium",

                "moon-meter-fast" => "moon-meter-fast",

                "moon-dashboard" => "moon-dashboard",

                "moon-hammer-2" => "moon-hammer-2",

                "moon-balance" => "moon-balance",

                "moon-bomb" => "moon-bomb",

                "moon-fire" => "moon-fire",

                "moon-fire-2" => "moon-fire-2",

                "moon-lab" => "moon-lab",

                "moon-atom" => "moon-atom",

                "moon-atom-2" => "moon-atom-2",

                "moon-magnet" => "moon-magnet",

                "moon-magnet-2" => "moon-magnet-2",

                "moon-magnet-3" => "moon-magnet-3",

                "moon-magnet-4" => "moon-magnet-4",

                "moon-dumbbell" => "moon-dumbbell",

                "moon-skull" => "moon-skull",

                "moon-skull-2" => "moon-skull-2",

                "moon-skull-3" => "moon-skull-3",

                "moon-lamp" => "moon-lamp",

                "moon-lamp-2" => "moon-lamp-2",

                "moon-lamp-3" => "moon-lamp-3",

                "moon-lamp-4" => "moon-lamp-4",

                "moon-remove" => "moon-remove",

                "moon-remove-2" => "moon-remove-2",

                "moon-remove-3" => "moon-remove-3",

                "moon-remove-4" => "moon-remove-4",

                "moon-remove-5" => "moon-remove-5",

                "moon-remove-6" => "moon-remove-6",

                "moon-remove-7" => "moon-remove-7",

                "moon-remove-8" => "moon-remove-8",

                "moon-briefcase" => "moon-briefcase",

                "moon-briefcase-2" => "moon-briefcase-2",

                "moon-briefcase-3" => "moon-briefcase-3",

                "moon-airplane" => "moon-airplane",

                "moon-airplane-2" => "moon-airplane-2",

                "moon-paper-plane" => "moon-paper-plane",

                "moon-car" => "moon-car",

                "moon-gas-pump" => "moon-gas-pump",

                "moon-bus" => "moon-bus",

                "moon-truck" => "moon-truck",

                "moon-bike" => "moon-bike",

                "moon-road" => "moon-road",

                "moon-train" => "moon-train",

                "moon-ship" => "moon-ship",

                "moon-boat" => "moon-boat",

                "moon-cube" => "moon-cube",

                "moon-cube-2" => "moon-cube-2",

                "moon-cube-3" => "moon-cube-3",

                "moon-cube4" => "moon-cube4",

                "moon-pyramid" => "moon-pyramid",

                "moon-pyramid-2" => "moon-pyramid-2",

                "moon-cylinder" => "moon-cylinder",

                "moon-package" => "moon-package",

                "moon-puzzle" => "moon-puzzle",

                "moon-puzzle-2" => "moon-puzzle-2",

                "moon-puzzle-3" => "moon-puzzle-3",

                "moon-puzzle-4" => "moon-puzzle-4",

                "moon-glasses" => "moon-glasses",

                "moon-glasses-2" => "moon-glasses-2",

                "moon-glasses-3" => "moon-glasses-3",

                "moon-sun-glasses" => "moon-sun-glasses",

                "moon-accessibility" => "moon-accessibility",

                "moon-accessibility-2" => "moon-accessibility-2",

                "moon-brain" => "moon-brain",

                "moon-target" => "moon-target",

                "moon-target-2" => "moon-target-2",

                "moon-target-3" => "moon-target-3",

                "moon-gun" => "moon-gun",

                "moon-gun-ban" => "moon-gun-ban",

                "moon-shield" => "moon-shield",

                "moon-shield-2" => "moon-shield-2",

                "moon-shield-3" => "moon-shield-3",

                "moon-shield-4" => "moon-shield-4",

                "moon-soccer" => "moon-soccer",

                "moon-football" => "moon-football",

                "moon-baseball" => "moon-baseball",

                "moon-basketball" => "moon-basketball",

                "moon-golf" => "moon-golf",

                "moon-hockey" => "moon-hockey",

                "moon-racing" => "moon-racing",

                "moon-eight-ball" => "moon-eight-ball",

                "moon-bowling-ball" => "moon-bowling-ball",

                "moon-bowling" => "moon-bowling",

                "moon-bowling-2" => "moon-bowling-2",

                "moon-lightning" => "moon-lightning",

                "moon-power" => "moon-power",

                "moon-power-2" => "moon-power-2",

                "moon-switch" => "moon-switch",

                "moon-power-cord" => "moon-power-cord",

                "moon-cord" => "moon-cord",

                "moon-socket" => "moon-socket",

                "moon-clipboard" => "moon-clipboard",

                "moon-clipboard-2" => "moon-clipboard-2",

                "moon-signup" => "moon-signup",

                "moon-clipboard-3" => "moon-clipboard-3",

                "moon-clipboard-4" => "moon-clipboard-4",

                "moon-list" => "moon-list",

                "moon-list-2" => "moon-list-2",

                "moon-list-3" => "moon-list-3",

                "moon-numbered-list" => "moon-numbered-list",

                "moon-list-4" => "moon-list-4",

                "moon-list-5" => "moon-list-5",

                "moon-playlist" => "moon-playlist",

                "moon-grid" => "moon-grid",

                "moon-grid-2" => "moon-grid-2",

                "moon-grid-3" => "moon-grid-3",

                "moon-grid-4" => "moon-grid-4",

                "moon-grid-5" => "moon-grid-5",

                "moon-grid-6" => "moon-grid-6",

                "moon-tree-3" => "moon-tree-3",

                "moon-tree-4" => "moon-tree-4",

                "moon-tree-5" => "moon-tree-5",

                "moon-menu" => "moon-menu",

                "moon-menu-2" => "moon-menu-2",

                "moon-circle-small" => "moon-circle-small",

                "moon-menu-3" => "moon-menu-3",

                "moon-menu-4" => "moon-menu-4",

                "moon-menu-5" => "moon-menu-5",

                "moon-menu-6" => "moon-menu-6",

                "moon-menu-7" => "moon-menu-7",

                "moon-menu-8" => "moon-menu-8",

                "moon-menu-9" => "moon-menu-9",

                "moon-cloud" => "moon-cloud",

                "moon-cloud-2" => "moon-cloud-2",

                "moon-cloud-3" => "moon-cloud-3",

                "moon-cloud-download" => "moon-cloud-download",

                "moon-cloud-upload" => "moon-cloud-upload",

                "moon-download-2" => "moon-download-2",

                "moon-upload-2" => "moon-upload-2",

                "moon-download-3" => "moon-download-3",

                "moon-upload-3" => "moon-upload-3",

                "moon-download-4" => "moon-download-4",

                "moon-upload-4" => "moon-upload-4",

                "moon-download-5" => "moon-download-5",

                "moon-upload-5" => "moon-upload-5",

                "moon-download-6" => "moon-download-6",

                "moon-upload-6" => "moon-upload-6",

                "moon-download-7" => "moon-download-7",

                "moon-upload-7" => "moon-upload-7",

                "moon-globe" => "moon-globe",

                "moon-globe-2" => "moon-globe-2",

                "moon-globe-3" => "moon-globe-3",

                "moon-earth" => "moon-earth",

                "moon-network" => "moon-network",

                "moon-link" => "moon-link",

                "moon-link-2" => "moon-link-2",

                "moon-link-3" => "moon-link-3",

                "moon-link2" => "moon-link2",

                "moon-link-4" => "moon-link-4",

                "moon-link-5" => "moon-link-5",

                "moon-link-6" => "moon-link-6",

                "moon-anchor" => "moon-anchor",

                "moon-flag" => "moon-flag",

                "moon-flag-2" => "moon-flag-2",

                "moon-flag-3" => "moon-flag-3",

                "moon-flag-4" => "moon-flag-4",

                "moon-flag-5" => "moon-flag-5",

                "moon-flag-6" => "moon-flag-6",

                "moon-attachment" => "moon-attachment",

                "moon-attachment-2" => "moon-attachment-2",

                "moon-eye" => "moon-eye",

                "moon-eye-blocked" => "moon-eye-blocked",

                "moon-eye-2" => "moon-eye-2",

                "moon-eye-3" => "moon-eye-3",

                "moon-eye-blocked-2" => "moon-eye-blocked-2",

                "moon-eye-4" => "moon-eye-4",

                "moon-eye-5" => "moon-eye-5",

                "moon-eye-6" => "moon-eye-6",

                "moon-eye-7" => "moon-eye-7",

                "moon-eye-8" => "moon-eye-8",

                "moon-bookmark" => "moon-bookmark",

                "moon-bookmark-2" => "moon-bookmark-2",

                "moon-bookmarks" => "moon-bookmarks",

                "moon-bookmark-3" => "moon-bookmark-3",

                "moon-spotlight" => "moon-spotlight",

                "moon-starburst" => "moon-starburst",

                "moon-snowflake" => "moon-snowflake",

                "moon-temperature" => "moon-temperature",

                "moon-temperature-2" => "moon-temperature-2",

                "moon-weather-lightning" => "moon-weather-lightning",

                "moon-weather-rain" => "moon-weather-rain",

                "moon-weather-snow" => "moon-weather-snow",

                "moon-windy" => "moon-windy",

                "moon-fan" => "moon-fan",

                "moon-umbrella" => "moon-umbrella",

                "moon-sun" => "moon-sun",

                "moon-sun-2" => "moon-sun-2",

                "moon-brightness-high" => "moon-brightness-high",

                "moon-brightness-medium" => "moon-brightness-medium",

                "moon-brightness-low" => "moon-brightness-low",

                "moon-brightness-contrast" => "moon-brightness-contrast",

                "moon-contrast" => "moon-contrast",



                "moon-bed" => "moon-bed",

                "moon-bed-2" => "moon-bed-2",

                "moon-star" => "moon-star",

                "moon-star-2" => "moon-star-2",

                "moon-star-3" => "moon-star-3",

                "moon-star-4" => "moon-star-4",

                "moon-star-5" => "moon-star-5",

                "moon-star-6" => "moon-star-6",

                "moon-heart" => "moon-heart",

                "moon-heart-2" => "moon-heart-2",

                "moon-heart-3" => "moon-heart-3",

                "moon-heart-4" => "moon-heart-4",

                "moon-heart-broken" => "moon-heart-broken",

                "moon-heart-5" => "moon-heart-5",

                "moon-heart-6" => "moon-heart-6",

                "moon-heart-broken-2" => "moon-heart-broken-2",

                "moon-heart-7" => "moon-heart-7",

                "moon-heart-8" => "moon-heart-8",

                "moon-heart-broken-3" => "moon-heart-broken-3",

                "moon-lips" => "moon-lips",

                "moon-lips-2" => "moon-lips-2",

                "moon-thumbs-up" => "moon-thumbs-up",

                "moon-thumbs-up-2" => "moon-thumbs-up-2",

                "moon-thumbs-down" => "moon-thumbs-down",

                "moon-thumbs-down-2" => "moon-thumbs-down-2",

                "moon-thumbs-up-3" => "moon-thumbs-up-3",

                "moon-thumbs-up-4" => "moon-thumbs-up-4",

                "moon-thumbs-up-5" => "moon-thumbs-up-5",

                "moon-thumbs-up-6" => "moon-thumbs-up-6",

                "moon-people" => "moon-people",

                "moon-man" => "moon-man",

                "moon-male" => "moon-male",

                "moon-woman" => "moon-woman",

                "moon-female" => "moon-female",

                "moon-peace" => "moon-peace",

                "moon-yin-yang" => "moon-yin-yang",

                "moon-happy" => "moon-happy",

                "moon-happy-2" => "moon-happy-2",

                "moon-smiley" => "moon-smiley",

                "moon-smiley-2" => "moon-smiley-2",

                "moon-tongue" => "moon-tongue",

                "moon-tongue-2" => "moon-tongue-2",

                "moon-sad" => "moon-sad",

                "moon-sad-2" => "moon-sad-2",

                "moon-wink" => "moon-wink",

                "moon-wink-2" => "moon-wink-2",

                "moon-grin" => "moon-grin",

                "moon-grin-2" => "moon-grin-2",

                "moon-cool" => "moon-cool",

                "moon-cool-2" => "moon-cool-2",

                "moon-angry" => "moon-angry",

                "moon-angry-2" => "moon-angry-2",

                "moon-evil" => "moon-evil",

                "moon-evil-2" => "moon-evil-2",

                "moon-shocked" => "moon-shocked",

                "moon-shocked-2" => "moon-shocked-2",

                "moon-confused" => "moon-confused",

                "moon-confused-2" => "moon-confused-2",

                "moon-neutral" => "moon-neutral",

                "moon-neutral-2" => "moon-neutral-2",

                "moon-wondering" => "moon-wondering",

                "moon-wondering-2" => "moon-wondering-2",

                "moon-cursor" => "moon-cursor",

                "moon-cursor-2" => "moon-cursor-2",

                "moon-point-up" => "moon-point-up",

                "moon-point-right" => "moon-point-right",

                "moon-point-down" => "moon-point-down",

                "moon-point-left" => "moon-point-left",

                "moon-pointer" => "moon-pointer",

                "moon-hand" => "moon-hand",

                "moon-stack-empty" => "moon-stack-empty",

                "moon-stack-plus" => "moon-stack-plus",

                "moon-stack-minus" => "moon-stack-minus",

                "moon-stack-star" => "moon-stack-star",

                "moon-stack-picture" => "moon-stack-picture",

                "moon-stack-down" => "moon-stack-down",

                "moon-stack-up" => "moon-stack-up",

                "moon-stack-cancel" => "moon-stack-cancel",

                "moon-stack-checkmark" => "moon-stack-checkmark",

                "moon-stack-list" => "moon-stack-list",

                "moon-stack-clubs" => "moon-stack-clubs",

                "moon-stack-spades" => "moon-stack-spades",

                "moon-stack-hearts" => "moon-stack-hearts",

                "moon-stack-diamonds" => "moon-stack-diamonds",

                "moon-stack-user" => "moon-stack-user",

                "moon-stack-4" => "moon-stack-4",

                "moon-stack-music" => "moon-stack-music",

                "moon-stack-play" => "moon-stack-play",

                "moon-move" => "moon-move",

                "moon-resize" => "moon-resize",

                "moon-resize-2" => "moon-resize-2",

                "moon-warning" => "moon-warning",

                "moon-warning-2" => "moon-warning-2",

                "moon-notification" => "moon-notification",

                "moon-notification-2" => "moon-notification-2",

                "moon-question" => "moon-question",

                "moon-question-2" => "moon-question-2",

                "moon-question-3" => "moon-question-3",

                "moon-question-4" => "moon-question-4",

                "moon-question-5" => "moon-question-5",

                "moon-plus-circle" => "moon-plus-circle",

                "moon-plus-circle-2" => "moon-plus-circle-2",

                "moon-minus-circle" => "moon-minus-circle",

                "moon-minus-circle-2" => "moon-minus-circle-2",

                "moon-info" => "moon-info",

                "moon-info-2" => "moon-info-2",

                "moon-blocked" => "moon-blocked",

                "moon-cancel-circle" => "moon-cancel-circle",

                "moon-cancel-circle-2" => "moon-cancel-circle-2",

                "moon-checkmark-circle" => "moon-checkmark-circle",

                "moon-checkmark-circle-2" => "moon-checkmark-circle-2",

                "moon-cancel" => "moon-cancel",

                "moon-spam" => "moon-spam",

                "moon-close" => "moon-close",

                "moon-close-2" => "moon-close-2",

                "moon-close-3" => "moon-close-3",

                "moon-close-4" => "moon-close-4",

                "moon-close-5" => "moon-close-5",

                "moon-checkmark" => "moon-checkmark",

                "moon-checkmark-2" => "moon-checkmark-2",

                "moon-checkmark-3" => "moon-checkmark-3",

                "moon-checkmark-4" => "moon-checkmark-4",

                "moon-spell-check" => "moon-spell-check",

                "moon-minus" => "moon-minus",

                "moon-plus" => "moon-plus",

                "moon-minus-2" => "moon-minus-2",

                "moon-plus-2" => "moon-plus-2",

                "moon-enter" => "moon-enter",

                "moon-exit" => "moon-exit",

                "moon-enter-2" => "moon-enter-2",

                "moon-exit-2" => "moon-exit-2",

                "moon-enter-3" => "moon-enter-3",

                "moon-exit-3" => "moon-exit-3",

                "moon-exit-4" => "moon-exit-4",

                "moon-play-3" => "moon-play-3",

                "moon-pause" => "moon-pause",

                "moon-stop" => "moon-stop",

                "moon-backward" => "moon-backward",

                "moon-forward-2" => "moon-forward-2",

                "moon-play-4" => "moon-play-4", 

                "moon-pause-2" => "moon-play-4", 

                "moon-pause-2" => 'moon-pause-2',

                "moon-stop-2" => "moon-stop-2",

                "moon-backward-2" => "moon-backward-2",

                "moon-forward-3" => "moon-forward-3",

                "moon-first" => "moon-first",

                "moon-last" => "moon-last",

                "moon-previous" => "moon-previous",

                "moon-next" => "moon-next",

                "moon-eject" => "moon-eject",

                "moon-volume-high" => "moon-volume-high",

                "moon-volume-medium" => "moon-volume-medium",

                "moon-volume-low" => "moon-volume-low",

                "moon-volume-mute" => "moon-volume-mute",

                "moon-volume-mute-2" => "moon-volume-mute-2",

                "moon-volume-increase" => "moon-volume-increase",

                "moon-volume-decrease" => "moon-volume-decrease",

                "moon-volume-high-2" => "moon-volume-high-2",

                "moon-volume-medium-2" => "moon-volume-medium-2",

                "moon-volume-low-2" => "moon-volume-low-2",

                "moon-volume-mute-3" => "moon-volume-mute-3",

                "moon-volume-mute-4" => "moon-volume-mute-4",

                "moon-volume-increase-2" => "moon-volume-increase-2",

                "moon-volume-decrease-2" => "moon-volume-decrease-2",

                "moon-volume5" => "moon-volume5",

                "moon-volume4" => "moon-volume4",

                "moon-volume3" => "moon-volume3",

                "moon-volume2" => "moon-volume2",

                "moon-volume1" => "moon-volume1",

                "moon-volume0" => "moon-volume0",

                "moon-volume-mute-5" => "moon-volume-mute-5",

                "moon-volume-mute-6" => "moon-volume-mute-6",

                "moon-loop" => "moon-loop",

                "moon-loop-2" => "moon-loop-2",

                "moon-loop-3" => "moon-loop-3",

                "moon-loop-4" => "moon-loop-4",

                "moon-loop-5" => "moon-loop-5",

                "moon-shuffle" => "moon-shuffle",

                "moon-shuffle-2" => "moon-shuffle-2",

                "moon-wave" => "moon-wave",

                "moon-wave-2" => "moon-wave-2",

                "moon-arrow-first" => "moon-arrow-first",

                "moon-arrow-right" => "moon-arrow-right",

                "moon-arrow-up" => "moon-arrow-up",

                "moon-arrow-right-2" => "moon-arrow-right-2",

                "moon-arrow-down" => "moon-arrow-down",

                "moon-arrow-left" => "moon-arrow-left",

                "moon-arrow-up-2" => "moon-arrow-up-2",

                "moon-arrow-right-3" => "moon-arrow-right-3",

                "moon-arrow-down-2" => "moon-arrow-down-2",

                "moon-arrow-left-2" => "moon-arrow-left-2",

                "moon-arrow-up-left" => "moon-arrow-up-left",

                "moon-arrow-up-3" => "moon-arrow-up-3",

                "moon-arrow-up-right" => "moon-arrow-up-right",

                "moon-arrow-right-4" => "moon-arrow-right-4",

                "moon-arrow-down-right" => "moon-arrow-down-right",

                "moon-arrow-down-3" => "moon-arrow-down-3",

                "moon-arrow-down-left" => "moon-arrow-down-left",

                "moon-arrow-left-3" => "moon-arrow-left-3",

                "moon-arrow-up-left-2" => "moon-arrow-up-left-2",

                "moon-arrow-up-4" => "moon-arrow-up-4",

                "moon-arrow-up-right-2" => "moon-arrow-up-right-2",

                "moon-arrow-right-5" => "moon-arrow-right-5",

                "moon-arrow-down-right-2" => "moon-arrow-down-right-2",

                "moon-arrow-down-4" => "moon-arrow-down-4",

                "moon-arrow-down-left-2" => "moon-arrow-down-left-2",

                "moon-arrow-left-4" => "moon-arrow-left-4",

                "moon-arrow-up-left-3" => "moon-arrow-up-left-3",

                "moon-arrow-up-5" => "moon-arrow-up-5",

                "moon-arrow-up-right-3" => "moon-arrow-up-right-3",

                "moon-arrow-right-6" => "moon-arrow-right-6",

                "moon-arrow-down-right-3" => "moon-arrow-down-right-3",

                "moon-arrow-down-5" => "moon-arrow-down-5",

                "moon-arrow-down-left-3" => "moon-arrow-down-left-3",

                "moon-arrow-left-5" => "moon-arrow-left-5",

                "moon-arrow-up-left-4" => "moon-arrow-up-left-4",

                "moon-arrow-up-6" => "moon-arrow-up-6",

                "moon-arrow-up-right-4" => "moon-arrow-up-right-4",

                "moon-arrow-right-7" => "moon-arrow-right-7",

                "moon-arrow-down-right-4" => "moon-arrow-down-right-4",

                "moon-arrow-down-6" => "moon-arrow-down-6",

                "moon-arrow-down-left-4" => "moon-arrow-down-left-4",

                "moon-arrow-left-6" => "moon-arrow-left-6",

                "moon-arrow" => "moon-arrow",

                "moon-arrow-2" => "moon-arrow-2",

                "moon-arrow-3" => "moon-arrow-3",

                "moon-arrow-4" => "moon-arrow-4",

                "moon-arrow-5" => "moon-arrow-5",

                "moon-arrow-6" => "moon-arrow-6",

                "moon-arrow-7" => "moon-arrow-7",

                "moon-arrow-8" => "moon-arrow-8",

                "moon-arrow-up-left-5" => "moon-arrow-up-left-5",

                "moon-arrow-square" => "moon-arrow-square",

                "moon-arrow-up-right-5" => "moon-arrow-up-right-5",

                "moon-arrow-right-8" => "moon-arrow-right-8",

                "moon-arrow-down-right-5" => "moon-arrow-down-right-5",

                "moon-arrow-down-7" => "moon-arrow-down-7",

                "moon-arrow-down-left-5" => "moon-arrow-down-left-5",

                "moon-arrow-left-7" => "moon-arrow-left-7",

                "moon-arrow-up-7" => "moon-arrow-up-7",

                "moon-arrow-right-9" => "moon-arrow-right-9",

                "moon-arrow-down-8" => "moon-arrow-down-8",

                "moon-arrow-left-8" => "moon-arrow-left-8",

                "moon-arrow-up-8" => "moon-arrow-up-8",

                "moon-arrow-right-10" => "moon-arrow-right-10",

                "moon-arrow-bottom" => "moon-arrow-bottom",

                "moon-arrow-left-9" => "moon-arrow-left-9",

                "moon-arrow-up-left-6" => "moon-arrow-up-left-6",

                "moon-arrow-up-9" => "moon-arrow-up-9",

                "moon-arrow-up-right-6" => "moon-arrow-up-right-6",

                "moon-arrow-right-11" => "moon-arrow-right-11",

                "moon-arrow-down-right-6" => "moon-arrow-down-right-6",

                "moon-arrow-down-9" => "moon-arrow-down-9",

                "moon-arrow-down-left-6" => "moon-arrow-down-left-6",

                "moon-arrow-left-10" => "moon-arrow-left-10",

                "moon-arrow-up-left-7" => "moon-arrow-up-left-7",

                "moon-arrow-up-10" => "moon-arrow-up-10",

                "moon-arrow-up-right-7" => "moon-arrow-up-right-7",

                "moon-arrow-right-12" => "moon-arrow-right-12",

                "moon-arrow-down-right-7" => "moon-arrow-down-right-7",

                "moon-arrow-down-10" => "moon-arrow-down-10",

                "moon-arrow-down-left-7" => "moon-arrow-down-left-7",

                "moon-arrow-left-11" => "moon-arrow-left-11",

                "moon-arrow-up-11" => "moon-arrow-up-11",

                "moon-arrow-right-13" => "moon-arrow-right-13",

                "moon-arrow-down-11" => "moon-arrow-down-11",

                "moon-arrow-left-12" => "moon-arrow-left-12",

                "moon-arrow-up-12" => "moon-arrow-up-12",

                "moon-arrow-right-14" => "moon-arrow-right-14",

                "moon-arrow-down-12" => "moon-arrow-down-12",

                "moon-arrow-left-13" => "moon-arrow-left-13",

                "moon-arrow-up-13" => "moon-arrow-up-13",

                "moon-arrow-right-15" => "moon-arrow-right-15",

                "moon-arrow-down-13" => "moon-arrow-down-13",

                "moon-arrow-left-14" => "moon-arrow-left-14",

                "moon-arrow-up-14" => "moon-arrow-up-14",

                "moon-arrow-right-16" => "moon-arrow-right-16",

                "moon-arrow-down-14" => "moon-arrow-down-14",

                "moon-arrow-left-15" => "moon-arrow-left-15",

                "moon-arrow-up-15" => "moon-arrow-up-15",

                "moon-arrow-right-17" => "moon-arrow-right-17",

                "moon-arrow-down-15" => "moon-arrow-down-15",

                "moon-arrow-left-16" => "moon-arrow-left-16",

                "moon-arrow-up-16" => "moon-arrow-up-16",

                "moon-arrow-right-18" => "moon-arrow-right-18",

                "moon-arrow-down-16" => "moon-arrow-down-16",

                "moon-arrow-left-17" => "moon-arrow-left-17",

                "moon-menu-10" => "moon-menu-10",

                "moon-menu-11" => "moon-menu-11",

                "moon-menu-close" => "moon-menu-close",

                "moon-menu-close-2" => "moon-menu-close-2",

                "moon-enter-4" => "moon-enter-4",

                "moon-enter-5" => "moon-enter-5",

                "moon-esc" => "moon-esc",

                "moon-backspace" => "moon-backspace",

                "moon-backspace-2" => "moon-backspace-2",

                "moon-backspace-3" => "moon-backspace-3",

                "moon-tab" => "moon-tab",

                "moon-transmission" => "moon-transmission",

                "moon-transmission-2" => "moon-transmission-2",

                "moon-sort" => "moon-sort",

                "moon-sort-2" => "moon-sort-2",

                "moon-key-keyboard" => "moon-key-keyboard",

                "moon-key-A" => "moon-key-A",

                "moon-key-up" => "moon-key-up",

                "moon-key-right" => "moon-key-right",

                "moon-key-down" => "moon-key-down",

                "moon-key-left" => "moon-key-left",

                "moon-command" => "moon-command",

                "moon-checkbox-checked" => "moon-checkbox-checked",

                "moon-checkbox-unchecked" => "moon-checkbox-unchecked",

                "moon-square" => "moon-square",

                "moon-checkbox-partial" => "moon-checkbox-partial",

                "moon-checkbox" => "moon-checkbox",

                "moon-checkbox-unchecked-2" => "moon-checkbox-unchecked-2",

                "moon-checkbox-partial-2" => "moon-checkbox-partial-2",

                "moon-checkbox-checked-2" => "moon-checkbox-checked-2",

                "moon-checkbox-unchecked-3" => "moon-checkbox-unchecked-3",

                "moon-checkbox-partial-3" => "moon-checkbox-partial-3",

                "moon-radio-checked" => "moon-radio-checked",

                "moon-radio-unchecked" => "moon-radio-unchecked",

                "moon-circle" => "moon-circle",

                "moon-circle-2" => "moon-circle-2",

                "moon-crop" => "moon-crop",

                "moon-crop-2" => "moon-crop-2",

                "moon-vector" => "moon-vector",

                "moon-rulers" => "moon-rulers",

                "moon-scissors" => "moon-scissors",

                "moon-scissors-2" => "moon-scissors-2",

                "moon-scissors-3" => "moon-scissors-3",

                "moon-filter" => "moon-filter",

                "moon-filter-2" => "moon-filter-2",

                "moon-filter-3" => "moon-filter-3",

                "moon-filter-4" => "moon-filter-4",

                "moon-font" => "moon-font",

                "moon-font-size" => "moon-font-size",

                "moon-type" => "moon-type",

                "moon-text-height" => "moon-text-height",

                "moon-text-width" => "moon-text-width",

                "moon-height" => "moon-height",

                "moon-width" => "moon-width",

                "moon-bold" => "moon-bold",

                "moon-underline" => "moon-underline",

                "moon-italic" => "moon-italic",

                "moon-strikethrough" => "moon-strikethrough",

                "moon-strikethrough-2" => "moon-strikethrough-2",

                "moon-font-size-2" => "moon-font-size-2",

                "moon-bold-2" => "moon-bold-2",

                "moon-underline-2" => "moon-underline-2",

                "moon-italic-2" => "moon-italic-2",

                "moon-strikethrough-3" => "moon-strikethrough-3",

                "moon-omega" => "moon-omega",

                "moon-sigma" => "moon-sigma",

                "moon-nbsp" => "moon-nbsp",

                "moon-page-break" => "moon-page-break",

                "moon-page-break-2" => "moon-page-break-2",

                "moon-superscript" => "moon-superscript",

                "moon-subscript" => "moon-subscript",

                "moon-superscript-2" => "moon-superscript-2",

                "moon-subscript-2" => "moon-subscript-2",

                "moon-text-color" => "moon-text-color",

                "moon-highlight" => "moon-highlight",

                "moon-pagebreak" => "moon-pagebreak",

                "moon-clear-formatting" => "moon-clear-formatting",

                "moon-table" => "moon-table",

                "moon-table-2" => "moon-table-2",

                "moon-insert-template" => "moon-insert-template",

                "moon-pilcrow" => "moon-pilcrow",

                "moon-left-to-right" => "moon-left-to-right",

                "moon-right-to-left" => "moon-right-to-left",

                "moon-paragraph-left" => "moon-paragraph-left",

                "moon-paragraph-center" => "moon-paragraph-center",

                "moon-paragraph-right" => "moon-paragraph-right",

                "moon-paragraph-justify" => "moon-paragraph-justify",

                "moon-paragraph-left-2" => "moon-paragraph-left-2",

                "moon-paragraph-center-2" => "moon-paragraph-center-2",

                "moon-paragraph-right-2" => "moon-paragraph-right-2",

                "moon-paragraph-justify-2" => "moon-paragraph-justify-2",

                "moon-indent-increase" => "moon-indent-increase",

                "moon-indent-decrease" => "moon-indent-decrease",

                "moon-paragraph-left-3" => "moon-paragraph-left-3",

                "moon-paragraph-center-3" => "moon-paragraph-center-3",

                "moon-paragraph-right-3" => "moon-paragraph-right-3",

                "moon-paragraph-justify-3" => "moon-paragraph-justify-3",

                "moon-indent-increase-2" => "moon-indent-increase-2",

                "moon-indent-decrease-2" => "moon-indent-decrease-2",

                "moon-share" => "moon-share",

                "moon-new-tab" => "moon-new-tab",

                "moon-new-tab-2" => "moon-new-tab-2",

                "moon-popout" => "moon-popout",

                "moon-embed" => "moon-embed",

                "moon-code" => "moon-code",

                "moon-console" => "moon-console",

                "moon-seven-segment-0" => "moon-seven-segment-0",

                "moon-seven-segment-1" => "moon-seven-segment-1",

                "moon-seven-segment-2" => "moon-seven-segment-2",

                "moon-seven-segment-3" => "moon-seven-segment-3",

                "moon-seven-segment-4" => "moon-seven-segment-4",

                "moon-seven-segment-5" => "moon-seven-segment-5",

                "moon-seven-segment-6" => "moon-seven-segment-6",

                "moon-seven-segment-7" => "moon-seven-segment-7",

                "moon-seven-segment-8" => "moon-seven-segment-8",

                "moon-seven-segment-9" => "moon-seven-segment-9",

                "moon-share-2" => "moon-share-2",

                "moon-share-3" => "moon-share-3",

                "moon-mail" => "moon-mail",

                "moon-mail-2" => "moon-mail-2",

                "moon-mail-3" => "moon-mail-3",

                "moon-mail-4" => "moon-mail-4",

                "moon-google" => "moon-google",

                "moon-google_plus" => "moon-google_plus",

                "moon-google_plus-2" => "moon-google_plus-2",

                "moon-google_plus-3" => "moon-google_plus-3",

                "moon-google_plus-4" => "moon-google_plus-4",

                "moon-google-drive" => "moon-google-drive",

                "moon-facebook" => "moon-facebook",

                "moon-facebook-2" => "moon-facebook-2",

                "moon-facebook-3" => "moon-facebook-3",

                "moon-facebook-4" => "moon-facebook-4",



                "moon-instagram" => "moon-instagram",

                "moon-twitter" => "moon-twitter",

                "moon-twitter-2" => "moon-twitter-2",

                "moon-twitter-3" => "moon-twitter-3",

                "moon-feed-2" => "moon-feed-2",

                "moon-feed-3" => "moon-feed-3",

                "moon-feed-4" => "moon-feed-4",

                "moon-youtube" => "moon-youtube",

                "moon-youtube-2" => "moon-youtube-2",

                "moon-vimeo" => "moon-vimeo",

                "moon-vimeo2" => "moon-vimeo2",

                "moon-vimeo-2" => "moon-vimeo-2",

                "moon-lanyrd" => "moon-lanyrd",

                "moon-flickr" => "moon-flickr",

                "moon-flickr-2" => "moon-flickr-2",

                "moon-flickr-3" => "moon-flickr-3",

                "moon-flickr-4" => "moon-flickr-4",

                "moon-picassa" => "moon-picassa",

                "moon-picassa-2" => "moon-picassa-2",

                "moon-dribbble" => "moon-dribbble",

                "moon-dribbble-2" => "moon-dribbble-2",

                "moon-dribbble-3" => "moon-dribbble-3",

                "moon-forrst" => "moon-forrst",

                "moon-forrst-2" => "moon-forrst-2",

                "moon-deviantart" => "moon-deviantart",

                "moon-deviantart-2" => "moon-deviantart-2",

                "moon-steam" => "moon-steam",

                "moon-steam-2" => "moon-steam-2",

                "moon-github" => "moon-github",

                "moon-github-2" => "moon-github-2",

                "moon-github-3" => "moon-github-3",

                "moon-github-4" => "moon-github-4",

                "moon-github-5" => "moon-github-5",

                "moon-wordpress" => "moon-wordpress",

                "moon-wordpress-2" => "moon-wordpress-2",

                "moon-joomla" => "moon-joomla",

                "moon-blogger" => "moon-blogger",

                "moon-blogger-2" => "moon-blogger-2",

                "moon-tumblr" => "moon-tumblr",

                "moon-tumblr-2" => "moon-tumblr-2",

                "moon-yahoo" => "moon-yahoo",

                "moon-tux" => "moon-tux",

                "moon-apple" => "moon-apple",

                "moon-finder" => "moon-finder",

                "moon-android" => "moon-android",

                "moon-windows" => "moon-windows",

                "moon-windows8" => "moon-windows8",

                "moon-soundcloud" => "moon-soundcloud",

                "moon-soundcloud-2" => "moon-soundcloud-2",

                "moon-skype" => "moon-skype",

                "moon-reddit" => "moon-reddit",

                "moon-linkedin" => "moon-linkedin",

                "moon-lastfm" => "moon-lastfm",

                "moon-lastfm-2" => "moon-lastfm-2",

                "moon-delicious" => "moon-delicious",

                "moon-stumbleupon" => "moon-stumbleupon",

                "moon-stumbleupon-2" => "moon-stumbleupon-2",

                "moon-stackoverflow" => "moon-stackoverflow",

                "moon-pinterest" => "moon-pinterest",

                "moon-pinterest-2" => "moon-pinterest-2",

                "moon-xing" => "moon-xing",

                "moon-xing-2" => "moon-xing-2",

                "moon-flattr" => "moon-flattr",

                "moon-safari" => "moon-safari",

                "moon-foursquare" => "moon-foursquare",

                "moon-foursquare-2" => "moon-foursquare-2",

                "moon-paypal" => "moon-paypal",

                "moon-paypal-2" => "moon-paypal-2",

                "moon-paypal-3" => "moon-paypal-3",

                "moon-yelp" => "moon-yelp",

                "moon-libreoffice" => "moon-libreoffice",

                "moon-file-pdf" => "moon-file-pdf",

                "moon-file-openoffice" => "moon-file-openoffice",

                "moon-file-word" => "moon-file-word",

                "moon-file-excel" => "moon-file-excel",

                "moon-file-zip" => "moon-file-zip",

                "moon-file-powerpoint" => "moon-file-powerpoint",

                "moon-file-xml" => "moon-file-xml",

                "moon-file-css" => "moon-file-css",

                "moon-html5" => "moon-html5",

                "moon-html5-2" => "moon-html5-2",

                "moon-css3" => "moon-css3",

                "moon-chrome" => "moon-chrome",

                "moon-firefox" => "moon-firefox",

                "moon-IE" => "moon-IE",

                "moon-opera" => "moon-opera"

            );

$lineaicons= array(

            "linea-basic-accelerator" => "linea-basic-accelerator",
            "linea-basic-alarm" => "linea-basic-alarm",
            "linea-basic-anchor" => "linea-basic-anchor",
            "linea-basic-anticlockwise" => "linea-basic-anticlockwise",
            "linea-basic-archive" => "linea-basic-archive",
            "linea-basic-archive-full" => "linea-basic-archive-full",
            "linea-basic-ban" => "linea-basic-ban",
            "linea-basic-battery-charge" => "linea-basic-battery-charge",
            "linea-basic-battery-empty" => "linea-basic-battery-empty",
            "linea-basic-battery-full" => "linea-basic-battery-full",
            "linea-basic-battery-half" => "linea-basic-battery-half",
            "linea-basic-bolt" => "linea-basic-bolt",
            "linea-basic-book" => "linea-basic-book",
            "linea-basic-book-pen" => "linea-basic-book-pen",
            "linea-basic-book-pencil" => "linea-basic-book-pencil",
            "linea-basic-bookmark" => "linea-basic-bookmark",
            "linea-basic-calculator" => "linea-basic-calculator",
            "linea-basic-calendar" => "linea-basic-calendar",
            "linea-basic-cards-diamonds" => "linea-basic-cards-diamonds",
            "linea-basic-cards-hearts" => "linea-basic-cards-hearts",
            "linea-basic-case" => "linea-basic-case",
            "linea-basic-chronometer" => "linea-basic-chronometer",
            "linea-basic-clessidre" => "linea-basic-clessidre",
            "linea-basic-clock" => "linea-basic-clock",
            "linea-basic-clockwise" => "linea-basic-clockwise",
            "linea-basic-cloud" => "linea-basic-cloud",
            "linea-basic-clubs" => "linea-basic-clubs",
            "linea-basic-compass" => "linea-basic-compass",
            "linea-basic-cup" => "linea-basic-cup",
            "linea-basic-diamonds" => "linea-basic-diamonds",
            "linea-basic-display" => "linea-basic-display",
            "linea-basic-download" => "linea-basic-download",
            "linea-basic-exclamation" => "linea-basic-exclamation",
            "linea-basic-eye" => "linea-basic-eye",
            "linea-basic-eye-closed" => "linea-basic-eye-closed",
            "linea-basic-female" => "linea-basic-female",
            "linea-basic-flag1" => "linea-basic-flag1",
            "linea-basic-flag2" => "linea-basic-flag2",
            "linea-basic-floppydisk" => "linea-basic-floppydisk",
            "linea-basic-folder" => "linea-basic-folder",
            "linea-basic-folder-multiple" => "linea-basic-folder-multiple",
            "linea-basic-gear" => "linea-basic-gear",
            "linea-basic-geolocalize-01" => "linea-basic-geolocalize-01",
            "linea-basic-geolocalize-05" => "linea-basic-geolocalize-05",
            "linea-basic-globe" => "linea-basic-globe",
            "linea-basic-gunsight" => "linea-basic-gunsight",
            "linea-basic-hammer" => "linea-basic-hammer",
            "linea-basic-headset" => "linea-basic-headset",
            "linea-basic-heart" => "linea-basic-heart",
            "linea-basic-heart-broken" => "linea-basic-heart-broken",
            "linea-basic-helm" => "linea-basic-helm",
            "linea-basic-home" => "linea-basic-home",
            "linea-basic-info" => "linea-basic-info",
            "linea-basic-ipod" => "linea-basic-ipod",
            "linea-basic-joypad" => "linea-basic-joypad",
            "linea-basic-key" => "linea-basic-key",
            "linea-basic-keyboard" => "linea-basic-keyboard",
            "linea-basic-laptop" => "linea-basic-laptop",
            "linea-basic-life-buoy" => "linea-basic-life-buoy",
            "linea-basic-lightbulb" => "linea-basic-lightbulb",
            "linea-basic-link" => "linea-basic-link",
            "linea-basic-lock" => "linea-basic-lock",
            "linea-basic-lock-open" => "linea-basic-lock-open",
            "linea-basic-magic-mouse" => "linea-basic-magic-mouse",
            "linea-basic-magnifier" => "linea-basic-magnifier",
            "linea-basic-magnifier-minus" => "linea-basic-magnifier-minus",
            "linea-basic-magnifier-plus" => "linea-basic-magnifier-plus",
            "linea-basic-mail" => "linea-basic-mail",
            "linea-basic-mail-multiple" => "linea-basic-mail-multiple",
            "linea-basic-mail-open" => "linea-basic-mail-open",
            "linea-basic-mail-open-text" => "linea-basic-mail-open-text",
            "linea-basic-male" => "linea-basic-male",
            "linea-basic-map" => "linea-basic-map",
            "linea-basic-message" => "linea-basic-message",
            "linea-basic-message-multiple" => "linea-basic-message-multiple",
            "linea-basic-message-txt" => "linea-basic-message-txt",
            "linea-basic-mixer2" => "linea-basic-mixer2",
            "linea-basic-mouse" => "linea-basic-mouse",
            "linea-basic-notebook" => "linea-basic-notebook",
            "linea-basic-notebook-pen" => "linea-basic-notebook-pen",
            "linea-basic-notebook-pencil" => "linea-basic-notebook-pencil",
            "linea-basic-paperplane" => "linea-basic-paperplane",
            "linea-basic-pencil-ruler" => "linea-basic-pencil-ruler",
            "linea-basic-pencil-ruler-pen" => "linea-basic-pencil-ruler-pen",
            "linea-basic-photo" => "linea-basic-photo",
            "linea-basic-picture" => "linea-basic-picture",
            "linea-basic-picture-multiple" => "linea-basic-picture-multiple",
            "linea-basic-pin1" => "linea-basic-pin1",
            "linea-basic-pin2" => "linea-basic-pin2",
            "linea-basic-postcard" => "linea-basic-postcard",
            "linea-basic-postcard-multiple" => "linea-basic-postcard-multiple",
            "linea-basic-printer" => "linea-basic-printer",
            "linea-basic-question" => "linea-basic-question",
            "linea-basic-rss" => "linea-basic-rss",
            "linea-basic-server" => "linea-basic-server",
            "linea-basic-server2" => "linea-basic-server2",
            "linea-basic-server-cloud" => "linea-basic-server-cloud",
            "linea-basic-server-download" => "linea-basic-server-download",
            "linea-basic-server-upload" => "linea-basic-server-upload",
            "linea-basic-settings" => "linea-basic-settings",
            "linea-basic-share" => "linea-basic-share",
            "linea-basic-sheet" => "linea-basic-sheet",
            "linea-basic-sheet-multiple" => "linea-basic-sheet-multiple",
            "linea-basic-sheet-pen" => "linea-basic-sheet-pen",
            "linea-basic-sheet-pencil" => "linea-basic-sheet-pencil",
            "linea-basic-sheet-txt" => "linea-basic-sheet-txt",
            "linea-basic-signs" => "linea-basic-signs",
            "linea-basic-smartphone" => "linea-basic-smartphone",
            "linea-basic-spades" => "linea-basic-spades",
            "linea-basic-spread" => "linea-basic-spread",
            "linea-basic-spread-bookmark" => "linea-basic-spread-bookmark",
            "linea-basic-spread-text" => "linea-basic-spread-text",
            "linea-basic-spread-text-bookmark" => "linea-basic-spread-text-bookmark",
            "linea-basic-star" => "linea-basic-star",
            "linea-basic-tablet" => "linea-basic-tablet",
            "linea-basic-target" => "linea-basic-target",
            "linea-basic-todo" => "linea-basic-todo",
            "linea-basic-todo-pen" => "linea-basic-todo-pen",
            "linea-basic-todo-pencil" => "linea-basic-todo-pencil",
            "linea-basic-todo-txt" => "linea-basic-todo-txt",
            "linea-basic-todolist-pen" => "linea-basic-todolist-pen",
            "linea-basic-todolist-pencil" => "linea-basic-todolist-pencil",
            "linea-basic-trashcan" => "linea-basic-trashcan",
            "linea-basic-trashcan-full" => "linea-basic-trashcan-full",
            "linea-basic-trashcan-refresh" => "linea-basic-trashcan-refresh",
            "linea-basic-trashcan-remove" => "linea-basic-trashcan-remove",
            "linea-basic-upload" => "linea-basic-upload",
            "linea-basic-usb" => "linea-basic-usb",
            "linea-basic-video" => "linea-basic-video",
            "linea-basic-watch" => "linea-basic-watch",
            "linea-basic-webpage" => "linea-basic-webpage",
            "linea-basic-webpage-img-txt" => "linea-basic-webpage-img-txt",
            "linea-basic-webpage-multiple" => "linea-basic-webpage-multiple",
            "linea-basic-webpage-txt" => "linea-basic-webpage-txt",
            "linea-basic-world" => "linea-basic-world",
            "linea-arrows-anticlockwise" => "linea-arrows-anticlockwise", 

            "linea-arrows-anticlockwise-dashed" => "linea-arrows-anticlockwise-dashed", 

            "linea-arrows-button-down" => "linea-arrows-button-down", 

            "linea-arrows-button-off" => "linea-arrows-button-off", 

            "linea-arrows-button-on" => "linea-arrows-button-on", 

            "linea-arrows-button-up" => "linea-arrows-button-up", 

            "linea-arrows-check" => "linea-arrows-check", 

            "linea-arrows-circle-check" => "linea-arrows-circle-check", 

            "linea-arrows-circle-down" => "linea-arrows-circle-down", 

            "linea-arrows-circle-downleft" => "linea-arrows-circle-downleft", 

            "linea-arrows-circle-downright" => "linea-arrows-circle-downright", 

            "linea-arrows-circle-left" => "linea-arrows-circle-left", 

            "linea-arrows-circle-minus" => "linea-arrows-circle-minus", 

            "linea-arrows-circle-plus" => "linea-arrows-circle-plus", 

            "linea-arrows-circle-remove" => "linea-arrows-circle-remove", 

            "linea-arrows-circle-right" => "linea-arrows-circle-right", 

            "linea-arrows-circle-up" => "linea-arrows-circle-up", 

            "linea-arrows-circle-upleft" => "linea-arrows-circle-upleft", 

            "linea-arrows-circle-upright" => "linea-arrows-circle-upright", 

            "linea-arrows-clockwise" => "linea-arrows-clockwise", 

            "linea-arrows-clockwise-dashed" => "linea-arrows-clockwise-dashed", 

            "linea-arrows-compress" => "linea-arrows-compress", 

            "linea-arrows-deny" => "linea-arrows-deny", 

            "linea-arrows-diagonal" => "linea-arrows-diagonal", 

            "linea-arrows-diagonal2" => "linea-arrows-diagonal2", 

            "linea-arrows-down" => "linea-arrows-down", 

            "linea-arrows-down-double" => "linea-arrows-down-double", 

            "linea-arrows-downleft" => "linea-arrows-downleft", 

            "linea-arrows-downright" => "linea-arrows-downright", 

            "linea-arrows-drag-down" => "linea-arrows-drag-down", 

            "linea-arrows-drag-down-dashed" => "linea-arrows-drag-down-dashed", 

            "linea-arrows-drag-horiz" => "linea-arrows-drag-horiz", 

            "linea-arrows-drag-left" => "linea-arrows-drag-left", 

            "linea-arrows-drag-left-dashed" => "linea-arrows-drag-left-dashed", 

            "linea-arrows-drag-right" => "linea-arrows-drag-right", 

            "linea-arrows-drag-right-dashed" => "linea-arrows-drag-right-dashed", 

            "linea-arrows-drag-up" => "linea-arrows-drag-up", 

            "linea-arrows-drag-up-dashed" => "linea-arrows-drag-up-dashed", 

            "linea-arrows-drag-vert" => "linea-arrows-drag-vert", 

            "linea-arrows-exclamation" => "linea-arrows-exclamation", 

            "linea-arrows-expand" => "linea-arrows-expand", 

            "linea-arrows-expand-diagonal1" => "linea-arrows-expand-diagonal1", 

            "linea-arrows-expand-horizontal1" => "linea-arrows-expand-horizontal1", 

            "linea-arrows-expand-vertical1" => "linea-arrows-expand-vertical1", 

            "linea-arrows-fit-horizontal" => "linea-arrows-fit-horizontal", 

            "linea-arrows-fit-vertical" => "linea-arrows-fit-vertical", 

            "linea-arrows-glide" => "linea-arrows-glide", 

            "linea-arrows-glide-horizontal" => "linea-arrows-glide-horizontal", 

            "linea-arrows-glide-vertical" => "linea-arrows-glide-vertical", 

            "linea-arrows-hamburger1" => "linea-arrows-hamburger1", 

            "linea-arrows-hamburger-2" => "linea-arrows-hamburger-2", 

            "linea-arrows-horizontal" => "linea-arrows-horizontal", 

            "linea-arrows-info" => "linea-arrows-info", 

            "linea-arrows-keyboard-alt" => "linea-arrows-keyboard-alt", 

            "linea-arrows-keyboard-cmd" => "linea-arrows-keyboard-cmd", 

            "linea-arrows-keyboard-delete" => "linea-arrows-keyboard-delete", 

            "linea-arrows-keyboard-down" => "linea-arrows-keyboard-down", 

            "linea-arrows-keyboard-left" => "linea-arrows-keyboard-left", 

            "linea-arrows-keyboard-return" => "linea-arrows-keyboard-return", 

            "linea-arrows-keyboard-right" => "linea-arrows-keyboard-right", 

            "linea-arrows-keyboard-shift" => "linea-arrows-keyboard-shift", 

            "linea-arrows-keyboard-tab" => "linea-arrows-keyboard-tab", 

            "linea-arrows-keyboard-up" => "linea-arrows-keyboard-up", 

            "linea-arrows-left" => "linea-arrows-left", 

            "linea-arrows-left-double-32" => "linea-arrows-left-double-32", 

            "linea-arrows-minus" => "linea-arrows-minus", 

            "linea-arrows-move" => "linea-arrows-move", 

            "linea-arrows-move2" => "linea-arrows-move2", 

            "linea-arrows-move-bottom" => "linea-arrows-move-bottom", 

            "linea-arrows-move-left" => "linea-arrows-move-left", 

            "linea-arrows-move-right" => "linea-arrows-move-right", 

            "linea-arrows-move-top" => "linea-arrows-move-top", 

            "linea-arrows-plus" => "linea-arrows-plus", 

            "linea-arrows-question" => "linea-arrows-question", 

            "linea-arrows-remove" => "linea-arrows-remove", 

            "linea-arrows-right" => "linea-arrows-right", 

            "linea-arrows-right-double" => "linea-arrows-right-double", 

            "linea-arrows-rotate" => "linea-arrows-rotate", 

            "linea-arrows-rotate-anti" => "linea-arrows-rotate-anti", 

            "linea-arrows-rotate-anti-dashed" => "linea-arrows-rotate-anti-dashed", 

            "linea-arrows-rotate-dashed" => "linea-arrows-rotate-dashed", 

            "linea-arrows-shrink" => "linea-arrows-shrink", 

            "linea-arrows-shrink-diagonal1" => "linea-arrows-shrink-diagonal1", 

            "linea-arrows-shrink-diagonal2" => "linea-arrows-shrink-diagonal2", 

            "linea-arrows-shrink-horizonal2" => "linea-arrows-shrink-horizonal2", 

            "linea-arrows-shrink-horizontal1" => "linea-arrows-shrink-horizontal1", 

            "linea-arrows-shrink-vertical1" => "linea-arrows-shrink-vertical1", 

            "linea-arrows-shrink-vertical2" => "linea-arrows-shrink-vertical2", 

            "linea-arrows-sign-down" => "linea-arrows-sign-down", 

            "linea-arrows-sign-left" => "linea-arrows-sign-left", 

            "linea-arrows-sign-right" => "linea-arrows-sign-right", 

            "linea-arrows-sign-up" => "linea-arrows-sign-up", 

            "linea-arrows-slide-down1" => "linea-arrows-slide-down1", 

            "linea-arrows-slide-down2" => "linea-arrows-slide-down2", 

            "linea-arrows-slide-left1" => "linea-arrows-slide-left1", 

            "linea-arrows-slide-left2" => "linea-arrows-slide-left2", 

            "linea-arrows-slide-right1" => "linea-arrows-slide-right1", 

            "linea-arrows-slide-right2" => "linea-arrows-slide-right2", 

            "linea-arrows-slide-up1" => "linea-arrows-slide-up1", 

            "linea-arrows-slide-up2" => "linea-arrows-slide-up2", 

            "linea-arrows-slim-down" => "linea-arrows-slim-down", 

            "linea-arrows-slim-down-dashed" => "linea-arrows-slim-down-dashed", 

            "linea-arrows-slim-left" => "linea-arrows-slim-left", 

            "linea-arrows-slim-left-dashed" => "linea-arrows-slim-left-dashed", 

            "linea-arrows-slim-right" => "linea-arrows-slim-right", 

            "linea-arrows-slim-right-dashed" => "linea-arrows-slim-right-dashed", 

            "linea-arrows-slim-up" => "linea-arrows-slim-up", 

            "linea-arrows-slim-up-dashed" => "linea-arrows-slim-up-dashed", 

            "linea-arrows-square-check" => "linea-arrows-square-check", 

            "linea-arrows-square-down" => "linea-arrows-square-down", 

            "linea-arrows-square-downleft" => "linea-arrows-square-downleft", 

            "linea-arrows-square-downright" => "linea-arrows-square-downright", 

            "linea-arrows-square-left" => "linea-arrows-square-left", 

            "linea-arrows-square-minus" => "linea-arrows-square-minus", 

            "linea-arrows-square-plus" => "linea-arrows-square-plus", 

            "linea-arrows-square-remove" => "linea-arrows-square-remove", 

            "linea-arrows-square-right" => "linea-arrows-square-right", 

            "linea-arrows-square-up" => "linea-arrows-square-up", 

            "linea-arrows-square-upleft" => "linea-arrows-square-upleft", 

            "linea-arrows-square-upright" => "linea-arrows-square-upright", 

            "linea-arrows-squares" => "linea-arrows-squares", 

            "linea-arrows-stretch-diagonal1" => "linea-arrows-stretch-diagonal1", 

            "linea-arrows-stretch-diagonal2" => "linea-arrows-stretch-diagonal2", 

            "linea-arrows-stretch-diagonal3" => "linea-arrows-stretch-diagonal3", 

            "linea-arrows-stretch-diagonal4" => "linea-arrows-stretch-diagonal4", 

            "linea-arrows-stretch-horizontal1" => "linea-arrows-stretch-horizontal1", 

            "linea-arrows-stretch-horizontal2" => "linea-arrows-stretch-horizontal2", 

            "linea-arrows-stretch-vertical1" => "linea-arrows-stretch-vertical1", 

            "linea-arrows-stretch-vertical2" => "linea-arrows-stretch-vertical2", 

            "linea-arrows-switch-horizontal" => "linea-arrows-switch-horizontal", 

            "linea-arrows-switch-vertical" => "linea-arrows-switch-vertical", 

            "linea-arrows-up" => "linea-arrows-up", 

            "linea-arrows-up-double-33" => "linea-arrows-up-double-33", 

            "linea-arrows-upleft" => "linea-arrows-upleft", 

            "linea-arrows-upright" => "linea-arrows-upright", 

            "linea-arrows-vertical" => "linea-arrows-vertical"



    );
  

// Icon list
  $icon_arr = array_merge( $steadysets, $linecons, $lineaicons, $moon, $fa_icons);
  return $icon_arr;
}

?>