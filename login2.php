<?php
$login = $_POST['username'];
$passwd = $_POST['password'];
include "dbConfig.php";
#open connection
$con = mysqli_connect($host, $username, $password, $dbname) or die("Cannot connect to DB: $dbname on $host\n");
$query = "SELECT name, login, password, role FROM TECH3720.EMPLOYEE Where login='$login' ";
$result = mysqli_query($con, $query);
$row = mysql_fetch_array($result);
$num=mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)) {
    $eid = $row["employee_id"];
    $eve_login = $row["login"];
    $eve_password = $row["password"];
    $name = $row["name"];
    $role = $row["role"];
  }
echo "<br><br>";

#get user IP address
$ip = @$_SERVER['HTTP_CLIENT_IP'] ?: @$_SERVER['HTTP_X_FORWARDED_FOR'] ?: @$_SERVER['REMOTE_ADDR'];

#Display IP address
echo "Your IP: $ip <br>";

#check if from Kean Domain
if(preg_match('%10\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})%', $ip) || preg_match('%131\.125\.([0-9]{1,3})\.([0-9]{1,3})%', $ip))
    echo "You are from the Kean University domain.";
else
    echo "You are <b>NOT</b> from Kean University.";

echo "<br>";

#Successful Login
if($eve_login == $login and $eve_password == $passwd){
    loggedIn("$name", "$role", "$eid");
}
#Wrong password
if($eve_login == $login and $eve_password != $passwd){
    wrongPassword("$login");
}
#Wrong Username
if($eve_password == $passwd and $eve_login != $login){
  wrongUserName("$login");

}
function loggedIn($name, $role, $e_id){
    echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/logout2.php">Logout</a>';
    echo "<br>Welcome user: $name <br>";
    echo "Role: $role <br>";
    echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/add_product.php">Add Products </a><br>';
    echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/display_update_products.php">Display/Update products </a>';
    setcookie("name",$name,time() + 36000);
}
function wrongPassword($login){
    echo "User $login is in the database, but the wrong password was entered <br> Please click ";
    echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/project2.html">here</a>';
    echo " to login.";
}
function wrongUserName($login){
    echo "User $login is not in the database. <br> Please click ";
    echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/project2.html">here</a>';
    echo " to login.";
} 
function logout($login){
    ob_end_clean();
    echo "$login has been successfully logged out";
    echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/project2.html">Project home page</a>';
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
<body <p style="width:100%; text-align:center; color:black; font-size: 20pt;">
</body>
</html>