<?php

header("Access-Control-Allow-Origin: *"); // all website
header("Access-Control-Allow-Methods: POST"); // post get delete
header("Content-type: application/json; charset=UTF-8"); //Content-type json array

include_once("../config/database.php");
include_once("../classes/users.php");


$db = new Database();
$connection = $db->connect();

$updateEmp = new User($connection);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

$data = json_decode(file_get_contents("php://input"));



if (!empty($data->name) && !empty($data->email) && !empty($data->phone_number) && !empty($data->id)) {
  
$updateEmp->name = $data->name;
$updateEmp->email = $data->email;
$updateEmp->phone_number = $data->phone_number;
$updateEmp->id = $data->id;

if ($updateEmp->updateEmp($data->name, $data->email, $data->phone_number, $data->id)) {
  http_response_code(200); // OK 
  echo json_encode(array(
    "status" => 1,
    "message" => "Data updated"
));
}else{
    http_response_code(500); //server Error
    echo json_encode(array(
        "status" => 0,
        "message" => "Data not updated",
    
    ));
}

}else{
    http_response_code(404); //Page not found
        echo json_encode(array(
            "status" => 0,
            "message" => "Values needed"
        ));
}
    
}else{
    http_response_code(503); // service unavailable
    echo json_encode(array(
        "status" => 0,
        "message" => "Access denied"
    ));
}


?>