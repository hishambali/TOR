<?php
// app/controllers/UserController.php
class RateController {
    private $model;
  

    public function __construct($db) {
      
        $this->model = new RateModel($db);
    }
   
    public function index() {
        $rates = $this->model->getRates();
        /* include __DIR__.'/../views/Rates_list.php'; */
    }

    public function addRate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $hotelname = $_POST['hotelname'];
            $comment=$_POST['comment'];
            $data = [
                'cityname' => $cityname,
                'password' => $country,
                'comment' => $comment
            ];

            if ($this->model->addRate($data)) {
                header('Location:' . BASE_PATH);
                echo 'done' ;
            } else {
                echo "Failed to add Rate.";
            }
        }
    }
    public function searchRates($searchTerm) {
        $rates = $this->model->searchRates($searchTerm);
        /* include '../views/rate_list.php'; */
    }

?>
