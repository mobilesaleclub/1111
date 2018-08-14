<?php
$simple_redata = simple_redata_variable();
get_header();


get_template_part('includes/view/page_header'); ?>

<section id="content" class="bg_image_404">
<div class="overlay">
     <div class="row-fluid row-dynamic-el" >
      <div class="container">
        <div class="row-fluid">
          
            <div class="span12 not_found">
                <h2>404</h2>
                <p><?php echo esc_attr($simple_redata['404_error_message']) ?></p>
                <div class="search_field">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
                             
      </div>
    </div>
    </div>
</section>
    
<?php get_footer(); ?>