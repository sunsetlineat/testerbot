<?php 
//set database
$hostname = "localhost";
$username = "root";
$password = "";

// Create connection
$link = mysqli_connect("$hostname", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($link, 'notify')or die("cannot select DB");

$conn = new mysqli($hostname, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    //echo "Connected successfully";
} 

$strSQL = "SELECT * FROM 'res_notify' ";
//$objQuery = mysql_query($strSQL) or die (mysql_error());


?>