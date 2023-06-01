<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charst=UTF-8");
header("Access-Control-Allow-Methods: POST");

//include
include_once('../config/database.php');
include_once('../classes/users.php');


//objects 
$db = new Database();
$connection = $db->connect();
$user = new User($connection);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $data = json_decode(file_get_contents("php://input"));


    if (!empty($data->name) && !empty($data->email) && !empty($data->password)) {

        $user->name = $data->name;
        $user->email = $data->email;
        // $user->password = $data->password;
        $user->password = password_hash($data->password, PASSWORD_DEFAULT);

        $email_data = $user->check_email();

        if (!empty($email_data)) {

            http_response_code((500));
            echo json_encode(array(
                "status" => 0,
                "message" => "Data already present"
            ));
         } else {
            if ($user->create_user()) {
                http_response_code(200);
                echo json_encode(array(
                    "status" => 1,
                    "message" => "user data inserted succefully"
                ));
             } else {
                http_response_code(404);
                echo json_encode(array(
                    "status" => 0,
                    "message" => "Failed to insert Data"

                ));
            }
        }
    } else {
        http_response_code(500);
        echo json_encode(array(
            "status" => 0,
            "message" => "All values need"
        ));
    }
} else {
    http_response_code(503); //server unavailable
    echo json_encode(array(
        "status" => 0,
        "message" => "Access Denied"
    ));
}
