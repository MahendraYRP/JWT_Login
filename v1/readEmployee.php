<?php

//include headers
header("Access-Control-Allow-Origin: *"); // all website
header("Access-Control-Allow-Methods: POST"); // post get delete
header("Content-type: application/json; charset=UTF-8"); //Content-type json array

include_once("../config/database.php");
include_once("../classes/users.php");


$db = new Database();
$connection =   $db->connect();

$readEmp = new User($connection);

if ($_SERVER['REQUEST_METHOD'] === "GET") {

    $data = $readEmp->readEmployee();
 

    if ($data->num_rows > 0) {                
       
        $emmRec["records"] = array();

        while ($row = $data->fetch_assoc()) { 
          
            array_push($emmRec["records"], array(
                "id" => $row['id'],
                "name" => $row['name'],
                "email" => $row['email'],
                "phone_number" => $row['phone_number'],
                "gender" => $row['gender'],
                "address" => $row['address'],
                "city" => $row['city'],
                "state" => $row['state'],
                "pin_code" => $row['pin_code'],
                "user_id" => $row['user_id'],

            ));
        }
       
        http_response_code(200); // ok
        echo json_encode(array(
            "status" => 1,
            "data" => $emmRec["records"]
        ));
    }    
} else {
    http_response_code(503); // service unavailable
    echo json_encode(array(
        "status" => 0,
        "message" => "Access denied"
    ));
}






