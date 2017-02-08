$(document).ready(function(){
	
	$('.dslider li').click(function() {
		
		var thiss = $(this);
		
		if (!thiss.hasClass('current')){
		
			$('li.current').removeClass('current');
		
			setTimeout(function(){

				thiss.addClass('current');

			}, 500);
		
		}
		
	});
	
});