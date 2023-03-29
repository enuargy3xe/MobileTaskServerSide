<?php

$response = array();

if(isset($_GET['finding_login'])){
    $findingUser = $_GET['finding_login'];

    require 'db_connect.php';

    $db = new DB_CONNECT();

    $request = mysql_query("SELECT user_id,login,name,surname,user_image FROM Users where login LIKE '%$findingUser'");

    if(mysql_num_rows($request) > 0){
        $result = mysql_fetch_array($request);

        $contacts = array();
        $contacts["user_id"] = $result["user_id"];
        $contacts["login"] = $result["login"];
        $contacts["name"] = $result["name"];
        $contacts["surname"] = $result["surname"];
        $contacts["user_image"] = $result["user_image"];
        $response["success"] = 1;
        $response["Contacts"] = array();
        array_push($response["Contacts"], $contacts);
        echo json_encode($response);
    }
    else{
        $response["success"] = 0;
        $response["message"] = "Users not found";
        echo json_encode($response);
    }
}
else{
    $response["success"] = 0;
    $response["message"] = "blank field";
    echo json_encode($response);
}

?>