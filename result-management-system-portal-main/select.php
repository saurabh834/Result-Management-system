<!-- selection of subjects -->
<?php

use function PHPSTORM_META\type;

include_once './db.php';
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
        <h1> select subjects </h1>
        <form action="select.php" method="post">
            <input type="text" name="fac_id" placeholder="enter your id  ">
            <p> enter subject-id </p>
            <input type="text" name="subject_id" placeholder="enter ids" id="">
            <button type="submit" name="submit">Submit</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $fac_id = trim($_POST['fac_id']);
            $subjects = trim($_POST['subject_id']);
            // $subjects = $subjects.",";
            // $subject = [];
            // $i = 0;
            // $j = 0;
            // // strtoupper($subjects);
            // // function upper($str)
            // // {
            // //     $i=0;
            // //     $l= strlen($str);
            // //     $str1= str_split($str);
            // //     $ans= "";
            // //     while($i<$l)
            // //     {
                    
            // //         if($str1[$i]>='a' && $str1[$i]<='z')
            // //         {
            // //             $str1[$i]=  $str1[$i]- 32;

                       
            // //         }
            // //         $ans= $ans.$str1[$i];
            // //         $i++;
                  
            // //     }
            // //     return $ans;
            // // }
            // // $subjects= upper($subjects);
            // // echo $subjects;
            // $length = strlen($subjects);
            // while ($i < $length) {
            //     if (($subjects[$i] >= 'A' && $subjects[$i] <= 'Z') || ($subjects[$i] >= 'a' && $subjects[$i] <= 'z') || ($subjects[$i] >= '0' && $subjects[$i] <= '9') || $subjects[$i] == '-' ||  $subjects[$i]==','  ) {
            //         if ($subjects[$i] == ',') {
            //             array_push($subject, substr($subjects, $j, $i - $j));
            //             $j = $i + 1;
            //         } 
                   
            //     } else {
            //         echo "enter valid subject ids . Retry";
            //         // unset($subject);
            //         $subject= [];
            //         break;
            //     }
            //     $i++;
            // }
            // // print_r(
            // //     $subject
            // // );
            // // $imploded_arr = implode(', ', array_map('mysql_real_escape_string', $subject));
            // // print_r($imploded_arr);
            // //    echo  gettype($subject);
            $check= "select *  from subject where sub_id= ('$subjects')";
            
                $result= mysqli_query($conn, $check);
                if($result->num_rows <=0)
                {
                    echo "subject id not found , retry";
                }
                else
                {

                    $update_fac_id = "update subject set fac_id = '$fac_id' where  sub_id= ('$subjects')";
                    $sql= "update faculty set subject_chosen= 1 where fac_id= '$fac_id'";
                    $result= mysqli_query($conn, $sql);
                    $chk = mysqli_query($conn, $update_fac_id);
                    if (empty($subjects)) {
                        echo "<br>Please Provide subject id";
                    } else {
                        if ($chk && $result)
                            echo "<center>data updated</center>";
                        else
                            echo " <center>update FAILED . retry</center>";
                    }
                }
        }
        ?>


    </div>
</body>

</html>