<?php
require_once __DIR__.'/../models/CityModel.php';

class CityController {
    private $model;

    public function __construct($db) {
        $this->model = new CityModel($db);
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
            if ($this->data_full($data)){
                if($this->data_validation($data)){
                if ($this->model->addCity($data)) {
                    echo json_encode(array('status'=>'ok',"data"=>$data));
                     } else {
                        echo json_encode(array('status'=>'ok',"data"=>"Failed to add city."));
                    }
                }
            }
        }
    }
    public function data_full($data=array()) {
        // var_dump($data);
        $res = true;
        foreach($data as $key => $value)
        {
            if (empty($value))
            {
                echo json_encode(array('status'=>'ok','data'=> "$key is empty please enter data"));
                $res = false ;
            } 
        }
        return $res ;
    }
    public function data_validation ($data)
    {
            if ($this->valid($data['name'],'name')
                && $this->valid($data['country'],'contry')
                )
                {
                    return True;
                }
            else{
                return False;
                }
    }
    public function valid($name,$key){
        $structure = "/^([A-Za-z]+)$/";
        if (preg_match($structure,$name)){
            return True;
        }
        else {
            echo json_encode(array('status'=>'ok','data'=>"invalid $key"));
            return False ;
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
