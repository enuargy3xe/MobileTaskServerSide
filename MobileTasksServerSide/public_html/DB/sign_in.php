<?php

$response = array();

if(isset($_GET['login']) && isset($_GET['password'])){
    $login = $_GET['login'];
    $password = $_GET['password'];

    require 'db_connect.php';

    $db = new DB_CONNECT();

    $request = mysql_query("SELECT * FROM Users WHERE login = '$login' and password = '$password'");

    if(mysql_num_rows($request) > 0){
        $result = mysql_fetch_array($request);

        $user = array();
        $user["user_id"] = $result["user_id"];
        $user["login"] = $result["login"];
        $user["password"] = $result["password"];
        $user["name"] = $result["name"];
        $user["surname"] = $result["surname"];
        $user["user_image"] = $result["user_image"];

        $response["success"] = 1;
        $response["user"] = array();
        array_push($response["user"], $user);
        echo json_encode($response);
    }
    else{
        $response["success"] = 0;
        $response["message"] = "No user found";
        echo json_encode($response);
    }
}
else{
    $response["success"] = 0;
    $response["message"] = "Detected blank fields";
    echo json_encode($response);
}

?>