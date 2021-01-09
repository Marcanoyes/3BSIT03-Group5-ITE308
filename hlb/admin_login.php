<?php
include "function.php";
session_start();
if(isset($_POST['login']))
{
  $username =$_POST['username'];
  $password =$_POST['password'];

  if (empty($username) || empty($password))
  {
    echo '<script type="text/javascript">alert("Please Fill Up Before Logging In");</script>';
  }
  else
  {
    $query="SELECT * FROM hlb_admin WHERE username='".$username."' and password='".$password."'";
    $result = mysqli_query($con,$query);
    if(mysqli_fetch_assoc($result))
    {
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['password'] = $_POST['password'];
      header("location:admin_accounts.php");
    }
    else
    {
      echo '<script type="text/javascript">alert("Incorrect Username and Password");</script>';
    }
  }
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
    <title>HomeLearning Buddy</title>
</head>
<body>
    <div class="bgimg">
      <div class="centerdiv">
        <img src="assets/userlogin.png" id="profilepic">
        <h2>HomeLearning Buddy</h2>
        <form method="post">
          <div class="input_container">
            <div class="input_container">
            
              <input placeholder="Email" class="inputbox" type="text" name="username" required>
              <i class="fa fa-user"></i>
            </div>
            <div class="input_container">
              
              <input placeholder="Password" class="inputbox" type="password" name="password" required>
               <i class="fa fa-lock"></i>
            </div>

            <hr class="mb-12">
            <button type="submit" name="login" value="Log In"> LOGIN </button>
          
          </div><br>
        </form>
      </div>
    </div>
</body>
</html>