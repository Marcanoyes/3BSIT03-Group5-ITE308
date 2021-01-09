<?php require_once 'notes_function.php'; ?>

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
    <title>Notes</title>
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
                $query = "SELECT * FROM `stud_notes` WHERE CONCAT (`title`,`notes`) LIKE'%".$valuetoSearch."%'";
                $search_result = filterTable($query);
                    
            }
            else 
            {
                $view_query = mysqli_query($connection,"SELECT * FROM stud_notes");
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
                <i class="fa fa-search fa-lg" aria-hidden="true"></i>
                <input type="text" name="valuetoSearch" class="form-control" placeholder="Search" style="width: 80%">
                <input type="submit" name="Search" value="Search" class="btn btn-success " style="width: 110px;">
                
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
                    <div class="addNew">
                        <a href="#" id="buttons"><i class="fa fa-plus-circle fa-3x" aria-hidden="true"></i></a>
                    </div>

                </ul>
                       
            </div>


            <div class="main_content"> 
                
             
<?php   
if($search_result)
    {
      while($row = mysqli_fetch_assoc($search_result))
      {
        ?>
<div class="container jumbotron">
    <div class="col-sm-12">
        <table class="table">
            <tr class="col-sm-2">
                <h4 style="font-size: 30px; font-style: italic;"><?php echo $row['title']; ?> </h4>              
            </tr>
            <tr>
                <td colspan="5" style="font-size: 18px;">
                
                <?php echo $row['notes']; ?></td>
                
            </tr>
            <td colspan="8">
                <button id="edit" type="button" class="btn btn-success" style="width: 50px;" > Edit</button>
                <a href="snote.php?delete=<?php echo $row['id']; ?>"style="width: 60px;" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete This Notes?')" >Delete</a>
            </td>
                
        </table>
    </div>
</div>

<div class="bg-modal" id="editnotes">
            <div class="modal_content">
                
                <div class="close"><i class="fa fa-times fa-sm" aria-hidden="true"></i></div>
                    <div class="head"><h5>EDIT NOTES</h5></div>
                    <form method="post" >
                    <div class="inputTitle">
                        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                        <label > Title: </label> &nbsp;&nbsp;
                        <input type="text"  id="title" name="title" value="<?php echo $row['title']; ?>" ><br>
                        <textarea cols="69" rows="13"  name="notes" id="note" type="text" ><?php echo $row['notes']; ?></textarea>
                        <input type="submit" id="submit" value="Update" name="update" style="float: right; margin-top: 10px; width: 100px;"class="btn btn-success">
                        
                        <!-- <input type="button" id="submit" value="Submit"> -->
                    </div><!-- inputTitle -->
                </form>
           
                
            </div><!-- modal_content -->
         </div> <!-- bg-modal end -->




<?php
      }
      
    }
    else{
      echo "No Records Found";
    }
    ?>

            </div><!-- main_content end -->
         </div> <!-- content end -->

         <div class="bg-modal" id="addnotess">
            <div class="modal_content">
                <div class="close" id="closenotes"><i class="fa fa-times fa-sm" aria-hidden="true"></i></div>
                    <div class="head"><h5>NOTES</h5></div>
                    <form method="post" >
                    <div class="inputTitle">
                        <label > Title: </label> &nbsp;&nbsp;
                        <input type="text" id="title" name="title" required ><br>
                        <textarea style="height: 300px; width: 100%;"name="notes" id="note" cols="69" rows="13" placeholder="write something..."></textarea>

                        <input type="submit" id="submit" value="addnotes" name="addnotes" style="float: right; margin-top: 10px; width: 100px;" class="btn btn-success">
                        
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