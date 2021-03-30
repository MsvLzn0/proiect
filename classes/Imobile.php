<?php

include 'lib/Database.php';
include_once 'lib/Session.php';


class Imobile
{


    // Db Property
    private $db;

    // Db __construct Method
    public function __construct()
    {
        $this->db = new Database();
    }

    // Date formate Method
    public function formatDate($date)
    {

        $strtime = strtotime($date);
        return date('Y-m-d H:i:s', $strtime);
    }

    // Check Exist Nr_cadastral Method
    public function checkExistEmail($nr_cadastral){
        $sql = "SELECT nr_cadastral from  imobil WHERE nr_cadastral = :nr_cadastral";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':nr_cadastral', $nr_cadastral);
        $stmt->execute();
        if ($stmt->rowCount()> 0) {
            return true;
        }else{
            return false;
        }
    }

// Add New Imobil By Admin
    public function addNewImobilByAdmin($data){

}












