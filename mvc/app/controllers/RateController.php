<?php
require_once __DIR__.'/../models/HotelModel.php';
require_once __DIR__.'/../models/RateModel.php';
require_once __DIR__.'/../models/CustomerModel.php';

class RateController {
    private $model;
    private $hotel;
    private $customer;

    public function __construct($db) {
        $this->hotel = new HotelModel($db);
        $this->model = new RateModel($db);
        $this->customer = new CustomerModel($db);
    }

    public function addRate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_id=$_POST['customer_id'];
            $rate=$_POST['rate'];
            $hotel_id=$_POST['hotel_id'];
            $comment=$_POST['comment'];
            $data = [
                'customer_id' => $customer_id ,
                'rate' => $rate ,
                'hotel_id'=> $hotel_id,
                'comment'=> $comment
            ];
            if ($this->data_full($data)){
                if($this->data_validation($data))
                {
                    if ($this->model->addRate($data)) {
                        echo json_encode(array('status'=>'ok',"data"=>$data));
                    
                    } else {
                        echo json_encode(array('status'=>'ok',"data"=>"Failed to add rate."));
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
            if ($this->valid_hotel_id($data['hotel_id'])
                && $this->valid_customer_id($data['customer_id'])
                && $this->valid_rate($data['rate'])
                )
            {
                return True;
            }else{
                return False;
            }
    }
    public function valid_hotel_id($hotel_id) { 
            if ($this->hotel->getHotelById($hotel_id))
            {
                return True;
            }else {
                echo json_encode(array('status'=>'ok','data'=>'this hotel not found'));
                return False ;
            }
    }

    public function  valid_customer_id($customer_id) {
            if ($this->customer->getCustomerById($customer_id))
            {
                return True;
            }else {
                echo json_encode(array('status'=>'ok','data'=>'this customer not found'));
                return False ;
            }
        }
    
    public function valid_rate($rate) {
        if (preg_match('/^[0-9]$/',$rate))
            {$rate = (int)$rate;
            if ($rate>=1 && $rate <=5){
                return True;
            }
            else{
                echo json_encode(array('status'=>'ok','data'=>'Enter rate between [1,5]'));
                return False ;
            }
        }else {
            echo json_encode(array('status'=>'ok','data'=>"rate must be one number integer"));
                return False ;
        }
    }
}

?>
