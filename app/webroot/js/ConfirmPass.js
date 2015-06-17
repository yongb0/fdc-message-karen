function confirmPass(){
	var pass1 = document.getElementById('password');
	var pass2 = document.getElementById('confirmPassword');
	
	if (pass1.value == pass2.value){
		alert('Passwords Match');
	} else {
		alert('Passwords Do Not Match');
	}
}