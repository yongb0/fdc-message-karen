/*Custom script*/

//for pagination

$(document).ready(function() {
	
	$(function() {
		$("#paginated-content-container").load("//message.local/message/show/");
	});
	
	$(document).ready(function(){
			var track_click = 1;
			var url = '/message/show/';
			$(document).on('click', '#show-more',function() {
				$.ajax({
				url: url,
				type: 'POST',
				data: {"page_number": track_click},
				success: function(data){
					$('#show-more').remove();
					$('#paginated-content-container').append(data);
					track_click++;
					}, 
				error: function(data,status,xhr){
					alert(xhr);
					}
				});
			});
		});

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});


