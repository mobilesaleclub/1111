<?php

$simple_redata = simple_redata_variable();

$simple_current_view =  simple_current_view();

$sidebar_style = "";



if($simple_redata['layout'] != 'fullwidth' || $simple_redata['bloglayout'] != 'fullwidth' || $simple_redata['singlebloglayout'] != 'fullwidth'):  ?>

    

    <aside class="span3 sidebar" id="widgetarea-sidebar">

        <?php if(is_active_sidebar($simple_redata['right_sidebar_dual'])) dynamic_sidebar($simple_redata['right_sidebar_dual']); ?>

    </aside>



<?php endif; ?>