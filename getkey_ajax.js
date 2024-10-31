jQuery(document).ready( function($) {
	$("#feedify_enable_ssl").click( function() {
		  document.getElementById("send_btn").disabled = true;
		if ($('#feedify_enable_ssl').is(":checked")) {
		 	var domain_key = document.getElementById("feedify_domain_key").value;
			var licence_key = document.getElementById("feedify_licence_key").value;
			var data = {
				action: 'getkey_response',
	            domain_key: domain_key,
	            licence_key: licence_key
			};
		 	$.post(the_ajax_script.ajaxurl, data, function(response) {
		 	    console.log('s');
		 	    console.log(response);
		 	var get_response =   JSON.parse(response)
		 	document.getElementById("feedify_public_key").value = get_response.public_key;
		 	document.getElementById("send_btn").disabled = false;
		 	});
		}else{
			document.getElementById("feedify_public_key").value = '';
			document.getElementById("send_btn").disabled = false;
			/*alert('not');*/
		}
		
	});


		$("#new_subs").click( function() {
			var data = {
				action: 'FeedifyUpdateUserSubscription'
	    	};
		 	$.post(the_ajax_script.ajaxurl, data, function(response) {
		 		var obj = JSON.parse(response);
		 		window.location.replace('https://app.feedify.net/login_with_wordpress?user_id='+obj.user_id+'&u_key='+obj.u_key+'&key='+obj.domain);
		 	//  window.location.replace =response;
		 	// ;
		 	// console.log(response);
		 	});
	});

	
});