<?php
$plugin_url = plugin_dir_url( __FILE__ );
?>
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
	width: 100%;
	display: block !important;
	float: left;
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
	font-size: 18px;
	color: #585858;
}
.doMainRelated tr {
	display: block;
	width: 100%;
	float: left;
	margin-bottom: 4px;
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
<?php 
if(get_option('feedify_domain_key') == "" || get_option('feedify_public_key') == "")
{
	?>
	.left-side-form{
		width: 50%;
		float: left;
	}
	.right-side-form{
		width: 50%;
		float: left;
	}
	@media screen and (max-width: 782px) {
		.doMainRelated.wrap {
			width: auto;
    		margin: 5%;
		}
		.left-side-form{
			width: 100%;
		}
		.right-side-form{
			width: 100%;
		}
		#wpcontent {		
			padding-left: 0px !important;
		}
	}
	<?php
}
?>
</style>

	<div class="left-side-form">
		<div class="wrap doMainRelated">

		<h1>Feedify Settings</h1>
		<form method="post" action="" id="feedify_key_form">
			<?php wp_nonce_field( 'setting' ); ?>
			<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="feedify_licence_key">Licence Key</label></th>
				<td><input type="text" id="feedify_licence_key" class="regular-text" name="feedify_licence_key" value="<?php echo esc_html(get_option('feedify_licence_key')); ?>" />

				<br/>
				
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="feedify_domain_key">Domain key</label></th>
				<td><input type="text" id="feedify_domain_key" class="regular-text mb10" name="feedify_domain_key" value="<?php echo get_option('feedify_domain_key'); ?>" />
				<br/>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="feedify_public_key" style="display:none;">Public Key</label></th>
				<td><input style="display: none;" type="text" id="feedify_public_key" class="regular-text" name="feedify_public_key" value="<?php echo htmlspecialchars(get_option('feedify_public_key'));  ?>" />
				</td>
				<?php if (is_ssl()) {
					$feedify_enable_ssl_check = true;
				}else{
					$feedify_enable_ssl_check = false;
				} ?>
				<td style="display:none !important;"><input type="hidden" name="feedify_enable_ssl_check" id="feedify_enable_ssl_check" value="<?php echo $feedify_enable_ssl_check;?>">
					<div style="display: flex;">
						<label class="switch">
							
						<?php if(get_option('feedify_licence_key') != '' && get_option('feedify_domain_key') != ''){ ?>
							<input type="checkbox" id="feedify_enable_ssl" name="feedify_enable_ssl" value="yes"  <?php echo (get_option('feedify_enable_ssl') == 'yes' ? 'checked' : ''); ?>/>
						<?php } else { ?>
							<input type="checkbox" id="feedify_enable_ssl" name="feedify_enable_ssl" value="yes"  checked/>
						<?php } ?>

							<span class="slider round"></span>
						</label>
						<span class="feedify_checkbox_txt">My website is HTTPS enabled</span>
					</div>	
				<br/>
				<div id="feedify_enable_ssl_err"></div>
				</td>
			</tr>
			</table>
			<input type="hidden" name="feedify_cmd" value="feedify_save_settings" />
			<div class="btn_center">
			<button class="button button-primary" id="send_btn" type="submit">Save Changes</button>
			</div>
		</form>

		<div class="clear"></div>
		</div>
	</div>
<?php
if(get_option('feedify_domain_key') == "" || get_option('feedify_public_key') == "")
{
?>	
	<div class="right-side-form">
		<div class="wrap doMainRelated">

		<h1>New to Feedify</h1>
		<form method="post" action="">			
			
			<input type="hidden" name="feedify_cmd" value="feedify_save_settings" />
			<input type="hidden" name="csrf-token" value="<?php echo bin2hex(random_bytes(32));?>">
			<div class="btn_center">
			<button class="button button-primary 1step_reg" onclick="feedify_signup_popup();" type="button">1-Step Registration</button>			
			</div>
			<br>
			<p class="btn_center">Facing Issues? <a href="https://app.feedify.net/signup" target="_blank">Manually Register on feedify.net</a></p>
		</form>

		<div class="clear"></div>
		</div>
	</div>
	
<script>
function feedify_signup_popup(){
	window.open('<?php echo $plugin_url;?>register.php?store_url=<?= site_url();?>&platform=wordpress',"wpushr-signup-dialog","width=600, height=550, resizable=0, scrollbars=0, status=0, titlebar=0, left=" + ((screen.width - 600) / 2) + ", top=" + ((screen.height - 550) / 2)  );
}
</script>
<?php
}
?>
