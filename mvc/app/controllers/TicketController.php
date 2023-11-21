<?php
require_once __DIR__.'/../models/CompanyModel.php';
require_once __DIR__.'/../models/TicketModel.php';
require_once __DIR__.'/../models/CityModel.php';

class TicketController {

private $model;
private $city;
private $company;

    public function __construct($db) {
        $this->model = new TicketModel($db);
        $this->city = new CityModel($db);
        $this->company = new CompanyModel($db);
    }

    public function addTicket() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $company_id=$_POST['company_id'];
            $city_id=$_POST['city_id'];
            $date_s=$_POST['date_s'];
            $date_e=$_POST['date_e'];
            $data = [
                'company_id' => $company_id ,
                'city_id' => $city_id ,
                'date_s' => $date_s ,
                'date_e' => $date_e ,
            ];
            if ($this->data_full($data)){
                if ($this->data_validation($data))
                {
                    if ($this->model->addTicket($data)) {
                        echo json_encode(array('status'=>'ok','data'=>$data));
                    } else {
                        echo json_encode(array('status'=>'ok','data'=>'sorry'));
                    }
                }
            }
        }
    }

    public function deleteTicket($id){
        $this->model->where('id',$id)->delete();
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
            if ($this->valid_company_id($data['company_id'])
                && $this->valid_city_id($data['city_id'])
                )
                {
                    return True;
                }
            else{
                return False;
                }
    }
    public function valid_company_id($company_id){
        if ($this->company->getCompanyById($company_id))
        {
            return True;
        }
        else {
            echo json_encode(array('status'=>'ok','data'=>'this company not found'));
            return False ;
        }
    }
    public function valid_city_id($city_id){
        if ($this->city->getCityById($city_id))
        {
            return True;
        } 
        else {
            echo json_encode(array('status'=>'ok','data'=>'this city not found'));
            return False ;
        }
    }
    
}
?>
