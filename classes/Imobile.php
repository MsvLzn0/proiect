<?php

include_once 'lib/Database.php';
include_once 'lib/Session.php';


class Imobile{


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
    public function checkExistImobil($nr_cadastral){
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
    public function addNewImobilByAdmin($data)
    {
        $id_proprietar = $data['id_proprietar'];
        $id_strada = $data['id_strada'];
        $nr_cadastral = $data['nr_cadastral'];
        $tel = $data['tel'];
        $nr = $data['nr'];
        $id_suburbie = $data['id_suburbie'];


        $checkImobil = $this->checkExistImobil($nr_cadastral);


        if ($nr_cadastral == "" || $tel == "" || $nr == "") {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Câmpurile de introducere nu trebuie să fie Golite!</div>';
            return $msg;
        } elseif (strlen($tel ) < 8) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong>Telefonul este prea scurt, cel puțin 8 caractere!</div>';
            return $msg;
        } elseif ($checkImobil == TRUE) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Imobilul există deja, vă rugăm să încercați un alt imobil ...!</div>';
            return $msg;
        } else {

            $sql = "INSERT INTO imobil(id_proprietar, id_strada, nr_cadastral, tel, nr, id_suburbie) VALUES(:id_proprietar, :id_strada, :nr_cadastral, :tel, :nr, :id_suburbie )";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':id_proprietar', $id_proprietar);
            $stmt->bindValue(':id_strada', $id_strada);
            $stmt->bindValue(':nr_cadastral', $nr_cadastral);
            $stmt->bindValue(':tel', $tel);
            $stmt->bindValue(':nr', $nr);
            $stmt->bindValue(':id_suburbie', $id_suburbie);
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
// Select All Imobile Method
    public function selectAllImobileData(){
        $sql = "SELECT * FROM imobil ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function selectAllActiveImobile(){
        $sql = "SELECT * FROM imobil WHERE isActive='1'ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }



// Delete Raion by Id Method
    public function deleteImobileById($remove){
        $sql = "DELETE FROM imobil WHERE id = :id ";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id', $remove);
        $result =$stmt->execute();
        if ($result) {
            $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> Imobil șters cu succes!</div>';
            return $msg;
        }else{
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Imobil nu a fost șters!</div>';
            return $msg;
        }
    }
    // User activated By Admin
    public function imobileActiveByAdmin($active){
        $sql = "UPDATE imobil SET
       isActive=:isActive
       WHERE id = :id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':isActive', 1);
        $stmt->bindValue(':id', $active);
        $result =   $stmt->execute();
        if ($result) {
            echo "<script>location.href='imobil.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Imobilul activat cu succes!</div>');
        }else{
            echo "<script>location.href='imobil.php';</script>";
            Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Imobilull nu este activat!</div>');
        }
    }
// Service Deactivated By Admin
    public function imobileDeactiveByAdmin($deactive)
    {
        $sql = "UPDATE imobil SET

       isActive=:isActive
       WHERE id = :id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':isActive', 0);
        $stmt->bindValue(':id', $deactive);
        $result = $stmt->execute();
        if ($result) {
            echo "<script>location.href='imobil.php';</script>";
            Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Raionul a fost dezactivat cu succes!</div>');

        } else {
            echo "<script>location.href='imobil.php';</script>";
            Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Imobilul nu este dezactivate!</div>');
        }
    }

//   Get Single Service Information By Id Method
    public function updateImobilByIdInfo($imobilid, $data)
    {
        $id_proprietar = $data['id_proprietar'];
        $id_strada = $data['id_strada'];
        $nr_cadastral = $data['nr_cadastral'];
        $tel = $data['tel'];
        $nr = $data['nr'];
        $id_suburbie = $data['id_suburbie'];



        if ($nr_cadastral == "" || $tel == "" || $nr == "") {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Câmpurile de introducere nu trebuie să fie Golite!</div>';
            return $msg;
        } elseif (strlen($tel) < 8) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Numarul este prea scurt, cel puțin 8 caractere!</div>';
            return $msg;
        } else {

            $sql = "UPDATE imobil SET
          id_proprietar = :id_proprietar,
          id_strada = :id_strada,
          nr_cadastral = :nr_cadastral,
          tel = :tel,
          nr = :nr,
          id_suburbie = :id_suburbie
          WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id_proprietar', $id_proprietar);
        $stmt->bindValue(':id_strada', $id_strada);
        $stmt->bindValue(':nr_cadastral', $nr_cadastral);
        $stmt->bindValue(':tel', $tel);
        $stmt->bindValue(':nr', $nr);
        $stmt->bindValue(':id_suburbie', $id_suburbie);
        $stmt->bindValue(':id', $imobilid);
            $result = $stmt->execute();

            if ($result) {
                echo "<script>location.href='imobil.php';</script>";
                Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Uau, informațiile dvs. au fost actualizate cu succes!</div>');


            } else {
                echo "<script>location.href='imobil.php';</script>";
                Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Datele nu sunt inserate!</div>');


            }
        }
    }
    // Get Single Client Information By Id Method
    public function getImobileInfoById($imobilid){
        $sql = "SELECT * FROM raion WHERE id = :id LIMIT 1";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id', $imobilid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if ($result) {
            return $result;
        }else{
            return false;
        }


    }

}