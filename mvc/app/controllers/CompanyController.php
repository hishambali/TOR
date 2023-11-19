<?php
class CompanyController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
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

            if ($this->model->addCompany($data)) {
                // echo json_encode($data);
                echo json_encode(array('status'=>'ok','data'=>$data));
            } else {
                // echo json_encode($data);
                echo json_encode(array('status'=>'ok','data'=>'sorry'));

            }
        }
    }
    public function deleteCompany($id){
        $this->model->where('id',$id)->delete();
    }
}
?>
