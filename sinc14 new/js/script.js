
$(document).ready(function()
{
	// Default
	$("#demo1").jfancytile();

	$("#demo2").jfancytile({
    	inEasing: "easeOutBounce", // from jQuery Easing Plugin
    	outEasing: "easeInCirc",   // from jQuery Easing Plugin
        inSpeed: 2000,
        outSpeed: 3500,
        rowCount: 5,
        columnCount: 10,
        maxTileShift: 5
    });
});

$(window).load(function() {
	$(".loader").fadeOut("slow");
});

