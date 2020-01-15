<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Shop 337 | Sign in or Register</title>
<link rel="stylesheet" href="login.css">
</head>
<h1>Shop 337</h1>
<body>

	<div class = image>
	<img src="images/image3.webp">
	<div class=centered>
	 
		<img src="images/username_icon.jpg" style="width: 10px"> 
		<input type="text" id="userName" pattern="[A-Z a-z]" required> <br> <br>
			<img src="images/password_icon.jpg" style="width: 10px"> 
			<input type="password" id="password" pattern= "[A-Z 0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}" required> <br> <br>
			<input type="button" value="Sign in" id="signIn" onClick="signIn()"> 
			<input type="button" value="Register" id="register" onClick="register()">
	</div>
	</div>

</body>

<script>
	function signIn(){
		var isValidPassword = false;
		var userName = document.getElementById("userName").value;
		var password = document.getElementById("password").value;
		if(userName.length > 0 && password.length > 0){
			databaseSearch('signIn', userName, password);
			
		}else{
			alert("Invalid Username or Password...\nPlease try again");
		}
	}


	
	function register(){
		var isValidPassword = false;
		var userName = document.getElementById("userName").value;
		var password = document.getElementById("password").value;
		if(userName.length > 0 && password.length > 0){
			databaseSearch('createAcc', userName, password);
			
		}else{
			alert("Invalid Username or Password...\nPlease try again");
		}
		
	}
	

function databaseSearch(mode, userName, password) {

	var ajax = new XMLHttpRequest();
	
	if(mode == 'signIn'){
		ajax.open("GET", "controller.php?mode=signIn&userName=" + userName+ "&password=" + password, true); 
	}
	if(mode == 'createAcc'){
		ajax.open("GET", "controller.php?mode=createAcc&userName=" + userName+ "&password=" + password, true);
	}
	ajax.send();
	
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200) {
			var str = ajax.resonseText;
			if(mode == "createAcc" && ajax.responseText.includes("Duplicate")){
				alert("Username is already taken...\nPlease try again");
				return;
			}else if(mode == 'createAcc'){
				return;
			}
			var arr = JSON.parse(ajax.responseText);
			if (arr.length > 0) {
				for (var i = 0; i < arr.length; i++) {
					if(userName == arr[i].userName && password == arr[i].password && mode == 'signIn'){
						location.href = 'index.php?user='+arr[i].userName;
						return;	
					}
				}

		}alert("Invalid Username or Password...\nPlease try again");
		; 
	}
}
}
</script>
</html>