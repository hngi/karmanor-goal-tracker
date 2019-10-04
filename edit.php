<?php
    include_once('controller.php');
    $ctrl = new goaltracker;
    $curr_edit = "Goal";

    if (isset($_GET['fetch']) && isset($_GET['id'])) {
        if ($_GET['fetch'] === 'goal') {
            $curr_edit = "Goal";
            $goal_details = $ctrl->getGoal($_GET['id']);
            echo  $goal_details;
            exit;
        }

        if ($_GET['fetch'] === 'task') {
            $curr_edit = "Task";
            $task_details = $ctrl->getTask($_GET['id']);
            echo  $task_details;
            exit;
        }
    }

    if (isset($_POST['update']) && isset($_POST['gt'])) {
        $id = $_POST['id'];
        $taskname = $_POST['title'];
        $duedate = $_POST['duedate'];
        $foo = $_POST['gt'];

        if ($_POST['gt'] === 'goal') {
            $ctrl->editGoal($id, $taskname, $duedate);
        } else if ($_POST['gt'] === 'task') {
            $ctrl->editTask($id, $taskname, $duedate);
        }

        header("location: dashboard.php");
    }
?>

<div class="modal fade" id="edit-goal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form action="" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="heading">Edit</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" class="form-control" id="title" placeholder="e.g Make new PR on goaltracker" required="required">
                    </div>
                    <input hidden name="id" id="gtid"> 
                    <input hidden name="gt" id="gt">
                    <div class="form-group">
                        <label for="duedate">Due Date</label>
                        <input name="duedate" type="date" class="form-control" id="due_date" required="required">
                    </div>                                    
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-default" id="close-modal" data-dismiss="modal">Close</a>

                    <input type="submit" name="update" class="btn btn-primary" value="Update">
                </div>   
            </div>
        </form>
    </div>
</div>
