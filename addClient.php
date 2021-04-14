<?php
include 'inc/header.php';
$sId =  Session::get('roleid');
if ($sId === '1') { ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addClient'])) {

        $clientAdd = $clients->addNewClientByAdmin($_POST);
    }

    if (isset($clientAdd)) {
        echo $clientAdd;
    }


    ?>


    <div class="card ">
        <div class="card-header">
            <h3 class='text-center'>Add New Client</h3>
        </div>
        <div class="cad-body">



            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="post">
                    <div class="form-group pt-3">
                        <label for="nume">Name</label>
                        <input type="text" name="nume"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prenume">Surname</label>
                        <input type="text" name="prenume"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="patronimic">Patronymic</label>
                        <input type="text" name="patronimic"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="IDNP">IDNP</label>
                        <input type="text" name="IDNP"  class="form-control">
                    </div>
                    <!--<div class="form-group">
                        <label for="data">Data de nastere dd/dd/dd</label>
                        <input type="text" name="data" class="form-control">
                    </div>-->
                    <div class="form-group">
                        <label for="tel">Mobile</label>
                        <input type="text" name="tel" class="form-control">
                    </div>
                    <div class="form-group">
                    <label for="e_mail">Email</label>
                    <input type="email" name="e_mail" class="form-control">
                    </div>
                    <div class="form-group">
                    <label for="adresa">Address</label>
                    <input type="text" name="adresa" class="form-control">
                    </div>

        <div class="form-group">
            <button type="submit" name="addClient" class="btn btn-success">Register</button>
        </div>



        </form>
            </div>


        </div>
    </div>

    <?php
}else{

    header('Location:client.php');



}
?>

<?php
include 'inc/footer.php';

?>
