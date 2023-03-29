<?php

$response = array();

if(isset($_GET['task_id']) && isset($_GET['status'])){
    $taskID = $_GET['task_id'];
    $status = $_GET['status'];
    require 'db_connect.php';

    $db = new DB_CONNECT();

    $request = mysql_query("UPDATE Tasks SET status = '$status' WHERE task_id = '$taskID'");
    if($request){
        $response["success"]= 1;
        echo json_encode($response);
    }
    else{
        $response["success"] = 0;
        echo json_encode($response);
    }
}
else{
    $response["success"] = 0;
    echo json_encode($response);
}

?>