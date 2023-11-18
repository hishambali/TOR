<?php
// app/controllers/UserController.php
class RateController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function index() {
        $cities = $this->model->getCities();
        
       
    }

    public function addCities() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_id=$_POST['customer_id'];
            $rate=$_POST['rate'];
            $hotel_id=['hotel_id'];
            $comment=['comment'];
            $data = [
                'customer_id' => $customer_id ,
                'rate' => $rate ,
                'hotel_id'=> $hotel_id,
                'comment'=> $comment
            ];

            if ($this->model->addCities($data)) {
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
    }*/
    public function deleteUser($id){
        $this->model->where('id',$id)->delete();
    }
}
?>
