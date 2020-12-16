<?php
$keyword = $_POST['keyword'];
include "dbConfig.php";
#open connection
$con = mysqli_connect($host, $username, $password, $dbname) or die("Cannot connect to DB: $dbname on $host\n");
$sql = mysqli_query("SELECT name, description from TECH3720_2018F.Products_heyligej;");
if ($keyword == '*')
  $result = mysqli_query($con, "SELECT p.p_id,p.name,p.description, v.name as vendor, p.cost,p.sell_price,p.quantity FROM TECH3720_2018F.Products_heyligej p, TECH3720.VENDOR v WHERE p.v_id = v.vendor_id ORDER BY p.p_id");
else
  $result = mysqli_query($con, "SELECT p.p_id,p.name,p.description, v.name as vendor, p.cost,p.sell_price,p.quantity FROM TECH3720_2018F.Products_heyligej p, TECH3720.VENDOR v WHERE p.v_id = v.vendor_id and CONCAT(p.name,p.description) like '%$keyword%' ORDER BY p.p_id;");
if($result){
  echo "Product search result for keyword: $keyword\n";
    echo "<TABLE border=1>\n";
    echo "<TR><TH>P ID<TH>Product Name<TH>Description<TH>Vendor Name<TH>Cost<TH>Sell Price<TH>Quantity\n";
    while($row = mysqli_fetch_array($result)) {
      $pid = $row["p_id"];
      $pname = $row["name"];
      $desc = $row["description"];
      $vname = $row["vendor"];
      $cost = $row["cost"];
      $sellprice = $row["sell_price"];
      $quant = $row["quantity"];
      if($pid <>"")
          echo "<TR><TD>$pid<TD>$pname<TD>$desc<TD>$vname<TD>$cost<TD>$sellprice<TD>$quant\n";
    }
    echo "</TABLE>";
}
else
  echo "No product found for your search keyword: $keyword";

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