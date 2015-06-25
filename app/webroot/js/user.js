/*Script to use select2 plugin*/

$(document).ready(function () {

  $('#select2').select2({
	placeholder: "Enter Name",
	allowClear: true,
    minimumInputLength: 1,
  });
});
