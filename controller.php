<?php
session_start();
ob_start();

class goaltracker
{
    private $db_server = "localhost";
          private $db_name = "karmanor-goal-tracker";
          private $db_user = "root";
          private $db_pass = ""; 



    function access_control()
    {


        if (!isset($_SESSION['email'])) {
            header('location: index.php');
        }
    }
    function connect_db()
    {
        $conn = new mysqli($this->db_server, $this->db_user, $this->db_pass, $this->db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        return $conn;
    }

    function userexists($email)
    {
        $newconnection = $this->connect_db();
        $sql = "SELECT * FROM users where email='$email'";
        $result = $newconnection->query($sql);
        $emailfound = false;

        if ($result->num_rows > 0) {
            $emailfound = true;
        }

        return $emailfound;
    }

    function signUp($name, $email, $password)
    {
        $emailfound = $this->userexists($email);



        if ($emailfound == false) {
            $newconnection = $this->connect_db();

            $sql = "INSERT INTO users (name, email, password) VALUES('$name', '$email', '$password')";

            if ($newconnection->query($sql) === TRUE) {
                echo "<br> Successfully Registered.";
                $_SESSION['email'] = $email;
                ob_end_clean();
                header("location: dashboard.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo '<font color="red">Email Already Registered, Please Signin or Try a Different Email</font>';
        }
    }
    function signIn($email, $password)
    {
        $newconnection = $this->connect_db();
        $sql = "SELECT * FROM users where email='$email' and password='$password'";
        $result = $newconnection->query($sql);
        $userfound = false;

        if ($result->num_rows > 0) {
            $userfound = true;
            $_SESSION['email'] = $email;
            ob_end_clean();
            header("location: dashboard.php");
        }

        return $userfound;
    }

    function signOut()
    {
        session_unset();
        session_destroy();
        header("location: index.php");
    }

    function fetchname($email)
    {

        $newconnection = $this->connect_db();
        $sql = "SELECT * FROM users where email='$email'";
        $result = $newconnection->query($sql);


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $name = $row['name'];
            }
        }

        return $name;
    }

    function createGoal($email, $title, $deadline)
    {
        $newconnection = $this->connect_db();
        $progress = 0;
        $sql = "INSERT INTO goals (email, title, deadline, progress) VALUES('$email', '$title', '$deadline', '$progress')";

        if ($newconnection->query($sql) === TRUE) {
            echo '<p style="padding-left: 100px;"><font color="green"> Goal Created Successfully. View Below</font></p>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    function createTask($taskname, $email, $goal_id, $duedate, $status)
    {

        $newconnection = $this->connect_db();

        $sql = "INSERT INTO tasks (taskname, email, goalid, duedate, status) VALUES('$taskname','$email', '$goal_id', '$duedate', '$status')";

        if ($newconnection->query($sql) === TRUE) {
            echo '<p style="padding-left: 100px;"><font color="green"> Task Created Successfully. View Below</font></p>';
        } else {
            echo "Error: " . $sql . "<br>" . $newconnection->error;
        }
    }

    function calculategoalProgress($goal_id)
    {

        $newconnection = $this->connect_db();
        $sql = "SELECT * FROM tasks where goalid='$goal_id'";
        $result = $newconnection->query($sql);
        $totaltask = $result->num_rows;
        $taskcompleted = 0;
        $progress = 0;




        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['status'] == "completed") {
                    $taskcompleted = $taskcompleted + 1;
                }
            }
        }

        if ($totaltask != 0) {
            $progress = round(($taskcompleted / $totaltask) * 100);
        }


        return $progress;
    }
    function fetchgoals($email)
    {
        $newconnection = $this->connect_db();
        $sql = "SELECT * FROM goals where email='$email'";
        $result = $newconnection->query($sql);



        if ($result->num_rows > 0) {
            $newdeadline = array();
            $b = 0;
            while ($row = $result->fetch_assoc()) {

                $id = $row['id'];
                $title = $row['title'];
                $deadline = $row['deadline'];
                $email = $row['email'];
                $progress = $row['progress'];
                $idtitle = str_replace(' ', '', $title);
                $rowtitle = $row['title'];
                $progress = $this->calculategoalProgress($id);
                if ($progress == 100) {
                    $progresscolor = "good";
                } else if ($progress < 100 && $progress >= 40) {
                    $progresscolor = "average";
                } else if ($progress < 40) {
                    $progresscolor = "poor";
                }

                $newdeadline[$b]=str_replace("-", ", " , $deadline);

                echo '
                  
                                        
                    <div class="panel panel-default all-goal-panel mt-3">
                        <div class="panel-heading">
                            <div class="container-fluid a-goal panel-title">
                                <div class="row goal-row">
                                    <div class="col-5 goal-name">
                                        
                                        <a href="#' . $idtitle . '" data-toggle="collapse" data-parent="#accordion">
                                            <strong>' . $title . '</strong>

                                        </a>
                                    </div>
                                    <div class="col-1 goal-progress">
                                        <div class="progress-circle progress-circle-' . $progresscolor . '"></div>
                                        <strong>' . $progress . '%</strong>

                                    </div>

                                    <div class="col-1 edit-goal">
                                        <a href="#" data-toggle="modal" data-target="#edit-goal" onclick="fetch('.$id.',1)">
                                            <strong><i class="fa fa-pencil"></i>Edit</strong>
                                        </a>   
                                    </div>
                                    <div class="col-2 add-task">
                                        <a href="#" data-toggle="modal" data-target="#add-task-'.$idtitle.'">
                                            <strong><i class="fa fa-plus"></i> Add tasks</strong>
                                        </a>

                                    
                                        <div class="modal fade" id="add-task-'.$idtitle.'" tabindex="-1" role="dialog">

                                            <div class="modal-dialog">

                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-center">Add New Task</h4>

                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                      
                                                    <div class="modal-body">

                                                        <form action="modalactions.php?email=' . $email . '&goal_id=' . $id . '" method="POST">
                                                            <div class="form-group">
                                                                <label for="add-task-name">Task Name</label>
                                                                <input name="taskname" type="text" class="form-control" id="add-task-name" placeholder="Enter Here" required="required">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="due-date">Due Date</label>
                                                                <input name="duedate" type="date" class="form-control" id="due-date" required="required">
                                                            </div>
                                                        
                                                         
                                                    </div>

                                                    <div class="modal-footer">
                                                        <a href="#" class="btn btn-default" id="close-modal" data-dismiss="modal">Close</a>

                                                        <input type="submit" name="addtask" class="btn btn-primary" value="Save">

                                                    </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="col-2 delete-goal">
                                        
                                        <a href="#" data-toggle="modal" data-target="#delete-modal-'.$id.'">
                                            <strong><i class="fa fa-trash"></i> Delete </strong>
                                        </a>
                                        
                                        <div class="modal fade" id="delete-modal-'.$id.'" tabindex="-1" role="dialog">

                                            <div class="modal-dialog">

                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-center">Delete Goal </h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <div class="modal-body delete-modal-body">

                                                        <h3>
                                                            Are you sure you want to delete this Goal? <span>(This action is irreversible)</span>
                                                        </h3>
                                                        
                                                        <a href="modalactions.php?email=' . $email . '&id=' . $id . '&deletegoal=yes"><button type="button" class="mt-4 btn btn-light btn-lg delete-a-goal-button">Delete</button></a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <div id="'.$idtitle.'" class="goal-end-date ml-auto">
                                     
                                    </div>


                                     <script>
                                        
                                        var countDownDate = new Date("'.$newdeadline[$b].' 00:00:00").getTime();


                                        var x = setInterval(function() {


                                          var now = new Date().getTime();

                                         
                                          var distance = countDownDate - now;

                                         
                                          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                          var seconds = Math.floor((distance % (1000 * 60)) / 1000);


                                          document.getElementById("'.$idtitle.'").innerHTML = days + "d " + hours + "h "
                                          + minutes + "m " + seconds + "s ";


                                           if (distance < 0) {
                                            clearInterval(x);
                                            document.getElementById("'.$idtitle.'").innerHTML = "EXPIRED";
                                          }
                                        }, 1000);
                                        </script>
                                </div>
                            </div>
                        </div>';


                $this->fetchtasks($email, $id, $idtitle);




                echo '</div>';
                $b++;
            }
        }
    }
    function fetchtasks($email, $goalid, $idtitle)
    {
        $newconnection = $this->connect_db();
        $sql = "SELECT * FROM tasks where email='$email' and goalid='$goalid'";
        $result = $newconnection->query($sql);


        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $taskname = $row['taskname'];
                $email = $row['email'];
                @$completed;

                $duedate = $row['duedate'];
                $status = $row['status'];

                if ($status == "completed") {
                    $completed = "checked disabled=disabled";
                } else {
                    $completed = "";
                }




                echo '<div class=" task-panel" id="#' . $idtitle . '">
                            <div class="container-fluid a-task panel-body">
                                <div class="row task-row">
                                    <div class="col-6 task-name">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="task3CustomCheck4'.$i.'" ' . $completed . '>
                                            <label class="custom-control-label" for="task3CustomCheck4'.$i.'">
                                                <strong>' . $taskname . '</strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-2 confirm-task">
                                        <a href="modalactions.php?email=' . $email . '&id=' . $id . '&goalid=' . $goalid .  '&completetask=yes">
                                            <strong><i class="fa fa-check fa-check-confirmed"></i> Complete </strong>
                                        </a>
                                    </div>
                                    <div class="col-1 edit-goal">
                                        <a href="#" data-toggle="modal" data-target="#edit-goal" onclick="fetch('.$id.',0)">
                                            <strong><i class="fa fa-pencil"></i>Edit</strong>
                                        </a>   
                                    </div>
                                    <div class="col-2 delete-task">
                                         <a href="modalactions.php?email=' . $email . '&id=' . $id . '&goalid=' . $goalid . '&deletetask=yes">
                                            <strong><i class="fa fa-trash"></i> Delete </strong>
                                        </a>
                                    </div>
                                    <div class="col-2 task-end-date ml-auto">
                                        <strong>20/09/2019</strong>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        $i++;
            }
        }
    }


    function deletegoal($email, $id)
    {
        $newconnection = $this->connect_db();
        $sql = "DELETE FROM goals where email='$email' and id='$id'";
        $result = $newconnection->query($sql);


        if ($newconnection->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
    function deletetask($email, $goal_id, $task_id)
    {
        $newconnection = $this->connect_db();
        $sql = "DELETE FROM tasks where email='$email' and id='$task_id' and goalid='$goal_id'";
        $result = $newconnection->query($sql);


        if ($newconnection->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

    function completetask($email, $goal_id, $task_id)
    {
        $newconnection = $this->connect_db();
        $sql = "UPDATE tasks SET status='completed' where email='$email' and id='$task_id' and goalid='$goal_id'";
        $result = $newconnection->query($sql);


        if ($newconnection->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    function editGoal($id, $title, $due_date) {
        $query_stmt = "UPDATE goals SET title = '$title', deadline = '$due_date' WHERE id = '$id'";
        
        if ($this->runQuery($query_stmt)) {
            echo '<p style="padding-left: 100px;"><font color="green"> Goal Updated</font></p>';
        } else {
            echo "An error occurred updating the goal";
        }
    }
    
    function editTask($id, $task, $due_date) {
        $query_stmt = "UPDATE tasks SET taskname = '$task', duedate = '$due_date' WHERE id = '$id'";

        if ($this->runQuery($query_stmt)) {
            echo '<p style="padding-left: 100px;"><font color="green"> Task Updated</font></p>';
        } else {
            echo "An error occurred updating the goal";
        }
    }

    function getGoal($id) {        
        $query_stmt = "SELECT * FROM goals WHERE id = $id";

        $conn_obj = $this->connect_db();
        $goal = $conn_obj->query($query_stmt);
        if ($goal->num_rows > 0) {
            while ($r = $goal->fetch_assoc()) {
                $id = $r['id'];
                $title = $r['title'];
                $deadline = $r['deadline'];
            }
            return json_encode(array('id' => $id, 'title' => $title, 'deadline' => $deadline), JSON_FORCE_OBJECT);
        } else {
            return "Goal not found";
        }
    }

    function getTask($id) {        
        $query_stmt = "SELECT * FROM tasks WHERE id = $id";

        $conn_obj = $this->connect_db();
        $goal = $conn_obj->query($query_stmt);
        if ($goal->num_rows > 0) {
            while ($r = $goal->fetch_assoc()) {
                $id = $r['id'];
                $title = $r['taskname'];
                $deadline = $r['duedate'];
            }
            return json_encode(array('id' => $id, 'title' => $title, 'deadline' => $deadline), JSON_FORCE_OBJECT);
        } else {
            return "Goal not found";
        }
    }

    function runQuery($query_stmt) {
        $conn_obj = $this->connect_db();
        if ($conn_obj->query($query_stmt)) {
            $conn_obj->close();
            return true;
        }
        $conn_obj->close();
        return false;
    }
}
