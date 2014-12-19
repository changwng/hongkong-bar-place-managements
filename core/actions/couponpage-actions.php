<?php
/**
* Element actions used by Hesk Response Pro.
*
* Author: HESKEYO KAM
* Copyright: © 2012
* {@link http://hkmdev.wordpress.com/ HKMdev LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package response Pro
* @since 1.0
*/

/**
* response Portfolio Section actions
 * capmomo@hotmail.com
*/
add_action( 'response_couponpage', 'couponpage_listing_html' );
function single_coupon_loop($post_object){
    $_id = $post_object -> ID;
    $datalist=array();
    $feature_image_m =wp_get_attachment_image_src(get_post_thumbnail_id($_id),'medium');
    $datalist['thumb']=$feature_image_m[0];
    $datalist['id']=$_id;
    $datalist['link']=get_permalink($_id);
    $datalist['coupontitle']=get_the_title($_id);
    $datalist['couponcode']=get_post_meta($_id, 'linkr_coupon_code', true);
    $datalist['detail']=get_post_meta($_id, 'linkr_coupon_detail', true);
    $datalist['cap']=get_post_meta($_id, 'linkr_coupon_cap', true);
    $datalist['phone']=get_post_meta($_id, 'linkr_coupon_person', true);
    $datalist['linkr_coupon_conditions']=get_post_meta($_id, 'linkr_coupon_conditions', true);
    //the post ID for the Coupon Event aka the party ID
    $eventcode = get_post_meta($_id, 'linkr_coupon_event', true);
    $club_hardcode = get_post_meta($_id, 'linkr_coupon_eventplace', true);
    $club_hardcode_obj=array(
        'title'=> hkm_cross_reference::meta_box_get_post_title($club_hardcode,HKM_BAR),
        'link'=>hkm_cross_reference::meta_box_get_permlink($club_hardcode,HKM_BAR),
    );
    $datalist['linkr_coupon_event']=$eventcode;
    //using the reference from one post type and search thru a key from that post type on the second level
    //$club = ($eventcode!=-1)?hkm_cross_reference::cross_reference_2step(HKM_EVENT,$eventcode,'linkr_eventplace' ,HKM_BAR):$club_hardcode;
    if($eventcode!=-1){
        $club=hkm_cross_reference::cross_reference_2step(HKM_EVENT,$eventcode,'linkr_eventplace' ,HKM_BAR);
    }else{
        $club=$club_hardcode_obj;
    }
    if(!$club){
       $datalist['club_attached']=FALSE;
       $datalist['club']="-N/A-";
       $datalist['clublink']="#";
     }else{
       $datalist['club_attached']=TRUE;
       $datalist['club']=$club['title'];
       $datalist['clublink']=$club['link'];
    }
    return $datalist;
}
function prepare_conpon_data($limit){
    $args = array('post_type' => HKM_COUPON,
            'posts_per_page' => $limit,
            'post_status' => 'publish');
     $dataholder=array();
     $actionquery = new WP_query($args);
            $pack = array();
            if ($actionquery -> have_posts()) :
                while ($actionquery -> have_posts()) : $actionquery -> the_post();
                    //getting the thumnail file url for this post
                    //any other custom fields will be using this functionslinkr_coupon_detail
                    //$this->finish_the_list_with_all_other_custom_fields($_id);
                    //$tmp = get_post_meta($id, $custom_field_id, true);linkr_coupon_cap
                    $dataholder[]=single_coupon_loop($actionquery -> post);
                endwhile;
            else :
            //echo wpautop('Sorry, no posts were found');
            endif;
            // Reset Post Data
            wp_reset_postdata();
            return $dataholder;
}
//this is the listing action for the coupon page - that will display a collection of coupons
function response_value_data_for_couponpage_classic($val){
$var = '<a href="%1$s" class="coming_events"><div class="time">%2$s</div><div class="shopname">%3$s</div>
<div class="club">%4$s</div><div class="detaillink">%5$s</div><div class="poster"><img class="rsImg" src="%6$s"/></div></a>';
echo sprintf($var,$val['link'],$val['club'], $val['coupontitle'],$val['cap'],$val['detail'],$val['thumb'] );
}
function response_value_data_for_couponpage($val){
//.coupon
?>
<div class="coupon flip-container" ontouchstart="this.classList.toggle('hover');" id="<?php echo 'coupon' . $val['id']; ?>" >
    <div class="flipper">
        <section class="front">
                <div class="datawrap">
                    <div class="coupontitle"><?php echo $val['coupontitle']; ?></div>
                    <?php if($val['club_attached']){?>
                    <div class="club">By <?php echo $val['club']; ?></div>
                    <?php } ?>
                    <div class="detail"><span>約制條款: </span><?php echo $val['linkr_coupon_conditions']; ?></div>
                </div>
                <div class="cover"></div>
                <img class="front-clip" src="<?php echo HKM_IMG_PATH . 'svgcut.png'; ?>"/>
                <img class="back-logo rsImg" src="<?php echo $val['thumb']; ?>"/>
        </section>
        <section class="image back">
                <div class="couponcode"><span>CODE: </span><?php echo $val['couponcode']; ?></div>
                <div class="phone"><span>查詢電話: </span><?php echo $val['phone']; ?></div>
                <div class="cap"><span>人數上限: </span><?php echo $val['cap']; ?></div>
                <div class="detail"><span>約制條款: </span><?php echo $val['linkr_coupon_conditions']; ?></div>
                <!--<img class="back-code rsImg" src="<?php echo HKM_IMG_PATH.'code.png';?>"/>-->
        </section>
    </div>
</div>
<?php
}
function response_value_data_for_single_classic_html($val){
    $qr = 'http://api.qrserver.com/v1/create-qr-code/?data=%1$s&size=100x100';
    ?>
<section class="front classic">
    <div class="datawrap">
        <div class="coupontitle"><?php echo $val['coupontitle']; ?></div>
        <?php if($val['club_attached']){?>
            <div class="club">By <?php echo $val['club']; ?></div>
        <?php } ?>
        <div class="detail"></div>
    </div>
    <div class="cover"><img src="<?php echo sprintf($qr, get_permalink($val['id']));?>"/></div>
    <img class="front-clip" src="<?php echo HKM_IMG_PATH . 'svgcut.png'; ?>"/>
    <img class="back-logo rsImg" src="<?php echo $val['thumb']; ?>"/>
</section>
<?php
}

function couponpage_listing_html(){
global $options, $post, $ec_themename, $ec_themeslug, $ec_root, $wp_query;
//echo "start get_menu_ressembled";
//echo get_menu_ressembled(array(125,125,175,175,155,175,210),50,"topnavmenu",HKM_IMG_PATH."button_home_menu.png",true,false);
?>
<div class="container">
<div class="row">
<div class="leftside_ads hide-on-phones">
<?php leftside_ads_html(); ?>
</div><!--leftside end-->
<div class="nine columns maincontentright">
<?php //section_tab_advertisement_2(); ?>

<div class="innerwrapper">
<?php //section_tab_advertisement();
		section_tab_coupons(); ?>
		<section class="middlepart coupon_box" id="coming_events"></section>
</div>
</div><!--end entry-->
<div class="rightside_ads hide-on-phones">
<?php rightside_ads_html(); ?>
</div>
</div><!--end row-->
</div><!--end container--><?php

}
function coupon_collect($coupon_collect_post){
//  echo $coupon_collect_post->ID."\n";
//print_r($coupon_collect_post->post_title);
// echo get_permalink($coupon_collect_post->ID);
$_id=$coupon_collect_post->ID;
$linkc=get_permalink($_id);
$eventcode = get_post_meta($_id, 'linkr_coupon_event', true);
$cap=get_post_meta($_id, 'linkr_coupon_cap', true);
$cap = ($cap=="")?'--':$cap;
$imagelinker=wp_get_attachment_image_src(get_post_thumbnail_id($_id),'small');
$benefit=get_post_meta($_id, 'linkr_coupon_detail', true);
$club_ = hkm_cross_reference::cross_reference_2step(HKM_EVENT,$eventcode,'linkr_eventplace' ,HKM_BAR);
if(!$club_){
	$club="-N/A-";
	$link="#";
}else{
	$club=$club_['title'];
	$link=$club_['link'];
}
$var = '<a href="%1$s" class="coming_events">
<div class="time">%3$s</div>
<div class="shopname">%4$s</div>
<div class="club">%5$s</div>
<div class="poster"><img class="rsImg" src="%2$s"/></div>
</a>';
echo sprintf($var,$linkc,$imagelinker[0],$coupon_collect_post -> post_title,$cap,$benefit);

}
