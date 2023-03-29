<?php

$response = array();

$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData,true);

if(!empty($data)){

    $name = $data['name'];
    $surname = $data['surname'];
    $login = $data['login'];
    $password = $data['password'];
    $userImage = "placeholder.jpg";

    require 'db_connect.php';

    $db = new DB_CONNECT();
 
    $loginCheck = mysql_query("SELECT user_id FROM Users WHERE login = '$login'");

    if(!empty($loginCheck)){
        if(mysql_num_rows($loginCheck) > 0){
            $response["success"] = 0;
            $response["message"] = "User with same login alredy exists";
            echo json_encode($response);
        }
        else{
            $request = mysql_query("INSERT INTO Users(login,password,name,surname,user_image) VALUES('$login','$password','$name','$surname','$userImage')");

            if($request){
                $response["success"] = 1;
                $response["message"] = "Success register";
                echo json_encode($response);
            }
            else{
                $response["success"] = 0;
                $response["message"] = "Registration error";
                echo json_encode($response);
            }
            
        }
    }
    else{
        $response["success"] = 0;
        $response["message"] = "User with same login alredy exists";
        echo json_encode($response);
    }
 }
 else{
    $response["success"] = 0;
    $response["message"] = "Detected blank fields";

    echo json_encode($response);
}

?>