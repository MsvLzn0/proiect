<?php

include_once 'lib/Database.php';
include_once 'lib/Session.php';


class Localitati{


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
    public function checkExistLocalitate($nume){
        $sql = "SELECT nume from  localitate WHERE nume = :nume";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':nume', $nume);
        $stmt->execute();
        if ($stmt->rowCount()> 0) {
            return true;
        }else{
            return false;
        }
    }

    public function addNewLocalitateByAdmin($data)
     {
         $id_raion = $data['id_raion'];
         $nume = $data['nume'];

         $checkLocalitate = $this->checkExistLocalitate($nume);


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
         } elseif ($checkLocalitate == TRUE) {
             $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Localitatea există deja, vă rugăm să încercați o alta localitate ...!</div>';
             return $msg;
         } else {

             $sql = "INSERT INTO localitate(id_raion, nume ) VALUES(:id_raion, :nume)";
             $stmt = $this->db->pdo->prepare($sql);
             $stmt->bindValue(':id_raion', $id_raion);
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
// Select All Localitati Method
    public function selectAllLocalitatiData(){
        $sql = "SELECT * FROM localitate ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function selectAllActiveLocalitati(){
        $sql = "SELECT * FROM localitate WHERE isActive='1' ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


// Delete Localitati by Id Method
    public function deleteLocalitatiById($remove){
        $sql = "DELETE FROM localitate WHERE id = :id ";
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
    // Localitati activated By Admin
    public function localitatiActiveByAdmin($active){
        $sql = "UPDATE localitate SET
       isActive=:isActive
       WHERE id = :id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':isActive', 1);
        $stmt->bindValue(':id', $active);
        $result =   $stmt->execute();
        if ($result) {
            echo "<script>location.href='localitate.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Raionul activat cu succes!</div>');
        }else{
            echo "<script>location.href='localitate.php';</script>";
            Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Raionul nu este activat!</div>');
        }
    }
// Service Deactivated By Admin
    public function localitatiDeactiveByAdmin($deactive)
    {
        $sql = "UPDATE localitate SET

       isActive=:isActive
       WHERE id = :id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':isActive', 0);
        $stmt->bindValue(':id', $deactive);
        $result = $stmt->execute();
        if ($result) {
            echo "<script>location.href='localitate.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Raionul a fost dezactivat cu succes!</div>');

        } else {
            echo "<script>location.href='localitate.php';</script>";
            Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Raionul nu este dezactivate!</div>');
        }
    }

//   Get Single Service Information By Id Method
    public function updateLocalitateByIdInfo($localitateid, $data)
    {
        $id_raion = $data['id_raion'];
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

            $sql = "UPDATE localitate SET
          id_raion = :id_raion,
         nume = :nume
          WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':id_raion', $id_raion);
            $stmt->bindValue(':nume', $nume);
            $stmt->bindValue(':id', $localitateid);
            $result = $stmt->execute();

            if ($result) {
                echo "<script>location.href='localitate.php';</script>";
                Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Uau, informațiile dvs. au fost actualizate cu succes!</div>');


            } else {
                echo "<script>location.href='localitate.php';</script>";
                Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Datele nu sunt inserate!</div>');


            }
        }
    }
    // Get Single Client Information By Id Method
    public function getLocalitatiInfoById($localitateid){
        $sql = "SELECT * FROM localitate WHERE id = :id LIMIT 1";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id', $localitateid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if ($result) {
            return $result;
        }else{
            return false;
        }


    }

}