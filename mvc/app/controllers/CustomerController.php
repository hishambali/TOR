<?php
require_once __DIR__.'/../models/CustomerModel.php';

class CustomerController {
    
    private $model;
  
    public function __construct($db) {
        $this->model = new CustomerModel($db);
    }
    
    public function addCustomer() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $data = [
                'name' => $name,
                'phone' => $phone,
                'gender' => $gender,
                'email' => $email
            ];
            // var_dump($data);
            if ($this->data_full($data))
            {
                if($this->data_validation($data))
                {
                    // var_dump($_POST);
                    if ($this->model->addCustomer($data)) {
                        // echo json_encode($data);
                        echo json_encode(array('status'=>'ok','data'=>$data));
                    } else {
                        // echo json_encode($data);
                        echo json_encode(array('status'=>'ok','data'=>'Failed to add customer'));
                    }
                }
            }
        }
    }

    public function showCustomers() {
        $customers = $this->model->getCustomers();
        print_r(json_encode($customers));
    }

    public function deleteCustomer($id) {
        if ($this->model->getCustomerById($id))
            {
                if ($this->model->deleteCustomer($id)) {
                // echo json_encode($data);
                echo json_encode(array('status'=>'ok','data'=>"customer deleted successfully!"));
            } else {
                // echo json_encode($data);
                echo json_encode(array('status'=>'ok','data'=>'Failed to delete customer'));
            }
        }else {
            echo json_encode(array('status'=>'ok','data'=>'customer not found'));
        }
        
    }

    public function updateCustomer($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $data = [
                'name' => $name,
                'phone' => $phone,
                'gender' => $gender,
                'email' => $email
            ];
            if ($this->data_validation ($data)){
                if ($this->model->updateCustomer($id, $data)) {
                    // echo json_encode($data);
                    echo json_encode(array('status'=>'ok','data'=>$data));
                } else {
                    // echo json_encode($data);
                    echo json_encode(array('status'=>'ok','data'=>'Failed to update customer'));
                }
        }
    }else {
            $customer = $this->model->getCustomerById($id);
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
            if ($this->valid_email($data['email'])
                && $this->valid_name($data['name'])
                && $this->valid_phone($data['phone'])
                && $this->valid_gender($data['gender']))
            {
                return True;
            }else{
                return False;}
    }
    public function valid_email($email){
        $structure = "/^([a-z0-9]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
        if (preg_match($structure,$email)){
            return True;
        }
        else {
            echo json_encode(array('status'=>'ok','data'=>'invalid email '));
        return False ;
        }
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
        $structure = "/^([A-Za-z]+)$/";
        if (preg_match($structure,$name)){
            return True;
        }
        else {
            echo json_encode(array('status'=>'ok','data'=>'invalid name '));
            return False ;
        }
    }

    public function valid_gender($gender){
        if ($gender=='female' || 
            $gender=='male'){
                return True;
            }
        else{
            echo json_encode(array('status'=>'ok','data'=>'invalid gender please enter (male/female)'));
            return False ;
        }
    }

}


?>