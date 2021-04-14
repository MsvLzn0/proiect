<?php

include_once 'lib/Database.php';
include_once 'lib/Session.php';


class Raioane{


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

// Check Exist Raion Method
    public function checkExistRaion($nume){
        $sql = "SELECT nume from  raion WHERE nume = :nume";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':nume', $nume);
        $stmt->execute();
        if ($stmt->rowCount()> 0) {
            return true;
        }else{
            return false;
        }
    }

    // Add New Regiune By Admin
    public function addNewRaionByAdmin($data)
    {
        $id_regiune = $data['id_regiune'];
        $nume = $data['nume'];

        $checkRaion = $this->checkExistRaion($nume);


        if ($nume == "") {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Câmpurile de introducere nu trebuie să fie Golite!</div>';
            return $msg;
        } elseif (strlen($nume) < 2) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Numele raionului este prea scurt, cel puțin 2 caractere!</div>';
            return $msg;
        } elseif ($checkRaion == TRUE) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Raionul există deja, vă rugăm să încercați un alt raion ...!</div>';
            return $msg;
        } else {

            $sql = "INSERT INTO raion(id_regiune, nume ) VALUES(:id_regiune, :nume)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':id_regiune', $id_regiune);
            $stmt->bindValue(':nume', $nume);
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
// Select All Raioane Method
    public function selectAllRaioaneData(){
        $sql = "SELECT * FROM raion ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Select All Raioane Method
    public function selectAllActiveRaioane(){
        $sql = "SELECT * FROM raion WHERE isActive='1' ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

// Delete Raion by Id Method
    public function deleteRaioaneById($remove){
        $sql = "DELETE FROM raion WHERE id = :id ";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id', $remove);
        $result =$stmt->execute();
        if ($result) {
            $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> Regiune șters cu succes!</div>';
            return $msg;
        }else{
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Regiunea nu a fost șters!</div>';
            return $msg;
        }
    }
    // User activated By Admin
    public function raioaneActiveByAdmin($active){
        $sql = "UPDATE raion SET
       isActive=:isActive
       WHERE id = :id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':isActive', 1);
        $stmt->bindValue(':id', $active);
        $result =   $stmt->execute();
        if ($result) {
            echo "<script>location.href='raion.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Raionul activat cu succes!</div>');
        }else{
            echo "<script>location.href='raion.php';</script>";
            Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Raionul nu este activat!</div>');
        }
    }
// Service Deactivated By Admin
    public function raioaneDeactiveByAdmin($deactive)
    {
        $sql = "UPDATE raion SET

       isActive=:isActive
       WHERE id = :id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':isActive', 0);
        $stmt->bindValue(':id', $deactive);
        $result = $stmt->execute();
        if ($result) {
            echo "<script>location.href='raion.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Raionul a fost dezactivat cu succes!</div>');

        } else {
            echo "<script>location.href='raion.php';</script>";
            Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Raionul nu este dezactivate!</div>');
        }
    }

//   Get Single Service Information By Id Method
    public function updateRaionByIdInfo($raionid, $data)
    {
        $id_regiune = $data['id_regiune'];
        $nume = $data['nume'];




        if ($nume == "") {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Câmpurile de introducere nu trebuie să fie Golite!</div>';
            return $msg;
        } elseif (strlen($nume) < 3) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Numele raionului este prea scurt, cel puțin 3 caractere!</div>';
            return $msg;
        } else {

            $sql = "UPDATE raion SET
          id_regiune = :id_regiune,
          nume = :nume
          WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':id_regiune', $id_regiune);
            $stmt->bindValue(':nume', $nume);
            $stmt->bindValue(':id', $raionid);
            $result = $stmt->execute();

            if ($result) {
                echo "<script>location.href='raion.php';</script>";
                Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Uau, informațiile dvs. au fost actualizate cu succes!</div>');


            } else {
                echo "<script>location.href='raion.php';</script>";
                Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Datele nu sunt inserate!</div>');


            }
        }
    }
    // Get Single Client Information By Id Method
    public function getRaioaneInfoById($raionid){
        $sql = "SELECT * FROM raion WHERE id = :id LIMIT 1";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id', $raionid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if ($result) {
            return $result;
        }else{
            return false;
        }


    }

}