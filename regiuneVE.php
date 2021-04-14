<?php
include 'inc/header.php';
?>

<?php

if (isset($_GET['id'])) {
    $regiuneid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $updateRegiune = $regiuni->updateRegiuneByIdInfo($regiuneid, $_POST);

}
if (isset($updateRegiune)) {
    echo $updateRegiune;
}




?>

<div class="card ">
    <div class="card-header">
        <h3>Regiune Profile <span class="float-right"> <a href="regiune.php" class="btn btn-primary">Back</a> </h3>
    </div>
    <div class="card-body">

        <?php
        $getRinfo = $regiuni->getRegiuniInfoById($regiuneid);
        if ($getRinfo) {






            ?>


            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="POST">
                    <div class="form-group">
                        <label for="nume">Name</label>
                        <input type="text" name="nume" value="<?php echo $getRinfo->nume; ?>" class="form-control">
                    </div>

                    <?php if (Session::get("id") == $getRinfo->id) {?>


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

                            <a class="btn btn-primary" href="regiune.php">Ok</a>
                        </div>
                    <?php } ?>


                </form>
            </div>

        <?php }else{

            header('Location:regiune.php');
        } ?>



    </div>
</div>


<?php
include 'inc/footer.php';

?>
