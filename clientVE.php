<?php
include 'inc/header.php';
Session::CheckSession();

?>

<?php

if (isset($_GET['id'])) {
    $clientid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $updateClient = $clients->updateClientByIdInfo($clientid, $_POST);

}
if (isset($updateClient)) {
    echo $updateClient;
}




?>

<div class="card ">
    <div class="card-header">
        <h3>User Profile <span class="float-right"> <a href="index.php" class="btn btn-primary">Back</a> </h3>
    </div>
    <div class="card-body">

        <?php
        $getCinfo = $clients->getClientInfoById($clientid);
        if ($getCinfo) {






            ?>


            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="POST">
                    <div class="form-group">
                        <label for="nume">Name</label>
                        <input type="text" name="nume" value="<?php echo $getCinfo->nume; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prenume">Surname</label>
                        <input type="text" name="prenume" value="<?php echo $getCinfo->prenume; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="patronimic">Patronymic</label>
                        <input type="text" name="patronimic" value="<?php echo $getCinfo->patronimic; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="IDNP">IDNP</label>
                        <input type="text" name="IDNP" value="<?php echo $getCinfo->IDNP; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="text" id="tel" name="tel" value="<?php echo $getCinfo->tel; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="e_mail" value="<?php echo $getCinfo->e_mail; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="adresa">Address</label>
                        <input type="text" name="adresa" value="<?php echo $getCinfo->adresa; ?>" class="form-control">
                    </div>

                    <?php if (Session::get("id") == $getCinfo->id) {?>


                        <div class="form-group">
                            <button type="submit" name="update" class="btn btn-success">Update</button>

                        </div>
                    <?php } elseif(Session::get("roleid") == '1') {?>


                        <div class="form-group">
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                        </div>
                    <?php } elseif(Session::get("roleid") == '2') {?>


                        <div class="form-group">
                            <button type="submit" name="update" class="btn btn-success">Update</button>

                        </div>

                    <?php   }else{ ?>
                        <div class="form-group">

                            <a class="btn btn-primary" href="index.php">Ok</a>
                        </div>
                    <?php } ?>


                </form>
            </div>

        <?php }else{

            header('Location:client.php');
        } ?>



    </div>
</div>


<?php
include 'inc/footer.php';

?>
