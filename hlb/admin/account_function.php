<?php 

            $mysqli = new mysqli('localhost','root','','homelearning');
            if (isset($_POST['register']))
            {
                $studid             = $_POST['studid'];
                $firstname          = $_POST['firstname'];
                $middlename         = $_POST['middlename'];
                $lastname           = $_POST['lastname'];
                $course             = $_POST['course'];
                $pnumber            = $_POST['pnumber'];
                $email              = $_POST['email'];
                $password           = $_POST['password'];
                $mysqli->query("INSERT INTO hlb_user (studid,firstname,middlename,lastname,course,pnumber,email,password)VALUES('$studid','$firstname','$middlename','$lastname','$course','$pnumber','$email','$password')") or die($mysqli->error);   
                header("location: admin_accounts.php");
                exit;
            }

            if (isset($_GET['delete']))
            {
                $id = $_GET['delete'];
                $mysqli->query("DELETE FROM hlb_user WHERE id=$id") or die($mysqli->error());
                header("location: admin_accounts.php");

            }

            if (isset($_GET['edit'])) 
            {
                $id = $_GET['edit'];
                $update= true;
                $result = $mysqli->query("SELECT * FROM hlb_user WHERE id=$id") or die($mysqli->error());
                if (mysqli_num_rows($result)==1) {
                    $row = $result->fetch_array();

                    $id = $row['id'];
                    $studid = $row['studid'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $course = $row['course'];
                    $pnumber = $row['pnumber'];
                    $email = $row['email'];
                    $username = $row['username'];
                    $password = $row['password'];
            }
}
?>