<?php
// app/models/UserModel.php
class CompanyModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getCompany() {
        return $this->db->get('companies');
    }

    public function addCompany($data) {
        return $this->db->insert('companies', $data);
    }
}
?>
