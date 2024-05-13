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
    session_start();
    $fac_id= $_SESSION['fac_id'];
      if (isset($_POST['button1'])) {
        $sql = "SELECT sub_id, s_name,credits, sem  from subject where fac_id= ('$fac_id')";
       

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

    ?>
            <table  class="table table-hover table-dark">
                <tr>
                    <th>Subject id</th>
                    <th>Subject name </th>
                    <th>Credits</th>
                  
                    <th>Semester</th>
                </tr>
            
    <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["sub_id"] . "</td><td>" . $row["s_name"] . "</td><td>" . $row["credits"] . "</td><td>" . $row["sem"] . "</td>" ;
            }
        } else {
            echo "no subjects found ";
        }
    }


    ?>
    </table>
</body>
</html>