<?php

$response = array();

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];

    require 'db_connect.php';

    $db = new DB_CONNECT();

    $request = mysql_query("SELECT Users.user_id,Users.login,Users.name,Users.surname,Users.user_image FROM Users INNER JOIN contacts ON contacts.second_user_id = Users.user_id AND contacts.first_user_id = '$user_id'");

    if(mysql_num_rows($request) > 0){
        $contacts = array();
        $response["Contacts"] = array();
        //$result = mysql_fetch_array($request);

        while($result = mysql_fetch_array($request,MYSQL_ASSOC)){
            $contacts["user_id"] = $result["user_id"];
            $contacts["login"] = $result["login"];
            $contacts["name"] = $result["name"];
            $contacts["surname"] = $result["surname"];
            $contacts["user_image"] = $result["user_image"];
            array_push($response["Contacts"], $contacts);
        }
       
        $response["success"] = 1;
       
        
        echo json_encode($response);
    }
    else{
        $response["success"] = 0;
        $response["message"] = "Contacts not fount";
        echo json_encode($response);
    }
}
else{
    $response["success"] = 0;
    $response["message"] = "Error!";
    echo json_encode($response);
    
}

?>