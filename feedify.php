<?php
/**
*Plugin Name: Free Web Push Notifications
*Plugin URI: https://app.feedify.net/
*Description: Trusted by thousands of websites worldwide to make the website more intelligent. Feedify gives you some out of the box tools to engage your website visitors, delight them and convert your sales.
*Version: 2.4.1
*Author: Feedify
*Author URI: https://app.feedify.net/
*License: GPLv2 or later
*License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

define( 'FEEDIFY_URL', plugin_dir_url(__FILE__) );
define( 'FEEDIFY_PATH', plugin_dir_path(__FILE__) );
define("FEEDIFY_PLUGIN_DIR",addslashes(dirname(__FILE__)));
$pinfo = pathinfo(FEEDIFY_PLUGIN_DIR);
define("FEEDIFY_PLUGIN_FILE",addslashes(__FILE__));
define('FEEDIFY_SLUG','feedify' );
define('FEEDIFY_SW_PATH', parse_url(FEEDIFY_URL, PHP_URL_PATH).'sdk_files' );

$upload_dir = wp_upload_dir();

add_action('wp_head','FeedifyHookHeader', -1000);
add_action( 'after_switch_theme', 'flush_rewrite_rules' );

function FeedifyWpActivate() {
	update_option( 'feedify_plugin_status', 1);
	if (file_exists(ABSPATH.'manifest.json')){
		unlink(ABSPATH.'manifest.json');
	}

	if (file_exists(ABSPATH.'FeedifySW.js')){
		unlink(ABSPATH.'FeedifySW.js');
	}

  update_option('feedify_permalinks_flushed', 0);
	
	
}
register_activation_hook( __FILE__, 'FeedifyWpActivate' );

function FeedifyHookHeader() { 

}
  
   // As you are dealing with plugin settings,
// I assume you are in admin side
add_action( 'admin_enqueue_scripts', 'FeedifyLoadWpMediaFiles' );
function FeedifyLoadWpMediaFiles( $page ) {
  // change to the $page where you want to enqueue the script
  if( $page == 'feedify_page_feedify-push-settings' ) {
                       
    // Enqueue WordPress media scripts
    wp_enqueue_media();
    // Enqueue custom script that will interact with wp.media
    wp_enqueue_script( 'myprefix_script', plugins_url( '/assets/js/myscript.js' , __FILE__ ), array('jquery'), '0.1' );
  }
}

add_action( 'wp_ajax_FeedifyMyprefixGetImage', 'FeedifyMyprefixGetImage'   );
function FeedifyMyprefixGetImage() {
    if(isset($_GET['id']) ){
        $image = wp_get_attachment_image( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'medium', false, array( 'id' => 'myprefix-preview-image' ) );
		    $image_url = wp_get_attachment_image_url( intval($_GET['id']), '' );
        $data = array(
            'image'			=> $image,
			      'image_url'		=> $image_url,
        );
        wp_send_json_success( $data );
    } else {
        wp_send_json_error();
    }
} 
 add_filter('admin_head', 'FeedifyMyCustomAlert');
  
  function FeedifyMyCustomAlert(){
	  echo "<script type='text/javascript'>
	  jQuery(document).on('click', '.editor-post-publish-button', function() {
		  setTimeout( function ( ) { document.getElementById('s_f_noti').checked = false; }, 30000 );
		  });
		  
      jQuery(document).on('click', '.editor-post-publish-button', function() {
		  setTimeout( function ( ) { document.getElementById('s_f_noti').checked = false; }, 30000 );
		  });  
		</script>";		
}  
  
require_once(FEEDIFY_PLUGIN_DIR . '/init.php');

register_deactivation_hook( __FILE__, 'FeedifyDeactivate' );
function FeedifyDeactivate(){
	if (file_exists(ABSPATH.'FeedifySW.js')){
		unlink(ABSPATH.'FeedifySW.js');
	}
	
	if(file_exists(ABSPATH.'wp-content/uploads/FeedifySW.js')){
		unlink(ABSPATH.'wp-content/uploads/FeedifySW.js');
	}
	
	update_option( 'feedify_plugin_status', 0);
}

//-----------v2.1.2---------------
add_action('wp_print_scripts', 'FeedifyGetKeyAjaxLoadScripts');
function FeedifyGetKeyAjaxLoadScripts() {
  // load our jquery file that sends the $.post request
  wp_enqueue_script( "getkey_ajax", plugin_dir_url( __FILE__ ) . '/getkey_ajax.js', array( 'jquery' ) );
 
  // make the ajaxurl var available to the above script
  wp_localize_script( 'getkey_ajax', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );  
}



add_action('wp_ajax_getkey_response', 'FeedidyGetkeyAjaxProcessRequest');


function FeedidyGetkeyAjaxProcessRequest(){

 	$feedify = new FeedifyAPI(sanitize_key($_POST['domain_key']), sanitize_key($_POST['licence_key']));
 	$data = array(
        'domain_key'	=>sanitize_key($_POST['domain_key'])
    );
    echo json_encode( $feedify->FeedifyGetPkey($data) ) ;
 	die();
} 

// start -08-04-2021- 025
add_action('wp_ajax_FeedifyUpdateUserSubscription', 'FeedifyUpdateUserSubscription');

function FeedifyUpdateUserSubscription(){
  $feedify_domain_key = get_option('feedify_domain_key');
  $feedify_licence_key = get_option('feedify_licence_key');
  $feedify = new FeedifyAPI($feedify_domain_key, $feedify_licence_key);
    echo json_encode($feedify->FeedifyUpdateUserSubscription()) ;
  die();
} 
//end -08-04-2021- 025 

add_action( 'upgrader_process_complete', 'FeedifyActionUpgraderProcessComplete' );

function FeedifyActionUpgraderProcessComplete(){
  if (file_exists(ABSPATH.'FeedifySW.js')){
    unlink(ABSPATH.'FeedifySW.js');
  }
}
