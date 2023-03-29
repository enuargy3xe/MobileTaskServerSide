<?php

//$JSONdata = json_decode(file_get_contents('php://input'),true);

$response = array();

$user_id = $_POST["user_id"];
$imageName = $_POST["image_name"];
$image = $_POST["image"];

$decodedImage = base64_decode($image);

$return = file_put_contents("../Avatars/".$imageName.".jpg", $decodedImage);

$extendedImageName = $imageName.".jpg";

if($return){

    require 'db_connect.php';
    $db = new DB_CONNECT();

    $request = mysql_query("UPDATE Users SET user_image = '$extendedImageName' WHERE user_id = '$user_id'");

    if($request){
        $response["success"] = 1;
        $response["message"] = "Image uploaded successfully";
    }
    else{
        $response["success"] = 0;
        $response["message"] = "Image uploaded failed";
    }

}
else{
    $response["success"] = 0;
    $response["message"] = "Image uploaded failed";
}

echo json_encode($response);


?>