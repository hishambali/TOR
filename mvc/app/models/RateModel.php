<?php
// app/models/UserModel.php
class RateModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function getRates() {
        return $this->db->get('rates');
    }
    public function addRate($data) {
        return $this->db->insert('cities', $data);
    }
    public function getRateById($id) {
        return $this->db->where('id', $id)->getOne('rates');
    }
    public function deleteRate($id) {
        $this->db->where('id', $id);
        return $this->db->delete('rate');
    }
    public function searchRates($searchTerm) {
       // $this->db->where('username', $searchTerm, 'LIKE');
        return $this->db->get('rates');
    }
}
?>
