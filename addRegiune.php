<?php
include 'inc/header.php';
$sId =  Session::get('roleid');
if ($sId === '1') { ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addRegiune'])) {

        $regiuneAdd = $regiuni->addNewRegiuneByAdmin($_POST);
    }

    if (isset($regiuneAdd)) {
        echo $regiuneAdd;
    }


    ?>


    <div class="card ">
        <div class="card-header">
            <h3 class='text-center'>Add New Regiune</h3>
        </div>
        <div class="cad-body">



            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="post">
                    <div class="form-group pt-3">
                        <label for="nume">Name</label>
                        <input type="text" name="nume"  class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="submit" name="addRegiune" class="btn btn-success">Register</button>
                    </div>



                </form>
            </div>


        </div>
    </div>

    <?php
}else{

    header('Location:regiune.php');



}
?>

<?php
include 'inc/footer.php';

?>
