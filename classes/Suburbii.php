<?php

include_once 'lib/Database.php';
include_once 'lib/Session.php';


class Suburbii{


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

// Check Exist Localitate Method
    public function checkExistSuburbie($nume){
        $sql = "SELECT nume from  suburbie WHERE nume = :nume";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':nume', $nume);
        $stmt->execute();
        if ($stmt->rowCount()> 0) {
            return true;
        }else{
            return false;
        }
    }

    public function addNewSuburbieByAdmin($data)
    {
        $id_localitate = $data['id_localitate'];
        $nume = $data['nume'];

        $checkSuburbie = $this->checkExistSuburbie($nume);


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
        } elseif ($checkSuburbie == TRUE) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Raionul există deja, vă rugăm să încercați un alt raion ...!</div>';
            return $msg;
        } else {

            $sql = "INSERT INTO suburbie(id_localitate, nume ) VALUES(:id_localitate, :nume)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':id_localitate', $id_localitate);
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
// Select All Suburbii Method
    public function selectAllSuburbiiData(){
        $sql = "SELECT * FROM suburbie ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function selectAllActiveSuburbii(){
        $sql = "SELECT * FROM suburbie WHERE isActive='1' ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


// Delete Localitati by Id Method
    public function deleteSsuburbiiById($remove){
        $sql = "DELETE FROM suburbie WHERE id = :id ";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id', $remove);
        $result =$stmt->execute();
        if ($result) {
            $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> Suburbie șters cu succes!</div>';
            return $msg;
        }else{
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Suburbie nu a fost șters!</div>';
            return $msg;
        }
    }
    // Localitati activated By Admin
    public function suburbieActiveByAdmin($active){
        $sql = "UPDATE suburbie SET
       isActive=:isActive
       WHERE id = :id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':isActive', 1);
        $stmt->bindValue(':id', $active);
        $result =   $stmt->execute();
        if ($result) {
            echo "<script>location.href='suburbie.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Suburbia activat cu succes!</div>');
        }else{
            echo "<script>location.href='suburbie.php';</script>";
            Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Suburbia nu este activat!</div>');
        }
    }
// Service Deactivated By Admin
    public function suburbieDeactiveByAdmin($deactive)
    {
        $sql = "UPDATE suburbie SET

       isActive=:isActive
       WHERE id = :id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':isActive', 0);
        $stmt->bindValue(':id', $deactive);
        $result = $stmt->execute();
        if ($result) {
            echo "<script>location.href='suburbie.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Suburbia a fost dezactivat cu succes!</div>');

        } else {
            echo "<script>location.href='suburbie.php';</script>";
            Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Suburbia nu este dezactivate!</div>');
        }
    }

//   Get Single Service Information By Id Method
    public function updateSuburbieByIdInfo($suburbieid, $data)
    {
        $id_localitate = $data['id_localitate'];
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

            $sql = "UPDATE suburbie SET
          nume = :nume,
          WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':id_localitate', $id_localitate);
            $stmt->bindValue(':nume', $nume);
            $result = $stmt->execute();

            if ($result) {
                echo "<script>location.href='suburbie.php';</script>";
                Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Uau, informațiile dvs. au fost actualizate cu succes!</div>');


            } else {
                echo "<script>location.href='suburbie.php';</script>";
                Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Datele nu sunt inserate!</div>');


            }
        }
    }
    // Get Single Client Information By Id Method
    public function getSuburbiiInfoById($suburbieid){
        $sql = "SELECT * FROM suburbie WHERE id = :id LIMIT 1";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id', $suburbieid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if ($result) {
            return $result;
        }else{
            return false;
        }


    }

}