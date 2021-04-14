<?php

include_once 'lib/Database.php';
include_once 'lib/Session.php';


class Services{


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

// Check Exist Nume Method
    public function checkExistNume($nume){
        $sql = "SELECT nume from  servicii_prestate WHERE nume = :nume";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':nume', $nume);
        $stmt->execute();
        if ($stmt->rowCount()> 0) {
            return true;
        }else{
            return false;
        }
    }

    // Add New Service By Admin
    public function addNewServiceByAdmin($data)
    {
        $nume = $data['nume'];
        $unit_masura = $data['unit_masura'];
        $cost = $data['cost'];
        $data_start = $data['data_start'];
        $data_stop = $data['data_stop'];


        $checkNume = $this->checkExistNume($nume);


        if ($nume == "" || $unit_masura == "" || $cost == "" || $data_start == "" || $data_stop == "") {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Câmpurile de introducere nu trebuie să fie Golite!</div>';
            return $msg;
        } elseif (strlen($nume) < 3) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Numele serviciului este prea scurt, cel puțin 3 caractere!</div>';
            return $msg;
        } elseif (filter_var($cost, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Introduceți numai caracterele numerice pentru câmpul Telefon si IDNP</div>';
            return $msg;
        } elseif ($checkNume == TRUE) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Serviciul există deja, vă rugăm să încercați un alt serviciu ...!</div>';
            return $msg;
        } else {

            $sql = "INSERT INTO servicii_prestate(nume, unit_masura, cost, data_start, data_stop ) VALUES(:nume, :unit_masura, :cost, :data_start, :data_stop)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':nume', $nume);
            $stmt->bindValue(':unit_masura', $unit_masura);
            $stmt->bindValue(':cost', $cost);
            $stmt->bindValue(':data_start', $data_start);
            $stmt->bindValue(':data_stop', $data_stop);
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
// Select All Services Method
    public function selectAllServiceData(){
        $sql = "SELECT * FROM servicii_prestate ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function selectAllActiveServicePr(){
        $sql = "SELECT * FROM servicii_prestate  WHERE isActive='1' ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

// Delete Srevice by Id Method
    public function deleteServiceById($remove){
        $sql = "DELETE FROM servicii_prestate WHERE id = :id ";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id', $remove);
        $result =$stmt->execute();
        if ($result) {
            $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> Service șters cu succes!</div>';
            return $msg;
        }else{
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Service nu a fost șters!</div>';
            return $msg;
        }
    }
    // User activated By Admin
    public function serviceActiveByAdmin($active){
        $sql = "UPDATE servicii_prestate SET
       isActive=:isActive
       WHERE id = :id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':isActive', 1);
        $stmt->bindValue(':id', $active);
        $result =   $stmt->execute();
        if ($result) {
            echo "<script>location.href='service.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Serviciu activat cu succes!</div>');
        }else{
            echo "<script>location.href='service.php';</script>";
            Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Serviciile nu sunt activate!</div>');
        }
    }
// Service Deactivated By Admin
    public function serviceDeactiveByAdmin($deactive)
    {
        $sql = "UPDATE servicii_prestate SET

       isActive=:isActive
       WHERE id = :id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':isActive', 0);
        $stmt->bindValue(':id', $deactive);
        $result = $stmt->execute();
        if ($result) {
            echo "<script>location.href='service.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Serviciul a fost dezactivat cu succes!</div>');

        } else {
            echo "<script>location.href='servicie.php';</script>";
            Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Serviciul nu este dezactivate!</div>');
        }
    }

//   Get Single Service Information By Id Method
    public function updateServiceByIdInfo($servicii_prestateid, $data)
    {
        $nume = $data['nume'];
        $unit_masura = $data['unit_masura'];
        $cost = $data['cost'];
        $data_start = $data['data_start'];
        $data_stop = $data['data_stop'];




        if ($nume == "" || $unit_masura == "" || $cost == "" || $data_start == "" || $data_stop == "") {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Câmpurile de introducere nu trebuie să fie Golite!</div>';
            return $msg;
        } elseif (strlen($nume) < 3) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Numele serviciului este prea scurt, cel puțin 3 caractere!</div>';
            return $msg;
        } elseif (filter_var($cost, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Introduceți numai caracterele numerice pentru câmpul Telefon si IDNP</div>';
            return $msg;
        } else {

            $sql = "UPDATE servicii_prestate SET
          nume = :nume,
          unit_masura = :unit_masura,
          cost = :cost,
          data_start = :data_start,
          data_stop = :data_stop
          WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':nume', $nume);
            $stmt->bindValue(':unit_masura', $unit_masura);
            $stmt->bindValue(':cost', $cost);
            $stmt->bindValue(':data_start', $data_start);
            $stmt->bindValue(':data_stop', $data_stop);
            $stmt->bindValue(':id', $servicii_prestateid);
            $result = $stmt->execute();

            if ($result) {
                echo "<script>location.href='service.php';</script>";
                Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Uau, informațiile dvs. au fost actualizate cu succes!</div>');


            } else {
                echo "<script>location.href='service.php';</script>";
                Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Datele nu sunt inserate!</div>');


            }
        }
    }
    // Get Single Client Information By Id Method
    public function getServiceInfoById($servicii_prestateid){
        $sql = "SELECT * FROM servicii_prestate WHERE id = :id LIMIT 1";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id', $servicii_prestateid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if ($result) {
            return $result;
        }else{
            return false;
        }


    }
}