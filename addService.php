<?php
include 'inc/header.php';
$sId =  Session::get('roleid');
if ($sId === '1') { ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addService'])) {

        $serviceAdd = $services->addNewServiceByAdmin($_POST);
    }

    if (isset($serviceAdd)) {
        echo $serviceAdd;
    }


    ?>


    <div class="card ">
        <div class="card-header">
            <h3 class='text-center'>Add New Service</h3>
        </div>
        <div class="cad-body">



            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="post">
                    <div class="form-group pt-3">
                        <label for="nume">Name</label>
                        <input type="text" name="nume"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="unit_masura">Unit</label>
                        <input type="text" name="unit_masura"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cost">Cost</label>
                        <input type="text" name="cost"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="data_start">Start date  y/m/d</label>
                        <input type="text" name="data_start"  class="form-control">
                    </div>
                    <!--<div class="form-group">
                        <label for="data">Data de nastere dd/dd/dd</label>
                        <input type="text" name="data" class="form-control">
                    </div>-->
                    <div class="form-group">
                        <label for="data_stop">Stop date  y/m/d</label>
                        <input type="text" name="data_stop" class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="submit" name="addService" class="btn btn-success">Register</button>
                    </div>



                </form>
            </div>


        </div>
    </div>

    <?php
}else{

    header('Location:service.php');



}
?>

<?php
include 'inc/footer.php';

?>
