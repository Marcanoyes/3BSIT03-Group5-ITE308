<?php 

            $mysqli = new mysqli('localhost','root','','homelearning');
            if (isset($_POST['addnotes']))
            {
                $title             = $_POST['title'];
                $notes          = $_POST['notes'];
               
                
                $mysqli->query("INSERT INTO stud_notes (title,notes)VALUES('$title','$notes')") or die($mysqli->error);   
                header("location: snote.php");
                exit;
            }
            if (isset($_GET['delete']))
            {
                $id = $_GET['delete'];
                $mysqli->query("DELETE FROM stud_notes WHERE id=$id") or die($mysqli->error());
                header("location: snote.php");

            }

            if (isset($_POST['update'])){
				$id = $_POST['id'];
				$title=$_POST['title'];
				$notes=$_POST['notes'];
				

				$mysqli->query("UPDATE stud_notes SET title='$title',notes='$notes' WHERE id=$id") or die($mysqli->error);
	
				header("location: snote.php");
			}
?>