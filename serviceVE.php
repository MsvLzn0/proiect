<?php
include 'inc/header.php';
Session::CheckSession();

?>

<?php

if (isset($_GET['id'])) {
    $serviceid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $updateService = $services->updateServiceByIdInfo($serviceid, $_POST);

}
if (isset($updateService)) {
    echo $updateService;
}




?>

<div class="card ">
    <div class="card-header">
        <h3>Services Profile<span class="float-right"> <a href="service.php" class="btn btn-primary">Back</a> </h3>
    </div>
    <div class="card-body">

        <?php
        $getSinfo = $services->getServiceInfoById($serviceid);
        if ($getSinfo) {






            ?>


            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="POST">
                    <div class="form-group">
                        <label for="nume">Name</label>
                        <input type="text" name="nume" value="<?php echo $getSinfo->nume; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="uit_masura">Unit</label>
                        <input type="text" name="unit_masura" value="<?php echo $getSinfo->unit_masura; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cost">Cost</label>
                        <input type="text" name="cost" value="<?php echo $getSinfo->cost; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="data_start">Start date  y/m/d</label>
                        <input type="text" name="data_start" value="<?php echo $getSinfo->data_start; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="data_stop">Stop date  y/m/d</label>
                        <input type="text" name="data_stop" value="<?php echo $getSinfo->data_stop; ?>" class="form-control">
                    </div>


                    <?php if (Session::get("id") == $getSinfo->id) {?>


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

            header('Location:service.php');
        } ?>



    </div>
</div>


<?php
include 'inc/footer.php';

?>
