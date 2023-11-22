<?php
require_once __DIR__.'/../models/CompanyModel.php';

class CompanyController {
    private $model;

    public function __construct($db) {
        $this->model = new CompanyModel($db);
    }

    public function index() {
        $d = $this->model->getCompany();
        echo json_encode($d);
    }

    public function addCompany() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name=$_POST['name'];
            $phone=$_POST['phone'];
            $data = [
                'name' => $name ,
                'phone' => $phone ,
            ];
            if ($this->data_full($data)){
                if($this->data_validation($data))
                    {
                        if ($this->model->addCompany($data)) {
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
    public function deleteCompany($id){
       if ($this->model->getCompanyById($id))
            {
                if ($this->model->deleteCompany($id)) {
                // echo json_encode($data);
                echo json_encode(array('status'=>'ok','data'=>"Company deleted successfully!"));
            } else {
                // echo json_encode($data);
                echo json_encode(array('status'=>'ok','data'=>'Failed to delete Company'));
            }
        }else {
            echo json_encode(array('status'=>'ok','data'=>'Company not found'));
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
            if ($this->valid_name($data['name'])
                && $this->valid_phone($data['phone'])
                )
                {
                    return True;
                }
            else{
                return False;
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
}
?>