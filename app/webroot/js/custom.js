/*Custom script*/

//for pagination
$(function() { 
	var paginatedContentContainer = $('#paginated-content-container');
	paginatedContentContainer.load(getBaseURL() + '/message/show')
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

function getBaseURL() {
	var url = location.href;
	var baseURL = url.substring(0, url.indexOf('/', 14));

	if (baseURL.indexOf('message.local') != -1) {
		var url = location.href;
		var pathname = location.pathname;
		var index1 = url.indexOf(pathname);
		var index2 = url.indexOf("/", index1 + 1);
		var baseLocalUrl = url.substr(0, index2);

		return baseLocalUrl + "";
	}
	else {
		// Root Url for domain name
		return baseURL + "/";
	}
}
