<?php

require_once 'Database.php';

class Role {
    
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function findRole($roleId){
        $this->db->query('SELECT Role FROM Roles WHERE Id_Role = :roleId');
        $this->db->bind(':roleId', $roleId);

        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }


}
