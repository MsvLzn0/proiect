<?php
include 'inc/header.php';
?>

<?php

if (isset($_GET['id'])) {
    $raionid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $updateRaion = $raioane->updateRaionByIdInfo($raionid, $_POST);

}
if (isset($updateRaion)) {
    echo $updateRaion;
}




?>

<div class="card ">
    <div class="card-header">
        <h3>Services Profile<span class="float-right"> <a href="raion.php" class="btn btn-primary">Back</a> </h3>
    </div>
    <div class="card-body">

        <?php
        $getLinfo = $raioane->getRaioaneInfoById($raionid);
        if ($getLinfo) {






            ?>


            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="POST">
                    <div class="form-group">
                        <label for="nume">Rgiune</label>
                        <input type="text" name="id_regiune" value="<?php echo $getLinfo->id_regiune; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nume">Name</label>
                        <input type="text" name="nume" value="<?php echo $getLinfo->nume; ?>" class="form-control">
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

            header('Location:raion.php');
        } ?>



    </div>
</div>


<?php
include 'inc/footer.php';

?>
