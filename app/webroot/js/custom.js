/*Custom script*/

//for pagination
$(function() { 
	var paginatedContentContainer = $('#paginated-content-container');
	paginatedContentContainer.load('//message.local/message/show')
							 .on({
								click: function() {
									paginatedContentContainer.empty().append(loadingBar).load($(this).attr("href"), 
								function () {
									loadingBar.fadeOut('fast');
								});
									return false;
								}
							 }, '.pagination-nav a');
});



