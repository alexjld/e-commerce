<?php
$userID = $_GET['user'];
echo "Welcome, " . $userID. "!". PHP_EOL;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Shop 337</title>
<link rel="stylesheet" href="indexStyle.css">
</head>
<br>
<input type="button" value="Sign out" onclick="signOut()">
<body>
	<h1>Shop 337</h1>

	<div class="filterArea">
		Category<select id="categoryChosen">
			<option selected="selected" value="all">all</option>
			<option value="shoes">Shoes</option>
			<option value="supplies">Supplies</option>
			<option value="apparel">Apparel</option>
			<option value="decor">Decor</option>
			<option value="electronics">Electronics</option>
		</select> Location<select id="locationChosen">
			<option selected="selected" value="all">all</option>
			<option value="Target">Target</option>
			<option value="Costco">Costco</option>
			<option value="Adidas">Adidas</option>
			<option value="Walmart">Walmart</option>
		</select> Price (less than or equal to) <input type="text"
			id="priceChosen" value=5000 pattern="[0-9]" required> <input type="submit"
			onClick='filterHandler()'>


	</div>
	<div id="shoppingCartArea">
		<b>SHOPPING CART</b> <br>
		
	</div>
	<div id="contentArea">

	</div>

	<script>

	var cartContents = {};
	var cartPrice = {};
	
	function signOut(){
		location.href="login.php";
	}
	
	function addToCart(productName, storeId){

		console.log(productName);

		var price = 0;

		console.log(price);

		//price = price + parseInt(storeId);

		//console.log(price);
		
		
		document.getElementById("shoppingCartArea").innerHTML = "";

		if (!(productName in cartContents)){
			cartContents[productName] = 1;
			
		}
		else if (productName in cartContents){
			cartContents[productName] +=1;
			
		}

		if (!(productName in cartPrice)){
			
			cartPrice[productName] = parseInt(storeId);
		}
		else if (productName in cartPrice){
			cartPrice[productName] += parseInt(storeId);
		}

		console.log(cartPrice);
		
		Object.keys(cartContents).forEach(function(key) {

			   document.getElementById("shoppingCartArea").innerHTML += (key + " - " + cartContents[key] +" |  $"+ cartPrice[key] +"<br>");
			   //console.log(price);
			   price = price + cartPrice[key];
			   			   
			});
		
		document.getElementById("shoppingCartArea").innerHTML += "<hr>";
		document.getElementById("shoppingCartArea").innerHTML += "<b> Your Order Total: $" + price + "</b><br><br>";
		document.getElementById("shoppingCartArea").innerHTML += '<button type="submit" value="Purchase Order" id="confirm" onclick="confirm(price)"> Purchase Order ';

		console.log(price);
		;		
	}
	function confirm(price) {

		alert('Your order has been confirmed. thanks!');
		document.getElementById("shoppingCartArea").innerHTML = "<b>SHOPPING CART</b> <br>";

	}
	function filterHandler(){
		var location = document.getElementById("locationChosen").value;
		var category = document.getElementById("categoryChosen").value;
		var price = document.getElementById("priceChosen").value;
		databaseSearch('search',location, category, price);
	}

	function databaseSearch(mode, location, category, price) {

		var ajax = new XMLHttpRequest();
		
		ajax.open("GET", "controller.php?mode=search&location=" + location+ "&category=" + category + "&price=" + price, true); 
		ajax.send();
		
		ajax.onreadystatechange = function() {
			if (ajax.readyState == 4 && ajax.status == 200) {
				var arr = JSON.parse(ajax.responseText);
				var output = "";
				if (arr.length > 0) {
					output += "<div class='concertInfoArea'><b>Showing "+arr.length+"/"+arr.length+" results.<b></div>";
					for (var i = 0; i < arr.length; i++) {

						output += '<div class="concertInfoArea" id="'+arr[i].productId+'"><div id="dateTime">'+arr[i].delivery_date+'</div><div id="price">$'+arr[i].price+'</div><div id="location">'+arr[i].location+'</div><div id="eventArea">'+arr[i].productName+'</div><div id="addToCartArea"><button type="button" id="'+arr[i].price+'" onclick="addToCart(\''+arr[i].productName+'\',\''+ arr[i].price+'\')">Add to Cart</button></div></div>';
					}
			}else{
				output += "<div class='concertInfoArea'>No results found.</div>";
			}document.getElementById("contentArea").innerHTML = output;
			; 
		}
	}
	}


</script>

</body>
</html>
