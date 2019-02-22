<?php



$conn = new mysqli("localhost","root","","card");//mysqli(hostname,username,password,database);
if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
}

mysqli_query("set character set utf8",$conn);
mysqli_query("SET CHARACTER_SET_database= utf8",$conn);
mysqli_query("SET CHARACTER_SET_CLIENT= utf8",$conn);
mysqli_query("SET CHARACTER_SET_RESULTS= utf8",$conn);

?>
