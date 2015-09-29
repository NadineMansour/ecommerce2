$(window).scroll(function() {
	if($(document).scrollTop() > 50) {
		$('nav').addClass('shrink animated jello');
	} else {
		$('nav').removeClass('shrink animated jello');

	}
})


