<?php
// echo "hello";

include_once "./db.php";

$sql= "update students set sem= sem+1";
$sql1= "update subject set fac_id= NULL ,sem= NULL ";

$result=mysqli_query($conn, $sql);
$result1=mysqli_query($conn, $sql1);

if($result  && $result1)
{
        echo "successful";
}
else
{
    echo "Error !retry";
}




?>
