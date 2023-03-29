<?php

$response = array();

$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData,true);

if(!empty($data)){

    $firstUser = $data['first_user_id'];
    $secondUser = $data['second_user_id'];

    require 'db_connect.php';

    $db = new DB_CONNECT();

    $request = mysql_query("INSERT INTO contacts(first_user_id,second_user_id) VALUES('$firstUser','$secondUser')");

    if($request){
        $response["success"] = 1;
        $response["message"] = "Gratz";
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