<?php
// app/controllers/UserController.php


class CityController {
    private $model;
    public function __construct($db) {
      
        $this->model = new CityModel($db);
    }
   
    public function index() {
        $cities = $this->model->getCities();
        include __DIR__.'/../views/cities_list.php';
    }

    public function addCity() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cityname = $_POST['name'];
            $country = $_POST['country'];
            $data = [
                'cityname' => $cityname,
                'password' => $country,
            ];

            if ($this->model->addCity($data)) {
                header('Location:' . BASE_PATH);
                echo 'done' ;
            } else {
                echo "Failed to add city.";
            }
        }
    }
    public function deleteCity($id) {
        if ($this->model->deleteCity($id)) {
            echo "City deleted successfully!";
            header('Location:' . BASE_PATH);
        } else {
            echo "Failed to delete city.";
        }
    }
    public function searchCities($searchTerm) {
        $cities = $this->model->searchCities($searchTerm);
        include '../views/city_list.php';
    }

?>
