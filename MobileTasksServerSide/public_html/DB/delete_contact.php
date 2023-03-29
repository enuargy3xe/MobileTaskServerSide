<?php

$response = array();

$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData,true);

if(!empty($data)){

    $firstUser = $data['first_user_id'];
    $secondUser = $data['second_user_id'];

    require 'db_connect.php';

    $db = new DB_CONNECT();

    $request = mysql_query("DELETE FROM contacts WHERE first_user_id = '$firstUser' and second_user_id = '$secondUser'");

    if($request){
        $response["success"] = 1;
        $response["message"] = "Done";
        echo json_encode($response);
    }
    else{
        $response["success"] = 0;
        $response["message"] = "Error";
        echo json_encode($response);
    }
}
else{
    $response["success"] = 0;
    $response["message"] = "Error!";
    echo json_encode($response);
}

?>