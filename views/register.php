<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require_once('../../../../wp-config.php'); 
$plugin_dir = plugins_url() . '/push-notification-by-feedify';

$domain_get = isset($_REQUEST['store_url']) ? $_REQUEST['store_url'] : "";
$url = preg_replace('/^https?:\/\//', '', $domain_get);
    
// Remove the path, query string, and fragment
$url = preg_replace('/\/.*$/', '', $url);
$mainDomain = $url;

$domain = $mainDomain;
$platform = isset($_REQUEST['platform']) ? $_REQUEST['platform'] : "";
$phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : "";
$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : "";
$err_msg = isset($_SESSION['error_msg']) ? $_SESSION['error_msg'] : "";
?>
<!DOCTYPE html>
<html lang="en"> <?php  define('front_cdn_url', 'https://cdn.feedify.net/');?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Feedify | Signup</title>
	<!-- Bootstrap -->
	<link href="<?php echo front_cdn_url; ?>/assets/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo front_cdn_url; ?>/assets/css/style.css" rel="stylesheet">
	<link href="<?php echo front_cdn_url; ?>/assets/css/carousel.css" rel="stylesheet">
	<link href="<?php echo front_cdn_url; ?>/assets/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo $plugin_dir; ?>/assets/css/formValidation.min.css" rel="stylesheet" type="text/css" media="screen">
	<!-- phone numbers -->
	<link rel="stylesheet" href="<?php echo $plugin_dir; ?>/assets/css/__intlTelInput.css">
	<link rel="stylesheet" href="<?php echo $plugin_dir; ?>/assets/css/demo.css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style type="text/css">
	.country-name {
		color: black;
	}

	#phone {
		width: 100% !important;
	}

	@media only screen and (max-width: 768px) {

		/* For mobile phones: */
		#phone {
			width: 100% !important;
		}
	}

	.intl-tel-input .country-list {
		z-index: 9;
	}
	</style>
</head>

<body class="bg-signup">
	<div class="container-fluid">		
		<div class="container">
			<div class="row">
				<a href="javascript:void(0);"><img src="<?php echo front_cdn_url;?>images/logo.png"></a>
			</div>
			<div class="row">
				<div class="col-sm-7">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 top30">
							<h1 class="text-center">Sign Up Now</h1>
							<form id="signup-form" action="" id="signup-form" method="post" class="form-verticle" role="form">
							<?php //wp_nonce_field( 'FeedifyRegister' ); ?>
								<div class="signup-form top40">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1"><img src="<?php echo front_cdn_url; ?>/images/semail.png"></span>
											<input type="text" name="email" value="<?php echo $email;?>" placeholder="Email" class="form-control">
										</div>
										<span style="color: red;"></span>
									</div>
									<label>Phone No.</label>
									<div class="form-group">
										<input type="tel" placeholder="Phone No." id="phone" name="phone" value="<?php echo $phone;?>" class="form-control phoneinput" maxlength="15">
										<span class="text-danger"></span>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1"><img src="<?php echo front_cdn_url; ?>/images/helpdesk.png"></span>
											<input type="text" id="store_url" name="store_url" value="<?php echo $domain;?>" placeholder="Store Url" class="form-control">
										</div>
										<span style="color: red;"></span>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1"><img src="<?php echo front_cdn_url; ?>/images/smobile.png"></span>
											<input type="password" name="password" id="password" placeholder="Password" class="form-control">
										</div>
										<span style="color: red;"></span>
									</div>
									<div class="row bottom20 top40">
										<div class="col-sm-12">
											<input type="hidden" name="platform" value="<?php echo $platform;?>">
											<input type="hidden" name="plan_id" value="">
											<input type="hidden" name="redirect_url" value="">
											<input type="hidden" name="feedify_cmd" value="feedify_register" />
											<input type="submit" class="btn btn-signup" value="GET STARTED">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<span style="color:red;"><?php echo $err_msg;?></span>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="<?php echo front_cdn_url; ?>/assets/js/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo front_cdn_url; ?>/assets/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo $plugin_dir; ?>/assets/js/formValidation.min.js"></script>
	<script type="text/javascript" src="<?php echo front_cdn_url; ?>/assets/js/bootstrap.min.js"></script>
<style>
span.c_error {
	min-height: 1px;
	display: block;
}

.has-error span.c_error,
.has-success span.c_error {
	display: none;
}

.has-success .form-control:focus {
	-webkit-box-shadow: none;
	box-shadow: none;
}

.has-error .form-control:focus {
	-webkit-box-shadow: none;
	box-shadow: none;
}

label {
	margin-bottom: 5px;
}

.form-group {
	margin-bottom: 10px;
}

.btn-signup {
	padding: 8px 56px;
}

.signin-form .card-header {
	font-size: initial;
}

.signin-form label {
	font-size: 16px;
}
</style>
<script>
$(document).ready(function() {
	if(typeof window.postMessage !== 'undefined') {
		console.log('hi');
		window.parent.postMessage({
			height: $("body").height()
		}, "*");
	}
});
</script>
<script src="<?php echo $plugin_dir; ?>/assets/js/intlTelInput.js"></script>
<script>
$(document).ready(function() {
	$('#signup-form').formValidation({
		framework: 'bootstrap',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			email: {
				validators: {
					notEmpty: {
						message: 'The email address is required'
					},
					/*emailAddress: {
					    message: 'The input is not a valid email address'
					}*/
					regexp: {
						regexp: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
						message: 'The input is not a valid email address'
					}
				}
			},
			store_url: {
				validators: {
					notEmpty: {
						message: 'The store url is required'
					},
					/*regexp: {
					        regexp: /\b(?:(?:https?|ftp):\/\/|\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i,
					        message: 'Please enter valid store URL'
					    }*/
					regexp: {
						regexp: /^((ftp|http|https):\/\/)?(www.)?(?!.*(ftp|http|https|www.))[a-zA-Z0-9_-]+(\.[a-zA-Z]+)+((\/)[\w#]+)*(\/\w+\?[a-zA-Z0-9_]+=\w+(&[a-zA-Z0-9_]+=\w+)*)?$/,
						message: 'Please enter valid store URL'
					}
				}
			},
			phone: {
				validators: {
					notEmpty: {
						message: 'The Phone No is required'
					},
					integer: {
						message: 'Please enter a valid Phone No.'
					}
				}
			},
			password: {
				validators: {
					notEmpty: {
						message: 'The password is required'
					},
					stringLength: {
						min: 6,
						max: 20
					}
				}
			}
		}
	});
});
</script>
<script>
$("#phone").intlTelInput({
	// allowDropdown: false,
	// autoHideDialCode: false,
	// autoPlaceholder: "off",
	// dropdownContainer: "body",
	//excludeCountries: [],
	//formatOnDisplay: false,
	geoIpLookup: function(callback) {
		$.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
			var countryCode = (resp && resp.country) ? resp.country : "";
			callback(countryCode);
		});
	},
	hiddenInput: "full_number",
	initialCountry: "auto",
	nationalMode: false,
	onlyCountries: [],
	placeholderNumberType: "MOBILE",
	preferredCountries: ['in', 'us', 'uk'],
	separateDialCode: true,
	utilsScript: "<?php echo $plugin_dir; ?>/assets/js/utils.js"
});
</script>
</body>
</html>
<?php
if(isset($_SESSION['error_msg'])){
 unset($_SESSION['error_msg']);
}
?>
