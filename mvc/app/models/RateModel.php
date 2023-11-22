<?php

class RateModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getRates() {
        return $this->db->get('rates');
    }

    public function addRate($data) {
        return $this->db->insert('rates', $data);
    }
    public function getRateById($id) {
        return $this->db->where('id', $id)->getOne('rates');
    }
}
?>
