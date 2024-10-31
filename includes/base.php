<?php

add_action( 'wp_loaded', 'feedify_run_cmd' );

add_action( 'admin_notices', 'feedify_admin_notice' );

add_action( 'add_meta_boxes', 'feedify_meta_box_add' );

add_action( 'save_post', 'feedify_on_save_post', 1, 3 );

add_action( 'transition_post_status', 'feedify_on_transition_post_status', 10, 3 );

add_action( 'publish_future_post', 'feedify_on_schedule_post_status', 10, 1  );

add_action( 'wp_head', 'feedify_site_script' );

$FeedifySW = new FeedifySW();

function feedify_site_script() {
	
	$feedify_domain_key = get_option('feedify_domain_key');
	$feedify_public_key = get_option('feedify_public_key');
	$feedify_enable_ssl = get_option('feedify_enable_ssl');
	$feedify_plugin_status = get_option('feedify_plugin_status');

    if( $feedify_plugin_status == 1  ) { 
    	if( $feedify_public_key  && (!empty($feedify_enable_ssl) && $feedify_enable_ssl=='yes' ) ) { ?>
    	<script  id="feedify_webscript" >
			var feedify = feedify || {};
			window.feedify_options={fedify_url:"https://app.feedify.net/",pkey:"<?php echo $feedify_public_key;?>",sw:"<?php echo FEEDIFY_SW_PATH; ?>"};
			(function (window, document){
				function addScript( script_url ){
					var s = document.createElement('script');
					s.type = 'text/javascript';
					s.src = script_url;
					document.getElementsByTagName('head')[0].appendChild(s);
				}
				addScript('https://cdn.feedify.net/getjs/feedbackembad-min-3.0.js');

				
			})(window, document);
		</script>
        <?php
    	}else{ ?>
    		<script  id="feedify_webscript" >
				var feedify = feedify || {};
				window.feedify_options={fedify_url:"https://app.feedify.net/",sw:"<?php echo FEEDIFY_SW_PATH; ?>"};
				(function (window, document){
					function addScript( script_url ){
						var s = document.createElement('script');
						s.type = 'text/javascript';
						s.src = script_url;
						document.getElementsByTagName('head')[0].appendChild(s);
					}
					addScript('https://cdn.feedify.net/getjs/feedbackembad-min-3.0.js');
				})(window, document);
			</script>
    	<?php }
    }
}





function feedify_on_save_post( $post_id, $post, $updated ) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
    }
	
	if (array_key_exists('send_feedify_notification', $_POST)) {
		if($_POST['send_feedify_notification']=='true'){
			update_post_meta($post_id, 'send_feedify_notification', true);
			}else{
				update_post_meta($post_id, 'send_feedify_notification', false);
			}
    } else {
		update_post_meta($post_id, 'send_feedify_notification', false);
		}
		
    $just_sent_notification = (get_post_meta($post_id, 'feedify_notification_already_sent', true) == true);
	
    if ($just_sent_notification) {
        // Reset our flag
        update_post_meta($post_id, 'feedify_notification_already_sent', false);
    }
	
	
	feedify_on_transition_post_status($post->post_status, $post->post_status, $post);
}

function feedify_on_transition_post_status( $new_status, $old_status, $post ) { 
	 
	
		if($new_status == 'future' && array_key_exists('send_feedify_notification', $_POST) && $_POST['send_feedify_notification']=='true'){
			update_post_meta($post->ID, 'schedule_send_feedify_notification', true);	
		}
		
    if (!(empty($post) || $new_status !== "publish" || $post->post_type == 'page')) {
		if( get_post_meta($post->ID, 'send_feedify_notification', true) && !get_post_meta($post->ID, 'feedify_notification_already_sent', true) ) {
			
            $feedify_licence_key = get_option('feedify_licence_key');
            $feedify_domain_key = get_option('feedify_domain_key');
            $feedify = new FeedifyAPI($feedify_domain_key, $feedify_licence_key);
			
			$feedify_is_default_logo	= get_option('feedify_is_default_logo');
			$feedify_is_banner_image	= get_option('feedify_is_banner_image');
			$feedify_is_featured_logo	= get_option('feedify_is_featured_logo');
			$feedify_is_word_limit		= get_option('feedify_is_word_limit');
			$feedify_is_msg_send		= get_option('feedify_is_msg_send');
			
			$msg						= wp_strip_all_tags($post->post_content);
			$logo_url					= get_the_post_thumbnail_url($post);
			$banner_url					= '';
			$post_content				= '';
			
			if($feedify_is_default_logo==1){
				$logo_url	= get_option('feedify_is_website_logo');
				}
			if($feedify_is_featured_logo==1){
				$logo_url	= get_the_post_thumbnail_url($post);
				}
			if($feedify_is_banner_image==1){
				$banner_url	= get_the_post_thumbnail_url($post);
				}
			if($feedify_is_word_limit==1){
				$msg	= wp_trim_words($msg, 15, '...');
				}
				
			if($feedify_is_msg_send==1){
				$post_content	= '';
			}else{
				$post_content	= $msg;
			}
				
				
				
			
            $data = array(
                'title' 	=> $post->post_title,
				'msg' 		=> $post_content,
                'url' 		=> get_permalink($post),
                'logo_url' 	=> $logo_url,
				'image_url' => $banner_url,
				'sent_web_subscribers'	=> 1,
				'sent_app_subscribers'	=> 1,
			);
			

            if (array_key_exists('send_feedify_notification', $_POST)) {
				if($_POST['send_feedify_notification']=='true'){
					if($feedify->FeedifySendPush($data)) {
						update_post_meta($post->ID, 'feedify_notification_already_sent', true);
						update_post_meta($post->ID, 'send_feedify_notification', false);
					}
				}
			}
        }
    }
}

// 025 - start - 12-05-2021 - schedule push
function feedify_on_schedule_post_status(  $post_id ) { 
	   		$post =get_post($post_id); 
		 	$feedify_licence_key = get_option('feedify_licence_key');
         	$feedify_domain_key = get_option('feedify_domain_key');
         	$feedify = new FeedifyAPI($feedify_domain_key, $feedify_licence_key);
			$feedify_is_default_logo	= get_option('feedify_is_default_logo');
			$feedify_is_banner_image	= get_option('feedify_is_banner_image');
			$feedify_is_featured_logo	= get_option('feedify_is_featured_logo');
			$feedify_is_word_limit		= get_option('feedify_is_word_limit');
			$feedify_is_msg_send		= get_option('feedify_is_msg_send');
			$msg						= wp_strip_all_tags($post->post_content);
			$logo_url					= get_the_post_thumbnail_url($post);
			$banner_url					= '';
			$post_content				= '';
			if($feedify_is_default_logo==1){
				$logo_url	= get_option('feedify_is_website_logo');
			}
			if($feedify_is_featured_logo==1){
				$logo_url	= get_the_post_thumbnail_url($post);
			}
			if($feedify_is_banner_image==1){
				$banner_url	= get_the_post_thumbnail_url($post);
			}
			if($feedify_is_word_limit==1){
				$msg	= wp_trim_words($msg, 15, '...');
			}
			if($feedify_is_msg_send==1){
				$post_content	= '';
			}else{
				$post_content	= $msg;
			}
            $data = array(
                'title' 	=> $post->post_title,
				'msg' 		=> $post_content,
                'url' 		=> get_permalink($post),
                'logo_url' 	=> $logo_url,
				'image_url' => $banner_url,
				'sent_web_subscribers'	=> 1,
				'sent_app_subscribers'	=> 1,
			);
		


 				if(get_post_meta($post->ID, 'schedule_send_feedify_notification', true)){

					if($feedify->FeedifySendPush($data)) {

					
						update_post_meta($post->ID, 'feedify_notification_already_sent', true);
						update_post_meta($post->ID, 'send_feedify_notification', false);
						update_post_meta($post->ID, 'schedule_send_feedify_notification', false);
					}
 				}

	
           
        
    
}

// 025 -  end  - 12-05-2021 - schedule push

function feedify_send_push_to_server() {
	
		$nonce = $_REQUEST['_wpnonce'];
	if ( ! wp_verify_nonce( $nonce, 'FeedifySendPush' ) ) {
		wp_redirect( admin_url( '/admin.php?page=feedify-manage-push&feedify_error='.urlencode('Not Valid CSRF Token')));
 		 exit; 
	}

    $feedify_licence_key = get_option('feedify_licence_key');
    $feedify_domain_key = get_option('feedify_domain_key');
    $feedify = new FeedifyAPI($feedify_domain_key, $feedify_licence_key);
    $data = array(
        'title'		=>sanitize_text_field($_POST['push_title']),
        'msg'		=>sanitize_textarea_field($_POST['push_message']),
        'url'		=>esc_url_raw($_POST['push_url']),
        'logo_url'	=>esc_url_raw($_POST['push_icon']),
		'sent_web_subscribers'	=> 1,
		'sent_app_subscribers'	=> 1,
    );

    if($feedify->FeedifySendPush($data)) {
        wp_redirect( admin_url( '/admin.php?page=feedify-manage-push&feedify_msg='.urlencode('Push Queued') ) );
        exit;
    } else {
        wp_redirect( admin_url( '/admin.php?page=feedify-manage-push&feedify_error='.urlencode('Error sending push') ) );
        exit;
    }


}

function feedify_meta_box_add(){
    add_meta_box( 'feedify-meta-box-id', 'Feedify Push Notifications', 'feedify_meta_box_cb', 'post', 'side', 'high' );
}

function feedify_meta_box_cb($post) {
    $meta_box_checkbox_send_notification = true;
    if($post) {
        $meta_box_checkbox_send_notification = get_post_meta($post->ID, 'send_feedify_notification', true);
    }
    	$feedify_domain_key = get_option('feedify_domain_key');
	$feedify_licence_key = get_option('feedify_licence_key');

 	$feedify = new FeedifyAPI($feedify_domain_key, $feedify_licence_key);
    
	$sub_limit = $feedify->FeedifyCheckSubscribers();
   

     if($sub_limit && $sub_limit == 'Expire') {
    	?>
    	<input type="checkbox" id="s_f_noti" disabled>
       <label for="s_f_noti">Send notification on post publish</label>
        <div style="color:red;">Upgrade your plan</div>

    	<?php
     }else{
    	?>
    	<input type="checkbox" name="send_feedify_notification" id="s_f_noti" value="true" <?php if ($meta_box_checkbox_send_notification) { echo "checked"; } ?>>
        <label for="s_f_noti">Send notification on post publish</label>
    	<?php
    }

}

function feedify_admin_notice() {

    if( isset($_GET['feedify_msg']) ) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><?php echo esc_html($_GET['feedify_msg']); ?></p>
        </div>
        <?php
    } else if( isset($_GET['feedify_error']) ) {
        ?>
        <div class="notice notice-error is-dismissible">
            <p><?php echo esc_html($_GET['feedify_error']); ?></p>
        </div>
        <?php
    }
}

function feedify_save_push_settings() {
	$nonce = $_REQUEST['_wpnonce'];
	if ( ! wp_verify_nonce( $nonce, 'push_setting' ) ) {
		wp_redirect( admin_url( '/admin.php?page=feedify-push-settings&feedify_error='.urlencode('Not Valid CSRF Token')));
 		 exit; 
	}

	$feedify_is_default_logo	= sanitize_text_field($_POST['feedify_is_default_logo']);
	$feedify_is_banner_image	= sanitize_text_field($_POST['feedify_is_banner_image']);
	$feedify_is_featured_logo	= sanitize_text_field($_POST['feedify_is_featured_logo']);
	$feedify_is_word_limit		= sanitize_text_field($_POST['feedify_is_word_limit']);
	$feedify_is_msg_send		= sanitize_text_field($_POST['feedify_is_msg_send']);
	
    $feedify_is_website_logo 	= esc_url_raw($_POST['custom_image_url']);
	$custom_image_url_type		= esc_url_raw($_POST['custom_image_url_type']);
	$myprefix_image_id 			= sanitize_text_field($_POST['myprefix_image_id']);
	
	
	
	if($feedify_is_default_logo==1){
			update_option( 'feedify_is_default_logo', 1);
		}else{
			update_option( 'feedify_is_default_logo', 0);
		}
	
	if($feedify_is_banner_image==1){
		update_option( 'feedify_is_banner_image', 1);
		}else{
			update_option( 'feedify_is_banner_image', 0);
		}
	
	if($feedify_is_featured_logo==1){
		update_option( 'feedify_is_featured_logo', 1);
		}else{
			update_option( 'feedify_is_featured_logo', 0);
		}
	
	if($feedify_is_word_limit==1){
		update_option( 'feedify_is_word_limit', 1);
		}else{
			update_option( 'feedify_is_word_limit', 0);
		}
		
	if($feedify_is_msg_send==1){
		update_option( 'feedify_is_msg_send', 1);
		}else{
			update_option( 'feedify_is_msg_send', 0);
		}
		
	if(empty($feedify_is_website_logo)){
		wp_redirect( admin_url( '/admin.php?page=feedify-push-settings&feedify_error='.urlencode('Please Select logo')));
		}else{
			update_option( 'feedify_is_website_logo', $feedify_is_website_logo);
			update_option( 'custom_image_url_type', $custom_image_url_type);
			update_option( 'myprefix_image_id', $myprefix_image_id);
			wp_redirect( admin_url( '/admin.php?page=feedify-push-settings&feedify_msg='.urlencode('Settings saved')));
			}
     exit;
        
	}
//Added on 09-07-2024 by eid 044 START
function feedify_register() {
	$feedify_licence_key = get_option('feedify_licence_key') ? get_option('feedify_licence_key') : "";
	$feedify_domain_key = get_option('feedify_domain_key') ? get_option('feedify_domain_key') : "";
	$feedify = new FeedifyAPI($feedify_domain_key, $feedify_licence_key, 'N');
	$data = array(
		'email'		 =>sanitize_text_field($_POST['email']),
		'store_name' =>sanitize_textarea_field(get_bloginfo( 'name' )),
		'phone'		 =>sanitize_textarea_field($_POST['full_number']),
		'store_url'	 =>esc_url_raw($_POST['store_url']),
		'password'	 =>sanitize_textarea_field($_POST['password']),
		'platform'	 =>'wordpress'		
	);
	$result = $feedify->FeedifyRegister($data);
	if(isset($result->licence_key)) {
		update_option( 'feedify_licence_key', $result->licence_key);
		update_option( 'feedify_domain_key', $result->domain_key);
		update_option( 'feedify_public_key', $result->public_key);
		update_option( 'feedify_enable_ssl', 'yes');
		echo"<script>window.opener.location.reload();window.close();</script>";		
	} else {
		$_SESSION['error_msg'] = $result;		
	}
}
//Added on 09-07-2024 by eid 044 END

function feedify_run_cmd() { 
	$allowed_functions = array(
		'feedify_save_settings',
		'feedify_send_push_to_server',
		'feedify_save_push_settings',
		'feedify_register'
	);
    if(isset($_REQUEST['feedify_cmd'])) {
        if( in_array($_REQUEST['feedify_cmd'], $allowed_functions) && is_callable($_REQUEST['feedify_cmd']) ) {
            call_user_func($_REQUEST['feedify_cmd']);
        }
    }
}
