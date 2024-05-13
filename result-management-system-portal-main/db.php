<?php
//  params to connect to  a database

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "result_portal";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName); 

if($conn)
{

}
else
{
    die("database connection unsuccessful");
}

?>
