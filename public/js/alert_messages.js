jQuery(function($){

	const alert = $('#alert');
	if(alert.length > 0){
		//alert.show().slideDown(500);
		alert.find('.close').click(function(e){
			e.preventDefault();
			alert.slideUp();
			window.location.href="messages";
		})
	}

});