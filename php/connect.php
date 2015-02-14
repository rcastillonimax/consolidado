<?php
$servername = "localhost";
$username = "root";
$password = "n1M4xmysql1520";
//$dbname = "consolidado_schema";
// Create connection
//$link = new mysqli($servername, $username, $password);
$query="SET NAMES 'utf8'";
$link = mysqli_connect($servername, $username, $password);

// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
} //else echo "Link <br>".$link->stat();
mysqli_query($link,$query);
?>