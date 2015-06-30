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
});
