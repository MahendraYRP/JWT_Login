<?php



require '../vendor/autoload.php';
use \Firebase\JWT\JWT;

//include headers
header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=utf-8");

// including files
include_once("../config/database.php");
include_once("../classes/Users.php");

//objects
$db = new Database();

$connection = $db->connect();

$salary_obj = new User($connection);

if($_SERVER['REQUEST_METHOD'] === "POST"){

   // body
   $data = json_decode(file_get_contents("php://input"));

   $headers = getallheaders();

   if (!empty($data->salary) && !empty($data->year)) {

     try{

       $jwt = $headers["Authorization"];

       $secret_key = "owt125";

       $decoded_data = JWT::decode($jwt, $secret_key, array('HS512'));
       
       $salary_obj->user_id = $decoded_data->data->id;
       $salary_obj->salary = $data->salary;
       $salary_obj->year = $data->year;



       if($salary_obj->empSalary()){

         http_response_code(200); // ok
         echo json_encode(array(
           "status" => 1,
           "message" => "Project has been created"
         ));
       }else{

         http_response_code(500); //server error
         echo json_encode(array(

           "status" => 0,
           "message" => "Failed to create project"
         ));
       }
     }catch(Exception $ex){

       http_response_code(500); //server error
       echo json_encode(array(
         "status" => 0,
         "message" => $ex->getMessage(),
         "message2" => "test 2"
       ));
     }
     
   }else{

     http_response_code(404); // not found
     echo json_encode(array(
       "status" => 0,
       "message" => "All data needed"
     ));
   }
}

 ?> 