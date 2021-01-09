
<?php require_once 'schedfunction.php'; ?>
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
    <link rel="stylesheet" href="css/stylenotes.css">
    <title>Schedule</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <script src="js/clickActive.js"></script>
    <script src="js/datepicker.js"></script>

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
                    <p style="font-size: 13px; width: 50px;"><?= $row['course']; ?></p> 
                    <!-- <p>Course</p> -->
                    <?php 
                    } ?>
                </div>
            </div>
        </div>

        <?php
            $connection = mysqli_connect("localhost", "root", "", "homelearning");
            if(isset($_POST['Search']))
            {
                $valuetoSearch = $_POST['valuetoSearch'];
                $query = "SELECT * FROM `schedule` WHERE CONCAT (`subjcode`) LIKE'%".$valuetoSearch."%'";
                $search_result = filterTable($query);
                    
            }
            else 
            {
                $view_query = mysqli_query($connection,"SELECT * FROM schedule");
                $search_result = $view_query;
            }
        
            // function to connect and execute the query
            function filterTable($query)
            {
                $connection = mysqli_connect("localhost", "root", "", "homelearning");
                $filter_result = mysqli_query($connection, $query);
                return $filter_result;
            }
        ?>

        <div class="header2">
            <div class="search">
                <form action="snote.php" method="post">
                <div class="addNew" style="float: right; margin-right: 50px; margin-top: 10px;">
                        <a href="#" id="buttons">Add Schedule</a>
                    </div>
                
            </div>
            </form>
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
                    <hr> <br><br><br><br>
                    
                    <br><br><br><br><br><br><br><br>
                    <div class="signout">
                        <i class="fa fa-sign-out fa-lg" aria-hidden="true"></i>
                        <a href="stud_login.php" ><span id="#signout">Sign Out</span></a>
                    </div>

                </div><!-- end of tabs -->
            </div> <!-- end of sidebar --> 
        </div> <!-- end of nav -->

         <div class="content">
            <div class="container"> 
                <ul>
                    

                </ul>
                       
            </div>


            
                
             
 <div class="main_content" id="main_content"> 
                <div class="container jumbotron">
                    <div class="row">
                        <div class="col">
                            <table class="table">
                                <thead>
                                    <tr>
                                        
                                        <th>Subject Code</th>
                                        <th>Description</th>
                                        <th>Professor</th>
                                        <th>Schedule</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                if($search_result)
                                {
                                    while($row = mysqli_fetch_assoc($search_result))
                                    {
                                ?>
                                <tr>
                                    
                                    <td><?= $row['subjcode']; ?></td>
                                    <td><?= $row['description']; ?></td>
                                    <td><?= $row['professor']; ?></td>
                                    <td><?= $row['schedule']; ?></td>
                                    <td><a href="schedule.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete This Schedule?')">Delete</a> 
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                else
                                {
                                    echo "No Records Found";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>   
            </div><!-- main_content end -->
         </div> <!-- content end -->

         

         <div class="bg-modal" id="addnotess">
            <div class="modal_content">
                <div class="close" id="closenotes"><i class="fa fa-times fa-sm" aria-hidden="true"></i></div>
                    <div class="head"><h5>Schedule</h5></div>
                    <form method="post" >
                    <div class="inputTitle">
                        <form method="post" > 
                        <label >Subject Code</label>
                        <input class="form-control" type="text" name="subjcode" required>
                        <label >Description</label>
                        <input class="form-control" type="text" name="description" required>
                         <label >Professor</label>
                        <input class="form-control" type="text" name="professor" required>
                        <label >Schedule</label>
                        <input class="form-control" type="text" name="schedule" required>
                        

                       <input style="margin-top: 10px;" type="submit" name="addsched" value="Add Schedule" class="btn btn-primary form-control">
                     </form>
                        <!-- <input type="button" id="submit" value="Submit"> -->
                    </div><!-- inputTitle -->
                </form>
                
            </div><!-- modal_content -->
         </div> <!-- bg-modal end -->

        
         

         
    </div><!-- Main Container end -->
    
    
    <script>
        document.getElementById('buttons').addEventListener("click", function() {
        document.querySelector('#addnotess').style.display = "flex";
        });

        document.querySelector('#closenotes').addEventListener("click", function() {
        document.querySelector('#addnotess').style.display = "none";
        });
    </script>

    <script>
        document.getElementById('edit').addEventListener("click", function() {
        document.querySelector('#editnotes').style.display = "flex";
        });

        document.querySelector('.close').addEventListener("click", function() {
        document.querySelector('#editnotes').style.display = "none";
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