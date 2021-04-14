<?php
include 'inc/header.php';
?>

<?php

if (isset($_GET['id'])) {
    $localitateid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $updateLocalitate = $localitati->updateLocalitateByIdInfo($localitateid, $_POST);

}
if (isset($updateLocalitate)) {
    echo $updateLocalitate;
}




?>

<div class="card ">
    <div class="card-header">
        <h3>Services Profile<span class="float-right"> <a href="localitate.php" class="btn btn-primary">Back</a> </h3>
    </div>
    <div class="card-body">

        <?php
        $getHinfo = $localitati->getLocalitatiInfoById($localitateid);
        if ($getHinfo) {
            ?>


            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="POST">
                    <div class="form-group">
                        <label for="nume">Raion</label>
                        <input type="text" name="id_raion" value="<?php echo $getHinfo->id_raion; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nume">Name</label>
                        <input type="text" name="nume" value="<?php echo $getHinfo->nume; ?>" class="form-control">
                    </div>



                    <?php if (Session::get("id") == $getHinfo->id) {?>


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

            header('Location:localitate.php');
        } ?>



    </div>
</div>


<?php
include 'inc/footer.php';

?>
