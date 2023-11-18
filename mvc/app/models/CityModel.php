<?php
// app/models/UserModel.php
class CityModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUsers() {
        return $this->db->get('cities');
    }

    public function addUser($data) {
        return $this->db->insert('cities', $data);
    }
}
?>
