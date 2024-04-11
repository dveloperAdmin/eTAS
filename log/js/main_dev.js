$(function() {
	'use strict';
	
  $('.form-control').on('input', function() {
	  var $field = $(this).closest('.form-group');
	  if (this.value) {
	    $field.addClass('field--not-empty');
	  } else {
	    $field.removeClass('field--not-empty');
	  }
	});

});

$("form").on("submit",function(e){
	let input = $("#login_mob").val().length;
	if(input != 10){
		// console.log(input);
		e.preventDefault();
		Swal.fire({
            icon: 'warning',
            title: 'Please provide 10 digit mobile number....',
            showCloseButton: true,
            confirmButton: true,

        })

	}
})