<?php
session_start();
if (!isset($_SESSION['studid']))
{
   echo "<script>alert('Login First!'); location.href='stud_login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/stylecalendar.css">
    <title>Calendar</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <script src="js/clickActive.js"></script>
    

</head>
<body>
    <div class="main_container">

        <?php 
    $mysqli = new mysqli('localhost','root','','homelearning') or die(mysqli_error($mysqli));

    $result = $mysqli->query("SELECT * FROM hlb_user") or die($mysqli->error);

    //pre_r($result);
?>
        <div class="header1">
            <div class="infos">
                <div style="margin-top: 10px; margin-left: 10px;">
                    <img src="assets/iconWhite.png" style="height: 30px; width: 30px;" >
                </div>
                
                <div style="color: #e1e1e1; margin-left: 10px;" >
                    <?php 
                    while ($row = mysqli_fetch_assoc($result))
                      {
                        ?>
                    <h6 style="font-size: 14px; margin-top: 5px;"><?= $row['firstname']; ?> <?= $row['lastname']; ?></h6> 
                    <h6 style="font-size: 13px; "><?= $row['course']; ?></h6> 
                    <!-- <p>Course</p> -->
                    <?php 
                    } ?>
                </div>
            </div>
        </div>

        <div class="header2">
            <div class="month">
                <i class="fa fa-angle-left prev"></i> &nbsp;&nbsp;
                <i class="fa fa-angle-right next"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="date">
                    <h1></h1>
                    <p></p>
                </div>
                <!-- <i class="fa fa-angle-right next"></i> -->
              </div>
            
        </div>

        <div class="nav">

            <div class="sidebar ">
                <div class="tabs">
                    <li class="active">
                        <i class="fa fa-sticky-note-o fa-2x" aria-hidden="true"></i>
                        <a href="snote.php"><span>Notes</span></a>
                    </li>
                    <li>
                        <i class="fa fa-calendar-o fa-2x" aria-hidden="true"></i>
                        <a href="calendar.php"><span>Calendars</span></a>
                    </li>
                    <li>
                        <i class="fa fa-list-alt fa-2x" aria-hidden="true"></i>
                        <a href="schedule.php"><span>Schedule</span></a>
                    </li>
                    <hr>
                    <br><br><br><br><br><br><br><br><br><br><br><br>

                    
                    
            
                    <div class="signout">
                        <i class="fa fa-sign-out fa-lg" aria-hidden="true"></i>
                        <a href="stud_login.php" ><span id="#signout">Sign Out</span></a>
                    </div>

                </div><!-- end of tabs -->
            </div> <!-- end of sidebar --> 
        </div> <!-- end of nav -->

         <div class="content">
            <div class="container">
                <div class="calendar">
                    <!-- <div class="month">
                      <i class="fa fa-angle-left prev"></i>
                      <div class="date">
                        <h1></h1>
                        <p></p>
                      </div>
                      <i class="fa fa-angle-right next"></i>
                    </div> -->
                    <div class="weekdays">
                      <div>Sun</div>
                      <div>Mon</div>
                      <div>Tue</div>
                      <div>Wed</div>
                      <div>Thu</div>
                      <div>Fri</div>
                      <div>Sat</div>
                    </div>
                    <div class="days"></div>
                  </div>
              </div>
              <hr>
              
         </div><!-- end of content -->

            
    <script src="js/calendarscript.js"></script>
       
</body>
</html>