<?php
include 'inc/header.php';
$sId =  Session::get('roleid');
if ($sId === '1') { ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addPrestat'])) {

        $prestatAdd = $prestate->addNewServiciuPrestatByAdmin($_POST);
    }

    if (isset($prestatAdd)) {
        echo $prestatAdd;
    }


    ?>


    <div class="card ">
        <div class="card-header">
            <h3 class='text-center'>Serviciu prestat contract</h3>
        </div>
        <div class="cad-body">



            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="post">
                    <div class="form-group pt-3">
                        <label for="" >ID contract</label>
                        <?php


                        $serviciiprestateLista = $contracte->selectAllActiveContracte();
                        $select =  '<select name="id_contract" class="form-control">';
                        if(count($serviciiprestateLista)){

                            foreach($serviciiprestateLista as $val){
                                $select.='<option value="'.$val->id.'">'.$val->nr_contract.'</option>';
                            }
                        }
                        $select .='</select>';
                        echo $select;
                        ?>

                    </div>
                    <div class="form-group pt-3">
                        <label for="" >Serviciu prestat</label>
                        <?php


                        $servicuprestatLista = $services->selectAllActiveServicePr();
                        $select =  '<select name="id_serviciu_prestat" class="form-control">';
                        if(count($servicuprestatLista)){

                            foreach($servicuprestatLista as $val){
                                $select.='<option value="'.$val->id.'">'.$val->nume.'</option>';
                            }
                        }
                        $select .='</select>';
                        echo $select;
                        ?>

                    </div>
                    <div class="form-group pt-3">
                        <label for="data_start">Data start  Y/M/D</label>
                        <input type="text" name="data_start"  class="form-control">
                    </div>
                    <div class="form-group pt-3">
                        <label for="data_fin">Data fine  Y/M/D</label>
                        <input type="text" name="data_fin"  class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="addPrestat" class="btn btn-success">Register</button>
                    </div>
                </form>
            </div>


        </div>
    </div>

    <?php
}else{

    header('Location:prestat.php');



}
?>

<?php
include 'inc/footer.php';

?>
