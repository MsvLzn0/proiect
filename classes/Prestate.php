<?php

include_once 'lib/Database.php';
include_once 'lib/Session.php';


class Prestate{


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

// Check Exist IDNP Address Method
    public function checkExistContract($id_contract){
        $sql = "SELECT id_contract from  servicii_prestate_contract WHERE id_contract = :id_contract";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id_contract', $id_contract);
        $stmt->execute();
        if ($stmt->rowCount()> 0) {
            return true;
        }else{
            return false;
        }
    }

    // Add New Client By Admin
    public function addNewServiciuPrestatByAdmin($data)
    {
        $id_contract = $data['id_contract'];
        $id_serviciu_prestat = $data['id_serviciu_prestat'];
        $data_start = $data['data_start'];
        $data_fin = $data['data_fin'];

        $checkContract = $this->checkExistContract($id_contract);


        if ($data_start == "" || $data_fin == "") {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Câmpurile de introducere nu trebuie să fie Golite!</div>';
            return $msg;
        } elseif ($checkContract == TRUE) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Contractul există deja, vă rugăm să încercați un alt id contract ...!</div>';
            return $msg;
        } else {

            $sql = "INSERT INTO servicii_prestate_contract(id_contract, id_serviciu_prestat, data_start, data_fin) VALUES(:id_contract, :id_serviciu_prestat, :data_start, :data_fin)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':id_contract', $id_contract);
            $stmt->bindValue(':id_serviciu_prestat', $id_serviciu_prestat);
            $stmt->bindValue(':data_start', $data_start);
            $stmt->bindValue(':data_fin', $data_fin);
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
// Select All Clients Method
    public function selectAllServiciiPrestateData(){
        $sql = "SELECT * FROM servicii_prestate_contract ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function selectAllActiveServiciiPrestate(){
        $sql = "SELECT * FROM servicii_prestate_contract WHERE isActive='1' ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


// Delete  by Id Method
    public function deleteServiciuPrestatById($remove){
        $sql = "DELETE FROM client WHERE id = :id ";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id', $remove);
        $result =$stmt->execute();
        if ($result) {
            $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> Serviciu prestat șters cu succes!</div>';
            return $msg;
        }else{
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Serviciu prestat nu a fost șters!</div>';
            return $msg;
        }
    }
// Client Deactivated By Admin
    public function prestatcontractDeactiveByAdmin($deactive)
    {
        $sql = "UPDATE servicii_prestate_contract SET

       isActive=:isActive
       WHERE id = :id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':isActive', 0);
        $stmt->bindValue(':id', $deactive);
        $result = $stmt->execute();
        if ($result) {
            echo "<script>location.href='prestat.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Serviciul prestat contract a fost dezactivat cu succes!</div>');

        } else {
            echo "<script>location.href='prestat.php';</script>";
            Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Serviciul prestat contract nu este dezactivate!</div>');
        }
    }
    public function prestatcontractActiveByAdmin($active){
        $sql = "UPDATE servicii_prestate_contract SET
       isActive=:isActive
       WHERE id = :id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':isActive', 1);
        $stmt->bindValue(':id', $active);
        $result =   $stmt->execute();
        if ($result) {
            echo "<script>location.href='prestat.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Serviciul prestat contract activat cu succes!</div>');
        }else{
            echo "<script>location.href='prestat.php';</script>";
            Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Serviciul prestat contract nu sunt activate!</div>');
        }
    }
//   Get Single Client Information By Id Method
    public function updateServiciuPrestatByIdInfo($servicii_prestate_contractid, $data)
    {
        $id_contract = $data['id_contract'];
        $id_serviciu_prestat = $data['id_serviciu_prestat'];
        $data_start = $data['data_start'];
        $data_fin = $data['data_fin'];



        if ($data_start == "" || $data_fin == "") {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Câmpurile de introducere nu trebuie să fie Golite!</div>';
            return $msg;
        } else {
            $sql = "UPDATE servicii_prestate_contract SET
                  id_contract = :id_contract,
                  id_serviciu_prestat = :id_serviciu_prestat,
                  data_start = :data_start,
                  data_fin = :data_fin
          WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':id_contract', $id_contract);
            $stmt->bindValue(':id_serviciu_prestat', $id_serviciu_prestat);
            $stmt->bindValue(':data_start', $data_start);
            $stmt->bindValue(':data_fin', $data_fin);
            $stmt->bindValue(':id', $servicii_prestate_contractid);
            $result = $stmt->execute();

            if ($result) {
                echo "<script>location.href='prestat.php';</script>";
                Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Uau, informațiile dvs. au fost actualizate cu succes!</div>');


            } else {
                echo "<script>location.href='prestat.php';</script>";
                Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Datele nu sunt inserate!</div>');


            }
        }
    }
    // Get Single Client Information By Id Method
    public function getServiciiPrestateInfoById($servicii_prestate_contractid){
        $sql = "SELECT * FROM servicii_prestate_contract WHERE id = :id LIMIT 1";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id', $servicii_prestate_contractid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if ($result) {
            return $result;
        }else{
            return false;
        }


    }

}