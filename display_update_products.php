<?php
include "dbConfig.php";
if(!isset($_COOKIE["name"])){
	echo "You have not logged in. Please click ";
	echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/project2.html">here</a>';
	echo " to login.";
	exit;
}
echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/logout2.php">User Logout</a>';
echo "<br>You can only update the description, cost, sell price and quantity.\n";
#open connection
$con = mysqli_connect($host, $username, $password, $dbname) or die("Cannot connect to DB: $dbname on $host\n");
$result = mysqli_query($con, "SELECT p.p_id,p.name,p.description, v.name as vendor, e.login, p.cost,p.sell_price,p.quantity FROM TECH3720_2018F.Products_heyligej p, TECH3720.VENDOR v, TECH3720.EMPLOYEE e WHERE p.v_id = v.vendor_id and p.e_id = e.employee_id ORDER BY p.p_id");
if($result){
    echo "<TABLE border=1>\n";
    echo "<TR><TH>Product ID<TH>Product Name<TH>Description<TH>Cost<TH>Sell Price<TH>Quantity<TH>Login ID<TH>Vendor Name\n";
    while($row = mysqli_fetch_array($result)) {
      $pid = $row["p_id"];
      $pname = $row["name"];
      $desc = $row["description"];
      $cost = $row["cost"];
      $sellprice = $row["sell_price"];
      $quant = $row["quantity"];
      $login = $row["login"];
      $vname = $row["vendor"];
      if($pid <>"")
          echo "<TR><TD>$pid<TD>$pname<TD>$desc<TD>$cost<TD>$sellprice<TD>$quant<TD>$login<TD>$vname\n";
    }
    echo "</TABLE>";
}

#free result set
mysqli_free_result($result);
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
<body <p style="width:100%; color:black; font-size: 20pt;">
</body>
</html>