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
    <div>student hello </div>
    <?php
    session_start();
    if (isset($_GET['submit'])) {
        $roll = trim($_GET['id']);
        $sql = "select * from students where roll= ('$roll')";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $blocked = $row["blocked"];
            if ($blocked) {
                echo "Your Result is Blocked .Contact System admin";
                goto end;
            }

            $sem = $row["sem"];
            $programme = $row["programme"];
            echo $sem;
            echo $programme;

    ?>
            <form method="post" action="">
                <input type="submit" name="button1" value="Show current sem result " id="btn1" />
            </form>

            <form method="post" action="">
                <input type="submit" name="button2" value="Show transcript " id="btn1" />
            </form>

            <form method="post" action="">
                <input type="submit" name="button3" value="List of courses" id="btn1" />
            </form>

            <!-- <form method="post" action="">
        <input type="submit" name="button4" value="Download transcipt pdf " id="btn1" />
    </form> -->



            <?php
            if (isset($_POST['button1'])) {

                $sum_score = 0;
                $total_score = 0;
                $sql = "select *  from marks_theory where sem=('$sem')  and roll = ('$roll')";
                $sql1 = "select * from marks_lab where sem=('$sem')  and roll = ('$roll')";
                $sql2 = "select count(sem) as sub_count , sum(credits) as total_credits  from subject  where sem= ('$sem') and programme= ('$programme')";
                $sql3="select  count(*) as theory_count from marks_theory where sem=('$sem')  and roll = ('$roll')";
                $sql4 = "select  count(*) as lab_count from marks_lab where sem=('$sem')  and roll = ('$roll')";

                $sub_count = 0;


                $result = mysqli_query($conn, $sql);
                $result1 = mysqli_query($conn, $sql1);
                $result3 = mysqli_query($conn, $sql3);
                $result4 = mysqli_query($conn, $sql4);

                $result2 = mysqli_query($conn, $sql2);
                if ($result2->num_rows>0) {
                    $row = $result2->fetch_assoc();
                    
                    $sub_count = $row["sub_count"];
                    $credits = $row["total_credits"];
                }


                if ($result3->num_rows>0 || $result4->num_rows>0) {
                    $row1 = $result3->fetch_assoc();
                    $theory_count = $row1["theory_count"];
                    // echo $theory_count;
                    // $result->data_seek(0);
                    $row2 = $result4->fetch_assoc();
                    $lab_count = $row2["lab_count"];
                    // echo $lab_count;
                    // $result1->data_seek(0);                    


                    if ($lab_count + $theory_count == $sub_count) {
            ?>
                        <table class="table table-hover table-dark">
                            <tr>
                                <th>Subject id</th>
                                <!-- <th>Subject name </th> -->
                                <th>Grade</th>

                            </tr>
                            <?php
                            $spi=0;
                            if ($result->num_rows > 0 and $result1->num_rows>0) {
                               
                                while ($roww = $result->fetch_assoc()) {
                                    echo "<tr><td>" . $roww["subject_id"] . "</td><td>"  . $roww["grade"] . "</td>";
                                    // echo "hello";
                                    $sum_score =   $sum_score +$roww["score"];
                                    // $total_score = $total_score + $roww["total"];
                                  
                                }
                                while ($rowe = $result1->fetch_assoc()) {
                                    echo "<tr><td>" . $rowe["subject_id"] . "</td><td>"  . $rowe["grade"] . "</td>";
                                    $sum_score =   $sum_score +$rowe["score"];
                                    // $total_score = $total_score +$rowe["total"];
                                  
                                }
                                if($credits!=0)
                                $spi= $sum_score/$credits;
                            ?>
                        </table>

                        <div class="button">
                            <button onclick="window.print()">Print Result</button>
                        </div>

            <?php

                                echo "<h3>spi = " .number_format((float)$spi, 2, '.', ''). " </h3>";

                                $insert_spi = "insert into result (roll,sem,spi,credits) values ('$roll', '$sem','$spi', '$credits')";
                                $result_insert= mysqli_query($conn,$insert_spi);

                                $cpi = 0;
                                $x = 0;

                                $sql_cpi = "select * from result where roll= ('$roll')";
                                $result_sql_cpi = mysqli_query($conn, $sql_cpi);
                                if ($result_sql_cpi->num_rows > 0) {
                                    while ($row = $result_sql_cpi->fetch_assoc()) {
                                        $cpi = $cpi + $row["spi"] * $row["credits"];
                                        $x = $x + $row["credits"];
                                    }

                                    echo "<h3> cpi = " .number_format((float)$cpi/$x, 2, '.', ''). " </h3>";
                                }
                            }
                        }
                    }
                } 
               
            }
            else {
                echo   "result not available";
            }





            if (isset($_POST['button2'])) {

                $sql = "select * from result where roll= ('$roll') order by sem";

                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0) {
            ?>
            <table class="table table-hover table-dark">
                <tr>
                    <th>Semester</th>
                    <th>SPI</th>

                </tr>

                <?php
                    $cpi = 0;
                    $x = 0;

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["sem"] . "</td><td>"  . $row["spi"] . "</td>";
                        $cpi = $cpi + $row["spi"] * $row["credits"];
                        $x = $x + $row["credits"];
                    }
                ?>
            </table>

            <div class="button">
                            <button onclick="window.print()">Print </button>
                        </div>
        <?php

echo "<h3> cpi = " .number_format((float)$cpi/$x, 2, '.', ''). " </h3>";
                }
            }

            if (isset($_POST['button3'])) {

                $sql = "select * from subject where sem=('$sem') and programme= ('$programme')";

                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0) {
        ?>
            <table class="table table-hover table-dark">
                <tr>
                    <th>Subject id</th>
                    <th>Subject Name</th>
                    <th>Credits</th>

                </tr>

                <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["sub_id"] . "</td><td>"  . $row["s_name"] . "</td><td>" . $row["credits"];
                    }
                ?>
            </table>
<?php

                }
            }
        } else {
            echo "record not found";
        }


        end:



?>


</body>

</html>