<?php header("Content-type: text/css; charset: UTF-8"); ?>
<?php
$style = qem_get_stored_style();
$cal = qem_get_stored_calendar();
$display = event_get_stored_display();
$register = qem_get_stored_register();
$script=$showeventborder=$formborder=$daycolor=$eventbold=$colour=$eventitalic='';
if ($style['calender_size'] == 'small') $radius = 7;
if ($style['calender_size'] == 'medium') $radius = 10;
if ($style['calender_size'] == 'large') $radius = 15;
$ssize=50 + (2*$style['date_border_width']).'px';
$srm = $ssize+5+($style['date_border_width']).'px';
$msize=70 + (2*$style['date_border_width']).'px';
$mrm = $msize+5+($style['date_border_width']).'px';
$lsize=90 + (2*$style['date_border_width']).'px';
$lrm = $lsize+5+($style['date_border_width']).'px';
    if ($style['date_background'] == 'color') $color = $style['date_backgroundhex'];
    if ($style['date_background'] == 'grey') $color = '#343838';
	if ($style['date_background'] == 'red') $color = 'red';
    if ($style['month_background'] == 'colour') $colour = $style['month_backgroundhex'];
	else $colour = '#FFF';
	
    if ($style['event_background'] == 'bgwhite') $eventbackground = 'background:white;';
	if ($style['event_background'] == 'bgcolor') $eventbackground = 'background:'.$style['event_backgroundhex'].';';
    
    $formwidth = preg_split('#(?<=\d)(?=[a-z%])#i', $register['formwidth']);
    if (!$formwidth[0]) $formwidth[0] = '280';
    if (!$formwidth[1]) $formwidth[1] = 'px';
    $regwidth = $formwidth[0].$formwidth[1];

    $dayborder = 'color:' . $style['date_colour'].';background:'.$color.'; border: '. $style['date_border_width']. 'px solid ' .$style['date_border_colour'].';border-bottom:none;';
    
    $nondayborder = 'border: '. $style['date_border_width']. 'px solid ' .$style['date_border_colour'].';border-top:none;background:'.$colour.';';
    
    $monthcolor = 'span.month {color:'.$style['month_colour'].';}';
    
    $eventborder = 'border: '. $style['date_border_width']. 'px solid ' .$style['date_border_colour'].';';
	
    if ($style['icon_corners'] == 'rounded') {
        $dayborder = $dayborder.'-webkit-border-top-left-radius:'.$radius.'px; -moz-border-top-left-radius:'.$radius.'px; border-top-left-radius:'.$radius.'px; -webkit-border-top-right-radius:'.$radius.'px; -moz-border-top-right-radius:'.$radius.'px; border-top-right-radius:'.$radius.'px;';
        $nondayborder = $nondayborder.'-webkit-border-bottom-left-radius:'.$radius.'px; -moz-border-bottom-left-radius:'.$radius.'px; border-bottom-left-radius:'.$radius.'px; -webkit-border-bottom-right-radius:'.$radius.'px; -moz-border-bottom-right-radius:'.$radius.'px; border-bottom-right-radius:'.$radius.'px;';
        $eventborder = $eventborder.'-webkit-border-radius:'.$radius.'px; -moz-border-radius:'.$radius.'px; border-radius:'.$radius.'px;';
    }
    
    if ($style['event_border']) $showeventborder = 'padding:'.$radius.'px;'.$eventborder;
    if ($register['formborder']) $formborder = "\n.qem-register {".$eventborder."padding:".$radius."px;}";
    if ($style['widthtype'] == 'pixel') $eventwidth = preg_replace("/[^0-9]/", "", $style['width']) . 'px;';
    else $eventwidth = '100%';
    
    $j = preg_split('#(?<=\d)(?=[a-z%])#i', $display['event_image_width']);
    if (!$j[0]) $j[0] = '300';
    $i = $j[0].'px';
    
    if ($cal['eventbold']) $eventbold = 'font-weight:bold;';
    if ($cal['eventitalic']) $eventitalic = 'font-style:italic;';
    $ec = ($cal['event_corner'] == 'square' ? 0 : 3); 
    $script .= '.qem {width:'.$eventwidth.';'.$style['event_margin'].';}
.qem p {'.$style['line_margin'].';}
.qem p, .qem h2 {margin: 0 0 8px 0;padding:0;}'."\n";
    if ($style['font'] == 'plugin') {
        $script .= ".qem p {font-family: ".$style['font-family']."; font-size: ".$style['font-size'].";}
.qem h2, .qem h2 a {font-size: ".$style['header-size']." !important;color:".$style['header-colour']." !important}\n";
    }
    $script .= '@media only screen and (max-width:'.$cal['trigger'].') {.qemtrim span {font-size:50%;}
.qemtrim, .calday, data-tooltip {font-size: '.$cal['eventtextsize'].';}}';
    $arr =array('arrow' => '\25B6','square' => '\25A0','box'=>'\20DE','asterix'=>'\2605','blank'=>' ');    
    foreach ($arr as $item => $key)
        if($item == $cal['smallicon'])
            $script .= '#qem-calendar-widget h2 {font-size: 1em;}
#qem-calendar-widget .qemtrim span {display:none;}
#qem-calendar-widget .qemtrim:after{content:"'.$key.'";font-size:150%;}
@media only screen and (max-width:'.$cal['trigger'].';) {
    .qemtrim span {display:none;}.qemtrim:after{content:"'.$key.'";font-size:150%;}
}'."\n";
        $script .= '.qem-small, .qem-medium, .qem-large {'.$showeventborder.$eventbackground.'}'
.$formborder.
".qem-register{max-width:".$regwidth.";}
.qem-register #submit {background: ".$register['submitbackground'].";}
.qem-register #submit:hover {background: ".$register['hoversubmitbackground'].";}
.qemright {max-width:".$display['max_width']."%;width:".$i.";height:auto;overflow:hidden;}
.qemlistright {max-width:".$display['max_width']."%;width:".$display['image_width']."px;height:auto;overflow:hidden;}
img.qem-image {width:100%;height:auto;overflow:hidden;}
img.qem-list-image {width:100%;height:auto;overflow:hidden;}
.qem-category {".$eventborder."}
.qem-icon .qem-calendar-small {width:".$ssize.";}
.qem-small {margin-left:".$srm.";}
.qem-icon .qem-calendar-medium {width:".$msize.";}
.qem-medium {margin-left:".$mrm.";}
.qem-icon .qem-calendar-large {width:".$lsize.";}
.qem-large {margin-left:".$lrm.";}
.qem-calendar-small .nonday, .qem-calendar-medium .nonday, .qem-calendar-large .nonday {display:block;".$nondayborder."}
.qem-calendar-small .day, .qem-calendar-medium .day, .qem-calendar-large .day {display:block;".$daycolor.$dayborder."}
.qem-calendar-small .month, .qem-calendar-medium .month, .qem-calendar-large .month {color:".$style['month_colour']."}
.qem-error { border-color: red !important; }
.qem-error-header { color: red !important; }
.qem-columns, .qem-masonry {border:".$display['eventgridborder'].";}
#qem-calendar ".$cal['header']." {margin: 0 0 8px 0;padding:0;".$cal['headerstyle']."}
#qem-calendar .calmonth {text-align:center;}
#qem-calendar .calday {background:".$cal['calday']."; color:".$cal['caldaytext']."}
#qem-calendar .day {background:".$cal['day'].";}
#qem-calendar .eventday {background:".$cal['eventday'].";}
#qem-calendar .eventday a {-webkit-border-radius:".$ec."px; -moz-border-radius:".$ec."px; border-radius:".$ec."px;color:".$cal['eventtext']." !important;background:".$cal['eventbackground']." !important;border:".$cal['eventborder']." !important;}
#qem-calendar .eventday a:hover {background:".$cal['eventhover']." !important;}
#qem-calendar .oldday {background:".$cal['oldday'].";}
#qem-calendar table {border-collapse: separate;border-spacing:".$cal['cellspacing']."px;}
.qemtrim span {".$eventbold.$eventitalic."}
@media only screen and (max-width: 700px) {.qemtrim img {display:none;}}
@media only screen and (max-width: 480px) {.qem-large, .qem-medium {margin-left: 50px;}
    .qem-icon .qem-calendar-large, .qem-icon .qem-calendar-medium  {font-size: 80%;width: 40px;margin: 0 0 10px 0;padding: 0 0 2px 0;}
    .qem-icon .qem-calendar-large .day, .qem-icon .qem-calendar-medium .day {padding: 2px 0;}
    .qem-icon .qem-calendar-large .month, .qem-icon .qem-calendar-medium .month {font-size: 140%;padding: 2px 0;}
}";
    if ($cal['tdborder']) {
        if ($cal['cellspacing'] > 0) {
            $script .='#qem-calendar td.day, #qem-calendar td.eventday, #qem-calendar td.calday {border: '.$cal['tdborder'].';}';
        } else {
            $script .='#qem-calendar td.day, #qem-calendar td.eventday, #qem-calendar td.calday {border-left:none;border-top:none;border-right: '.$cal['tdborder'].';border-bottom: '.$cal['tdborder'].';}
#qem-calendar tr td.day:first-child,#qem-calendar tr td.eventday:first-child,#qem-calendar tr td.calday:first-child{border-left: '.$cal['tdborder'].';}'."\n".'
#qem-calendar tr td.calday{border-top: '.$cal['tdborder'].';}
#qem-calendar tr td.blankday {border-bottom: '.$cal['tdborder'].';}
#qem-calendar tr td.firstday {border-right: '.$cal['tdborder'].';border-bottom: '.$cal['tdborder'].';}';
        }
    }
    $lbmargin = $display['lightboxwidth']/2;
    $script .= '#xlightbox {width:'.$display['lightboxwidth'].'%;margin-left:-'.$lbmargin.'%;}
@media only screen and (max-width: 480px) {#xlightbox {width:90%;margin-left:-45%;}}';
    if ($register['ontheright'])
        $script .='.qem-register {width:100%;} .qem-rightregister {max-width:'.$i.'px;}';
    if ($style['use_custom'] == 'checked')
        $script .= $style['custom'];
    $cat = array('a','b','c','d','e','f','g','h','i','j');
    foreach ($cat as $i) {
        if ($style['cat'.$i]) {
            $eb = ($cal['fixeventborder'] || $cal['eventborder'] == 'none' ? '' : 'border:1px solid '.$style['cat'.$i.'text'].' !important;');
            $script .="#qem-calendar a.".$style['cat'.$i]." {background:".$style['cat'.$i.'back']." !important;color:".$style['cat'.$i.'text']." !important;".$eb."}";
            $script .='.'.$style['cat'.$i].' .qem-small, .'.$style['cat'.$i].' .qem-medium, .'.$style['cat'.$i].' .qem-large {border-color:'.$style['cat'.$i.'back'].';}
.'.$style['cat'.$i].' .qem-calendar-small .day, .'.$style['cat'.$i].' .qem-calendar-medium .day, .'.$style['cat'.$i].' .qem-calendar-large .day, .'.$style['cat'.$i].' .qem-calendar-small .nonday, .'.$style['cat'.$i].' .qem-calendar-medium .nonday, .'.$style['cat'.$i].' .qem-calendar-large .nonday {border-color:'.$style['cat'.$i.'back'].';}';
        }
    }

echo $script;
?>