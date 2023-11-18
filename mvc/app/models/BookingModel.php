<?php 
class BookingModel {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    public function getBooking ($id = null){
        if (isset($id)) {
            $this->db->where("id",$id);
            return $this->db->get('booking');
        }
        else {
            return $this->db->get('booking');
        } 
    }
    public function addBooking($data){
        return $this->db->insert('booking', $data);
    }
    public function UpdataBooking($data,$id){
        $this->db->where('id',$id );
        return $this->db->update('booking', $data);
    }
}


?>