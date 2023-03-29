<?php

$response = array();

$JSONdata = file_get_contents('php://input');

$data = json_decode($JSONdata,true);

if(!empty($data)){  
    $senderID = $data["sender"];
    $reciverID = $data["reciver"];
    $taskTittle = $data["task_tittle"];
    $taskDetails = $data["task_details"];
    $taskStatus = "new";

    require 'db_connect.php';

    $db = new DB_CONNECT();

    $result = mysql_query("INSERT INTO Tasks(from_user,to_user,task_tittle,task_details,status) VALUES('$senderID','$reciverID','$taskTittle','$taskDetails','$taskStatus')");

    if($result){
        $response["success"] = 1;
        $response["message"] = "done";
        echo json_encode($response);
    }
    else{
        $response["success"] = 0;
        $response["message"] = "Not good";
        echo json_decode($response);
    }
}
else{
    $response["success"] = 0;
    $response["message"] = "Error!";
    echo json_encode($response);
}

?>