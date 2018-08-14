<?php

$simple_redata = simple_redata_variable();

$simple_current_view = simple_current_view();

$sidebar_style = "";
if($simple_redata['layout'] != 'fullwidth' || $simple_redata['bloglayout'] != 'fullwidth' || $simple_redata['singlebloglayout'] != 'fullwidth'): ?>

   
    <aside class="span3 sidebar" id="widgetarea-sidebar">

        <?php
        if( ( $simple_redata['overwrite_layout'] && $simple_redata['layout'] != 'dual' ) || !$simple_redata['overwrite_layout'] ){
            if ( ($simple_current_view == 'blog' || $simple_current_view == 'single_blog') && is_active_sidebar( 'sidebar-blog' ) )
                dynamic_sidebar( 'sidebar-blog' );
            
            if ($simple_current_view == 'portfolio' && is_active_sidebar( 'sidebar-portfolio' ))
                dynamic_sidebar( 'sidebar-portfolio' );

            if ($simple_current_view == 'page' && is_active_sidebar( 'sidebar-pages' ) && dynamic_sidebar( 'sidebar-pages' )) : $use_default = false; endif;

            if ($simple_current_view == 'woocommerce' && is_active_sidebar( 'woocommerce' ) && dynamic_sidebar( 'woocommerce' )) : $use_default = false; endif;

            $page_title = simple_check_custom_sidebar('page');

            if (function_exists('dynamic_sidebar') && dynamic_sidebar(__('Page','the-simple').': '.$page_title) ) : $use_defailt = false; endif;

            $cat_title = simple_check_custom_sidebar('cat');

            if (function_exists('dynamic_sidebar') && dynamic_sidebar(__('Category','the-simple').': '.$cat_title) ) : $use_defailt = false; endif;
        }else if($simple_redata['overwrite_layout'] && $simple_redata['layout'] == 'dual' && is_active_sidebar($simple_redata['left_sidebar_dual'])){
                dynamic_sidebar($simple_redata['left_sidebar_dual']);
        }
        


        ?>

    </aside>



<?php endif; ?>

