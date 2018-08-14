<?php
/*
Template Name: Portfolio Page
*/
$simple_redata = simple_redata_variable();

$simple_current_view = simple_rewrite_simple_current_view('portfolio');


$id = simple_get_post_id(); 
if(function_exists('redux_post_meta'))
    $replaced = redux_post_meta('simple_redata',(int) $id);

if(isset($replaced) && !empty($replaced))
    foreach($replaced as $key => $value){
        $simple_redata[$key] = $value;
    }

get_header();
get_template_part('includes/view/page_header');

?>

<section id="content" class="content_portfolio <?php echo esc_attr($simple_redata['portfolio_layout']) ?> layout-<?php echo esc_attr($simple_redata['layout']) ?>">
    
    <?php if($simple_redata['portfolio_content'] == 'top'): ?>
        <?php get_template_part( 'includes/view/loop', 'page' ); ?>
    <?php endif; ?>

    <?php if($simple_redata['portfolio_layout'] == 'in_container'): ?>
    <div class="container">
    <?php endif; ?>
    <?php if($simple_redata['portfolio_filters'] == 'normal'):?>
        <div class="row-fluid filter-row">
       
			<?php if(!empty($simple_redata['portfolio_categories'])): ?>
                <?php if($simple_redata['portfolio_layout'] == 'fullwidth'): ?>
                <div >
                <?php endif; ?>
            		<!-- Portfolio Filter -->
            		<nav id="portfolio-filter" >
                		<ul class="">
                    		<li class="filter active all" data-filter="all"><a href="#" onclick="return false;" class="filter active" data-filter="all"><?php esc_html_e('View All', 'the-simple') ?></a></li>
                            
                			<?php foreach($simple_redata['portfolio_categories'] as $cat): ?>
                                <?php $cat = get_term($cat, 'portfolio_entries');

                                    if(isset($cat)):
                                 ?>
                                
                        		              <li class="other filter"  data-filter=".<?php echo esc_attr($cat->slug) ?>"><a href="#" onclick="return false;" class="filter" data-filter=".<?php echo esc_attr($cat->slug) ?>"><?php echo esc_html($cat->name) ?></a></li>

                                     <?php endif; ?>         
                    
                			<?php endforeach; ?>
                		</ul>
            		</nav>
                <?php if($simple_redata['portfolio_layout'] == 'fullwidth'): ?>
                </div>
                <?php endif; ?>
    	    <?php endif; ?>
        </div>
     <?php endif; ?>

	    <?php 
	    	
            $grid = 'three-cols';
		    switch($simple_redata['portfolio_columns']){
		        case '3':
		            $grid = 'three-cols';
		            break;
		        case '2':
		            $grid = 'two-cols';
		            break;
		        case '4':
		            $grid = 'four-cols';
		            break;
                case '5':
                    $grid = 'five-cols';
                    break;
		        case '1':
		            $grid = 'one-cols';
		            break;
		    }

    	?>
        <div class="row-fluid">
            <?php if($simple_redata['layout'] == 'sidebar_left') get_sidebar(); ?>

            <?php if($simple_redata['layout'] != 'fullwidth'): ?>
            <div class="span9">
            <?php endif; ?>

                <section id="portfolio-preview-items" class="<?php echo esc_attr($grid) ?> <?php echo esc_attr($simple_redata['portfolio_space']) ?> " data-cols="<?php echo esc_attr($simple_redata['portfolio_columns']) ?>">
                <?php
                        
                        if($simple_redata['portfolio_mode'] == 'grid')
                            get_template_part('includes/view/portfolio/loop', 'grid');

                        else if($simple_redata['portfolio_mode'] == 'masonry')
                            get_template_part('includes/view/portfolio/loop', 'masonry');
                        
                       wp_reset_postdata();
                        
                ?>
                </section>
                
            <?php if($simple_redata['layout'] != 'fullwidth'): ?>
            </div>
            <?php endif; ?>

            <?php if($simple_redata['layout'] == 'sidebar_right') get_sidebar(); ?>
		</div>
    <?php if($simple_redata['portfolio_layout'] == 'in_container'): ?>
	</div>
    <?php endif; ?>
    <?php if($simple_redata['portfolio_content'] == 'bottom'): ?>
        <?php get_template_part( 'includes/view/loop', 'page' ); ?>
    <?php endif; ?>
</section>
<?php get_footer(); ?>