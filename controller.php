<?php
    session_start();
     ob_start();
    class goaltracker{
    	  private $db_server = "localhost";
          private $db_name = "karmanor-goal-tracker";
          private $db_user = "root";
          private $db_pass = ""; 

       
   
     function access_control(){
			ob_start();
		    @session_start();

		    if(!isset($_SESSION['username'])){
				header('location: login.php');
			}
	 }	
     function connect_db(){
            $conn= new mysqli($this->db_server, $this->db_user, $this->db_pass,$this->db_name);

             if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
                        } 


                        return $conn;


        }  

     function userexists($email){
         $newconnection = $this->connect_db();
                $sql = "SELECT * FROM users where email='$email'";
                $result=$newconnection->query($sql);
                $emailfound= false;

                if($result->num_rows>0){
                    $emailfound = true;
                }
                
                return $emailfound; 


     }

     function signUp($name, $email, $password){
          $emailfound= $this->userexists($email);
          


        if($emailfound == false){
           $newconnection = $this->connect_db();

            $sql = "INSERT INTO users (name, email, password) VALUES('$name', '$email', '$password')";

            if ($newconnection->query($sql) === TRUE){
                echo "<br> Successfully Registered.";
                   $_SESSION['email']=$email;
                   ob_end_clean( );
                 header("location: dashboard.php");
             }

            else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }     
           }
        else{
            echo '<font color="red">Email Already Registered, Please Signin or Try a Different Email</font>';
        }

    }
    function signIn($email, $password){
        $newconnection = $this->connect_db();
                $sql = "SELECT * FROM users where email='$email' and password='$password'";
                $result=$newconnection->query($sql);
                $userfound= false;

                if($result->num_rows>0){
                    $userfound = true;
                    $_SESSION['email']=$email;
                    ob_end_clean( );
                    header("location: dashboard.php");
                }
                
                return $userfound;

      
     } 

     function signOut(){
        session_start();
        session_unset();
        session_destroy();
        header('Location:index.php');
        exit();

     }
     function createGoal($username, $title, $description, $deadline){


     }
     function createTask($taskname){


     }
     function calculateProgress($goalname){


     }
     function alert(){


     }



    }


?>
