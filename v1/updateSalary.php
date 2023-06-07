<?php

header("Access-Control-Allow-Origin: *"); // all website
header("Access-Control-Allow-Methods: POST"); // post get delete
header("Content-type: application/json; charset=UTF-8"); //Content-type json array

include_once("../config/database.php");
include_once("../classes/users.php");


$db = new Database();
$connection = $db->connect();

$updateSalary = new User($connection);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $data = json_decode(file_get_contents("php://input"));
  print_r(json_encode($data));
    if (!empty($data->id) && !empty($data->salary) && !empty($data->year)) {

        
        $updateSalary->salary = $data->salary;
        $updateSalary->year = $data->year;
        $updateSalary->id = $data->id;
        
        if ($updateSalary->updateSalary($data->salary, $data->year,$data->id,)) {
            http_response_code(200);
            echo json_encode(array(
             "status"=> 1,
             "message"=>"Data updated",
             
        
            ));
        }else{
            http_response_code(500);
            echo json_encode(array(
                "status"=> 0,
                "message"=>"not updated"
            ));
        }
    }else{
        http_response_code(404); //Page not found
            echo json_encode(array(
                "status" => 0,
                "message" => "Values needed"
            ));
    }

} else {
    http_response_code(503); // service unavailable
    echo json_encode(
        array(
            "status" => 0,
            "message" => "Access denied"
        )
    );
}