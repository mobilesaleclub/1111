<?php
if(!defined('APOLLON_BASE' ) ) define( 'APOLLON_BASE', get_template_directory_uri().'/'); 


if(!defined('SIMPLE_BASE_URL' ) ) define( 'SIMPLE_BASE_URL', get_template_directory_uri().'/'); 

if(function_exists('wp_get_theme'))
{
	$wp_theme_obj = wp_get_theme();
	$simple_base_data['prefix'] = $simple_base_data['Title'] = $wp_theme_obj->get('Name');
    if(!defined('THEMENAME')) define('THEMENAME', $simple_base_data['Title']);
}

if(!defined('THEMETITLE')) define('THEMETITLE', $simple_base_data['Title']);


if(is_admin()){
	add_action('admin_print_scripts','simple_global_js');

	function simple_global_js(){
	    echo "\n <script type='text/javascript'>\n /* <![CDATA[ */  \n";
	    echo "var simple_global = {\n \tframeworkUrl: '".plugins_url()."/elle-shortcodes/', \n \tinstalledAt: '".plugins_url()."/elle-shortcodes/', \n \tajaxurl: '".admin_url( 'admin-ajax.php' )."'\n \t}; \n /* ]]> */ \n ";
	    echo "</script>\n \n ";
	}
}



if ( class_exists( 'ThemeCheckMain' ) ) {
	
	add_action( 'themecheck_checks_loaded',  'disable_checks' );

}	


function disable_checks() {
                global $themechecks;

                $checks_to_disable = array(
               	    'IncludeCheck',
                	'I18NCheck',
              	    'AdminMenu',
              	    'Bad_Checks',
                	'MalwareCheck',
                	'Theme_Support',
                	'CustomCheck',
                	'EditorStyleCheck',
               	    'IframeCheck',
                );
                
               foreach ( $themechecks as $keyindex => $check ) {
               	if ( $check instanceof themecheck ) {
               		$check_class = get_class( $check );
               		if ( in_array( $check_class, $checks_to_disable ) ) {
              			unset( $themechecks[$keyindex] );
               		}
                	}
               }
            }


?>