<?php require_once 'account_function.php'; ?>

<?php
session_start();
if (!isset($_SESSION['username']))
{
   echo "<script>alert('Login First!'); location.href='admin_login.php';</script>";
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
    <title>Homelearning Buddy</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <script src="js/clickActive.js"></script>
    <script src="js/datepicker.js"></script>

</head>
<body>
    <div class="main_container">
        <div class="header1">
            <div class="infos">
                <div class="icon">
                    <img src="assets/iconWhite.png">
                </div>
                
                <div class="name">
                    <h6>HOMELEARNING BUDDY</h6>
                    <!-- <p>Course</p> -->
                </div>
            </div>
        </div>

        <div class="nav">

            <div class="sidebar ">
                <div class="tabs">
                    <li class="active">
                        <i class="fa fa-sticky-note-o fa-2x" aria-hidden="true"></i>
                        <a href="admin_accounts.php"><span>Accounts</span></a>
                    </li>
                    <hr>
                     <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <div class="signout">
                        <i class="fa fa-sign-out fa-lg" aria-hidden="true"></i>
                        <a href="signout.php" ><span id="#signout">Sign Out</span></a>
                    </div>

                </div><!-- end of tabs -->
            </div> <!-- end of sidebar --> 
        </div> <!-- end of nav -->

        <!-- Search -->
        <?php
            $connection = mysqli_connect("localhost", "root", "", "homelearning");
            if(isset($_POST['Search']))
            {
                $valuetoSearch = $_POST['valuetoSearch'];
                $query = "SELECT * FROM `hlb_user` WHERE CONCAT (`id`,`studid`,`firstname`,`lastname`, `course`, `pnumber`, `email`, `username`, `password`) LIKE'%".$valuetoSearch."%'";
                $search_result = filterTable($query);
                    
            }
            else 
            {
                $view_query = mysqli_query($connection,"SELECT * FROM hlb_user");
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


        <!-- End Search -->

        <div class="header2">
            <div class="search">
                <i class="fa fa-search fa-lg" aria-hidden="true"></i>
                <form action="admin_accounts.php" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" name="valuetoSearch" class="form-control" placeholder="Search">
                        </div>
                        <div class="col-sm-6">
                            <input type="submit" name="Search" value="Search" class="btn btn-primary">
                        </div>
                    </div>
                </form> 
            </div>
        </div>
         <div class="content">
            <div class="container">
                <ul>
                    <div class="addNew">
                        <form action="admin_accounts.php" method="post">
                            <button type="button" id="button" class="btn btn-primary" >Add Account</button>
                        </form>
                    </div>

                </ul>        
            </div>

            <div class="main_content" id="main_content"> 
                <div class="container jumbotron">
                    <div class="row">
                        <div class="col">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Student Id</th>
                                        <th>FisrtName</th>
                             
                                        <th>LastName</th>
                                        <th>Course</th>
                            
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                            

                                <?php
                                if($search_result)
                                {
                                    while($row = mysqli_fetch_assoc($search_result))
                                    {
                                ?>
                                <tr>
                                    <td><?= $row['studid']; ?></td>
                                    <td><?= $row['firstname']; ?></td>
                                    
                                    <td><?= $row['lastname']; ?></td>
                                    <td><?= $row['course']; ?></td>
                              
                                    <td><?= $row['email']; ?></td>
                                    <td><?= $row['password']; ?></td>
                                    <td>
                                    
                                    <a href="admin_accounts.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete This Account?')">Delete</a> 
                                    <td>
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

        <div class="bg-modal">
            <div class="modal_content">
                <div class="close"><i class="fa fa-times fa-sm" aria-hidden="true"></i></div>
                    <div class="head"><h5>ADD ACCOUNT</h5></div>
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
          
        

    </div><!-- Main Container end -->
   
    
    
    <script>
        document.getElementById('button').addEventListener("click", function() {
	    document.querySelector('.bg-modal').style.display = "flex";
        });

        document.querySelector('.close').addEventListener("click", function() {
	    document.querySelector('.bg-modal').style.display = "none";
        });
    </script>

   
    
</body>
</html>