<?php
include 'inc/header.php';
?>

<?php

if (isset($_GET['id'])) {
    $imobilid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $updateImobil = $imobile->updateImobilByIdInfo($imobilid, $_POST);

}
if (isset($updateImobil)) {
    echo $updateImobil;
}




?>

<div class="card ">
    <div class="card-header">
        <h3>Imobil<span class="float-right"> <a href="contract.php" class="btn btn-primary">Back</a> </h3>
    </div>
    <div class="card-body">

        <?php
        $getLinfo = $imobile->getImobileInfoById($imobilid);
        if ($getLinfo) {
            ?>


            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="POST">

                    <div class="form-group">
                        <label for="nume">ID proprietar</label>
                        <input type="text" name="id_proprietar" value="<?php echo $getLinfo->id_proprietar; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nume">ID strada</label>
                        <input type="text" name="id_strada" value="<?php echo $getLinfo->id_strada; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nume">Numar cadastral</label>
                        <input type="text" name="nr_cadastral" value="<?php echo $getLinfo->nr_cadastral; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nume">telefon</label>
                        <input type="text" name="tel" value="<?php echo $getLinfo->tel; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nume">Numar strada</label>
                        <input type="text" name="nr" value="<?php echo $getLinfo->nr; ?>" class="form-control">
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

            header('Location:imobil.php');
        } ?>



    </div>
</div>


<?php
include 'inc/footer.php';

?>
