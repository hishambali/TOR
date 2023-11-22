<?php
class AdminModel {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }
    public function getAdmins ($id = null){
        if (isset($id)) {
            $this->db->where("id",$id);
            return $this->db->get('admin');
        }
        else {
            return $this->db->get('admin');
        }
        
    }
    public function getAdminsByemail ($email = null){
        if (isset($email)) {
            $this->db->where("email",$email);
            return $this->db->get('admin');
        }
        
        
    }
    public function addAdmin($data){
        return $this->db->insert('admin', $data);

    }
    public function UpdataAdmin($data,$id){
        $this->db->where('id',$id );
        return $this->db->update('admin', $data);
    }
    public function deleteAdmin($id){
        $this->db->where('id', $id);
        return $this->db->delete('admin');
        
    }
}

?>
