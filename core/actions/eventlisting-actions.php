<?php
/**
* Eventlisting actions used by response.
*
* @Author: HESKEYO KAM
* @Copyright: © DEVHKM 2012
* 
* {@link http://hkmdev.wordpress.com/}
* {@link http://imusictech.com/}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
* 
* @package response
* @since 2.0
*/

/**
* response Portfolio Section actions
 * capmomo@hotmail.com
*/
add_action( 'response_eventlisting_element', 'menu_long_event_listing' );
add_action( 'response_menu_event_listing', 'response_eventlisting_element_content' );
function event_coming_listing(){
    $eventdata = new hkm_event();
    $dataof_event = $eventdata->show_barevents(9);
    //This is for checking
    //print_r($dataof_event);
    ob_start();
    foreach ($dataof_event as $key => $value) {
         ?><div class="smallevent row"><?php
            response_value_data_for_list($value);
         ?></div><?php
    }
    return ob_get_contents();
}
function response_value_data_for_list($value){ ?>
	<div class="datawrap">
<div class="date list"><?php echo $value['listval']['linkr_eventdate']; ?></div>
<div class="timeevent list"><?php echo $value['listval']['linkr_time']; ?></div>
<?php if ($value['listval']['barlink']!=-1||!empty($value['listval']['barlink'])){?>
<div class="placeevent list"><a href="<?php echo $value['listval']['barlink']; ?>"><?php echo $value['listval']['linkr_eventplace']; ?></a></div>    
<?php } ?>
<div class="partyname list"><a href="<?php echo $value['plink']; ?>"><?php echo $value['title']; ?></a></div>
</div><?php

}
function menu_long_event_listing(){
    global $options, $post, $ec_themename, $ec_themeslug, $ec_root, $wp_query; ?>
    <div class="container">
    <div class="row">
    <div class="leftside_ads hide-on-phones">
        <?php leftside_ads_html(); ?>
    </div>
    <div class="nine columns maincontentright">
        <?php //section_tab_advertisement_2(); ?>
    <!--<div class="fixwrapcontent">-->
        <div class="innerwrapper">
        <?php 
        section_tab_events(); 
        section_tab_otheracti(); 
        ?>
    </div>
    <!--</div>-->
    </div>
    <div class="nine columns centered hide-on-desktop">
    <?php echo ad_bar_150x75('linkrad_lower_m');?>
    </div>
    <div class="advertisement_400 nine columns centered hide-on-phones">
    <?php echo ad_bar_400x100(); ?>
    </div>
    <div class="pastevent nine columns maincontentright">
        <?php //section_tab_advertisement_2(); ?>
    <!--<div class="fixwrapcontent">-->
        <div class="innerwrapper">
        <?php section_tab_past_events(); ?>
    </div>
    <!--</div>-->
    </div>
    <div class="rightside_ads hide-on-phones">
       <?php rightside_ads_html(); ?>
    </div>
    </div><!--row-->
    </div><!--container--><?php
}
function response_eventlisting_element_content() {
	global $options, $post, $ec_themeslug, $ec_root, $wp_query;
	$tmp_query = $wp_query; 
	$image = get_post_meta($post->ID, 'portfolio_image' , true);
	if (is_page()) {
		$caption4 = get_post_meta($post->ID, $ec_themeslug.'_page_portfolio_image_four_caption' , true);
	}else{
		$caption4 = $options->get($ec_themeslug.'_blog_portfolio_image_four_caption');
	}
	?>
<div id="events" class="container">
<div class="row">
<?php
        /* Post-specific variables */
        $image = get_post_meta($post->ID, 'portfolio_image' , true);
        $title = get_the_title() ;
        $showat=0;
        $showtoplimit=3;
        $eventdata = new hkm_event();
        $dataof_event = $eventdata->get_bar_data();
        //print_r($dataof_event); --this is for checking
        foreach ($dataof_event as $key => $value) {
                if($showat<$showtoplimit){
                  ?><div class="bigevent"><?php
                }else{
                  ?><div class="smallevent row"><?php
                }
                    response_value_data($value);
                      ?></div><?php
                    $showat++;
        }
        if($showat<$showtoplimit){
        	$adding = $showtoplimit-$showat;
        	for($i = 0; $i<$adding;$i++){
        		 ?><div class="bigevent"><?php 
        		
        		 ?></div><?php
        	}
        }
/* END */ 
?>
	</div>
</div>
<?php
}
function response_value_data($value){
?><div class="datawrap">
<div class="date"><?php echo $value['linkr_eventdate']; ?></div>
<div class="placeevent"><a href="<?php echo $value['barlink']; ?>"><?php echo $value['linkr_eventplace']; ?></a></div>
<div class="timeevent"><?php echo $value['linkr_time']; ?></div>
<div class="content"><?php echo $value['linkr_eventdetails_custom']; ?></div>
</div>
<div class="image"><?php 
     if (!empty($value['feature_imagem'])) {
      echo "<img src='".$value['feature_imagem']."'/>";
    } 
    ?></div><?php 
}
function section_tab_past_events(){
	 wp_enqueue_script('eventlisting');
    $eventdata = new hkm_event();
    $dataof_event = $eventdata->show_all_events();
    //This is for checking
    //print_r($dataof_event);
   $g = '';
    $format = '<div class="title_tab pasted_event"></div><section id="pastevent_container" class="eventdetails">%1$s</section>';
	if(count($dataof_event)>0){
	    foreach ($dataof_event as $key => $val) {
	    		/*
				 
	    	echo '<pre>';
	    	print_r($val);
	    	echo '</pre>';
				 
				 */
				 if($val['listval']['order_time_event']==2){
				 	  $g.=render_tab_the_event($val);
				 }
	    }
	}
    echo sprintf($format,$g); 
}
function render_tab_the_event($value){
	//http://isotope.metafizzy.co/custom-layout-modes/masonry-column-shift.html
	$format = '<article class="event">
	<div class="post"><a href="%6$s">%1$s</a></div>
	<div class="date"><span></span>%2$s</div>
	<div class="time"><span></span>%5$s</div>
	<div class="place"><span></span>%3$s</div>
	<div class="title">%4$s</div>
	</article>';
	$a =$value['listval']['linkr_eventdate'];
	$b=($value['listval']['barlink']!=-1||!empty($value['listval']['barlink']))?$value['listval']['barlink']:'';
	$c =$value['listval']['linkr_eventplace'];
	$d =$value['listval']['linkr_time'];
	$eventlink=$value['plink'];
	//$e =$value['listval']['linkr_eventdetails_custom'];
    $f= "<img src='".$value['mid']."'/>";
	$g =$value['title'];
    return sprintf($format,$f,$a,$c,$g,$d,$eventlink);
}
?>