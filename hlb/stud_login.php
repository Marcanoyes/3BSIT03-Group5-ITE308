
<?php
include "function.php";
session_start();
if(isset($_POST['login']))
{
  $studid =$_POST['studid'];
  $password =$_POST['password'];

  if (empty($studid) || empty($password))
  {
    echo '<script type="text/javascript">alert("Please Fill Up Before Logging In");</script>';
  }
  else
  {
    $query="SELECT * FROM hlb_user WHERE studid='".$studid."' and password='".$password."'";
    $result = mysqli_query($con,$query);
    if(mysqli_fetch_assoc($result))
    {
      $_SESSION['studid'] = $_POST['studid'];
      $_SESSION['password'] = $_POST['password'];
      header("location:snote.php");
    }
    else
    {
      echo '<script type="text/javascript">alert("Incorrect StudentID or Password");</script>';
    }
  }
}

$mysqli = new mysqli('localhost','root','','homelearning');
if (isset($_POST['register']))
            {
                $studid             = $_POST['studid'];
                $firstname          = $_POST['firstname'];
                $lastname           = $_POST['lastname'];
                $course             = $_POST['course'];
                
                $email              = $_POST['email'];
                $password           = $_POST['password'];
                $mysqli->query("INSERT INTO hlb_user (studid,firstname,lastname,course,email,password)VALUES('$studid','$firstname','$lastname','$course','$email','$password')") or die($mysqli->error);   
                header("location: stud_login.php");
                exit;
            }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/stylelogin.css">
    <link rel="stylesheet" href="css/stylenotes.css">
    <title>HomeLearning Buddy</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <script src="js/clickActive.js"></script>
    <script src="js/datepicker.js"></script>
</head>
<body>

  <div class="bgimg">
      <div class="centerdiv">
        <img src="assets/userlogin.png" id="profilepic">
        <h2>HomeLearning Buddy</h2>
        <form method="post">
          <div class="input_container">
            <div class="input_container">
            
              <input placeholder="Student ID" class="inputbox" type="text" name="studid" required>
              <i class="fa fa-user"></i>
            </div>
            <div class="input_container">
              
              <input placeholder="Password" class="inputbox" type="password" name="password" required>
               <i class="fa fa-lock"></i>
            </div>
<br><br>
            <hr class="mb-12">
            <button type="submit" name="login" value="Log In"> LOGIN </button>
            <br><br>
            <div class="forgot_section">
<br><br>
            <a href="#" id="button">Create account</i></a>
        </div>
          
          </div><br>
        </form>
      </div>

    </div>
     
         <div class="bg-modal">
            <div class="modal_content">
                <div class="close"><i class="fa fa-times fa-sm" aria-hidden="true"></i></div>
                    <div class="head"><h5>CREATE ACCOUNT</h5></div>
                    <div class="inputTitle">
                        <form method="post" > 
                        <label >Student ID</label>
                        <input class="form-control" type="text" name="studid" required>
                        <label >First Name</label>
                        <input class="form-control" type="text" name="firstname" required>
                        <label >Last Name</label>
                        <input class="form-control" type="text" name="lastname" required>
                        <label >Course</label>
                        <select name="course" style="margin-top: 10px; margin-left: 10px;">
                            <?php 
                                $res = mysqli_query($mysqli,"SELECT `course` FROM `course`");
                                while ($row=mysqli_fetch_array($res)) {
                            ?>
                            <option><?php echo $row["course"];?></option>
                            <?php 
                                }
                             ?>
                        </select>
                        <br>
                        <label >Email</label>
                        <input class="form-control" type="email" name="email" required>
                        <label >Password</label>
                        <input class="form-control" type="password" name="password" required>

                       <input style="margin-top: 10px;" type="submit" name="register" value="Register" class="btn btn-primary form-control">
                     </form>
                        <!-- <input type="button" id="submit" value="Submit"> -->
                    </div><!-- inputTitle -->
            </div><!-- modal_content -->
         </div> <!-- bg-modal end -->
   
    
    
    <script>
        document.getElementById('button').addEventListener("click", function() {
      document.querySelector('.bg-modal').style.display = "flex";
        });

        document.querySelector('.close').addEventListener("click", function() {
      document.querySelector('.bg-modal').style.display = "none";
        });
    </script>

    <script>
        document.getElementById('btn').addEventListener("click", function() {
        document.querySelector('.bg-modal').style.display = "flex";
        });

        document.querySelector('.close').addEventListener("click", function() {
        document.querySelector('.bg-modal').style.display = "none";
     });
    </script>
  
    

    


</body>
</html>