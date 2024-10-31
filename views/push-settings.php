<style>
.doMainRelated * {
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	padding: 0;
	margin: 0;
	font-size: 16px;
}
.doMainRelated.wrap {
	max-width: 450px;
	width: 100%;
	margin: 100px auto 0;
	padding: 20px 25px 40px;
	-moz-box-shadow: 0 0 10px 0 rgba(0,0,0,.2);
	-webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,.2);
	box-shadow: 0 0 10px 0 rgba(0,0,0,.2);
	position: relative;
	z-index: 1;
}
#wpbody {
	background: url(https://sftextures.com/texture/2748/0/2743/corner-pattern-background-light-grey-color-squared-90-degrees-lines-seamless-wallpaper-texture.jpg) left top repeat;
	background-size: 100px;
	-moz-background-size: 100px;
	-webkit-background-size: 100px;
}
.doMainRelated.wrap::after {
	content: "";
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: #ffffff;
	z-index: -1;
	opacity: .4;
}
.doMainRelated .clear {
	clear: both;
}
.doMainRelated th, .doMainRelated td {
	padding: 0;
}
.doMainRelated .regular-text {
	width: 100%;
	height: 44px;
	padding: 0 10px;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
}
.doMainRelated .regular-text:focus {
	border: 1px so-lid #ccc;
	box-shadow: 0 0 5px 0 rgba(0,0,0,.2);
}
.doMainRelated h1 {
	text-align: center;
	padding: 0 0 15px;
	width: calc(100% + 50px);
	margin-left: -25px;
	margin-top: -20px;
	margin-bottom: 15px;
	color: #fff;
	padding: 25px 0;
	font-weight: 700;
	font-size: 30px;
	border-bottom: 2px solid #094477;
	background: rgba(49,183,245,1);
	background: -moz-linear-gradient(left, rgba(49,183,245,1) 0%, rgba(0,92,135,1) 100%);
	background: -webkit-gradient(left top, right top, color-stop(0%, rgba(49,183,245,1)), color-stop(100%, rgba(0,92,135,1)));
	background: -webkit-linear-gradient(left, rgba(49,183,245,1) 0%, rgba(0,92,135,1) 100%);
	background: -o-linear-gradient(left, rgba(49,183,245,1) 0%, rgba(0,92,135,1) 100%);
	background: -ms-linear-gradient(left, rgba(49,183,245,1) 0%, rgba(0,92,135,1) 100%);
	background: linear-gradient(to right, rgba(49,183,245,1) 0%, rgba(0,92,135,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#31b7f5', endColorstr='#005c87', GradientType=1 );
}
.doMainRelated label {
	margin-bottom: 10px;
	display: block;
	font-size: 15px;
	color: #585858;
	margin-bottom: 0;
	padding-left: 20px;
	font-weight: 600;
}
.doMainRelated tr {
	display: block;
	width: 100%;
	float: left;
	margin-bottom: 16px;
}
.doMainRelated .button-primary {
	font-size: 16px;
	padding: 0 50px;
	height: 40px;
	line-height: 38px;
	color: #fff;
	text-shadow: none !important;
	box-shadow: none;
	border: none;
	margin-top: 10px;
	-webkit-transition: all ease-in-out 300ms;
	-moz-transition: all ease-in-out 300ms;
	transition: all ease-in-out 300ms;
	-webkit-border-radius: 35px;
	-moz-border-radius: 35px;
	border-radius: 35px;
}
.btn_center {
	text-align: center;
}
.signUp {
	font-size: 16px;
	color: #717171;
}
.mt10 {
	margin-top: 10px;
}
.mb10 {
	margin-bottom: 10px;
}
.power {
	width: 100%;
	float: left;
	display: block;
}
.white-text {
	color: white;
}
.inputLabel {
	margin-bottom: 10px;
}
.imageBox {
	max-width: 300px;
	width: 100%;
	margin: 0 auto;
	text-align: center;
	position: relative;
}
.imageBox:after, .imageBox:before {
	content: "";
	display: table;
}
.imageBox:after {
	clear: both;
}
.imageBox img {
	width: 100%;
	display: block;
}
.slectBtn {
	font-size: 16px;
	padding: 0 26px;
	height: 40px;
	line-height: 38px;
	color: #fff;
	text-shadow: none !important;
	box-shadow: none;
	border: none;
	margin-top: 10px;
	-webkit-transition: all ease-in-out 300ms;
	-moz-transition: all ease-in-out 300ms;
	transition: all ease-in-out 300ms;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	background: #005c87;
	position: absolute;
	bottom: 10px;
	left: 50%;
	-moz-transform: translate(-50%, 0);
	-webkit-transform: translate(-50%, 0);
	transform: translate(-50%, 0);
	box-shadow: 0 1px 0 #ccc;
}
.slectBtn:hover {
	background: #333;
}
.uploadImage {
	width: 100%;
	float: left;
}
.uploadImage .uploadImageLeft {
	width: calc(100% - 103px);
	float: left;
	padding-right: 10px;
}
.uploadImage .uploadImageRight {
	width: 103px;
	float: left;
}
.upImageSection {
	width: 100%;
	float: left;
	margin-top: 20px;
}
.upImageSection h2 {
	padding-bottom: 10px;
}
.button-secondary.uploadnewBtn {
	height: 44px;
	background: #005c87;
	color: #fff;
	-webkit-transition: all ease-in-out 300ms;
	-moz-transition: all ease-in-out 300ms;
	transition: all ease-in-out 300ms;
}
.button-secondary.uploadnewBtn:hover {
	background: #333;
	color: #fff;
}
#myprefix-preview-image {
	height: 250px;
	-moz-object-fit: cover;
	-webkit-object-fit: cover;
	object-fit: cover;
}
.checkboxSection{
	margin-top: 10px;
	margin-bottom: 8px;
	width: 100%;
	float: left;
}
.checkboxSection label{
	display: inline-block;
	padding-left: 5px;
	}
</style>

<div class="wrap doMainRelated">

  <h1>Push Setting</h1>
  <form method="post" action="">
	   <?php wp_nonce_field( 'push_setting' ); ?>
    <div class="imageBox">
      <?php 
		$feedify_uploded_logo='';
		$no_image=plugin_dir_url(__FILE__).'no-image-icon.png';
    	$image_id = get_option( 'myprefix_image_id' );
		$custom_image_url_type = get_option( 'custom_image_url_type' );
		$feedify_is_website_logo = get_option( 'feedify_is_website_logo' );
		
		if($custom_image_url_type=='S'){
			if( intval( $image_id ) > 0 ) {
				$image_url=wp_get_attachment_image_url( $image_id, '' );
					echo '<img id="myprefix-preview-image" src="'.esc_url($image_url).'"/>';
				} else {
					echo '<img id="myprefix-preview-image" src="'.esc_url($no_image).'"/>';
				}
			}else{
				$feedify_uploded_logo = get_option( 'feedify_is_website_logo' );
				echo '<img id="myprefix-preview-image" src="'.esc_url($feedify_is_website_logo).'"/>';
			}
				
?>
     
    </div>
    <div class="upImageSection">
      <h2 for="image_url">Upload Image</h2>
      <div class="uploadImage">
        <div class="uploadImageLeft">
          <input type="text" id="image_url" class="regular-text" value="<?php if(isset($feedify_uploded_logo)){ echo $feedify_uploded_logo;} ?>" readonly="readonly">
        </div>
        <div class="uploadImageRight">
          <input type="button" name="upload-btn" id="upload-btn" class="button-secondary uploadnewBtn" value="Upload Image">
        </div>
      </div>
    </div>
    
    <div class="checkboxSection">
    <?php $feedify_is_default_logo = get_option( 'feedify_is_default_logo' );?>
    <input id="feedify_is_default_logo" name="feedify_is_default_logo" type="checkbox" class="" value="1" <?php if(isset($feedify_is_default_logo)){ if($feedify_is_default_logo==1){ echo 'checked="checked"';}} ?>   />
    <label for="feedify_is_default_logo"> Use default logo in Push Notification</label>
    </div>
    
    <div class="checkboxSection">
    <?php $feedify_is_banner_image = get_option( 'feedify_is_banner_image' );?>
    <input id="feedify_is_banner_image" name="feedify_is_banner_image" type="checkbox" class="" value="1" <?php if(isset($feedify_is_banner_image)){ if($feedify_is_banner_image==1){ echo 'checked="checked"';}} ?>   />
    <label for="feedify_is_banner_image"> Use Featured Image as Banner Image</label>
    </div>
    
    <div class="checkboxSection">
    <?php $feedify_is_featured_logo = get_option( 'feedify_is_featured_logo' );?>
    <input id="feedify_is_featured_logo" name="feedify_is_featured_logo" type="checkbox" class="" value="1" <?php if(isset($feedify_is_featured_logo)){ if($feedify_is_featured_logo==1){ echo 'checked="checked"';}} ?>   />
    <label for="feedify_is_featured_logo"> Use Featured image as logo, if featured image is used in post</label>
    </div>
    
    <div class="checkboxSection">
    <?php $feedify_is_word_limit = get_option( 'feedify_is_word_limit' );?>
    <input id="feedify_is_word_limit" name="feedify_is_word_limit" type="checkbox" class="" value="1" <?php if(isset($feedify_is_word_limit)){ if($feedify_is_word_limit==1){ echo 'checked="checked"';}} ?>   />
    <label for="feedify_is_word_limit"> Trim the message to 15 words</label>
    </div>
    
    <div class="checkboxSection">
    <?php $feedify_is_msg_send = get_option( 'feedify_is_msg_send' );?>
    <input id="feedify_is_msg_send" name="feedify_is_msg_send" type="checkbox" class="" value="1" <?php if(isset($feedify_is_msg_send)){ if($feedify_is_msg_send==1){ echo 'checked="checked"';}} ?>   />
    <label for="feedify_is_msg_send"> Send message without description</label>
    </div>
    
    
    
    
    <input type="hidden" name="myprefix_image_id" id="myprefix_image_id" value="<?php echo esc_attr( $image_id ); ?>" class="regular-text" />
    <input type="hidden" name="custom_image_url_type" id="custom_image_url_type" value="<?php if(isset($custom_image_url_type)){ echo $custom_image_url_type;} ?>" />
    <input type="hidden" name="custom_image_url" id="custom_image_url" value="<?php if(isset($feedify_is_website_logo)){ echo $feedify_is_website_logo;} ?>" />
    <input type="hidden" name="feedify_cmd" value="feedify_save_push_settings" />
    <div class="btn_center">
      <button class="button button-primary" type="submit">Save Changes</button>
    </div>
  </form>
  <div class="clear"></div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
    $('#upload-btn').click(function(e) {
		wp.media.controller.Library.prototype.defaults.contentUserSetting=false;
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
            $('#image_url').val(image_url);
			$('#custom_image_url').val(image_url);
			$('#custom_image_url_type').val('M');
			
        });
    });
});
</script> 
