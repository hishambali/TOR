<?php
class AdminController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }
    
    public function login($email, $password) {
        
        $this->model->getAdminsByemail($email);
        if ($this->model->getAdminsByemail($email)) {
            echo "hello ";
            $_SESSION['email']=$email;
            echo $_SESSION['email'];  
            header("location:/mvc/");
        }
        else {
            echo "plz enter valid information";
            
        }
    }
    public function index() {
        $admins = $this->model->getAdmins();
        echo json_encode(array('status'=> 'success', 'data' =>$admins) );
    }
    public function addAdmin() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $adminname= $_POST['name'];
        $data = Array ( "name" => $adminname,
                        "email" => $email,
                        "password" => $password,
        );
        if ($this->model->addAdmin($data)) {
            echo json_encode($data);
        } else {
            echo "Failed to add admin.";
            echo "<br>";
            echo json_encode($data);
        }
    }
}

?>