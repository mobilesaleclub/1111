
<?php

$simple_redata = simple_redata_variable();
wp_reset_postdata();

if(function_exists('redux_post_meta'))
    $fullscreen_post_style = redux_post_meta('simple_redata',(int) simple_get_post_id(), 'fullscreen_post_style');
else
    $fullscreen_post_style = '0';

?>

   

<?php // TOP wapper closed ?> 

<?php if((int) simple_get_post_id() && function_exists('redux_post_meta') && !redux_post_meta('simple_redata',(int) simple_get_post_id(), 'fullscreen_post_style')): ?>
</div>
<?php endif;?>
<!-- Footer -->
 <a href="#" class="scrollup"><?php esc_html_e('Scroll', 'the-simple') ?></a> 
    <div class="footer_wrapper">
        
        <footer id="footer" class="">

            
            <?php if($simple_redata['show_footer']): ?>


        	<div class="inner">
            <?php if(!$simple_redata['footer_container_full']): ?>
            <div class="container">
            <?php endif; ?>
    	        	<div class="row-fluid ff">
                    	<!-- widget -->
    		        	<?php
                        
                        $columns = esc_attr($simple_redata['footer_columns']);
                        $spans=array(3,2,2,2,3);

                        for($i = 1; $i <= $columns; $i++): ?>
                        <?php if($simple_redata['footer_columns'] == 5){?>
                        <div class="span<?php echo esc_attr($spans[$i-1]); ?>">

                        <?php } else {?>

                            <div class="span<?php echo 12/esc_attr($columns) ?>">
                            <?php } ?>

                                <?php if (is_active_sidebar('footer-column-'.$i)): 

                                        dynamic_sidebar('Footer - column'.$i);

                                endif; ?>
                                
                            </div>
                        <?php endfor; ?>
    	            </div>

    	        <?php if(!$simple_redata['footer_container_full']): ?>
            </div>  
            <?php endif; ?>

            <?php if(isset($simple_redata['footer_background_color']['background-image']) && $simple_redata['footer_background_color']['background-color']): ?>
                <?php $rgb_color = simple_hexToRgb($simple_redata['footer_background_color']['background-color']);  ?>
                <div class="bg-overlay" style="background:rgba(<?php echo esc_attr($rgb_color['r']) ?>, <?php echo esc_attr($rgb_color['g']) ?>, <?php echo esc_attr($rgb_color['b']) ?>, 0.88)"></div>
             <?php endif; ?> 

            </div>
            <?php endif; ?>

            <?php if($simple_redata['show_copyright']): ?>
            <div id="copyright">
    	    	<?php if(!$simple_redata['footer_container_full']): ?>
            <div class="container">
            <?php endif; ?>
    	        	<div class="row-fluid">
    		        	<div class="span12 desc"><div class="copyright_text"><?php echo wp_kses_data($simple_redata['copyright_text'], '', ''); ?></div>
                          
                            <div class="pull-right">
                               <?php dynamic_sidebar('Copyright Footer Sidebar') ?>
                            </div>
                            
                        </div>
                    </div>
                
                <?php if(!$simple_redata['footer_container_full']): ?>
            </div>  
            <?php endif; ?>

            </div><!-- #copyright -->
            <?php endif; ?>
        </footer>
    </div>
    <!-- #footer -->

<?php if($simple_redata['site_layout'] == 'boxed'): ?> 
</div>
<?php endif; ?>
</div>
<?php wp_footer(); ?>


<!-- Snap Drawer -->
<!--</div>-->
<!-- Snap Drawer -->
</body>
</html>