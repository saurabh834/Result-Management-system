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
    <div>student</div>
    <!-- <?php
    // session_start();
    // if(isset($_GET['submit']))
    // {
    //     $roll= trim($_GET['id']);
    //    $sql= "select * from studenta where roll= ('$roll')";

    //    $result= mysqli_query($conn, $sql);
    //    if(mysqli_num_rows($result)>0)
    //    {
    //     $_SESSION['roll']= $roll;
    //     header("Location: student_page.php?id=$roll");
    //    }
    //    else
    //    {
    //     echo "record not found";
    //    }


    // }
    ?> -->

    <div>
    <form action="student_page.php" method="get">
        <p>enter your id</p>
    <input type="text" name="id" placeholder="Reg_no">
    
    <button type="submit" name="submit"> submit</button>
    </form>

   

   

</div>

</body>
</html>