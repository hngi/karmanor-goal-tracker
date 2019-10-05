<?php
    include_once('controller.php');
    $ctrl = new goaltracker;
    // $conn_obj = $ctrl->connect_db();
    $stmt = "UPDATE tasks t INNER JOIN goals g ON t.goalid = g.title SET t.goalid = g.id";
    if ($ctrl->runQuery($stmt)) {
        echo "Done";
    } else {
        echo "error";
    }

?>