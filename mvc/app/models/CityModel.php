<?php

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
}
?>
