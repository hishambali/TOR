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
    public function deleteCompany($id) {
        $this->db->where('id', $id);
        return $this->db->delete('companies');
    }
    public function getCompanyById($id) {
        return $this->db->where('id', $id)->getOne('companies');
    }
}
?>
