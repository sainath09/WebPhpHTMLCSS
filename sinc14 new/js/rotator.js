
(function($){
	$(document).ready(
	function(){
		$('ul#rotator').innerfade({
		speed: 1000,
		timeout: 3500,
		type: 'sequence',
		containerheight: '250px'
		});
	});
})(jQuery);

