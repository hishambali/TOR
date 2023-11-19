<?php
class AdminController {
    
    private $model;
    public function __construct($model) {
        $this->model = $model;
    }
    public function index() {
        $admins = $this->model->getAdmins();
        include 'app/views/admintab.php';
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
            echo "admin added successfully!";
            header("refresh: 1; url =/Tourist-office-reservations/mvc/");
        } else {
            echo "Failed to add admin.";
        }
    }
}

?>