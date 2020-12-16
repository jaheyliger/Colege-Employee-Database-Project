<?php 
#ask if the name cookie is set to see if the user has actually logged int
if(!isset($_COOKIE["name"])) {
    echo "You didn't login. Please click";
    echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/project2.html"> here </a>';
    echo "to login. <br>";
    echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/project2.html">Project Home Page</a>';
} 
else {
#print the name and print that the user is logged out and then sets the cookie in the past to delete it
    echo $_COOKIE["name"];
    echo " has been successfully logged out. <br> <br>";
    echo '<a href="http://eve.kean.edu/~heyligej/TECH3720/project2.html">Project Home Page</a>';
    setcookie("name",$name,time() - 36000);
}   
?>