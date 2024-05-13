<!-- entry of marks from teacher -->
<?php 
include './db.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>result_portal</title>
</head>
<body>
    <div>
        <h1>Marks entry page</h1>
        <form action="marks.php" method="post">
            <p>enter your id</p>
            <input type="text" name="fac_id" placeholder="enter id">
            <p>enter subject id</p>
            <input type="text" name="sub_id" placeholder="sub_id">
            <p>enter programme</p>
            <input type="text" name="programme" placeholder="btech/mtech">
            <button type="submit" name= "submit">submit</button>
        </form>

        <?php
        session_start();
        if(isset($_POST['submit']))
        {
            $fac_id= trim($_POST['fac_id']);
            $sub_id= trim($_POST['sub_id']);
            $programme= trim($_POST['programme']);

            
            $sql= "select fac_id from subject where sub_id= ('$sub_id')";
            $chk = mysqli_query($conn, $sql);
            if(empty($fac_id) || empty($sub_id))
            {
                echo "please fill form completely";
            }
            else{
                if(mysqli_num_rows($chk)>0)
                {
                    $result= mysqli_fetch_assoc($chk);
                    if($result['fac_id']=== $fac_id)
                    {
                        $_SESSION['fac_id']=$fac_id;
                        $_SESSION['sub_id']=$sub_id;
                        $_SESSION['programme']=$programme;
                       header("Location: mentry.php?$fac_id#$sub_id");
                    // header("Location: mentry.php");
                    }
                    else
                    echo"not authoized to enter marks of ". $sub_id;

                }
                else
                echo "error ! retry";
            }

        }
        ?>

    </div>
</body>
</html>
