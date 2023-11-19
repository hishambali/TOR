<?php
    
class CustomerController {
    
    private $model;
  
    public function __construct($model) {
        $this->model = $model;
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

    public function showCustomers() {
        $customers = $this->model->getCustomers();
        print_r(json_encode($customers));
    }

    public function deleteCustomer($id) {
        if ($this->model->deleteCustomer($id)) {
            // echo json_encode($data);
            echo json_encode(array('status'=>'ok','data'=>"customer deleted successfully!"));
        } else {
            // echo json_encode($data);
            echo json_encode(array('status'=>'ok','data'=>'Failed to delete customer'));
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
            if ($this->model->updateCustomer($id, $data)) {
                // echo json_encode($data);
                echo json_encode(array('status'=>'ok','data'=>$data));
            } else {
                // echo json_encode($data);
                echo json_encode(array('status'=>'ok','data'=>'Failed to update customer'));
            }

        } else {
            $customer = $this->model->getCustomerById($id);
        }
    }
}


?>