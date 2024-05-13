<?php 
include_once './db.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<title>result_portal</title>
</head>

<body>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php
  include "./navar.php";
    ?>

    <div>
        teacher


        <?php
    $sql= "select * from admin";
    $result= mysqli_query($conn, $sql);
    if($result )
    {
        $row= $result->fetch_assoc();
        if($row["course_entry"]==1)
   {
?>

        <!-- <button type="button" onclick="window.location.href='select.php'">Select subjects</button> -->

        <form method="post" action="select.php">
            <input type="submit" name="button1" value="select subjects" id="btn1" />
        </form>
        <script>
     window.onload = function(){
        document.getElementById("btn2").style.display = "none";

   }
   </script>
   <?php
}
   else
   {
 
?>
        <!-- <button type="button" onclick="window.location.href='marks.php'">enter marks</button> -->
        <script>
        window.onload = function(){
        document.getElementById("btn1").style.display = "none";
     }
     </script>
        <form method="post" action="marks.php">
            <input type="submit" name="button1" value="Enter marks" id="btn2" />
        </form>
        <?php
   }
}
else
{
    echo "database error! retry";
}
?>

<!-- 
        <button type="button" onclick="window.location.href='display_subjects.php'">display subjects</button> -->

        <form method="post" action="display_subjects.php">
            <input type="submit" name="button1" value="display_subjects" id="btn3" />
        </form>
       

    </div>
</body>

</html>