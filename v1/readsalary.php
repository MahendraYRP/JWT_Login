<?php

//include headers
header("Access-Control-Allow-Origin: *"); // all website
header("Access-Control-Allow-Methods: POST"); // post get delete
header("Content-type: application/json; charset=UTF-8"); //Content-type json array

include_once("../config/database.php");
include_once("../classes/users.php");


$db = new Database();
$connection =   $db->connect();

$readSalary = new User($connection);

if ($_SERVER['REQUEST_METHOD'] === "GET") {

    $empSalary["salary"] = array();
    $salarydata = $readSalary->displaySalary();

    if ($salarydata->num_rows > 0) {                
       
        $empSalary["salary"] = array();

        while ($row = $salarydata->fetch_assoc()) {
            
            array_push($empSalary["salary"], array(
                  "id"=>$row['id'],
                  "salary"=>$row['Salary'],
                  "year"=>$row['year'],
                  "user_id"=>$row['user_id']

            ));
        }
   
        http_response_code(200); // ok
        echo json_encode(array(
            "status" => 1,
            "data" =>  $empSalary["salary"]
        ));
    }
} else {
    http_response_code(503); // service unavailable
    echo json_encode(array(
        "status" => 0,
        "message" => "Access denied"
    ));
}






