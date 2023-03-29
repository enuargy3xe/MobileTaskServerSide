<?php

$response = array();

if(isset($_GET['user_id'])){
    $userID = $_GET['user_id'];

    require 'db_connect.php';

    $db = new DB_CONNECT();

    $request = mysql_query("SELECT Tasks.task_id,Tasks.task_tittle,Tasks.task_details,Tasks.status,Users.user_id,Users.name,Users.surname,Users.user_image FROM Tasks INNER JOIN Users ON Users.user_id = Tasks.from_user AND Tasks.to_user = '$userID'");

    if(mysql_num_rows($request) > 0){
        $tasks = array();
        $response["Tasks"] = array();

        while($result = mysql_fetch_array($request,MYSQL_ASSOC)){
            $tasks["task_id"] = $result["task_id"];
            $tasks["task_tittle"] = $result["task_tittle"];
            $tasks["task_details"] = $result["task_details"];
            $tasks["status"] = $result["status"];
            $tasks["user_id"] = $result["user_id"];
            $tasks["name"] = $result["name"];
            $tasks["surname"] = $result["surname"];
            $tasks["user_image"] = $result["user_image"];

            array_push($response["Tasks"], $tasks);
        }
        $response["success"] = 1;
        echo json_encode($response);
    }
}
else{
    $response["success"] = 0;
    $response["message"] = "Nichego ne prishlo";
    echo json_encode($response);
}

?>