<?php
class BookingController {
    private $model; 
    
    public function __construct($model) {
        $this->model = $model;
    }
    public function index() {
        $Bookings = $this->model->getBooking();
        include 'app/views/bookingtab.php';
    }
    public function addBooking() {
        $customer_id = $_POST['customer_id'];
        $ticket_id = $_POST['ticket_id'];
        $hotel_id= $_POST['hotel_id'];
        $date = $_POST['date'];
        $data = Array ( 
                        "customer_id" => $customer_id,
                        "ticket_id" => $ticket_id,
                        "hotel_id" => $hotel_id,
                        'date' => $date
                );
        if ($this->model->addBooking($data)) {
            /* echo "Booking added successfully!";
            header(" refresh: 2; url =/Tourist-office-reservations/mvc/ "); */
            echo json_encode(array('status'=> 'success', 'data' =>$data) );
        } else {
            echo json_encode(array('status'=> 'error', 'data' =>$data) );

        }
    }
    public function updataBooking(){
        
        /* $Bookings = $this->model->getBooking($_GET['id']);
        foreach ($Bookings as $Booking ) {
            $customer_id = $Booking['customer_id'];
            $ticket_id = $Booking['ticket_id'];
            $hotel_id= $Booking['hotel_id'];
            $date = $Booking['date'];
        } */
        
        /* if (isset($_POST['updata'])) { */
        $data = Array ( 
                        "customer_id" => $_POST['customer_id'],
                        "ticket_id" => $_POST['ticket_id'],
                        'hotel_id' => $_POST['hotel_id'],
                        "date" => $_POST['date']); 
                        
            if ($this->model->UpdataBooking($data,$_GET['id'])) {
                /* echo "Booking upadtaed successfully!";
                header("refresh: 1; url = /Tourist-office-reservations/mvc/"); */
                echo json_encode(array('status'=> 'success', 'data' =>$data) );

            } 
            else {
                /* echo "Failed to update Booking ."; */
                echo json_encode(array('status'=> 'Failed', 'data' =>$data) );

            }
        
        /* else {
            require "app/views/editbooking.php";
        }

    } */}
    public function deleteBooking($id) {
        if ($this->model->deleteBooking($id)) {
            echo "Booking deleted successfully!";
            /* header("refresh: 1; url = /darrbeni/mvc/"); */
        } 
        else {
            echo "Failed to delete user.";
            }

    }
    
}


?>