<?php
  
?>
<style type="text/css">

	.sendPush *{
		box-sizing: border-box;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		padding: 0;
		margin: 0;
	}
	.sendPush.wrap{
		max-width:450px;
		width:100%;
		margin: 30px auto;
		background: #fff;
		padding: 20px 25px;
		-moz-box-shadow: 0 0 10px 0 rgba(0,0,0,.2);
		-webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,.2);
		box-shadow: 0 0 10px 0 rgba(0,0,0,.2);
	}
	.sendPush .clear{
		clear: both;
	}
	.sendPush th, .sendPush td{
		width:100%;
		display: block !important;
		float: left;
		padding: 0;
	}
	.sendPush .regular-text{
		width: 100%;
    height: 44px;
    padding: 0 10px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
	}
	.sendPush textarea.regular-text{
		height: 100px;
		
	}
	.sendPush h1{
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
	.sendPush label{
		margin-bottom: 5px;
		display: block;
	}
	.sendPush .button-primary{
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
	.btn_center{
		text-align:center;
	}
	#wpbody {
	background: url(https://sftextures.com/texture/2748/0/2743/corner-pattern-background-light-grey-color-squared-90-degrees-lines-seamless-wallpaper-texture.jpg) left top repeat;
	background-size: 100px;
	-moz-background-size: 100px;
	-webkit-background-size: 100px;
}
</style>

<div class="wrap sendPush">
    <h1 class="wp-heading-inline btn_center">Send Push</h1>
    <div class="notice notice-error">
    <p style="color: red;">Please Upgrade Your Plan <a id="new_subs" style="cursor: pointer;" >Click Here</a>  </p>
    </div>
    <hr class="wp-header-end">
	<form method="post" enctype="multipart/form-data" action="" id="frm_send_push">
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="push_title">Title</label></th>
                <td><input type="text" id="push_title" class="regular-text" name="push_title" value="" disabled /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="push_message">Message</label></th>
                <td><textarea id="push_message" class="regular-text" name="push_message" disabled></textarea></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="push_url">URL</label></th>
                <td><input type="text" id="push_url" class="regular-text" name="push_url" value=""  disabled /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="push_url">Push Icon URL</label></th>
                <td><input type="text" id="push_icon" class="regular-text" name="push_icon" value="" disabled /></td>
            </tr>
        </table>
     
        <div class="btn_center">
        <button class="button button-primary" type="submit" id="btn_send_push" disabled>Send Push</button>
        </div>
	</form>
	<div class="clear"></div>
</div>

