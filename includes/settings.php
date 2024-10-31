<?php

    function feedify_register_settings() {
        add_option( 'feedify_licence_key', '');
        add_option( 'feedify_domain_key', '');
        add_option( 'feedify_public_key', '');
        add_option( 'feedify_enable_ssl', '');

        register_setting( 'feedify_options_group', 'feedify_licence_key', 'feedify_callback' );
        register_setting( 'feedify_options_group', 'feedify_domain_key', 'feedify_callback' );
        register_setting( 'feedify_options_group', 'feedify_enable_ssl', 'feedify_callback' );
        register_setting( 'feedify_options_group', 'feedify_public_key', 'feedify_callback' );

    }

    function feedify_save_settings() {
		 $nonce = $_REQUEST['_wpnonce'];
            if ( ! wp_verify_nonce( $nonce, 'setting' ) ) {
               wp_redirect( admin_url( '/admin.php?page=feedify-settings&feedify_error='.urlencode('Not Valid CSRF Token') ) );
                 exit; 
    	}
        $feedify_licence_key = sanitize_text_field($_POST['feedify_licence_key']);
        $feedify_domain_key = sanitize_text_field($_POST['feedify_domain_key']);
        $feedify_public_key = sanitize_text_field($_POST['feedify_public_key']);
        $feedify_enable_ssl = sanitize_text_field($_POST['feedify_enable_ssl']);
        
        // check if keys are valid //

        $feedify = new FeedifyAPI($feedify_domain_key, $feedify_licence_key);

        if( $feedify->FeedifyStatus() ) {

            if($feedify_enable_ssl == 'yes'){
				$postarray['domain_key'] = $feedify_domain_key;
				$postarray['licence_key'] = $feedify_licence_key;
				$resdata = $feedify->FeedifyGetPkey($postarray);
				if(!empty($resdata)){
					$feedify_public_key = isset($resdata->public_key) ? $resdata->public_key : '';
				}
			}

            update_option( 'feedify_licence_key', $feedify_licence_key);
            update_option( 'feedify_domain_key', $feedify_domain_key);
            update_option( 'feedify_public_key', $feedify_public_key);
            update_option( 'feedify_enable_ssl', $feedify_enable_ssl);

            if (file_exists(ABSPATH.'FeedifySW.js')){
                unlink(ABSPATH.'FeedifySW.js');
            }

            wp_redirect( admin_url( '/admin.php?page=feedify-settings&feedify_msg='.urlencode('Settings saved') ) );
            exit;
        } else {
            wp_redirect( admin_url( '/admin.php?page=feedify-settings&feedify_error='.urlencode('Invalid keys') ) );
            exit;
        }
    }
    add_action( 'admin_init', 'feedify_register_settings' );