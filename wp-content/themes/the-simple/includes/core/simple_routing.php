<?php


if(!function_exists('simple_routing_frontpage')){
    
    add_action('init', 'simple_routing_frontpage');

    function simple_routing_frontpage(){
        
        global $simple_redata;

        if(!empty($simple_redata['frontpage'])){
        	add_filter('pre_option_show_on_front', 'simple_show_on_front_filter');
			add_filter('pre_option_page_on_front', 'simple_page_on_front_filter');

			if(!empty($simple_redata['blogpage'])){
				add_filter('pre_option_page_for_posts', 'simple_page_for_posts_filter');
			}
        }

	}

	function simple_show_on_front_filter($attr) { return 'page'; }
	function simple_page_on_front_filter($attr) { 
		global $simple_redata; 
		return $simple_redata['frontpage']; 
	}
	function simple_page_for_posts_filter($attr){ 
		global $simple_redata; 
		return $simple_redata['blogpage']; 
	}
    
}


if(!function_exists('simple_routing_template'))
{

	add_action('simple_routing_template', 'simple_routing_template');

	function simple_routing_template( $current_template = false )
	{
		global $simple_config, $for_online, $simple_redata, $post;
		$dynamic_id = "";
		

		if(isset($post)) $dynamic_id = $post->ID;
		$frontpage = $simple_redata['frontpage'];
        $blogpage = $simple_redata['blogpage'];
        
        /* FRONTPAGE QUERY */
        if($frontpage && isset($simple_config['new_query']) && $simple_config['new_query']['page_id'] == $frontpage)
		{
			$dynamic_id = $frontpage;

		}

		/* BLOG QUERY */
        if(isset($post) && $blogpage == $post->ID && !isset($simple_config['new_query']))
		{ 	
			$simple_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));	
											
			get_template_part( 'template', 'blog' ); exit();
		}

		/* For Online */
		if(isset($post) && $post->ID == 3287){
			$simple_redata['bloglayout'] = 'sidebar_left';
			$simple_redata['blog_style'] = 'normal';
			$simple_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));	
			$for_online = true;									
			get_template_part( 'template', 'blog' ); exit();
		}	
		if(isset($post) && $post->ID == 3285){
			$simple_redata['bloglayout'] = 'sidebar_right';
			$simple_redata['blog_style'] = 'normal';
			$simple_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));	
			$for_online = true;									
			get_template_part( 'template', 'blog' ); exit();
		}
		if(isset($post) && $post->ID == 3289){
			$simple_redata['bloglayout'] = 'fullwidth';
			$simple_redata['blog_style'] = 'normal';
			$simple_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));	
			$for_online = true;									
			get_template_part( 'template', 'blog' ); exit();
		}	
		if(isset($post) && $post->ID == 3291){
			$simple_redata['bloglayout'] = 'sidebar_right';
			$simple_redata['blog_style'] = 'alternate';
			$simple_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));	
			$for_online = true;									
			get_template_part( 'template', 'blog' ); exit();
		}
		if(isset($post) && $post->ID == 3293){
			$simple_redata['bloglayout'] = 'sidebar_left';
			$simple_redata['blog_style'] = 'alternate';
			$simple_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));	
			$for_online = true;									
			get_template_part( 'template', 'blog' ); exit();
		}
		if(isset($post) && $post->ID == 3297){
			$simple_redata['bloglayout'] = 'fullwidth';
			$simple_redata['blog_style'] = 'alternate';
			$simple_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));	
			$for_online = true;									
			get_template_part( 'template', 'blog' ); exit();
		}
		
		if(isset($post) && $post->ID == 3303){
			$simple_redata['bloglayout'] = 'sidebar_right';
			$simple_redata['blog_style'] = 'timeline';
			$simple_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));
			$for_online = true;										
			get_template_part( 'template', 'blog' ); exit();
		}
		if(isset($post) && $post->ID == 3301){
			$simple_redata['bloglayout'] = 'sidebar_left';
			$simple_redata['blog_style'] = 'timeline';
			$simple_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));
			$for_online = true;										
			get_template_part( 'template', 'blog' ); exit();
		}	
		if(isset($post) && $post->ID == 3299){
			$simple_redata['bloglayout'] = 'fullwidth';
			$simple_redata['blog_style'] = 'timeline';
			$simple_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));
			$for_online = true;										
			get_template_part( 'template', 'blog' ); exit();
		}	
		if(isset($post) && $post->ID == 3305){
			$simple_redata['bloglayout'] = 'fullwidth';
			$simple_redata['blog_style'] = 'grid';
			$simple_redata['blog_grid_col'] = 3;
			$simple_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));
			$for_online = true;										
			get_template_part( 'template', 'blog' ); exit();
		}	
		if(isset($post) && $post->ID == 3308){
			$simple_redata['bloglayout'] = 'sidebar_left';
			$simple_redata['blog_style'] = 'grid';
			$simple_redata['blog_grid_col'] = 2;
			$simple_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));
			$for_online = true;										
			get_template_part( 'template', 'blog' ); exit();
		}

		if(isset($post) && $post->ID == 3311){
			$simple_redata['blog_style'] = 'fullscreen';
			$simple_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));
			$for_online = true;										
			get_template_part( 'template', 'blog' ); exit();
		}
					
		/* End For Online */
		
		
	}
}

if(!function_exists('simple_set_portfolio_query')){
    function simple_set_portfolio_query()
	{
		global $simple_redata;
		
		$terms = $simple_redata['portfolio_categories'];

		$p_per_page = 6;
		switch($simple_redata['portfolio_columns']){
			case '1':
				$p_per_page = 3;
			    break;
			case '2':
				$p_per_page = 6;
				break;
			case '3':
				$p_per_page = 9;
				break;
			case '4':
				$p_per_page = 12;
				break;
			case '5':
				$p_per_page = 10;
				break;
		}
		if(isset($terms[0]) && !empty($terms[0]) && !is_null($terms[0]) && $terms[0] != "null")
		{	
			$new_query = array(	'orderby' 	=> 'ID', 
												    'order' 	=> 'DESC', 
												    'paged' 	=> get_query_var( 'paged' ), 
												    'posts_per_page' => $p_per_page,  
												    'tax_query' => array( 	array( 	'taxonomy' 	=> 'portfolio_entries', 
																				    'field' 	=> 'id', 
																				    'terms' 	=> $terms, 	
																				    'operator' 	=> 'IN')));
		}
		else
		{
			$new_query = array(	'paged' 		 => get_query_var( 'paged' ),  
												    'posts_per_page' => -1,  
												    'post_type' 	 => 'portfolio'); 
		}

		query_posts($new_query);
		
	}
}

if(!function_exists('simple_execute_query')){
    add_action('simple_excecute_query_var_action', 'simple_execute_query');

    function simple_execute_query($temp = false){
        global $simple_config;
        if(isset($simple_config['new_query'])){
            query_posts($simple_config['new_query']);
        }
    }
}

function is_vc(){
	preg_match_all('/\[vc_row(.*?)\]/', get_the_content((int) simple_get_post_id()), $matches );
	if ( isset($matches[0]) && !empty($matches[0]) )
		return true;
	return false;
}
?>