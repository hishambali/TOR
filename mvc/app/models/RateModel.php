<?php
// app/models/UserModel.php
class RateModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUsers() {
        return $this->db->get('rates');
    }

    public function addUser($data) {
        return $this->db->insert('rates', $data);
    }
}
?>
