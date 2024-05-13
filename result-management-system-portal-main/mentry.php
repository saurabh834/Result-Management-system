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

    <h1> list of Students</h1>
    <?php
    session_start();
    $programme = $_SESSION['programme'];
    $fac_id = $_SESSION['fac_id'];
    $sub_id = $_SESSION['sub_id'];

    $curr_sem = "select sem  from subject where sub_id= ('$sub_id')";



    $result = mysqli_query($conn, $curr_sem);
    $x = $result->fetch_assoc();
    $sem = $x["sem"];

    if ($result) {
        $roll_arr = array();

        $sql = "SELECT roll, name, email
    FROM students
     where sem= ('$sem') and programme= ('$programme')";

        $result1 = mysqli_query($conn, $sql);

        if ($result1->num_rows > 0) {

    ?>
            <table class="table table-hover table-dark">
                <tr>
                    <th>Reg No</th>
                    <th>Name </th>
                    <th>Email</th>

                </tr>

                <?php
                while ($row = $result1->fetch_assoc()) {
                    echo "<tr><td>" . $row["roll"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td>";
                    array_push($roll_arr, $row["roll"]);
                }
                // print_r($roll_arr);

                ?>
            </table>




            <h1> enter marks</h1>
            <?php






            function grading($m1, $m2, $m3, &$score, $credit)
            {
                $sum = $m1 + $m2 + $m3;
                $grade = "";


                if ($sum < 15) {
                    $grade = "F";
                    $score = 0;
                } else if ($sum <= 29) {
                    $grade = "E";
                    $score = $credit * 2;
                } else if ($sum <= 44) {
                    $grade = "D";
                    $score = $credit * 4;
                } else if ($sum <= 54) {
                    $grade = "C";
                    $score = $credit * 6;
                } else if ($sum <= 64) {
                    $grade = "B";
                    $score = $credit * 7;
                } else if ($sum <= 74) {
                    $grade = "B+";
                    $score = $credit * 8;
                } else if ($sum <= 84) {
                    $grade = "A";
                    $score = $credit * 9;
                } else {
                    $grade = "A+";
                    $score = $credit * 10;
                }
                return $grade;
            }


            $sql = "select type from subject where sub_id =('$sub_id')";

            $sql1 =  "select credits from subject where sub_id =('$sub_id')";


            $chk = mysqli_query($conn, $sql);
            $chk1 = mysqli_query($conn, $sql1);

            $result = mysqli_fetch_all($chk);
            $result1 = mysqli_fetch_all($chk1);

            //  print_r ($result1);

            $x = $result1[0];
            $credit = $x[0];
            // echo $credit;
            // print_r($credit[0]);

            $y = $result[0];
            $type = $y[0];
            $entered_arr=array();

            if ($type === 't') {

              
                // echo "hello";
            ?>

                <form action="" method="post">
                    <p>Roll no</p>
                    <input type="text" name="roll" placeholder="enter roll no">
                    <p>End-sem</p>
                    <input type="number" name="m1" placeholder="enter marks">
                    <p>mid-sem</p>
                    <input type="number" name="m2" placeholder="enter marks">
                    <p>internals</p>
                    <input type="number" name="m3" placeholder="enter marks">
                    <p></p>
                    <button type="submit" name="submit">submit</button>
                </form>


                <?php

                if (isset($_POST['submit'])) {
                    $roll = $_POST['roll'];
                    $m1 = $_POST['m1'];
                    $m2 = $_POST['m2'];
                    $m3 = $_POST['m3'];
                    $score = 0;
                    // print_r($roll_arr);

                    if (!in_array($roll,$roll_arr) ) {
                        
                        echo "enter correct roll";
                        goto end;
                    }

                    // echo $m1;
                    // echo $m2;
                    // echo $m3;
                  
                   elseif($m1 + $m2 + $m3 > 100)
                        echo "enter correct marks";
                    else {
                        // array_push($entered_arr,$roll);
                        $entered_arr[]= $roll;
                        $grade = grading($m1, $m2, $m3, $score, $credit);
                        $total = $credit * 10;
                        $sql2 = "insert into marks_theory (subject_id,roll,sem,s1,s2,s3,score,total,grade) values ('$sub_id','$roll', '$sem','$m1', '$m2', '$m3','$score','$total','$grade')";

                        $update_entry="update  subject set marks_entered='1' where sub_id=('$sub_id')";
                        $result_entry= mysqli_query($conn, $update_entry);

                        $chk2 = mysqli_query($conn, $sql2);

                        if ($chk2)
                            echo "data updated successfully";
                        else
                            echo "error ! retry";
                    }
                //    var_dump($entered_arr);
                //    sort($entered_arr);
                //    sort($roll_arr);
                //     if($entered_arr==$roll_arr)
                //     {
                //         $update_entry="alter table subject set marks_entered=1 where sub_id=('$sub_id')";
                //         $result_entry= mysqli_query($conn, $update_entry);

                //     }
                }
                end:
            } else {
                ?>

                <form action="" method="post">
                    <p>Roll no</p>
                    <input type="number" name="roll" placeholder="enter roll no">
                    <p>External</p>
                    <input type="number" name="m1" placeholder="enter marks">
                    <p>internals</p>
                    <input type="number" name="m3" placeholder="enter marks">
                    <p></p>
                    <button type="submit" name="submit">submit</button>
                </form>
    <?php

                if (isset($_POST['submit'])) {
                    $roll = $_POST['roll'];
                    $m1 = $_POST['m1'];
                    $m3 = $_POST['m3'];
                    $score = 0;

                    if (!array_search($roll, $roll_arr)) {
                        echo "enter correct roll";
                        goto end1;
                    }

                    // echo $m1;

                    // echo $m3;

                    if ($m1 + $m3 > 100)
                        echo "enter correct marks";
                    else {
                        $grade = grading($m1, 0, $m3, $score, $credit);
                        $total = $credit * 10;
                        $sql2 = "insert into marks_lab (subject_id,roll,sem,s1,s2,score,total,grade) values ('$sub_id','$roll', '$sem','$m1', '$m3','$score','$total','$grade')";

                        $chk2 = mysqli_query($conn, $sql2);

                        if ($chk2)
                            echo "data updated successfully";
                        else
                            echo "record already exist";
                    }
                    end1:
                }
            }
        } else {
            echo "no students exist";
        }
    } else
        echo "error";
    ?>















</body>

</html>