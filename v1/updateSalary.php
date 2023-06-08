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





    for ($i=0; $i <count($data) ; $i++) {

        if (!empty($data[$i]->id) && !empty($data[$i]->salary) && !empty($data[$i]->year)) {


            $updateSalary->salary = $data[$i]->salary;
            $updateSalary->year = $data[$i]->year;
            $updateSalary->id = $data[$i]->id;

            if ($updateSalary->updateSalary($data[$i]->salary, $data[$i]->year, $data[$i]->id)) {
                http_response_code(200);
                echo json_encode(
                    array(
                        "status" => 1,
                        "message" => "Data updated",


                    )
                );
            } else {
                http_response_code(500);
                echo json_encode(
                    array(
                        "status" => 0,
                        "message" => "not updated"
                    )
                );
            }
        } else {
            http_response_code(404); //Page not found
            echo json_encode(
                array(
                    "status" => 0,
                    "message" => "Values needed"
                )
            );
        }

    } 

}else {
    http_response_code(503);
    echo json_encode(
        array(
            "status" => 0,
            "message" => "Access denied"
        )
    );

}