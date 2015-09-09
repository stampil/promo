var is_mobile=false;
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	is_mobile=true;
}

(function($) {

    $(document).ready(function(){  
		console.info('document ready');
	});	
	
	$(window).load(function () {
		console.info('window load');
	});
	
});