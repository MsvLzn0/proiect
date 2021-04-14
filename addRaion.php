<?php
include 'inc/header.php';
$sId =  Session::get('roleid');
if ($sId === '1') { ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addRaion'])) {

        $raionAdd = $raioane->addNewRaionByAdmin($_POST);
    }

    if (isset($raionAdd)) {
        echo $raionAdd;
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
                        <label for="">Regiune</label>
                        <?php


                        $regiuneLista = $regiuni->selectAllActiveRegiuni();
                        $select =  '<select name="id_regiune" class="form-control">';
                        if(count($regiuneLista)){

                            foreach($regiuneLista as $val){
                                $select.='<option value="'.$val->id.'">'.$val->nume.'</option>';
                            }
                        }
                        $select .='</select>';
                        echo $select;
                        ?>


                    </div>
                    <div class="form-group pt-3">
                        <label for="nume">Name</label>
                        <input type="text" name="nume"  class="form-control">
                    </div>


                    <div class="form-group">
                        <button type="submit" name="addRaion" class="btn btn-success">Register</button>
                    </div>



                </form>
            </div>


        </div>
    </div>

    <?php
}else{

    header('Location:raion.php');



}
?>

<?php
include 'inc/footer.php';

?>