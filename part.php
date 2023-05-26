<?php 


$host = "";
$dbname = "";
$password = "";

$check = mysqli_connect($host, $dbname, $password);

if (!$check) {
    echo "Connection Established!!.";
} else {
    echo "Check your connetions and try agin later";
}