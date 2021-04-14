<?php
include 'inc/header.php';
?>

<?php

if (isset($_GET['id'])) {
    $contractid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $updateContract = $contracte->updateContractByIdInfo($contractid, $_POST);

}
if (isset($updatecontract)) {
    echo $updateContract;
}




?>

<div class="card ">
    <div class="card-header">
        <h3>Servicii prestate contract<span class="float-right"> <a href="contract.php" class="btn btn-primary">Back</a> </h3>
    </div>
    <div class="card-body">

        <?php
        $getLinfo = $contracte->getContracteInfoById($contractid);
        if ($getLinfo) {
            ?>


            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="POST">
                    <div class="form-group">
                        <label for="nume">Nr contract</label>
                        <input type="text" name="nr_contract" value="<?php echo $getLinfo->nr_contract; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nume">ID imobil</label>
                        <input type="text" name="id_imobil" value="<?php echo $getLinfo->id_imobil; ?>" class="form-control">
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

            header('Location:contract.php');
        } ?>



    </div>
</div>


<?php
include 'inc/footer.php';

?>
