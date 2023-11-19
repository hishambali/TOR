<?php

class RateController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }
/*
    public function index() {
        $rates = $this->model->getRates();
        
       
    } */

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

            if ($this->model->addRate($data)) {
                echo json_encode(array('status'=>'ok',"data"=>$data));

            } else {
                echo "Failed to add rate.";
            }
        }
    }

    /*public function showGetrates(){


       $this->$model->getRates();

    }*/

    /*public function updateRate($id){
        $model->where(id)->delete();
    }
    public function deleteRate($id){
        $this->model->where('id',$id)->delete();
    }*/
}
?>
