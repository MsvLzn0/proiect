<?php
include 'inc/header.php';
?>

<?php

if (isset($_GET['id'])) {
    $servicii_prestate_contractid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $updatePrestat = $prestate->updateServiciuPrestatByIdInfo($servicii_prestate_contractid, $_POST);

}
if (isset($updatePrestat)) {
    echo $updatePrestat;
}




?>

<div class="card ">
    <div class="card-header">
        <h3>Servicii prestate contract<span class="float-right"> <a href="prestat.php" class="btn btn-primary">Back</a> </h3>
    </div>
    <div class="card-body">

        <?php
        $getLinfo = $prestate->getServiciiPrestateInfoById($servicii_prestate_contractid);
        if ($getLinfo) {
            ?>


            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="POST">
                    <div class="form-group">
                        <label for="nume">ID contract</label>
                        <input type="text" name="id_contract" value="<?php echo $getLinfo->id_contract; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nume">ID serviciu prestat</label>
                        <input type="text" name="id_serviciu_prestat" value="<?php echo $getLinfo->id_serviciu_prestat; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nume">Data start</label>
                        <input type="text" name="data_start" value="<?php echo $getLinfo->data_start; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nume">Data fine</label>
                        <input type="text" name="data_fin" value="<?php echo $getLinfo->data_fin; ?>" class="form-control">
                    </div>


                    <?php if (Session::get("id") == $getLinfo->id) {?>


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

                            <a class="btn btn-primary" href="news.php">Ok</a>
                        </div>
                    <?php } ?>


                </form>
            </div>

        <?php }else{

            header('Location:prestat.php');
        } ?>



    </div>
</div>


<?php
include 'inc/footer.php';

?>
