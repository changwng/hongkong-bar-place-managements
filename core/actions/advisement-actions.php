<?php
add_action ( 'twobytwo_ad', 'resp_2x2_stack' );
function response_bottom_advertisement_gen(){
     $args = array(
     //param
     'post_type' => HKM_SPONSOR,
     //totally shows 6 pieces of the pictures for this
     'posts_per_page' => 4,
     'post_status' => 'publish',
     'meta_query' => array(
      //  "relation"=>"",
        array(
             'key' => 'linkr_ad_strip',
     )));
     $dataholder=array();
     $actionquery = new WP_query($args);
     $array = array();
     if ($actionquery -> have_posts()) :
     while ($actionquery -> have_posts()) : $actionquery -> the_post();
        //in_advertisement_development_loop($actionquery -> post);
        $_id=$actionquery -> post->ID;
        $var = get_post_meta($_id, 'linkr_ad_strip', false);
            if(count($var)>0){
                $possibility=count($var);
                $possibility=rand(0,$possibility-1);
                $var=$var[$possibility];
                $feature_image_m =wp_get_attachment_image_src($var,'full');
                $feature_image_m= $feature_image_m[0];
                
                $array[]=array(
                "img"=>$feature_image_m,
                "link" => get_post_meta($_id, 'linkr_sp_url' , true)
                ); //a list of images ID;
            }
        //$array[]=get_post_meta($_id, 'linkr_google_url', true)
     endwhile;
     else :
     //echo wpautop('Sorry, no posts were found');
     endif;
     // Reset Post Data
     wp_reset_postdata();
     return $array;
}
function img_html_headerbanner_advertisement(){
    $args = array(
     //param
     'post_type' => HKM_SPONSOR,
     'posts_per_page' => 1,
     'post_status' => 'publish',
     'meta_query'=>array(
        "relation"=>"AND",
        array(
                'key' => 'linkr_sp_premium',
                'value' => "p",
            ),
        array(
                'key' => 'linkr_ad_banner',
        )
     )
     );
     $dataholder=array();
     $actionquery = new WP_query($args);
     $pack = array();
     if ($actionquery -> have_posts()) :
     while ($actionquery -> have_posts()) : $actionquery -> the_post();
        top_ad_loop($actionquery -> post);
     endwhile;
     else :
     //echo wpautop('Sorry, no posts were found');
     endif;
     // Reset Post Data
     wp_reset_postdata();
}

function top_ad_loop($objectpost){
    $_id = $objectpost -> ID;
    $linkrad = get_post_meta($_id, 'linkr_ad_banner' , false); //a list of images ID
    if(count($linkrad)==0){
        return;
    }else{
        $possibility=count($linkrad);
        $possibility=rand(0,$possibility-1);
        $linkrad=$linkrad[$possibility];
    }
    $feature_image_m =wp_get_attachment_image_src($linkrad,'full');
    $feature_image_m= $feature_image_m[0];
    $link = get_post_meta($_id, 'linkr_sp_url' , true); //a list of images ID

?>
<a href="<?php echo $link; ?>" target="_blank"><img src="<?php echo $feature_image_m; ?>"/></a><?php
}
//to be called directly inside of the container
function resp_2_by_2_ad(){
$ar=response_bottom_advertisement_gen();
if(count($ar)>0){
?>
<div class="nine columns ganggo">
    <div class="six columns">
        <a target="_blank" href="<?=$ar[0]["link"]; ?>"><img src="<?=$ar[0]["img"]; ?>"/></a>
        <a target="_blank" href="<?=$ar[1]["link"]; ?>"><img src="<?=$ar[1]["img"]; ?>"/></a>
    </div>
    <div class="six columns">
        <a target="_blank" href="<?=$ar[2]["link"]; ?>"><img src="<?=$ar[2]["img"]; ?>"/></a>
        <a target="_blank" href="<?=$ar[3]["link"]; ?>"><img src="<?=$ar[3]["img"]; ?>"/></a>
    </div>
</div><!--end row-->
<?php }else{ ?>
<div class="nine columns ganggo">
    NO DATA FOR Banner AD section
</div><!--end row-->
<?php }
    }

function ad_bar_150x75($field='linkrad_upper_m'){
    $bar_ids = get_post_meta(HOME_PG, $field, FALSE);
    $html='';
    $var ='<a class="banner_150 ecdrinkad" href="%1$s"><img src="%2$s"/></a>';
    foreach ($bar_ids[0] as $bar_id) {
        $bar_img_id = get_post_meta($bar_id, 'linkr_img_ad', true);
        $img_url = wp_get_attachment_image_src($bar_img_id,'full');
        $html.=sprintf($var,get_permalink($bar_id),$img_url[0]);
    }
    return $html;
}//linkrad_upper_m


function ad_bar_400x100($field='linkrad_upper'){
    $bar_ids = get_post_meta(HOME_PG, $field, FALSE);
    $html='';
    //six columns
    $var ='<a class="banner_400 dashed" href="%1$s"><img src="%2$s"/></a>';
    foreach ($bar_ids[0] as $bar_id) {
        $bar_img_id = get_post_meta($bar_id, 'linkr_img_animated', true);
        $img_url = wp_get_attachment_image_src($bar_img_id,'full');
        $html.=sprintf($var,get_permalink($bar_id),$img_url[0]);
    }
    return $html;
    }//linkrad_upper_m
function resp_2x2_stack(){  ?>
        <div class="row ganggo_full_width">
            <?php //resp_2_by_2_ad(); ?>
        </div>
<?php } ?>
<?php 
    function ad_list_vertical($field){
    $bar_ids = get_post_meta(HOME_PG, $field, true);
    $html='';
    $var = '<a class="ecdrink_bar" href="%1$s"><div class="namespace">%3$s</div><img src="%2$s"/></a>';
    foreach ($bar_ids as $bar_id) {
    $bar_img_id = get_post_meta($bar_id, 'linkr_img_ad', true);
    $img_url = wp_get_attachment_image_src($bar_img_id,'full');
    $html.=sprintf($var,get_permalink($bar_id), $img_url[0], get_the_title($bar_id));
    }
    return $html;
    }
?>