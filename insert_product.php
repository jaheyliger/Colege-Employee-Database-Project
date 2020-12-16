<?php
include "dbConfig.php";

#check if user is logged in 
if(!isset($_COOKIE["name"])){
	echo "You have not logged in. Please click ";
	echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/project2.html">here</a>';
	echo " to login.";
	exit;
}
#if so, assign the employee name equal to the name of the logged in user
else
	$employee_name = $_COOKIE["name"];

$productName = $_POST['pName'];
$desc = $_POST['description'];
$cost = $_POST['cost'];
$sell_price = $_POST['sellPrice'];
$quantity = $_POST['quantity'];
$vendor_id = $_POST['vendor'];

#open connection
$con = mysqli_connect($host, $username, $password, $dbname) or die("Cannot connect to DB: $dbname on $host\n");
$result = mysqli_query($con, "SELECT name FROM TECH3720_2018F.Products_heyligej WHERE name = '$productName'");
$row = mysqli_num_rows($result);

$query = mysqli_query($con,"SELECT employee_id FROM TECH3720.EMPLOYEE WHERE name = '$employee_name'");
if($query){
	while($row1 = mysqli_fetch_array($query)){
		$eid = $row1["employee_id"];
	}
}

if($row > 0){
	echo "<br>Product name exists in the table already!\n";
	echo "Please enter a different product name\n";
	echo "<br>";
	echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/add_product.php">Return to previous page</a>';
}
else{
	if(($cost < 0) || ($sell_price < 0)){
		echo "The quantity, cost, and selling price must all be non-negative values.";
		echo "<br>";
		echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/add_product.php">Return to previous page</a>';
	}
	else if($sell_price < $cost){
		echo "The sell price should be more that than the cost of the product.";
		echo "<br>";
		echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/add_product.php">Return to previous page</a>';
	}
	else if($quantity < 0){
		echo "Quantity must be a non-negative value.";
		echo "<br>";
		echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/add_product.php">Return to previous page</a>';
	}
	else{
		#$usertable = "TECH3720_2018F.Products_heyligej";
		$sql = "INSERT INTO TECH3720_2018F.Products_heyligej (name, description, cost, sell_price, quantity, v_id, e_id) VALUES ('$productName', '$desc', '$cost','$sell_price','$quantity', '$vendor_id', '$eid')";
		$result2 = mysqli_query($con, $sql);
		echo "Successfully insert the product: $productName";
		echo "<br><br>";
		echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/add_product.php">Click to add another product</a>';
	}
} 

#free result set
mysqli_free_result($result2);
#close connection
mysqli_close($con);
?>
<html>
<head>
<style type ="text/css">
body {
    background-color: lightblue;
}
</style>
</head>
<body <p style="width:100%; text-align:center; color:black; font-size: 20pt;">
</body>
</html>