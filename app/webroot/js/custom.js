/*Custom script*/

//for pagination

$(document).ready(function() {

    var track_click = 0; //track user click on "show more" button, right now it is 0 click
   
	$(function() {
		$("#paginated-content-container").load("//message.local/message/show/");
	});
    
    /*$(function() {
	
		$.ajax({
			url: "//message.local/message/show/"+track_click, 
			type: "POST",
			data: track_click,
			success: function() {
				$("#paginated-content-container").load("//message.local/message/show/");
			}
		});
    });
*/
});
