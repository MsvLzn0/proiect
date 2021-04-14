<?php

include_once 'lib/Database.php';
include_once 'lib/Session.php';


class Clients{


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
    public function checkExistIDNP($IDNP){
        $sql = "SELECT IDNP from  client WHERE IDNP = :IDNP";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':IDNP', $IDNP);
        $stmt->execute();
        if ($stmt->rowCount()> 0) {
            return true;
        }else{
            return false;
        }
    }
    // Check Exist Email Address Method
    public function checkExistEmail($e_mail){
        $sql = "SELECT e_mail from  client WHERE e_mail = :e_mail";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':e_mail', $e_mail);
        $stmt->execute();
        if ($stmt->rowCount()> 0) {
            return true;
        }else{
            return false;
        }
    }
    // Add New Client By Admin
    public function addNewClientByAdmin($data)
    {
        $nume = $data['nume'];
        $prenume = $data['prenume'];
        $patronimic = $data['patronimic'];
        $IDNP = $data['IDNP'];
        $tel = $data['tel'];
        $e_mail = $data['e_mail'];
        $adresa = $data['adresa'];

        $checkIDNP = $this->checkExistIDNP($IDNP);


        if ($nume == "" || $prenume == "" || $patronimic == "" || $IDNP == "" || $tel == "" || $e_mail == "" || $adresa == "") {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Câmpurile de introducere nu trebuie să fie Golite!</div>';
            return $msg;
        } elseif (strlen($nume) < 3) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Numele, prenumele, patronimicul este prea scurt, cel puțin 3 caractere!</div>';
            return $msg;
        } elseif (filter_var($tel, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Introduceți numai caracterele numerice pentru câmpul Telefon si IDNP</div>';
            return $msg;
        } elseif (strlen($IDNP) < 13) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> IDNP-ul  este prea scurt, cel puțin 13 caractere!</div>';
            return $msg;
        } elseif (strlen($IDNP) > 13) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> IDNP-ul  este prea lung, cel mult 13 caractere!</div>';
            return $msg;
        } elseif (strlen($e_mail) < 8) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Email-ul  este prea scurt, cel putin 8 caractere!</div>';
            return $msg;
        } elseif ($checkIDNP == TRUE) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> IDNP-ul există deja, vă rugăm să încercați un alt IDNP ...!</div>';
            return $msg;
        } else {

            $sql = "INSERT INTO client(nume, prenume, patronimic, IDNP, tel, e_mail, adresa) VALUES(:nume, :prenume, :patronimic, :IDNP, :tel, :e_mail, :adresa)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':nume', $nume);
            $stmt->bindValue(':prenume', $prenume);
            $stmt->bindValue(':patronimic', $patronimic);
            $stmt->bindValue(':IDNP', $IDNP);
            $stmt->bindValue(':tel', $tel);
            $stmt->bindValue(':e_mail', $e_mail);
            $stmt->bindValue(':adresa', $adresa);
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
    public function selectAllClientData(){
        $sql = "SELECT * FROM client ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function selectAllActiveClient(){
        $sql = "SELECT * FROM client WHERE isActive='1' ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


// Delete client by Id Method
public function deleteClientById($remove){
    $sql = "DELETE FROM client WHERE id = :id ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result =$stmt->execute();
    if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success !</strong> Client șters cu succes!</div>';
        return $msg;
    }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Clientul nu a fost șters!</div>';
        return $msg;
    }
}
// Client Deactivated By Admin
public function clientDeactiveByAdmin($deactive)
{
    $sql = "UPDATE client SET

       isActive=:isActive
       WHERE id = :id";

    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':isActive', 1);
    $stmt->bindValue(':id', $deactive);
    $result = $stmt->execute();
    if ($result) {
        echo "<script>location.href='client.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Clientul a fost dezactivat cu succes!</div>');

    } else {
        echo "<script>location.href='client.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Clientul nu este dezactivate!</div>');
    }
}

//   Get Single Client Information By Id Method
    public function updateClientByIdInfo($clientid, $data)
    {
        $nume = $data['nume'];
        $prenume = $data['prenume'];
        $patronimic = $data['patronimic'];
        $IDNP = $data['IDNP'];
        $tel = $data['tel'];
        $e_mail = $data['e_mail'];
        $adresa = $data['adresa'];


        $checkIDNP = $this->checkExistIDNP($IDNP);

        if ($nume == "" || $prenume == "" || $patronimic == "" || $IDNP == "" || $tel == "" || $e_mail == "" || $adresa == "") {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Câmpurile de introducere nu trebuie să fie Golite!</div>';
            return $msg;
        } elseif (strlen($nume) < 3) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Numele, prenumele, patronimicul este prea scurt, cel puțin 3 caractere!</div>';
            return $msg;
        } elseif (filter_var($tel, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Introduceți numai caracterele numerice pentru câmpul Telefon si IDNP</div>';
            return $msg;
        } elseif (strlen($IDNP) < 13) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> IDNP-ul  este prea scurt, cel puțin 13 caractere!</div>';
            return $msg;
        } elseif (strlen($IDNP) > 13) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> IDNP-ul  este prea lung, cel mult 13 caractere!</div>';
            return $msg;
        } elseif (strlen($e_mail) < 8) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Email-ul  este prea scurt, cel putin 8 caractere!</div>';
            return $msg;
        } elseif ($checkIDNP == TRUE) {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> IDNP-ul există deja, vă rugăm să încercați un alt IDNP ...!</div>';
            return $msg;
        } else {

            $sql = "UPDATE client SET
          nume = :nume,
          prenume = :prenume,
          patronimic = :patronimic,
          IDNP = :IDNP,
          tel = :tel,
          e_mail = :e_mail,
          adresa = :adresa
          WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':nume', $nume);
            $stmt->bindValue(':prenume', $prenume);
            $stmt->bindValue(':patronimic', $patronimic);
            $stmt->bindValue(':IDNP', $IDNP);
            $stmt->bindValue(':tel', $tel);
            $stmt->bindValue(':e_mail', $e_mail);
            $stmt->bindValue(':adresa', $adresa);
            $stmt->bindValue(':id', $clientid);
            $result = $stmt->execute();

            if ($result) {
                echo "<script>location.href='client.php';</script>";
                Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Uau, informațiile dvs. au fost actualizate cu succes!</div>');


            } else {
                echo "<script>location.href='client.php';</script>";
                Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error !</strong> Datele nu sunt inserate!</div>');


            }
        }
    }
    // Get Single Client Information By Id Method
    public function getClientInfoById($clientid){
        $sql = "SELECT * FROM client WHERE id = :id LIMIT 1";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id', $clientid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if ($result) {
            return $result;
        }else{
            return false;
        }


    }
}