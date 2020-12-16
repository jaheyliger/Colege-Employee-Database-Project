<?php
include "dbConfig.php";
if(!isset($_COOKIE["name"])){
	echo "You have not logged in. Please click ";
	echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/project2.html">here</a>';
	echo " to login.";
	exit;
}
#open connection
$con = mysqli_connect($host, $username, $password, $dbname) or die("Cannot connect to DB: $dbname on $host\n");
echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/logout2.php">Logout</a>';
echo "<br>";

#free result set
mysqli_free_result($result);
#close connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<style type ="text/css">
body {
    background-color: lightblue;
}
</style>
<body <p style="width:100%; text-align:center; color:black; font-size: 20pt;">
	<form action="insert_product.php" method="POST">
			<b>Add Product</b>
			<br>
			Product Name:
            <input type="text" name="pName" required="required">
	        <br>Description:
            <input type="text" name="description" required="required">
            <br>Cost:
            <input type="text" name="cost" required="required">
            <br>Sell Price:
            <input type="text" name="sellPrice" required="required">
            <br>Quantity:
            <input type="text" name="quantity" required="required">
            <br>Select a Vendor:
            <select name="vendor">
            	<option value="Kean">Kean</option>
            	<option value="York">York</option>
            	<option value="CCC">CCC</option>
            	<option value="XYZ">XYZ</option>
            	<option value="MMM">MMM</option>
            </select>
            <input type="submit" value="Submit">
	</form>	
</body>
</html>