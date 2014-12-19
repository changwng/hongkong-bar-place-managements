<?php


/* THIS PAGE CONTAINS OTHER ACTIVITIES AND PARTS IN THE MIDDLE TAB AREA
 * 
 * 
 */
    function render_featured_bars(){
        $data = data_get_bars_featured();
        $html = '';
        $var = '<div class="cell"><a href="%1$s">%2$s</a></div>';
        foreach ($data as $key => $value) {
            $html.=sprintf($var,$value['link'],$value['img']);
        }
        return $html;
    }
    function mobile_element_menu(){
        get_template_part("tpl/menu","mobile");
    }
    function web_element_menu(){
        global $ec_themename;
        $submegaType = hkm_cross_reference::custom_taxonomy_walker_level_1('linkrbarfeat',0,true);
        $submegaLocations = hkm_cross_reference::custom_taxonomy_walker_level_1('linkrarea',0,true);
        ob_start();
        wp_nav_menu(array('items_wrap' => '<ul id="nav_menu" class="topnavmenu' . addClassifIE8(true) . '">%3$s</ul>', 'fallback_cb' => $ec_themename . '_menu_fallback', 'theme_location' => 'homepage-menu', ));
        $menu=ob_get_clean();
        ob_start();
        get_template_part("tpl/menu","web");
        $tpl=ob_get_clean();
        ob_start();
        echo ajaxy_search_form();
        $ajaxy_search_form=ob_get_clean();
        echo sprintf($tpl,$menu,$ajaxy_search_form,$submegaType,$submegaLocations,render_featured_bars());
    }
    function section_tab_walker_bar_types(){
        $index_html = hkm_cross_reference::custom_taxonomy_walker_level_1('linkrbarfeat');
    ?><!-- start section -->
    <section class="middlepart bar_features">
            <div class="title_tab linker_bar_types"></div>
            <?php echo $index_html; ?>
    </section><!-- End section -->
    <?php
    }
    function tab_event_loop($value){
    get_template_part("tpl/loop","tabevent");
    }
    function tab_even_loop2($value){
    $var1='<a href="%1$s" class="coming_events %3$s">%2$s</a>';
    $var2='<div class="time">%1$s</div><div class="shopname">%2$s</div><div class="poster"><img src="%3$s"/></div>';
    $time_place = $value['listval']['linkr_eventdate'].'<br>';
    $time_place = ($value['listval']['order_time_event']==1)?'Upcoming<br>'.$time_place : $time_place;
    //order_time_event
    $old_event =  'ispast_'.$value['listval']['order_time_event'];
    $time_place .='<div class="place">'.($value['listval']['linkr_eventplace']!=-1)?$value['listval']['linkr_eventplace']:''.'</div>';
    $r =sprintf($var2,$time_place ,$value['title'], $value['mid']);
    return $h =sprintf($var1, $value['plink'], $r, $old_event);
    }
    function tab_event_loop_in_bar($value){
         ob_start();
    get_template_part("tpl/loop","tabcomingevent");  
    $tpl=ob_get_clean();
      echo sprintf($tpl,$value['listval']['linkr_eventdate'],$value['listval']['linkr_time'],$value['plink'], $value['title'], $value['mid']);
    }
    function section_tab_otheracti($limits=3){
    global $options, $post, $ec_themeslug, $ec_root, $wp_query, $googleapikey,$ec_themename;
    $c = new hkm_event();
    $data_events = $c->show_barevents($limits);
    //print_r($data_events);
    ob_start();
    if(count($data_events)>0){
    foreach ($data_events as $key => $longdata) {
    echo tab_even_loop2($longdata);
    }
    }else{
    echo "沒有任何活動";
    }
    $content=ob_get_clean();
    ob_start();
    get_template_part("tpl/section","tab_column");
    $tpl=ob_get_clean();
    echo sprintf($tpl,$content,"linkerotheract");
    }

    function section_tab_events($limits=3){
    global $options, $post, $ec_themeslug, $ec_root, $wp_query, $googleapikey,$ec_themename;
    $c = new hkm_event();
    $data_events = $c->show_barevents($limits,true);
    ob_start();
    //print_r($data_events);
    if(count($data_events)>0){
    foreach ($data_events as $key => $longdata) {
    echo tab_even_loop2($longdata);
    }
    }else{
    echo "沒有任何活動";
    }
    $content=ob_get_clean();
    ob_start();
    get_template_part("tpl/section","tab_column");
    $tpl=ob_get_clean();
    echo sprintf($tpl,$content,"ecdrink_activity_coming");
    }
    /*
    function section_tab_events(){
    $eventdata = new hkm_event();
    $dataof_event = $eventdata->show_barevents(9);
    // --this is for checking
    //print_r($dataof_event);
    ?><!-- start section --><section class="middlepart">
    <div class="linkerevents_coming"></div>
    <?php
    foreach ($dataof_event as $key => $value) {
    ?><div class="smallevent row"><?php
    response_value_data_for_list($value);
    ?></div><?php
    };
    ?>
    </section><!-- End section --><?php
    }
    */

    function section_tab_advertisement(){
    ?><!-- start section --><section class="middlepart ad4ve1ment">
        <div class="title_tab advertisebartop"></div>
        <img src="http://linker.imusictech.com/wp-content/themes/linkr/images/ad_banner_small.jpg" />
        <img src="http://linker.imusictech.com/wp-content/themes/linkr/images/ad_banner_small.jpg" />
        <img src="http://linker.imusictech.com/wp-content/themes/linkr/images/ad_banner_small.jpg" />
        <img src="http://linker.imusictech.com/wp-content/themes/linkr/images/ad_banner_small.jpg" />
        </section><!-- End section -->
   <?php

}
    function section_tab_advertisement_2(){
     ?><!-- start section --><section class="middlepart ad4ve2ment single">
        <img src="http://linker.imusictech.com/wp-content/themes/linkr/images/ad_banner_long.jpg" />
        <img src="http://linker.imusictech.com/wp-content/themes/linkr/images/ad_banner_small.jpg" />
        </section><!-- End section -->
   <?php
}
    function section_tab_coupons_fliping(){
$dataof_coupon=prepare_conpon_data(-1);
ob_start();
foreach ($dataof_coupon as $key => $value) {
response_value_data_for_couponpage($value);
}
$html=ob_get_clean();
    ?>
    <section class="middlepart coupon_box">
            <div class="title_tab linkercoupons"></div>
            <?php echo $html; ?>
    </section>
    <?php
    }
    function section_tab_coupons(){
    wp_enqueue_style('pagnation');
    wp_enqueue_script('pagnation');
    wp_enqueue_script('coupon_page');

    $dataof_coupon=prepare_conpon_data(-1);
    ob_start();
    foreach ($dataof_coupon as $key => $value) {
    response_value_data_for_couponpage_classic($value);
    }
    $html=ob_get_clean();
    if(is_lt_IE8()){
    $html.="<style>.coming_events{ height:65px; } .shopname{width:120px;} .club{width:200px;}</style>";
    }
    ob_start();
    get_template_part("tpl/list","coupon");
    $tpl=ob_get_clean();
    echo sprintf($tpl, $html);
    }

    function rightside_ads_single_column_html(){
    $coupons_html = "";
    $seclinkerpromote = '<section><div class="title_tab linkerpromote"></div><div class="show">%s</div></section>';
    $seclinkernewshop = '<section><div class="title_tab linkernewshop"></div><div class="show">%s</div></section>';
    $var = '<div class="promoteshop"><a href="%1$s"><div class="shopname">%2$s</div></a><img src="%3$s"/></div>';
    // ob_start();rightside_ads_single_column_html
    $c = new frontend_hkm_bar();
    $data_promote = $c->get_checked_posts_with_image('linkr_promotion',3);
    foreach ($data_promote as $key => $value) {
    $coupons_html .= sprintf($var, $value[1], $value[0], $value[2]);
    }
    echo sprintf($seclinkerpromote, $coupons_html);
    $coupons_html = "";
    $c = new frontend_hkm_bar();
    $coupons_html = "";
    $data_newshop = $c -> get_checked_posts_with_image('linkr_promote_new', 3);
    foreach ($data_newshop as $key => $value) {
    $coupons_html .= sprintf($var, $value[1], $value[0], $value[2]);
    }
    echo sprintf($seclinkernewshop, $coupons_html);
    //$k = ob_get_contents();
    // echo $k;
    }
    function go_back($label, $url){
    $var ='<a class="gobackbutton" href="%1$s">%2$s</a>';
    echo sprintf($var, $url, $label);
    }
    function leftside_ads_html(){
    // ob_start();
    $content = ad_list_vertical('linkrad_lower_l');
    $var ='<section><div class="title_tab linkernewshop"></div><div class="show">%1$s</div></section>';
    echo sprintf($var, $content);
    }
    function rightside_ads_html(){
    $content = ad_list_vertical('linkrad_lower_r');
    ?>
    <section>
            <div class="title_tab linkerpromote"></div>
            <div class="show">
				<?php echo $content; ?>
            </div>
        </section>
        <?php
        }
        /*
        * LINKER CUSTOMIZATION BING MAP
        * SLIDER WITH 4 ITEMS MENU
        */
    function menubingmap_html() {
        global $options, $post, $ec_themeslug, $ec_root, $wp_query, $googleapikey, $ec_themename;
        $tmp_query = $wp_query;
        css_original_design();
    ?><div id="map_all_bars" class="container">
      <div class="row">
       <div id="nav">
        <?php wp_nav_menu(array('items_wrap' => '<ul id="nav_menu" class="topnavmenu">%3$s</ul>', 'fallback_cb' => $ec_themename . '_menu_fallback', 'theme_location' => 'header-menu', )); ?></div>
       <div id="mapcanvas" class="hide-on-phones"></div>
      </div>
<div class="row"><?php
//if(function_exists('get_menu_ressembled'))
//echo get_menu_ressembled(array(150,150,180,150,150,180,150),60,"loactions_filter",HKM_IMG_PATH."button_location.png",true,false);
//else echo "no method for get_menu_ressembled";
make_menu_in_circle_html();
?><ul class="loactions_filter full hide-on-phones" id="list_loactions_filter"><li><a></a></li><li><a></a></li><li><a></a></li><li><a></a></li><li><a></a></li><li><a></a></li><li><a></a></li></ul>
</div>
<div class="row">
<div id="mobile_bar_detail" class="bardetailthumb"></div>
<div class="hide bardata">
<?php
$madata = new frontend_hkm_bar();
$mapdata=$madata->prepare_map_data();
//print_r($madata->result);
foreach($mapdata as $key=>$value){
?><div class="bar" barid="<?php echo $value['barid']; ?>" area="<?php echo $value['area']; ?>">
<?php
if (!empty($value['feature_image'])) {
    echo "<img src='" . $value['feature_image'] . "'/>";
} else {
    //echo $default_220['url'];
    echo "";
}
?><div class="barname"><?php echo $value['barname']; ?></div>
<div class="gradient"></div></div><?php

}
?></div><div id="mobile_bar_slider_small" class="bardetail"><?php
// this will be under controlled by JQ and ajax
// jquery.royalslider
?></div>
</div>
</div><?php mbingmap_js(1000, 405, json_encode($mapdata)); ?><script>
    jQuery("#mapcanvas").css('float', 'right');
 </script><?php

}

    function gear_tab_content_html(){
$gear_tab_content_list = array(
array('metatab',__('酒吧資料','linker'), 'selected' ),
array('fullstory',__('酒吧介紹','linker'), '' ),
array('hh',__('Happy Hour 時間收費','linker'), ''  ),
array('weekend',__('週末營業時間收費','linker'),''),
array('normal',__('平日營業時間','linker'), '' ),
array('weekends',__('平日營業時間收費','linker'), '' ),
array('coupon',__('優惠券','linker'), '' ),
array('activity',__('活動','linker'), '' ),
//array('population',__('Rating','linker'), 'linkr_cap' ),
);
get_template_part("tpl/menu","bar_detail"); ?>
<!--<div class="row selectionbar show-on-phones">
            <select><?php
            $buffer = "";
            foreach ($gear_tab_content_list as $key0 => $list) {
                $active = $list[2] == "selected" ? "selected=\"selected\"" : "";
                $buffer .= "<option " . $active . " value=\"" . $list[0] . "\">" . $list[1] . "</option>";
            }
            echo $buffer;
            ?>
            </select>
</div>-->
        <div class='nine columns partyarrangement'>
            <ul class="tabs show-on-desktops" <?php inlineStyleIE_displayNone_fix(); ?>>
                <li class="tab metatab"><a>酒吧資料</a></li>
                <li class="tab fullstory <?php echo detect_mobile() ? "active" : "active"; ?>"><a>酒吧介紹</a></li>
                <li class="tab hh"><a>Happy Hour 時間收費</a></li>
                <li class="tab weekend"><a>週末營業時間收費</a></li>
                <li class="tab normal"><a>平日營業時間收費</a></li>
                <li class="tab coupon"><a>優惠券</a></li>
                <li class="tab activity"><a>活動</a></li>
            </ul>
        <section id="tabcontent">
            <!--meta tab starts
        <div class="metatab hideDisplay" <?php inlineStyleIE_displayNone_fix();?>>-->
        <div id="metatab" class="metatab">
        <div class="<?php echo ieTab(); ?>">酒吧資料</div><ul class="meta">
        <?php gear_html_meta_info(); ?></ul>
        <?php tab_content_metatab_reservbutton_html(); ?>
        </div><!--end meta tab starts-->
        <!--detail starts-->
        <div id="fullstory" class="detail fullstory <?php echo detect_mobile() ? "" : "active"; ?>"><div class="<?php echo ieTab(); ?>">酒吧介紹</div><?php
        gear_autop_arrayd('linkr_detail');
        ?></div><!--end detail tab starts-->
        <div  id="hh" class="happyhour hh" ><div class="<?php echo ieTab(); ?>">Happy Hour 時間收費</div><?php
        gear_content_print_line('linkr_happyhour');
        ?></div>
        <div  id="weekend" class="weekend" ><div class="<?php echo ieTab(); ?>">週末營業時間收費</div><?php
        gear_content_print_line('linkr_wend_hour');
        ?></div>
        <div  id="normal" class="normal" ><div class="<?php echo ieTab(); ?>">平日營業時間收費</div><div class="innerwrap"><?php
        gear_content_print_line('linkr_normalhour');
        ?></div></div>
        <div  id="coupon" class="coupon" ><div class="<?php echo ieTab(); ?>">優惠券</div>
        <div class="coupons_li5643st coming_events first"><div class="time">COUPON</div><div class="shopname">人數上限</div><div class="club">優惠</div></div>
       <?php
    global $post;
    $crossed1 = hkm_cross_reference::cross_reference_collect_ids_2step(HKM_EVENT, HKM_COUPON, 'linkr_eventplace', 'linkr_coupon_event', $post -> ID, 'coupon_collect');
    $crossed2 = hkm_cross_reference::cross_reference_lookup_followers_cb('linkr_coupon_eventplace', HKM_COUPON, $post -> ID, 'coupon_collect');
    if (!$crossed1 && !$crossed2) {
        echo '沒有任何優惠券<style>.coupons_li5643st { display: none;}</style>';
    }
        ?></div><!--end coupon-->
        <div  id="activity" class="activity" >
            <div class="<?php echo ieTab(); ?>">活動</div>
            <?php 
           $c = new hkm_event();
           $data_events = $c->ShowDisBarEvents($post);
           //print_r($data_events);
           if(count($data_events)>0){
        ?><div class="coming_events first">
            <div class="time">時間</div>
            <div class="shopname">活動主題</div>
            <div class="poster"></div>
         </div>
        <?php
        foreach ($data_events as $key => $longdata) {
            tab_event_loop_in_bar($longdata);
        }
        }else{
        echo "沒有任何活動";
        }
        ?>
        </div>
        </section>
        </div><?php
        }
        function tab_content_metatab_reservbutton_html(){
        global $post;
    ?><div class="row buttonlinkr"><?php
    if(detect_mobile()){
       ?><a href="tel:<?php gear_content_print_line('linkr_phone'); ?>" class="reserv button"><?php
    }else{
       ?><a class="reserv button"><?php
    }
 ?>
            <span class="shine"></span>
            <span class="text">撥打電話<br><?php gear_content_print_line('linkr_phone'); ?></span>
        </a><a target="_blank" href="<?php echo get_post_meta($post -> ID, "linkr_google_url", true); ?>" class="reserv button"><span class="shine"></span>
            <span class="text"><div class="map"></div><span class="maptext">地圖</span></span>
        </a>
        </div><?php
        }
    ?>
