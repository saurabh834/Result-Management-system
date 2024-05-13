<?php
include_once "./db.php";
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
  include_once "./navar.php";
    ?>
   

  


    <div>Admin
        <div>
            <button type="submit" onclick='window.location.href="changesem.php"'>changesem</button>
        </div>
        <br>


        <!-- <button type="submit" onclick='window.location.href="course_entry.php"'>start course entry / stop marks entry  </button>
     </div>
     <div>
     <button type="submit" onclick='window.location.href="marks_entry.php"'>start marks entry /stop course entry</button>
     </div> -->



        <div>

            <form method="post">
                <input type="submit" name="button1" value="start course entry / stop marks entry " />
            </form>
            <form method="post">
                <input type="submit" name="button2" value="start marks entry /stop course entry" />
            </form>
            <form method="post">
            <input type="submit" name="button4" value="list of teachers who did not choose subjects" />
                
            </form>

            <form method="post">
                <input type="submit" name="button3" value="list of teachers who did not submit marks " />
            </form>

            <form method="post" >
                <input type="text" name= "roll" placeholder="Reg_no"/>
                <input type="submit" name="button5" value="block result" />
                <input type="submit" name="button6" value="unblock result" />
            </form>

            <!-- <form method="post" action="unblock.php">
            <input type="text" name= "roll" value="Reg_no"/>
                <input type="submit" name="button6" value="unblock result" />
            </form> -->
            <form method="post">
                <input type="submit" name="button7" value="list of blocked results" />
            </form>

        </div>

        <?php
        if (isset($_POST['button5'])) {
            $roll= trim($_POST['roll']);
            $sql = "update students set blocked =1 where roll= ('$roll') ";
           
            $result= mysqli_query($conn, $sql);

        
            if ($result ) {
              echo "blocked";
            } else {
                echo "wrong reg no";
            }
        }
        if (isset($_POST['button6'])) {
            $roll= trim($_POST['roll']);
            $sql = "update students set blocked =0 where roll= ('$roll') ";
           
            $result= mysqli_query($conn, $sql);

        
            if ($result ) {
              echo "unblocked";
            } else {
                echo "wrong reg no";
            }
        }

        if (isset($_POST['button7'])) {
            $sql = "SELECT roll, name, email,programme
            FROM students
           where blocked= 1";
        
            $result = mysqli_query($conn, $sql);
        
            if ($result->num_rows > 0) {
        
        ?>
                <table  class="table table-hover table-dark">
                    <tr>
                        <th>Reg_no</th>
                        <th>Name </th>
                        <th>Email</th>
                        <th>Programme</th>
                        
                    </tr>
                
        <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["roll"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"]."</td><td>".$row["programme"]."</td>";
                }
            } else {
                echo "error !retry";
            }
        }
        
        
        ?>
        </table>
        <?php
        


        if (isset($_POST['button1'])) {
            $sql = "update admin set course_entry =1 , marks_entry=0";
            $sql1= "update faculty  set suject_chosen=0";
            $result1= mysqli_query($conn, $sql1);

            $result = mysqli_query($conn, $sql);
            if ($result && $result1) {
                echo "course entry started , marks entry ended";
            } else {
                echo "error !retry";
            }
        }
        if (isset($_POST['button2'])) {
            $sql = "update admin set course_entry =0 , marks_entry=1";
            $sql1 = "update subject set marks_entered= false";

            $result = mysqli_query($conn, $sql);
            $result1 = mysqli_query($conn, $sql1);

            if ($result and $result1) {
                echo "marks entry started , course  entry ended";
            } else {
                echo "error !retry";
            }
        }
        if (isset($_POST['button3'])) {
            $sql = "SELECT faculty.*, subject.s_name, subject.sem
            FROM faculty
            INNER JOIN subject
            ON faculty.fac_id = subject.fac_id and subject.marks_entered=0 order BY fac_id;";

            $result = mysqli_query($conn, $sql);

            if ($result->num_rows > 0) {

        ?>
                <table  class="table table-hover table-dark">
                    <tr>
                        <th>Faculty id</th>
                        <th>Faculty name </th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Semester</th>
                    </tr>
                
        <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["fac_id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["s_name"] . "</td><td>" . $row["sem"];
                }
            } else {
                echo "error !retry";
            }
        }


        ?>
        </table>


        <?php

if (isset($_POST['button4'])) {
    $sql = "SELECT fac_id, name, email
    FROM faculty
   where subject_chosen= 0";

    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {

?>
        <table  class="table table-hover table-dark">
            <tr>
                <th>Faculty id</th>
                <th>Faculty name </th>
                <th>Email</th>
                
            </tr>
        
<?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["fac_id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"]."</td>";
        }
    } else {
        echo "error !retry";
    }
}


?>
</table>
       


    </div>
</body>

</html>