<?php
require_once __DIR__.'/../models/HotelModel.php';
require_once __DIR__.'/../models/CityModel.php';

class HotelController {

    private $model;
    private $city;

    public function __construct($db) {
        $this->model = new HotelModel($db) ;
        $this->city = new CityModel($db);
    }

    public function addHotel() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $city_id = $_POST['city_id'];
            $data = [
                'name' => $name,
                'phone' => $phone,
                'city_id' => $city_id
            ];
            if ($this->data_full($data)){
                if($this->data_validation($data))
                    {
                        if ($this->model->addHotel($data)) {
                            // echo json_encode($data);
                            echo json_encode(array('status'=>'ok','data'=>$data));
                        } else {
                            // echo json_encode($data);
                            echo json_encode(array('status'=>'ok','data'=>'sorry'));
                        }
                    }
            }
        }
    }

    public function showHotels() {
        $hotels = $this->model->getHotels();
        if ($this->model->getHotels()) {
            // echo json_encode($data);
            echo json_encode(array('status'=>'ok','data'=>$hotels));
        } else {
            // echo json_encode($data);
            echo json_encode(array('status'=>'ok','data'=>'sorry'));
        }
    }

    public function deleteHotel($id) {
        if ($this->model->deleteHotel($id)) {
            // echo json_encode($data);
            echo json_encode(array('status'=>'ok','data'=>'hotel deleted successfully!'));
        } else {
            // echo json_encode($data);
            echo json_encode(array('status'=>'ok','data'=>'Failed to delete hotel.'));
        }
    }

    public function updateHotel($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $city_id = $_POST['city_id'];
            $data = [
                'name' => $name,
                'phone' => $phone,
                'city_id' => $city_id
            ];
            if ($this->model->updateHotel($id, $data)) {
                // echo json_encode($data);
                echo json_encode(array('status'=>'ok','data'=>'hotel updated successfully!'));
            } else {
                // echo json_encode($data);
                echo json_encode(array('status'=>'ok','data'=>'Failed to update hotel.'));
            }
        } else {
            $hotel = $this->model->getHotelById($id);
        }
    }

    public function data_full($data=array()) {
        // var_dump($data);
         $res = true;
         foreach($data as $key => $value)
         {
             if (empty($value))
             {
                 echo json_encode(array('status'=>'ok','data'=> "$key is empty please enter data "));
                 $res = false ;
             } 
         }
         return $res ;
    }

    public function data_validation ($data)
    {
            if ($this->valid_city_id($data['city_id'])
                && $this->valid_name($data['name'])
                && $this->valid_phone($data['phone']))
            {
                return True;
            }else{
                return False;}
    }

    public function valid_phone($phone){
        $structure = "/^([0-9]+)$/";
        if (preg_match($structure,$phone)){
            return True;
        }
        else {
            echo json_encode(array('status'=>'ok','data'=>'invalid phone '));
            return False ;
        }
    }
    public function valid_name($name){
        $structure = "/^([A-Za-z0-9]+)$/";
        if (preg_match($structure,$name)){
            return True;
        }
        else {
            echo json_encode(array('status'=>'ok','data'=>'invalid name '));
            return False ;
        }
    }
    public function valid_city_id($city_id){
        if ($this->city->getCityById($city_id))
        {
            return True;
        }else {
            echo json_encode(array('status'=>'ok','data'=>'this city not found'));
            return False ;
        }
    }

}
?>