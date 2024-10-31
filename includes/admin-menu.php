<?php

function feedify_register_menu() {

	$feedify_licence_key = get_option('feedify_licence_key');

	$feedify_domain_key = get_option('feedify_domain_key');

	if(!empty($feedify_licence_key) &&  !empty($feedify_domain_key)) {

		add_menu_page('Send Push', 'Feedify', 'manage_options',FEEDIFY_SLUG.'-send-push','feedify_send_push', FEEDIFY_URL.'assets/img/feedify-grey-logo-20x20.png');

		add_submenu_page(FEEDIFY_SLUG.'-send-push','Send Push', 'Send Push', 'manage_options',FEEDIFY_SLUG.'-send-push', 'feedify_send_push');

		add_submenu_page(FEEDIFY_SLUG.'-send-push','Reports', 'Reports', 'manage_options',FEEDIFY_SLUG.'-manage-push', 'feedify_manage_push');

		add_submenu_page(FEEDIFY_SLUG.'-send-push','Push Setting', 'Push Setting', 'manage_options',FEEDIFY_SLUG.'-push-settings', 'feedify_push_settings');

		add_submenu_page(FEEDIFY_SLUG.'-send-push','Settings', 'Settings', 'manage_options',FEEDIFY_SLUG.'-settings', 'feedify_settings');

	} else {

		add_menu_page('Settings', 'Feedify', 'manage_options',FEEDIFY_SLUG.'-settings','feedify_settings', FEEDIFY_URL.'assets/img/feedify-grey-logo-20x20.png');

		add_submenu_page(FEEDIFY_SLUG.'-send-push','Settings', 'Settings', 'manage_options',FEEDIFY_SLUG.'-settings', 'feedify_settings');

	}

}

function feedify_manage_push() {
	require_once(FEEDIFY_PATH . 'views/manage-push.php');
}



function feedify_send_push() {

	//start 025 - 01-04-2021
     $feedify_domain_key = get_option('feedify_domain_key');
 	$feedify_licence_key = get_option('feedify_licence_key');
  	$feedify = new FeedifyAPI($feedify_domain_key, $feedify_licence_key);
     $sub_limit = $feedify->FeedifyCheckSubscribers() ;
    
     if($sub_limit && $sub_limit == 'Expire') {
     	require_once(FEEDIFY_PATH . 'views/update-plan.php');
	}else{
	    require_once(FEEDIFY_PATH . 'views/send-push.php');
	}
	//end 025 - 01-04-2021
}

function feedify_push_settings() {
	require_once(FEEDIFY_PATH . 'views/push-settings.php');
}


function feedify_settings() {
	require_once(FEEDIFY_PATH . 'views/settings.php');
}



function feedify_desktop_settings() {
	require_once(FEEDIFY_PATH . 'views/desktop-settings.php');
}

function feedify_mobile_settings() {

	require_once(FEEDIFY_PATH . 'views/mobile-settings.php');

}



add_action( 'admin_menu', 'feedify_register_menu' );
