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

$emp_obj = new User($connection);

if($_SERVER['REQUEST_METHOD'] === "POST"){


   $data = json_decode(file_get_contents("php://input"));

   $headers = getallheaders();

   if (!empty($data->name) && !empty($data->email) && !empty($data->phone_number) && !empty($data->gender) && 
   !empty($data->address) && !empty($data->city) && !empty($data->state) && !empty($data->pin_code)) {

     try{

       $jwt = $headers["Authorization"];

       $secret_key = "owt125";

       $decoded_data = JWT::decode($jwt, $secret_key, array('HS512'));
       
       $emp_obj->user_id = $decoded_data->data->id;
       $emp_obj->name = $data->name;
       $emp_obj->email = $data->email;
       $emp_obj->phone_number = $data->phone_number;   
      //  $emp_obj->salary = $data->salary;   
       $emp_obj->gender = $data->gender;
       $emp_obj->address = $data->address;
       $emp_obj->city = $data->city;
       $emp_obj->state = $data->state;
       $emp_obj->pin_code = $data->pin_code;

       if($emp_obj->create_Employees()){

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