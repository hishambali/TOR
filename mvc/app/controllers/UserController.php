<?php
// app/controllers/UserController.php
class UserController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function index() {
        $users = $this->model->getUsers();
        
        include 'app/views/user_list.php';
    }

    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username=$_POST['username'];
            $email=$_POST['password'];
            $data = [
                'username' =>$username ,
                'password' => $email ,
            ];

            if ($this->model->addUser($data)) {
                echo "User added successfully!";
            } else {
                echo "Failed to add user.";
            }
        }
    }
}
?>
