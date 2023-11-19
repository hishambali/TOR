<?php
class HotelController {

    private $model;

    public function __construct($model) {
        $this->model = $model;
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

            if ($this->model->addHotel($data)) {
                // echo json_encode($data);
                echo json_encode(array('status'=>'ok','data'=>$data));
            } else {
                // echo json_encode($data);
                echo json_encode(array('status'=>'ok','data'=>'sorry'));
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

}
?>