<?php
/*
 * 
 * 
 * HESK MOD CIRCLE MENU 
 */
 add_action("response_circlemenu","make_menu_in_circle_html");
 function make_menu_in_circle_html(){

      $vlist = array(
      "slug" => "http://www.ecdrink.com.hk/wp-content/themes/linkr/images/logo_220x100_grayscale.png",
      "tst" => "http://www.ecdrink.com.hk/wp-content/themes/linkr/images/logo_220x100_grayscale.png",
      "f" => "http://www.ecdrink.com.hk/wp-content/themes/linkr/images/logo_220x100_grayscale.png",
      "cs" => "http://www.ecdrink.com.hk/wp-content/themes/linkr/images/logo_220x100_grayscale.png",
      "a" => "http://www.ecdrink.com.hk/wp-content/themes/linkr/images/logo_220x100_grayscale.png",
      "va" => "http://www.ecdrink.com.hk/wp-content/themes/linkr/images/logo_220x100_grayscale.png",
      "vd" => "http://www.ecdrink.com.hk/wp-content/themes/linkr/images/logo_220x100_grayscale.png",
      "cv" => "http://www.ecdrink.com.hk/wp-content/themes/linkr/images/logo_220x100_grayscale.png",
      "xc" => "http://www.ecdrink.com.hk/wp-content/themes/linkr/images/logo_220x100_grayscale.png",
      "bc" => "http://www.ecdrink.com.hk/wp-content/themes/linkr/images/logo_220x100_grayscale.png",
      );

     ?>
     <div class="container show-on-phones"><div id="circlemenu" class="row"><img src="http://www.ecdrink.com.hk/wp-content/themes/linkr/images/button_location_ring.png" border="0" usemap="#Map" />
<map name="Map" id="Map">
  <area shape="poly" coords="126,95,84,23,159,2,235,23,193,95" alt="central" href="javascript:goto(5)" />
  <area shape="poly" coords="199,99,242,27,297,80,317,155,233,157" alt="jordan" href="javascript:goto(3)" />
  <area shape="poly" coords="234,164,318,164,295,241,243,296,199,221" alt="tst" href="javascript:goto(2)" />
  <area shape="poly" coords="193,224,235,298,161,319,86,298,126,227" alt="mk" href="javascript:goto(1)" />
  <area shape="poly" coords="121,221,79,293,27,244,5,162,85,163" alt="wanchai" href="javascript:goto(4)" />
  <area shape="poly" coords="88,156,2,157,28,78,79,28,121,99" alt="causewaybay" href="javascript:goto(10)" />
</map>
    <?php 
     
   /*
    * <div class="container bar_locations"><div class="row">
         <ul class="loactions_filter hide-on-phones" id="list_loactions_filter"><li area="central" chinese="中環"><a></a></li><li area="jordan" chinese="佐敦"><a></a></li><li area="tst" chinese="尖沙咀"><a></a></li><li area="mk" chinese="旺角"><a></a></li><li area="wanchai" chinese="灣仔"><a></a></li><li area="causewaybay" chinese="銅鑼灣"><a></a></li></ul>
     </div></div>
    * <canvas id="circlemenu" width="400" height="400" class="show-on-phones"></canvas>
    * 
    *   ?><ul id="circlemenudata"><?php
      foreach($vlist as $key=>$val){
         ?><img src="<?php echo $val; ?>" alt="<?php echo $key; ?>" /><?php 
         ?><li><?php
         echo $key; 
         ?></li><?php
      }
      echo "this is the circle";
      ?></ul><?php
   */
      
       ?></div></div><script>
           jQuery(function($){
          /*jQuery("#list_loactions_filter").wheelMenu({
              displayAttr:'chinese', centerImageSrc:wsm_base_obj.imagebin+'location_centre.png'
          });*/
           jQuery("#list_loactions_filter li").each(function(){
               var self= jQuery(this);
               var slug = self.attr('area');
               self.children("a").attr('href',wsm_base_obj.domainbase+'/area/'+slug);
           });
      });</script><?php
 }
 ?>
