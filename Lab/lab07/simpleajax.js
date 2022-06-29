function getEmail(name, password) {
	const xhr = new XMLHttpRequest();
	xhr.open("POST", "data.php");
	xhr.setRequestHeader("Accept", "application/json");
	xhr.setRequestHeader("Content-type", "application/json");

	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4 && xhr.status === 200) {
			let response = JSON.parse(xhr.responseText);
			let email = response.email;
			if(email != null){
				$('.email-result').text(email);
			}else{
				$('.email-result').text("Authentication information to get email is incorrect. Please try again");
			}
		}
	}
	const data = '{"user_name": "' + name + '", "password": "' + password + '" }';
	xhr.send(data);
}