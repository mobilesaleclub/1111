<?php

if ( ! isset( $content_width ) ) $content_width = 940;

/* --------------------- Load Core Functions ------------------------- */
require_once( get_template_directory().'/includes/core/simple_config.php' );
require_once( get_template_directory().'/includes/core/core-functions.php' );
/* --------------------- End Load Core ------------------------------ */

/* --------------------- Load MetaBoxes ----------------------------------- */
require_once get_template_directory().'/includes/simple-slider/simple_slider_options.php';
require_once get_template_directory().'/includes/simple-slider/simple_slider.php';
require_once get_template_directory().'/includes/core/simple_metaboxes.php';
/* --------------------- End Load Metaboxes ------------------------------ */



require_once get_template_directory().'/functions-simple.php';
require_once get_template_directory().'/includes/core/simple_routing.php';



/* --------------------- Register ------------------------------------ */
require_once  get_template_directory().'/includes/register/register_sidebars.php';
/* --------------------- End Register -------------------------------- */


/* --------------------- Required Plugins Activation ----------------- */
require_once get_template_directory().'/includes/core/simple_required_plugins.php' ;
require_once( get_template_directory() .'/envato_setup/envato_setup_init.php');
require_once( get_template_directory() .'/envato_setup/envato_setup.php');
/* --------------------- Required Plugins Activation ----------------- */


/* --------------------- Simple Slider Load ------------------------ */
require_once get_template_directory().'/includes/core/simple_slideshow.php' ;
/* --------------------- End Simple Slider Load -------------------- */





/* --------------------- Load Widgets -------------------------------- */
require_once get_template_directory().'/includes/widgets/simple_flickr.php';
require_once get_template_directory().'/includes/widgets/simple_mostpopular.php';
require_once get_template_directory().'/includes/widgets/simple_shortcodewidget.php';
require_once get_template_directory().'/includes/widgets/simple_socialwidget.php';
require_once get_template_directory().'/includes/widgets/simple_topnavwidget.php';
require_once get_template_directory().'/includes/widgets/simple_twitter.php';
require_once get_template_directory().'/includes/widgets/simple_ads.php';
/* --------------------- End Load Widgets ---------------------------- */


/* -------------------- Load Custom Menu ----------------------------- */
require_once get_template_directory().'/includes/core/simple_megamenu.php';
/* -------------------- Load Custom Menu ----------------------------- */

/* -------------------- Load Woocommerce Functions ----------------------------- */
if(class_exists( 'woocommerce' ))
    require_once get_template_directory().'/functions-woocommerce.php';

add_action( 'after_setup_theme', 'simple_woocommerce_setup' );
 
function simple_woocommerce_setup() {
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
/* -------------------- Load Custom Menu ----------------------------- */

/* -------------------- Setup Theme ---------------------------------- */
add_action('init', 'simple_default_redata', 1);

add_action( 'after_setup_theme', 'simple_setup' );

function simple_setup(){

    add_action('init', 'simple_language_setup');
    add_action('wp_enqueue_scripts', 'simple_register_global_styles');
    add_action('wp_enqueue_scripts', 'simple_register_global_scripts');

    add_filter( 'https_ssl_verify', '__return_false' );
    add_filter( 'https_local_ssl_verify', '__return_false' );
    
    simple_theme_support();
    simple_images_sizes();
    simple_navigation_menus();
    simple_register_widgets();  
    new simple_custom_menu();
}

/* -------------------- End Setup Theme --------------------------------- */


/* -------------------- PO/MO files ------------------------------------- */

function simple_language_setup() {
    $lang_dir = get_template_directory() . '/languages';
    load_theme_textdomain('the-simple', $lang_dir);
} 

/* -------------------- End PO/MO files --------------------------------- */



/* -------------------- Theme Support ----------------------------------- */

function simple_theme_support(){
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support('nav_menus');
    add_theme_support( 'post-formats', array( 'quote', 'gallery','video', 'audio' ) ); 
    add_theme_support( 'custom-header' );
    add_theme_support( 'custom-background' );
    add_theme_support( "title-tag" );
}

/* -------------------- End Theme Support ------------------------------- */



/* -------------------- Add Various Image Sizes ------------------------ */

function simple_images_sizes(){
    
    add_image_size( 'simple_port3', 825, 600, true );
    add_image_size( 'simple_port3_grayscale', 627, 470, true );
    add_image_size( 'simple_port2', 600, 360, true );
    add_image_size( 'simple_port2_grayscale', 940, 570, true );
    add_image_size( 'simple_blog', 1100, 500, true );
    add_image_size( 'simple_alternate_blog', 440, 250, true );
    add_image_size( 'simple_alternate_blog_side', 355, 235, true );
    add_image_size( 'simple_staff', 500, 500, true );
   

}

/* -------------------- End Add Various Image Sizes --------------------- */


/* -------------------- Register Navigations ---------------------------- */

function simple_navigation_menus(){
    global $simple_redata;
    $navigations = array('main' => 'Main Navigation');

    if(isset($simple_redata['header_style']) && $simple_redata['header_style'] == 'header_11')
        $navigations = array('left' => 'In left side of logo', 'right' => 'In right side of logo'); 

    foreach($navigations as $id => $name){ 
    	register_nav_menu($id, THEMETITLE.' '.$name); 
    }
}

/* -------------------- End Register Navigation ------------------------ */


/* -------------------- Register Widgets ------------------------------- */

function simple_register_widgets(){
	register_widget( 'SimpleTwitter' );
    register_widget( 'SimpleSocialWidget' );
    register_widget( 'SimpleFlickrWidget' );
    register_widget( 'SimpleShortcodeWidget' );
    register_widget( 'SimpleMostPopularWidget');
    register_widget( 'SimpleTopNavWidget');
    register_widget( 'SimpleAdsWidget');
}

/* -------------------- End Register Widgets ------------------------ */


/* -------------------- Register Styles used over all pages --------- */

function simple_register_global_styles(){
    global $simple_redata;   
    
    wp_enqueue_style('style', get_stylesheet_uri());
    if ( class_exists( 'WooCommerce' ) )
        wp_enqueue_style('simple-woocommerce', SIMPLE_BASE_URL.'css/woocommerce.css' );

    if($simple_redata['simple_page_transition'])
     wp_enqueue_style('animsition.min.css', SIMPLE_BASE_URL. 'css/animsition.min.css' );

    wp_enqueue_style('simple-bootstrap-responsive', SIMPLE_BASE_URL.'css/bootstrap-responsive.css');
    wp_enqueue_style('jquery.fancybox', SIMPLE_BASE_URL.'fancybox/source/jquery.fancybox.css?v=2.1.2' ); 
    wp_enqueue_style('font-awesome', SIMPLE_BASE_URL.'css/font-awesome.min.css');  
    wp_enqueue_style( 'idangerous.swiper', SIMPLE_BASE_URL.'css/idangerous.swiper.css');
    wp_enqueue_style( 'owl.carousel', SIMPLE_BASE_URL.'css/owl.carousel.css' );
    wp_enqueue_style( 'owl.theme' ,SIMPLE_BASE_URL.'css/owl.theme.css' ); 
    wp_enqueue_style('simple-dynamic-css', admin_url('admin-ajax.php').'?action=dynamic_css');
    if(!class_exists('ElleFramework')){
        wp_enqueue_style('simple-default', SIMPLE_BASE_URL.'css/default.css');
        wp_enqueue_style('simple-fonts-default', simple_enqueue_default_fonts() , array(), '1.0.0');
    }

    $p_id = simple_get_post_id();
    if(isset($p_id) && !empty($p_id) && function_exists('redux_post_meta'))
        if( redux_post_meta('simple_redata',(int) $p_id, 'fullscreen_post_style' ) || $simple_redata['fullscreen_sections_active'] )
            wp_enqueue_style('simple-fullscreen_post_css', SIMPLE_BASE_URL.'css/fullscreen_post.css');
      

}


function simple_enqueue_default_fonts(){
    $font_url = add_query_arg( 'family', urlencode( 'Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic|Open Sans|Raleway:100,200,300,400,500,600,700,800,900|lato:300' ), "//fonts.googleapis.com/css" );
    return $font_url;
}


/* -------------------- Register Styles used over all pages --------- */



/* -------------------- Register Scripts used over all pages --------- */

function simple_register_global_scripts(){
            
    global $simple_redata;
    global $simple_current_view;

    if($simple_redata['simple_page_transition'])
        wp_enqueue_script( 'animsitions', SIMPLE_BASE_URL. 'js/jquery.animsition.min.js', array(), '', true);
    
    wp_enqueue_script( 'simple-load-css-async', SIMPLE_BASE_URL. 'js/simple-loadCSS.js', array(), '', false );
    wp_enqueue_script( 'bootstrap.min', SIMPLE_BASE_URL.'js/bootstrap.min.js', array('jquery'), 1, true );
    wp_enqueue_script( 'jquery-easing-1-3', SIMPLE_BASE_URL.'js/jquery.easing.1.3.js', array('jquery'), 1, true  );
    wp_enqueue_script( 'jquery-easy-pie-chart', SIMPLE_BASE_URL.'js/jquery.easy-pie-chart.js', array('jquery'), 1, true  );

    if($simple_redata['nicescroll'])
        wp_enqueue_script('smoothscroll', SIMPLE_BASE_URL.'js/smoothscroll.js', array('jquery'), 1, true);

    wp_enqueue_script( 'waypoints.min', SIMPLE_BASE_URL.'js/waypoints.min.js', array('jquery'), 1, true);

    if(class_exists('WPBakeryVisualComposerAbstract') && $simple_current_view == 'page' ) {

       wp_enqueue_script('pathformer',SIMPLE_BASE_URL.'js/pathformer.js', array('jquery'), 1, false );
       wp_enqueue_script('vivus', SIMPLE_BASE_URL.'js/vivus.js', array('jquery', 'pathformer'), 1, false);  
       wp_enqueue_script('odometer.min', SIMPLE_BASE_URL.'js/odometer.min.js', array('jquery'), 1, true );
       wp_enqueue_script('jquery.appear', SIMPLE_BASE_URL.'js/jquery.appear.js', array('jquery'), 1, true );
           
    }

    wp_enqueue_script('modernizr', SIMPLE_BASE_URL.'js/modernizr.custom.js', array('jquery'), 1, true);
    
    wp_enqueue_script('simple-animations',  SIMPLE_BASE_URL.'js/simple-animations.js', array('jquery'), 1, true);
    
    wp_enqueue_script( 'simple-main', SIMPLE_BASE_URL.'js/simple-main.js', array('jquery', 'simple-animations'), 1, true );

    wp_enqueue_script('comment-reply');
    
    wp_enqueue_script('classie',  SIMPLE_BASE_URL.'js/classie.js', '', 1, true ); 

    if(isset($simple_redata['page_header_menu_color']) && $simple_redata['page_header_menu_color'] == 'auto' )
         wp_enqueue_script('background-check.min',  SIMPLE_BASE_URL.'js/background-check.min.js', array('jquery'), 1, true);

   

    if($simple_redata['sticky'])
         wp_enqueue_script('jquery.slicknav.min', SIMPLE_BASE_URL.'js/jquery.slicknav.min.js', array('jquery'), 1, true); 

  

    if(isset($simple_redata['one_page_active']) && $simple_redata['one_page_active'] == 1)
         wp_enqueue_script('jquery.onepage',SIMPLE_BASE_URL.'js/jquery.onepage.js', array('jquery'), 1, true);

    wp_enqueue_script('imagesloaded', SIMPLE_BASE_URL.'js/jquery.imagesloaded.min.js', array('jquery'), 1, true);
    

    $p_id = simple_get_post_id();
    if(isset($p_id) && !empty($p_id) && function_exists('redux_post_meta'))
        if( redux_post_meta('simple_redata',(int) $p_id, 'fullscreen_post_style' ))   {
            wp_enqueue_script('jquery.appear', SIMPLE_BASE_URL.'js/jquery.appear.js', array('jquery'), 1, true);
            wp_enqueue_script('simple-fullscreen_post', SIMPLE_BASE_URL.'js/fullscreen_post.js', array('jquery'), 1, true);

        }
    
    wp_localize_script('simple-main', 's_gb', array('theme_js' =>  SIMPLE_BASE_URL.'js/' , 'theme_fancy' => SIMPLE_BASE_URL.'fancybox/source/')); 

    wp_localize_script('simple-load-css-async', 's_gb', array('theme_css' =>  SIMPLE_BASE_URL.'css/')); 

    
    echo "\n <script type='text/javascript'>\n /* <![CDATA[ */  \n";
    echo "var simple_global = { \n \tajaxurl: '".esc_js(admin_url( 'admin-ajax.php' ) )."',\n \tbutton_style: '".esc_js($simple_redata['overall_button_style'][0])."'\n \t}; \n /* ]]> */ \n ";
    echo "</script>\n \n ";
}

/* -------------------- Register Scripts used over all pages --------- */ 

/* -------------------- WP TITLE Filter ------------------------------ */

function simple_wp_title_filter( $title, $sep ) {
    if ( is_feed() ) {
        return $title;
    }
    
    global $page, $paged;

    // Add the blog name
    $title .= get_bloginfo( 'name', 'display' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " $sep $site_description";
    }

    // Add a page number if necessary:
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
        $title .= " $sep " . sprintf( __( 'Page %s', 'the-simple' ), max( $paged, $page ) );
    }

    return $title;
}


/* -------------------- End WP Title Filter -------------------------- */


if(class_exists('Envato_WordPress_Theme_Upgrader')){
    /**
     * Load the Envato WordPress Toolkit Library check for updates
     * and direct the user to the Toolkit Plugin if there is one
     */
    function simple_envato_toolkit_admin_init() {
     
        // Include the Toolkit Library
        include_once( get_template_directory() . '/includes/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php' );
     
        // Add further code here
     
    }
    add_action( 'admin_init', 'simple_envato_toolkit_admin_init' );

    // Use credentials used in toolkit plugin so that we don't have to show our own forms anymore
    $credentials = get_option( 'envato-wordpress-toolkit' );
    if ( empty( $credentials['user_name'] ) || empty( $credentials['api_key'] ) ) {
        add_action( 'admin_notices', 'simple_envato_toolkit_credentials_admin_notices' );
        return;
    }

    /**
     * Display a notice in the admin to remind the user to enter their credentials
     */
    function simple_envato_toolkit_credentials_admin_notices() {
        $message = sprintf( __( "To enable theme update notifications, please enter your Envato Marketplace credentials in the %s", "the-simple" ),
            "<a href='" . admin_url() . "admin.php?page=envato-wordpress-toolkit'>Envato WordPress Toolkit Plugin</a>" );
        echo "<div id='message' class='updated below-h2'><p>{$message}</p></div>";
    }

    // Check updates only after a while
    $lastCheck = get_option( 'toolkit-last-toolkit-check' );
    if ( false === $lastCheck ) {
        update_option( 'toolkit-last-toolkit-check', time() );
        return;
    }
     
    // Check for an update every 3 hours
    if ( 10800 < ( time() - $lastCheck ) ) {
        return;
    }
     
    // Update the time we last checked
    update_option( 'toolkit-last-toolkit-check', time() );


    // Check for updates
    $upgrader = new Envato_WordPress_Theme_Upgrader( $credentials['user_name'], $credentials['api_key'] );
    $updates = $upgrader->check_for_theme_update();
     
    // If $updates->updated_themes_count == true then we have an update!

    // Add update alert, to update the theme
    if ( $updates->updated_themes_count ) {
        add_action( 'admin_notices', 'simple_envato_toolkit_admin_notices' );
    }

    /**
     * Display a notice in the admin that an update is available
     */
    function simple_envato_toolkit_admin_notices() {
        $message = sprintf( __( "An update to the theme is available! Head over to %s to update it now.", "the-simple" ),
            "<a href='" . admin_url() . "admin.php?page=envato-wordpress-toolkit'>Envato WordPress Toolkit Plugin</a>" );
        echo "<div id='message' class='updated below-h2'><p>{$message}</p></div>";
    }

}


// Global variable written in function

    function simple_redata_variable(){
           
            global $simple_redata;

            return $simple_redata;

            
    }

    function  simple_current_view(){

        global $simple_current_view;

        return $simple_current_view;
    }  

    function simple_rewrite_simple_current_view($vars){

        global $simple_current_view;

        $simple_current_view = $vars;

        return $simple_current_view;
    }

    add_action('wp_ajax_dynamic_css', 'dynaminc_css');
    add_action('wp_ajax_nopriv_dynamic_css', 'dynaminc_css');
    function dynaminc_css() {
        require(get_template_directory().'/includes/register/register_styles.css.php');
        exit;
    }

    /* -------------------- Convert Color HEX to RGB ------------------------------------ */

function simple_hexToRgb($hex) {

    $hex = str_replace("#", "", $hex, $count);
    $color = array();


    if(is_string($hex)){
       
      if(strlen($hex) == 3) {
          $color['r'] = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
          $color['g'] = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
          $color['b'] = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
      }
      else if(strlen($hex) == 6) {
          $color['r'] = hexdec(substr($hex, 0, 2));
          $color['g'] = hexdec(substr($hex, 2, 2));
          $color['b'] = hexdec(substr($hex, 4, 2));
      }
    }
    return $color;
}

/* -------------------- End Convert Color HEX to RGB -------------------------------- */


/* ------------------- Top header transparent ----------------------------------*/
function simple_header_topnav_transparent(){
   global $simple_redata;

   if($simple_redata['top_navigation'] && $simple_redata['top_navigation_transparency']): ?>
        <div class="top_nav top_nav_transparency">
            <?php if(!$simple_redata['header_container_full'] || $simple_redata['header_style'] == 'header_7'): ?>
            <div class="container">
            <?php endif; ?>
                <div class="row-fluid">
                    <div class="span6">
                        <?php if(is_active_sidebar("Top Header Left")): ?>
                        <div class="pull-left">
                            <?php dynamic_sidebar( "Top Header Left" ); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="span6">
                        <?php if(is_active_sidebar("Top Header Right")): ?>
                        <div class="pull-right">
                            <?php dynamic_sidebar( "Top Header Right" ); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                   
                </div> 
            <?php if(!$simple_redata['header_container_full'] || $simple_redata['header_style'] == 'header_7'): ?>    
            </div>
            <?php endif; ?>
        </div>
  <?php endif;
}
/* ------------------- check background header ----------------------------------*/
function simple_header_bgCheck(){
  global $simple_redata;

  $bgCheck = '';

  if($simple_redata['header_transparency']){
      if((int) simple_get_post_id() != 0 && function_exists('redux_post_meta'))
          $page_header_menu_color = redux_post_meta('simple_redata',(int) simple_get_post_id(), 'page_header_menu_color');
      else
          $page_header_menu_color = 'light';

      if(isset($page_header_menu_color) && !empty($page_header_menu_color))
          $bgCheck = ($page_header_menu_color =='auto') ? '' : 'background--'.esc_attr($page_header_menu_color); 
      else
          $bgCheck = 'background--light';

      if(function_exists('redux_post_meta')){
          $p_bool = redux_post_meta('simple_redata',(int) simple_get_post_id(), 'page_header_bool');
          $s_bool = redux_post_meta('simple_redata',(int) simple_get_post_id(), 'slider_type');
      }else{
          $p_bool = 1;
          $s_bool = 'none';

      }
          
      if($p_bool == '0' && $s_bool == 'none')
        $bgCheck = 'background--light';
      

  }

  return $bgCheck;

}


function simple_default_portfolio_image($size){
    if( !is_array($size) && !empty($size)){
        global $_wp_additional_image_sizes;
        $size = $_wp_additional_image_sizes[$size];
    }

    if( empty($size) ){
        $size = array('width' => 600, 'height' => 360);
    }

    return 'http://placehold.it/'.$size['width'].'x'.$size['height'];
}



add_filter( 'vc_iconpicker-type-lineaicons', 'simple_iconpicker_type_lineaicons' );

function simple_iconpicker_type_lineaicons( $icons ) {

$typicons_icons = array(
        
            array( 'linea-basic-alarm' => 'Alarm' ),
           
        );
        return array_merge( $icons, $typicons_icons );

        }
add_filter( 'vc_enqueue_font_icon_element-lineaicon', 'simple_icon_element_fonts_enqueue1' );

function simple_icon_element_fonts_enqueue1() {
    wp_enqueue_style( 'lineaicon', SIMPLE_BASE_URL.'css/lineaicon.css' );
}

?>