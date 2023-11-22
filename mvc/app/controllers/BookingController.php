<?php
require_once __DIR__.'/../models/BookingModel.php';
require_once __DIR__.'/../models/TicketModel.php';
require_once __DIR__.'/../models/HotelModel.php';
require_once __DIR__.'/../models/CustomerModel.php';

class BookingController {

    private $model; 
    private $ticket; 
    private $customer; 
    private $hotel; 
    
    public function __construct($db) {
        $this->model = new BookingModel($db);
        $this->ticket = new TicketModel($db);
        $this->customer = new CustomerModel($db);
        $this->hotel = new HotelModel($db);
    }
    public function index() {
        $Bookings = $this->model->getBooking();
        echo json_encode($Bookings);
        /* include 'app/views/bookingtab.php'; */
    }
    public function addBooking() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        if ($this->data_full($data))
        {
            if($this->data_validation($data))
                {
                    if ($this->model->addBooking($data)) {
                        /* echo "Booking added successfully!";
                        header(" refresh: 2; url =/Tourist-office-reservations/mvc/ "); */
                        echo json_encode(array('status'=> 'success', 'data' =>$data) );
                    } else {
                        echo json_encode(array('status'=> 'error', 'data' =>$data) );
                    
                    }
            }
        }
    }
}
    public function updataBooking($id){
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $customer_id = $_POST['customer_id'];
                $ticket_id = $_POST['ticket_id'];
                $date = $_POST['date'];
                $hotel_id = $_POST['hotel_id'];
                $data = Array ( 
                        "customer_id" => $_POST['customer_id'],
                        "ticket_id" => $_POST['ticket_id'],
                        'hotel_id' => $_POST['hotel_id'],
                        "date" => $_POST['date']
                    ); 
                if ($this->data_validation ($data)){
                    if ($this->model->UpdataBooking($data,$_GET['id'])) {
                        echo json_encode(array('status'=> 'success', 'data' =>$data) );
                    } 
                    else {
                        echo json_encode(array('status'=> 'Failed', 'data' =>"failed to update booking") );}
                    }
            }else {
                $booking = $this->model->getBookingById($id);
            }
            
        }

    public function deleteBooking($id) {

        if ($this->model->getBookingById($id))
            {
                if ($this->model->deleteBooking($id)) {
                    echo json_encode(array('status'=>'ok','data'=>'Booking deleted successfully!'));
                } 
                else {
                    echo json_encode(array('status'=>'ok','data'=>'failed to delete booking'));
                }
        }else {
            echo json_encode(array('status'=>'ok','data'=>'Booking not found'));
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
        if ($this->valid_customer_id($data['customer_id'])
                && $this->valid_ticket_id($data['ticket_id'])
                && $this->valid_hotel_id($data['hotel_id'])
            )
            {
                return True;
            }else{
                return False;}
    }
    public function valid_customer_id($customer_id) {
            if ($this->customer->getCustomerById($customer_id))
            {
                return True;
            }else {
                echo json_encode(array('status'=>'ok','data'=>'this customer not found'));
                return False ;
            }
    }
    public function valid_hotel_id($hotel_id) {
            if ($this->hotel->getHotelById($hotel_id))
            {
                return True;
            }else {
                echo json_encode(array('status'=>'ok','data'=>'this Hotel not found'));
                return False ;
            }
    }
    public function valid_ticket_id($ticket_id) {
            if ($this->ticket->getTicketById($ticket_id))
            {
                return True;
            }else {
                echo json_encode(array('status'=>'ok','data'=>'this Ticket not found'));
                return False ;
            }
    }
}


?>