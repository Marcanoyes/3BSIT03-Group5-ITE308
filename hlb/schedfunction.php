<?php 

            $mysqli = new mysqli('localhost','root','','homelearning');
 			if (isset($_POST['addsched']))
            {
                $subjcode             = $_POST['subjcode'];
                $description          = $_POST['description'];
                $professor          		  = $_POST['professor'];
                $schedule          	  = $_POST['schedule'];
               
                
                $mysqli->query("INSERT INTO schedule (subjcode,description,professor,schedule)VALUES('$subjcode','$description','$professor','$schedule')") or die($mysqli->error);   
                header("location: schedule.php");
                exit;
            }
            if (isset($_GET['delete']))
            {
                $id = $_GET['delete'];
                $mysqli->query("DELETE FROM schedule WHERE id=$id") or die($mysqli->error());
                header("location: schedule.php");

            }


?>