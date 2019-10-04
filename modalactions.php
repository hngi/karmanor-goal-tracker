<?php
   include 'controller.php';


   if(isset($_GET['email'], $_GET['title'], $_GET['deletegoal'])){
   	 
   	 	$email=$_GET['email'];
   	 	$title=$_GET['title'];
   	 	$goaltracker=new goaltracker;
         $goaltracker->deletegoal($email, $title);

         header("location: dashboard.php");
   	
   }

   if(isset($_GET['email'], $_GET['goaltitle'], $_GET['taskname'], $_GET['deletetask'])){

         $email=$_GET['email'];
         $title=$_GET['goaltitle'];
         $taskname=$_GET['taskname'];
         $goaltracker=new goaltracker;
         $goaltracker->deletetask($email, $title, $taskname);

        header("location: dashboard.php");
      
   }
   if(isset($_GET['email'], $_GET['goaltitle'], $_GET['taskname'], $_GET['completetask'])){

         $email=$_GET['email'];
         $title=$_GET['goaltitle'];
         $taskname=$_GET['taskname'];
         $goaltracker=new goaltracker;
         $goaltracker->completetask($email, $title, $taskname);

        header("location: dashboard.php");
      
   }

   if(isset($_POST['addtask'])){
   	   

      $duedate=$_POST['duedate'];
      $taskname=$_POST['taskname'];
      $status=0;
      $email=$_GET['email'];
      $title=$_GET['title'];
      $today = date('Y-m-d');

      $goaltracker=new goaltracker;

      $newconnection = $goaltracker->connect_db();
      $sql = "SELECT deadline FROM goals where email='$email'";
      $result = $newconnection->query($sql);

      if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                  $goalenddate = $row['deadline'];
            }
      }
      else {
            echo 'Please Kindly geddifok';
            exit();
      }

      if ($duedate <= $goalenddate && $duedate >= $today) {
            $goaltracker->createTask($taskname, $email, $title, $duedate, $status);
            header("location: dashboard.php");
      }
      else{
            header('location:dashboard.php?addtaskwrongdate');
      }
   	
   }


?>