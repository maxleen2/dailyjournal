<?php
date_default_timezone_set('Asia/Jakarta');

$servername = "localhost";
$Username = "root";
$password = "";
$db = "webdailyjournal";

//create connection 
$conn = new mysqli($servername,$Username,$password,$db);

//check connection
If($conn->connect_error){
    die("Connection failed : ".$conn->connect_error);
}

// echo "Connection succesfully<hr>";
?>