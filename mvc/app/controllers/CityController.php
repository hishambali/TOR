<?php
// app/controllers/UserController.php
class CityController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    /*public function index() {
        $cities = $this->model->getUsers();
        
        include 'app/views/user_list.php';
    }*/

    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name=$_POST['name'];
            $country=$_POST['country'];
            $data = [
                'name' => $name ,
                'country' => $country ,
            ];

            if ($this->model->addUser($data)) {
                echo json_encode(array('status'=>'ok',"data"=>$data));
            } else {
                echo "Failed to add user.";
            }
        }
    }

    /*public function showUsers(){


       $this->$model->getUsers();

    }*/

    /*public function updateUser($id){
        $model->where(id)->delete();
    }
    public function deleteUser($id){
        $this->model->where("id=$id")->delete();
    }*/
}
?>
