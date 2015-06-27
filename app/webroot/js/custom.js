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
    $("#show-more").click(function (e) { //user clicks on button
    
        $(this).hide(); //hide load more button on click
        $("#ajax-loader").show(); //show loading image

        if(track_click <= total_pages) //user click number is still less than total pages
        {
            //post page number and load returned data into result element
            $.post('fetch_pages.php',{'page': track_click}, function(data) {
            
                $("#ajax-loader").show(); //bring back load more button
                
                $("#paginated-content-container").append(data); //append data received from server
                
                //scroll page smoothly to button id
                $("html, body").animate({scrollTop: $("#show-more").offset().top}, 500);
                
                //hide loading image
                $("ajax-loader").hide(); //hide loading image once data is received
    
                track_click++; //user click increment on load button
            
            }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
                alert(thrownError); //alert with HTTP error
                $("#show-more").show(); //bring back load more button
                $("#ajax-loader").hide(); //hide loading image once data is received
            });
            
            
            if(track_click >= total_pages-1) //compare user click with page number
            {
                //reached end of the page yet? disable load button
                $("#show-more").attr("disabled", "disabled");
            }
         }
          
        });
});
