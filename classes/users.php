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
    public $year;
    public $id; 
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
    private $empsalary;
    private $employees_tbl;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->users_tbl = "user_table";
        $this->empsalary = "empsalary";
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


    public function create_Employees(){

        $Employees_query = "INSERT INTO ".$this->employees_tbl." SET user_id = ?, name = ?, email = ?, phone_number = ?, gender = ?, address = ?, city = ?, state = ?, pin_code = ?";

        
        $Employees_list = $this->conn->prepare($Employees_query);
    
        $name = htmlspecialchars(strip_tags($this->name));
        $email = htmlspecialchars(strip_tags($this->email));
        $phone_number = htmlspecialchars(strip_tags($this->phone_number));
        // $salary = htmlspecialchars(strip_tags($this->salary));
        $gender = htmlspecialchars(strip_tags($this->gender));
        $address = htmlspecialchars(strip_tags($this->address));
        $city = htmlspecialchars(strip_tags($this->city));
        $state = htmlspecialchars(strip_tags($this->state));
        $pin_code = htmlspecialchars(strip_tags($this->pin_code));
    
        $Employees_list->bind_param("isssisssss", $this->user_id, $name, $email, $phone_number, $gender, $address, $city, $state, $pin_code);
     
        if ($Employees_list->execute()) {
            return true;
        }
        return false;
        }




        public function empSalary( $year,$salary){

          
            $empSalary = "INSERT into ".$this->empsalary." SET user_id = ?, salary = ?, year = ?";
            
            $Salary_obj = $this->conn->prepare($empSalary);
                       
            $Salary_obj->bind_param("iii", $this->user_id, $salary, $year);
             
                if($Salary_obj->execute()){
                    return true;
                }
           
            
            return false;
        }
        

        public function readEmployee(){
            $readEmp = "SELECT * from ".$this->employees_tbl." ";
            $readEmp_obj = $this->conn->prepare($readEmp);

            if ($readEmp_obj->execute()) {
                return $readEmp_obj->get_result();
            }
            return false;
        }
        

        public function displaySalary(){
            $displaysalay = "SELECT * from ".$this->empsalary." ";

            $displaysalary_obj = $this->conn->prepare($displaysalay);

            if ( $displaysalary_obj->execute()) {
                return  $displaysalary_obj->get_result();
            }
            return false;

        }

        public function updateEmp($name, $email, $phone_number, $id){ 
            $updateEmp = "UPDATE ".$this->employees_tbl." SET name = ?, email = ?, phone_number = ? WHERE id = ?" ; 

            $updateEmp_obj = $this->conn->prepare($updateEmp);

            $updateEmp_obj->bind_param('sssi',$name, $email, $phone_number, $id);
            

            if ($updateEmp_obj->execute()) {
                return true;
            }

            return false;
        }

        public function updateSalary($user_id, $salary, $year){
               
            $updatesalary = "UPDATE ".$this->empsalary." SET Salary = ?, year = ? WHERE user_id	 = ?";

            $updatesatary_obj = $this->conn->prepare($updatesalary);

            $updatesatary_obj->bind_param('iii',$user_id, $salary, $year);


            if ($updatesatary_obj->execute()) {
                return true;
            }
               return false;
        }

        
    }









