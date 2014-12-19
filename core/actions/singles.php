<?php


function response_only_for_hkm_bar_single(){
global $options, $ec_themeslug, $post;
    ?><!--Begin @container HKM--><div class="barsingle_row nine columns hide-on-phones">
      <div class="byline three columns"><?php  response_post_byline(); ?></div><?php ?><div class="entry nine columns hkmlinkerbar"><?php
    response_mobile_post_byline();
    gear_rslider_html("detailstory");
	
    ?><div class='clear'>&nbsp;</div>
                <!--Begin @response link pages hook-->
                <?php response_link_pages(); ?>
                <!--End @response link pages hook-->
                </div><!--end entry-->
                
                </div><!--end row-->
                <!--Begin @container HKM--><div class="barsingle_row nine columns show-on-phones">
                  <?php gear_rslider_html("detailstorymobile"); ?>
              </div><!--end row-->
   <!--<div class="row barsingle_mobile hide-on-phones">
        <?php //gear_rslider_html("detailstorymobile"); ?>
   </div>-->
                <?php
                gear_tab_content_html();
                // $content = ob_get_clean();
                // $content = apply_filters('response_post_formats_' . $format . '_content', $content);
                // echo $content;
                }
                function response_only_single_coupon(){
                global $options, $post, $ec_themename, $ec_themeslug, $ec_root, $wp_query;
    ?><div class="container">
    <div class="row">
    <div id="printarea" class="nine columns maincontentright">
    <?php
    // $data = single_coupon_loop($post);
    //echo "start get_menu_ressembled";
    //echo get_menu_ressembled(array(125,125,125,125,125,125),100,"topnavmenu",HKM_IMG_PATH."button_menu.png",true,false);
    ?>
    <div class="bgwhite singlecoupon">
        <a href="javascript:printcoupon();" id="book_the_seat" class="print ecbutton">
            <img alt="抓取並打印" src="<?php echo HKM_IMG_PATH; ?>button_printer.png"/>
        </a>
        <?php //print_r(single_coupon_loop($post));
            $val=single_coupon_loop($post)
         ?>
        <div class="datawrap">
            <div class="six columns coupontitle"><?php echo $val['coupontitle']; ?></div>
            <?php if($val['club']!=false){?>
             <div class="six columns club"><span>地點: </span><a href="<?php echo $val['clublink']; ?>"><?php echo $val['club']; ?></a></div>
            <?php } ?>
            <?php if($val['cap']>0){?>
                <div class="six columns cap"><span>人數上限: </span><?php echo $val['cap']; ?></div>
            <?php } ?>
            <div class="six columns couponcode"><span>CODE: </span><?php echo $val['couponcode']; ?></div>
            <div class="six columns phone"><span>查詢電話: </span><?php echo $val['phone']; ?></div>
            <div class="six columns detail"><span>詳情: </span><?php echo $val['detail']; ?></div>
            <?php   response_value_data_for_single_classic_html($val); ?>
            <div class="detail_condition">約制條款: </span><?php echo $val['linkr_coupon_conditions']; ?></div>
        </div>
        <?php
       // $flipoption = $options -> get($ec_themeslug . '_couponflip_toggle');
       // if (!$flipoption) {
            //this is the classic presentation of the coupon sample on the page
          //  response_value_data_for_single_classic_html($val);
      //  } else {
            //this is the in active fliping page the coupon sample of the page
          //  response_value_data_for_couponpage($val);
       // }
        ?>
    </div>  
    </div><!--end entry-->
    <div class="nine columns centered hide-on-desktop">
    <?php echo ad_bar_150x75('linkrad_lower_m');?>
    </div>
    <div class="advertisement_400 nine columns centered hide-on-phones">
    <?php echo ad_bar_400x100(); ?>
    </div>
    </div><!--end row-->
    </div><!--end container--><?php

    }
    function the_event_single(){
    global $post;
    $_id=$post->ID;
    $large = wp_get_attachment_image_src(get_post_thumbnail_id($_id),'large');
    $relation_event_place=gear_contentfilter_cf_get('linkr_eventplace');
    ?><article><div class="image">
        <img src="<?php echo $large[0]; ?>"/>
        </div><div class="datawrap">
            <div class="eventtitle"><?php echo $post -> post_title; ?></div>
            <?php 
                 if($relation_event_place!=-1){
                            $club=hkm_cross_reference::meta_box_get_post_title($relation_event_place,HKM_BAR);
                            $link=hkm_cross_reference::meta_box_get_permlink($relation_event_place,HKM_BAR);
                            if(strtolower($club)!="others"){
                                  ?><div class="club"><span>酒吧: </span><a href="<?php echo $link; ?>"><?php echo $club; ?></a></div><?php
                            }
                  }
            ?>
            <div class="date"><span>日期: </span><?php echo gear_contentfilter_cf_get('linkr_eventdate'); ?></div>
            <div class="time"><span>時間: </span><?php echo gear_contentfilter_cf_get('linkr_time'); ?></div>
            <div class="detail"><span>詳情: </span><?php echo gear_contentfilter_cf_get('linkr_eventdetails_custom'); ?></div>
            <div class="phone"><span>訂座電話: </span><?php echo gear_contentfilter_cf_get('linkr_booking_number'); ?></div>
            <?php ?>
            </div>
            <a id="book_the_seat" class="ecbutton" href="<?php echo site_url("/reserves/"); ?>">包場查詢</a>
      </article><?php

    }
    function response_only_for_hkm_event_single(){
    global $options, $post, $ec_themename, $ec_themeslug, $ec_root, $wp_query;
    ?><div class="container">
    <div class="row">
    <div class="nine columns maincontentright single_content">
    <?php
    //echo "start get_menu_ressembled";
    //echo get_menu_ressembled(array(125,125,125,125,125,125),100,"topnavmenu",HKM_IMG_PATH."button_menu.png",true,false);
    ?>
    <div class="singlecontent">
        <section class="middlepart eventsingle">
            <div class="linkerevents_coming title_tab"></div>
            <?php the_event_single(); ?>
            <?php if ($options->get($ec_themeslug.'_post_pagination') == "1") : ?>
                <!--Begin @response post pagination hook-->
                    <?php
                    response_post_pagination();
                    response_edit_link_content();
                    ?>
                <!--End @response post pagination hook-->           
            <?php endif; ?>
        </section>
    </div>  
    </div><!--end entry--><?php
    resp_2_by_2_ad();
    ?>
    </div><!--end row-->
    </div><!--end container--><?php
    }

    ?>