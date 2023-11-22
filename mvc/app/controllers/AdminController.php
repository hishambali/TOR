<?php

class AdminController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }
    
   

    public function login($email, $password) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)!=false) {
        $this->model->getAdminsByemail($email);
        if ($this->model->getAdminsByemail($email)) {
            
            $_SESSION['email']=$email;
            var_dump ($_SESSION['email']); 
            header("location:/mvc/");
            
              
        }
        else {
   
            echo json_encode(array('status'=> 'faild', 'data' =>'plz enter valid information') );
        }
    }else{
        echo json_encode(array('status'=> 'faild', 'data' =>'please enter true email') );

    }
    }

    public function index() {
        $admins = $this->model->getAdmins();
        echo json_encode(array('status'=> 'success', 'data' =>$admins) );
    }
    public function addAdmin() {
         function chechpassword($password){

            if(strlen($password)>=6)
            {
              echo "the password is clear"."<br>";
            }
            else
            {
              echo "the password is not correct"."<br>";
            }
          }
          
        $email = $_POST['email'];
        $password = $_POST['password'];
        $adminname= $_POST['name'];
        $data = Array ( "name" => $adminname,
                        "email" => $email,
                        "password" => $password,
        );
        if (filter_var($email, FILTER_VALIDATE_EMAIL)!=false and chechpassword($password)) {
        if ($this->model->addAdmin($data)) {
            echo json_encode($data);
        } else {
            echo json_encode(array('status'=> 'faild', 'data' =>'input error in email or password') );
            echo "<br>";
            echo json_encode($data);
        }
    }
}
}
?>
