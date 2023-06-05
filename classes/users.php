<?php

class User
{

    public $phone_number;
    public $salary;
    public $gender;
    public $address;
    public $city;
    public $state;
    public $pin_code;
    

    // define properties
    public $name;
    public $email;
    public $password;
    public $user_id;
    public $project_name;
    public $description;
    public $status;

    private $conn;
    private $users_tbl;
    private $projects_tbl;
    private $employees_tbl;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->users_tbl = "user_table";
        $this->projects_tbl = "project_table";
        $this->employees_tbl = "Employees";
    }

    public function create_user()
    {

        $user_query = "INSERT INTO " . $this->users_tbl . " SET name = ?, email = ?, password = ?";

        $user_obj = $this->conn->prepare($user_query);

        $user_obj->bind_param("sss", $this->name, $this->email, $this->password);

        if ($user_obj->execute()) {
            return true;
        }

        return false;
    }

    public function check_email()
    {

        $email_query = "SELECT * from " . $this->users_tbl . " WHERE email = ?";

        $usr_obj = $this->conn->prepare($email_query);

        $usr_obj->bind_param("s", $this->email);

        if ($usr_obj->execute()) {

            $data = $usr_obj->get_result();

            return $data->fetch_assoc();
        }

        return array();
    }

    public function check_login()
    {

        $email_query = "SELECT * from " . $this->users_tbl . " WHERE email = ?";

        $usr_obj = $this->conn->prepare($email_query);

        $usr_obj->bind_param("s", $this->email);

        if ($usr_obj->execute()) {

            $data = $usr_obj->get_result();

            return $data->fetch_assoc();
        }

        return array();
    }

    //create project
    // public function create_project()
    // {
    //     $project_query = "INSERT INTO ".$this->projects_tbl." SET user_id = ?, name = ?, description = ? status=?";
    //     $project_obj = $this->conn->prepare( $project_query);

    //     $project_name = htmlspecialchars(strip_tags($this->project_name));
    //     $description = htmlspecialchars(strip_tags($this->description));
    //     $status = htmlspecialchars(strip_tags($this->status));

    //     $project_obj->bind_param("isss",$this->user_id, $project_name, $description, $status);


    //     if ($project_obj->execute()) {
    //         return true;
    //     }
    //      return false;


    // }

    


    public function create_project(){

        $project_query = "INSERT into ".$this->projects_tbl." SET user_id = ?, name = ?, description = ?, status = ?";
  
        $project_obj = $this->conn->prepare($project_query);
        // sanitize input variables
        $project_name = htmlspecialchars(strip_tags($this->project_name));
        $description = htmlspecialchars(strip_tags($this->description));
        $status = htmlspecialchars(strip_tags($this->status));
        // bind parameters
        $project_obj->bind_param("isss", $this->user_id, $project_name, $description, $status);
  
        if($project_obj->execute()){
          return true;
        }
  
        return false;
  
    }


    public function create_Employees(){

        $Employees_query = "INSERT INTO ".$this->employees_tbl." SET user_id = ?, name = ?, email = ?, phone_number = ?, salary = ?, gender = ?, address = ?, city = ?, state = ?, pin_code = ?";

        
        $Employees_list = $this->conn->prepare($Employees_query);
    
        $name = htmlspecialchars(strip_tags($this->name));
        $email = htmlspecialchars(strip_tags($this->email));
        $phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $salary = htmlspecialchars(strip_tags($this->salary));
        $gender = htmlspecialchars(strip_tags($this->gender));
        $address = htmlspecialchars(strip_tags($this->address));
        $city = htmlspecialchars(strip_tags($this->city));
        $state = htmlspecialchars(strip_tags($this->state));
        $pin_code = htmlspecialchars(strip_tags($this->pin_code));
    
        $Employees_list->bind_param("isssisssss", $this->user_id, $name, $email, $phone_number, $salary, $gender, $address, $city, $state, $pin_code);
     
        if ($Employees_list->execute()) {
            return true;
        }
        return false;
        }










        
    }









