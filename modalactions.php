<?php
   include 'controller.php';


   if(isset($_GET['email'], $_GET['id'], $_GET['deletegoal'])){
   	 
   	 	$email=$_GET['email'];
   	 	$id=$_GET['id'];
   	 	$goaltracker=new goaltracker;
         $goaltracker->deletegoal($email, $id);

         header("location: dashboard.php");
   	
   }

   if(isset($_GET['email'], $_GET['goalid'], $_GET['id'], $_GET['deletetask'])){

         $email=$_GET['email'];
         $goal_id=$_GET['goalid'];
         $id=$_GET['id'];
         $goaltracker=new goaltracker;
         $goaltracker->deletetask($email, $goal_id, $id);

        header("location: dashboard.php");
      
   }
   if(isset($_GET['email'], $_GET['goalid'], $_GET['id'], $_GET['completetask'])){

         $email=$_GET['email'];
         $goal_id=$_GET['goalid'];
         $id=$_GET['id'];
         $goaltracker=new goaltracker;
         $goaltracker->completetask($email, $goal_id, $id);

        header("location: dashboard.php");
      
   }

   if(isset($_POST['addtask'])){
   	   

   	     $duedate=$_POST['duedate'];
   	     $taskname=$_POST['taskname'];
   	     $status=0;
   	  $email=$_GET['email'];
   	   $goal_id=$_GET['goal_id'];
   	 

   	 	$goaltracker=new goaltracker;
         $goaltracker->createTask($taskname, $email, $goal_id, $duedate, $status);

         header("location: dashboard.php");
   	
   }


?>