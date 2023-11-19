<?php
// app/models/UserModel.php

class CityModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function getCities() {
        return $this->db->get('cities');
    }
    public function addCity($data) {
        return $this->db->insert('cities', $data);
    }
    public function updateCity($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('cities', $data);
    }
    public function deleteCity($id) {
        $this->db->where('id', $id);
        return $this->db->delete('cities');
    }

    
}
?>
