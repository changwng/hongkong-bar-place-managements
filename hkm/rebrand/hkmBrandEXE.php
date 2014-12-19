<?php
if (!class_exists("hkmBrandEXE")) :
    class hkmBrandEXE {
        public function __construct() {
            $this -> run_options_frontend_head();
        }
            global $hkm_hud, $hkmbranding_options;
            //   ob_start();
            //Hide WordPress top bar dropdown menus and the logo
            if ($hkmbranding_options -> get($hkm_hud . '_ele5_toggle') == true) {
            //Hide WordPress logo
            if ($hkmbranding_options -> get($hkm_hud . '_ele4_toggle') == true) {
            //Hide admin bar update notifications
            if ($hkmbranding_options -> get($hkm_hud . '_ele6_toggle') == true) {
            //Hide WordPress update notification bar - remove the update nag
            if ($hkmbranding_options -> get($hkm_hud . '_ele7_toggle') == true) {
                add_action('admin_init', array(&$this, 'c2c_no_update_nag'));
            //Hide Screen Options menu
            if ($hkmbranding_options -> get($hkm_hud . '_ele8_toggle') == true) {
            //Hide Help menu
            if ($hkmbranding_options -> get($hkm_hud . '_ele9_toggle') == true) {
            if ($hkmbranding_options -> get($hkm_hud . '_ele10_toggle') == true) {
            //Change Howdy text
            if ($hkmbranding_options -> get($hkm_hud . '_ele11') != "") {
            //Change Log out text
            if ($hkmbranding_options -> get($hkm_hud . '_ele12') != "") {
            //Remove "Edit My Profile" option from dropdown menu
            if ($hkmbranding_options -> get($hkm_hud . '_ele13_toggle') == true) {
            //Log out only
            if ($hkmbranding_options -> get($hkm_hud . '_ele14_toggle') == true) {
            //Hide footer text - hide default text in the footer
            if ($hkmbranding_options -> get($hkm_hud . '_af1_toggle') == true) {
            //Hide footer text - hide default text in the footer
            if ($hkmbranding_options -> get($hkm_hud . '_af2') != "") {
            //hide version of the text - Hide version text
            if ($hkmbranding_options -> get($hkm_hud . '_af3_toggle') == true) {
            //Change version text
            if ($hkmbranding_options -> get($hkm_hud . '_af4') != "") {

            // return $end=ob_end_clean();
        }
        function dashboard_image() {
            global $hkmbranding_options, $hkm_hud;
            }
        function dashboard_user_add_comments_widget_function($title, $id, $functioncall) {
            wp_add_dashboard_widget($id, $title, array(&$this, $functioncall));
        }
        function hide_welcome_screen() {
            $user_id = get_current_user_id();
            if (1 == get_user_meta($user_id, 'show_welcome_panel', true))
                update_user_meta($user_id, 'show_welcome_panel', 0);
            global $wp_meta_boxes, $hkmbranding_options, $hkm_hud;
            if ($hkmbranding_options -> get($hkm_hud . '_w1_toggle') == true) {
                add_action('load-index.php', array(&$this, 'hide_welcome_screen'));
            }
            if ($hkmbranding_options -> get($hkm_hud . '_w2_toggle') == true) {
                unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
            }
            if ($hkmbranding_options -> get($hkm_hud . '_w3_toggle') == true) {
                unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
            }
            if ($hkmbranding_options -> get($hkm_hud . '_w4_toggle') == true) {
                unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
            }
            if ($hkmbranding_options -> get($hkm_hud . '_w5_toggle') == true) {
                unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
            }
            if ($hkmbranding_options -> get($hkm_hud . '_w6_toggle') == true) {
                unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
            }
            if ($hkmbranding_options -> get($hkm_hud . '_w7_toggle') == true) {
                unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
            }
            if ($hkmbranding_options -> get($hkm_hud . '_w8_toggle') == true) {
                unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
            }
            if ($hkmbranding_options -> get($hkm_hud . '_w9_toggle') == true) {
                unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
            }
        }