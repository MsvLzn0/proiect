<?php

include_once 'lib/Database.php';
include_once 'lib/Session.php';


class Contracte{


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

// Check Exist Contract Method

    public function addNewContractByAdmin($data)
    {
        $nr_contract = $data['nr_contract'];
        $id_imobil = $data['id_imobil'];

        $checkContract = $this->checkExistContract($nr_contract);


        if ($nr_contract == "") {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Câmpurile de introducere nu trebuie să fie Golite!</div>';
            return $msg;
        } elseif ($checkContract == TRUE) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Contractul există deja, vă rugăm să încercați un alt raion ...!</div>';
            return $msg;
        } else {

            $sql = "INSERT INTO contract(nr_contract, id_imobil ) VALUES(:nr_contract, :id_imobil)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':nr_contract', $nr_contract);
            $stmt->bindValue(':id_imobil', $id_imobil);
            $result = $stmt->execute();
            if ($result) {
                $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success !</strong> Ați înregistrat cu succes!</div>';
                return $msg;
            } else {
                $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error !</strong> Ceva n-a mers bine !</div>';
                return $msg;
            }
        }
    }


    // Add New Regiune By Admin

    public function checkExistContract($nr_contract){
        $sql = "SELECT nr_contract from  contract WHERE nr_contract = :nr_contract";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':nr_contract', $nr_contract);
        $stmt->execute();
        if ($stmt->rowCount()> 0) {
            return true;
        }else{
            return false;
        }
    }
// Select All Contracte Method

    public function selectAllContracteData(){
        $sql = "SELECT * FROM contract ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function selectAllActiveContracte(){
        $sql = "SELECT * FROM contract  WHERE isActive='1' ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
}


// Delete Contract by Id Method
    public function deleteContracteById($remove){
        $sql = "DELETE FROM contract WHERE id = :id ";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id', $remove);
        $result =$stmt->execute();
        if ($result) {
            $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> Contract șters cu succes!</div>';
            return $msg;
        }else{
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Contract nu a fost șters!</div>';
            return $msg;
        }
    }
    // Contract activated By Admin
    public function contractActiveByAdmin($active){
        $sql = "UPDATE contract SET
       isActive=:isActive
       WHERE id = :id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':isActive', 1);
        $stmt->bindValue(':id', $active);
        $result =   $stmt->execute();
        if ($result) {
            echo "<script>location.href='contract.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Contract activat cu succes!</div>');
        }else{
            echo "<script>location.href='contract.php';</script>";
            Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Contract nu este activat!</div>');
        }
    }
// Contract Deactivated By Admin
    public function contractDeactiveByAdmin($deactive)
    {
        $sql = "UPDATE contract SET

       isActive=:isActive
       WHERE id = :id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':isActive', 0);
        $stmt->bindValue(':id', $deactive);
        $result = $stmt->execute();
        if ($result) {
            echo "<script>location.href='contract.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Contractul a fost dezactivat cu succes!</div>');

        } else {
            echo "<script>location.href='Contract.php';</script>";
            Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Contractul nu este dezactivate!</div>');
        }
    }

//   Get Single Service Information By Id Method
    public function updateContractByIdInfo($contractid, $data)
    {
        $nr_contract = $data['nr_contract'];
        $id_imobil = $data['id_imobil'];




        if ($nr_contract == "") {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Câmpurile de introducere nu trebuie să fie Golite!</div>';
            return $msg;
        } else {

            $sql = "UPDATE contract SET
          nr_contract = :nr_contract;
          id_imobil = :id_imobil
          WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':nr_contract', $nr_contract);
            $stmt->bindValue(':id_imobil', $id_imobil);
            $stmt->bindValue(':id', $contractid);
            $result = $stmt->execute();

            if ($result) {
                echo "<script>location.href='contract.php';</script>";
                Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Uau, informațiile dvs. au fost actualizate cu succes!</div>');


            } else {
                echo "<script>location.href='contract.php';</script>";
                Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Datele nu sunt inserate!</div>');


            }
        }
    }
    // Get Single Client Information By Id Method
    public function getContracteInfoById($contractid){
        $sql = "SELECT * FROM contract WHERE id = :id LIMIT 1";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id', $contractid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if ($result) {
            return $result;
        }else{
            return false;
        }


    }

}