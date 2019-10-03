<?php
                    include 'controller.php'; 
                    $goaltracker = new goaltracker;
                    $goaltracker->access_control();

                    
                    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- required meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Team Karmanov Dahsboard</title>
        <!-- fontawesome! -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- bootstrap CSS !-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- style.css -->     
        <link rel="stylesheet" href="css/style.css">
    </head>
    
    <body>
        
        <div class="container-fluid both-col-12">
            <div class="row box-row title-header">
                <div class="col-6">
                    <div class="left-title">
                        <h2><a href="#">KARMA</a></h2>
                    </div>
                </div>
                <div class="col-6 logout">
                    <?php
                            if(@$_GET['action']=="logout"){

                            $goaltracker = new goaltracker;
                            $goaltracker->signout();

                        }
                    ?>


                    <a href="dashboard.php?action=logout">
                        <i class="fa fa-sign-out"></i> Logout
                    </a>
                </div>
            </div>
            
            <div class="row welcome-name">
                <div class="welcome-text">
                    <h1>WELCOME</h1>
                   
                        <?php
                                             

                                        $email=$_SESSION['email'];
                                        
                                        $goaltracker = new goaltracker;
                                        $name=$goaltracker->fetchname($email);
                                        echo '<h3>'.$name.'</h3>';
                                        
      
                       ?>
                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-10 col-xs-12 d-flex" id="create-goal-col">
                    <button type="button" class="mt-4 btn btn-light btn-lg create-goals-button" data-toggle="modal" data-target="#goal-modal">Create goals</button>
                    
                    <div class="modal fade" id="goal-modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-center">Create Goal</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <div class="modal-body">

                                    <form action="dashboard.php" method="POST">
                                        <div class="form-group">
                                            <label for="goal-title">Goal Title*</label>
                                            <input name="title" type="text" class="form-control" id="goal-title" placeholder="Enter Here">
                                        </div>
                                        <div class="form-group">
                                            <label for="due-date">Due Date*</label>
                                            <input name="deadline" type="date" class="form-control" id="due-date">
                                        </div>
                                      
                                   
                                    
                                </div>
                                
                                <div class="modal-footer">
                                    <a href="#" class="btn btn-default" id="close-modal" data-dismiss="modal">Close</a>
                                    <input type="submit" name="addgoal" class="btn btn-primary" value="Save">
                                     </form>

                                </div>

                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
             
                    <?php
                        if(isset($_POST['addgoal'])){
                            if($_POST['title'] AND $_POST['deadline'] != NULL){
                                  $title=$_POST['title'];                                  $deadline=$_POST['deadline'];
                                  $email=$_SESSION['email'];


                                  $goaltracker=new goaltracker;
                                  $goaltracker->createGoal($email, $title, $deadline);                                                
                              }
                            else{
                                echo '<p style="padding-left: 100px;"><font color="red">Please Fill Required (*) Fields to Create Goal</font>';
                                                
                                }
                                         }

                        ?>
                    
            <div class="row">
                <div class="panel-group goal-panel col-md-10 col-xs-12 total-goals-col mt-5" id="accordion">
                  
                <?php
                    $email=$_SESSION['email'];


                    $goaltracker=new goaltracker;
                    $goaltracker->fetchgoals($email);
                ?>
                
                    </div>
            </div>
            <br><br>
        </div>
        
        
        
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        
        <!-- bootstrap Javascript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        <!-- Javascript file -->
        <script src="js/script.js"></script>
    </body>
    
</html>