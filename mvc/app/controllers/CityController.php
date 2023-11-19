<?php

class CityController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    /*public function index() {
        $cities = $this->model->getCities();
        
       
    }*/

    public function addCity() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name=$_POST['name'];
            $country=$_POST['country'];
            $data = [
                'name' => $name ,
                'country' => $country ,
            ];

            if ($this->model->addCity($data)) {
                echo json_encode(array('status'=>'ok',"data"=>$data));
            } else {
                echo "Failed to add city.";
            }
        }
    }

    /*public function showCities(){


       $this->$model->getCities();

    }*/

    /*public function updateCity($id){
        $model->where(id)->delete();
    }
    public function deleteCity($id){
        $this->model->where('id',$id)->delete();
    }*/
}
?>
