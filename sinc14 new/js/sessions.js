

(function($) { 
$(document).ready(function() {
	
/*	$("#more-topics").click(function() {
		$("#hidden-topics").toggle('slow');
		$(this).text($(this).text() == 'Show More Options' ? 'Show Fewer Options' : 'Show More Options');
		
		return false;
	});
	
	$("#more-audiences").click(function() {
		$("#hidden-audiences").toggle('slow');
		$(this).text($(this).text() == 'Show More Options' ? 'Show Fewer Options' : 'Show More Options');
		
		return false;
	});


		
	var val = $(this).val();
		if (val == 3) {var btnText = "Basic"} 
		else if (val == 23) {var btnText = "Intermediate"}
		else if (val == 1) {var btnText = "Advanced"};
		var button = "<button class=\"btn_tag btn_tag_level\">" + btnText + "</button>";
		if ("input.level:checked") {
			$(".tags_area").prepend(button)
		}
		else {$(".tags_area").remove(button)}
		
		return false;
	}); 
	
/*	$("input.type").change(function() {
		var val = $(this).val();
		if (val == 12) {var btnText = "Concurrent Session"} 
		else if (val == 33) {var btnText = "Panel Session"}
		else if (val == 35) {var btnText = "Poster Display"}
		else if (val == 36) {var btnText = "Pre-Conference Workshop"};
		var button = "<button class=\"btn_tag btn_tag_type\">" + btnText + "</button>";
		$(".tags_area").prepend(button);
		
		return false;
	});
	
var totalSessions = 128;








    $("#holder li, .played").hide();
    $("#holder.showThis li").show();
 
 
    // Counts up occurances of classes and sets number of occurrences in filter list
    $(".filters li").each(function(){
        var $val = $(this).find('input').val();
        var $valcount = $("#session-holder ."+$val).length;
		$(this).find('span.count').html($valcount);
		//alert($valcount);
    });
 
 
    // Sets the number in the 'Show all' filter by counting the total amount of entries.
    var $itval = $("#session-holder li").length;
    $(".filters li input[value*='all']").parent().find('span.count').html($itval);
 
 
 
 
    // When clicking an item in the filter list, elements will appear or dissappear
    // depending on whether list item is checked or unchecked.
 
    $(".filters li input[type=checkbox]").click(function(){
 
 
        $('a.jqTransformCheckbox').parent().find('input[type=checkbox]').removeAttr('checked');
        $('a.jqTransformChecked').parent().find('input[type=checkbox]').attr('checked','checked');
 
        // next two lines remove the initial page content when a filter is clicked
        $(".entry-made").hide();
 
        var selection = $(this).val();
        if (selection == "all"){
            //show all items
            if ($(this).is(':checked')){
                $("#session-holder li").slideDown('slow');
                $(".filters li input[type=checkbox]").attr('checked','checked');
                $(".filters li").addClass('checked');
                $(".filters li label").css({'color':'#222222'});
            }else{
                $("#session-holder li").slideUp('slow', function() {
                    $(".played").slideDown('fast');
                });
                $(".filters li input[type=checkbox]").removeAttr('checked');
                $(".filters li").removeClass('checked');
                $(".filters li label").css({'color':'#333333'});
            }
        }else{
            if ($(this).is(':checked')){
                $("#session-holder li."+selection).prependTo('#session-holder').slideDown('fast');
 
                var stringOfClassNames = '';
                var thisClassString = $("#session-holder li."+selection).attr('class');
                stringOfClassNames = stringOfClassNames +' '+ thisClassString;
 
                var arrayClasses = stringOfClassNames.split(' ');
                $.each(arrayClasses, function() {
                    $('.filters input[value='+this+']').parent('li').addClass('checked');
                    $('.filters input[value='+this+']').parent('li').find('label').css({'color':'#222222'});
                    $('.filters input[value='+this+']').attr('checked','checked');
                });
 
                $(this).parent('li').addClass('checked');
                $(this).parent().find('label').css({'color':'#222222'});
 
 
                if ($.browser.webkit) {
                    $('#main #session-holder li').css({'position':'relative'})
                }
            }else{
 
                $("#session-holder li."+selection).slideUp('fast', function() {
 
                    var stringOfClassNames = '';
                    var thisClassString = $("#session-holder li."+selection).attr('class');
                    stringOfClassNames = stringOfClassNames +' '+ thisClassString;
 
                    var arrayClasses = stringOfClassNames.split(' ');
 
                    $.each(arrayClasses, function() {
                        $('.filters input[value='+this+']').parent('li').removeClass('checked');
                        $('.filters input[value='+this+']').parent().find('a.jqTransformCheckbox').removeClass('jqTransformChecked');
                        $('.filters input[value='+this+']').parent('li').find('label').css({'color':'#333333'});
                        $('.filters input[value='+this+']').removeAttr('checked');
                    });
 
                    if ($('.filters input:checked').length <= 0){
                        $("#session-holder li").slideUp('fast');
                        $(".played").slideDown('fast');
                    }
 
                });
 
                $(this).parent('li').removeClass('checked');
                $(this).parent('li.'+selection+' input[type=checkbox]').removeAttr('checked');
                $(this).parent().find('label').css({'color':'#333333'});
 
                if ($('#filterIDall').is(':checked')){
                    $('#filterIDall').removeAttr('checked');
                    $('#filterIDall').parent().find('li').removeClass('checked');
                    $('#filterIDall').parent().find('label').css({'color':'#333333'});
                }
            }
        }
    }); */
});
})(jQuery);