


(function($) { 
	$(document).ready(function() {
							   



		$('#exhibitorList').listnav(
			showCounts: false
		);      
		
		
		$(".registration>tr:odd").addClass("odd");
		
		$("#form_container").accordion({
			collapsible: true,
			heightStyle: "content"
		});

		
});
})(jQuery);

(function($) {
	$(window).load(function() {
    	$('#slider').nivoSlider({
		effect: 'sliceUpLeft', // Specify sets like: 'fold,fade,sliceDown'
        slices: 15, // For slice animations
        boxCols: 8, // For box animations
        boxRows: 4, // For box animations
        animSpeed: 800, // Slide transition speed
        pauseTime: 5000, // How long each slide will show
        startSlide: 0, // Set starting Slide (0 index)
        directionNav: true, // Next & Prev navigation
        directionNavHide: true, // Only show on hover
        controlNav: true, // 1,2,3... navigation
        controlNavThumbs: false, // Use thumbnails for Control Nav
        pauseOnHover: true, // Stop animation while hovering
        manualAdvance: false, // Force manual transitions
        prevText: 'Prev', // Prev directionNav text
        nextText: 'Next', // Next directionNav text
        randomStart: true, // Start on a random slide
		});
	});
})(jQuery);