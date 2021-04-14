<?php
include 'inc/header.php';
$sId =  Session::get('roleid');
if ($sId === '1') { ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addImobil'])) {

        $imobilAdd = $imobile->addNewImobilByAdmin($_POST);
    }

    if (isset($imobilAdd)) {
        echo $imobilAdd;
    }


    ?>


    <div class="card ">
        <div class="card-header">
            <h3 class='text-center'>Add New Imobil</h3>
        </div>
        <div class="cad-body">



            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="post">
                    <div class="form-group pt-3">
                        <label for="" >Proprietar</label>
                        <?php
                        $clientsLista = $clients->selectAllClientData();
                        $select =  '<select name="id_proprietar" class="form-control">';
                        if(count($clientsLista)){

                            foreach($clientsLista as $val){
                                $select.='<option value="'.$val->id.'">'.$val->nume.'  '.$val->IDNP.'</option>';
                            }
                        }
                        $select .='</select>';
                        echo $select;
                        ?>
                    </div>

                    <div class="form-group pt-3">
                        <label for="" >Strada</label>
                        <?php
                        $straziLista = $strazi->selectAllActiveStrazi();
                        $select =  '<select name="id_strada" class="form-control">';
                        if(count($straziLista)){

                            foreach($straziLista as $val){
                                $select.='<option value="'.$val->id.'">'.$val->nume.'</option>';
                            }
                        }
                        $select .='</select>';
                        echo $select;
                        ?>
                    </div>
                    <div class="form-group pt-3">
                        <label for="nr_cadastral">Nr cadastral</label>
                        <input type="text" name="nr_cadastral"  class="form-control">
                    </div>
                        <div class="form-group pt-3">
                            <label for="tel">Telefon</label>
                            <input type="text" name="tel"  class="form-control">
                        </div>



                    <div class="form-group pt-3">
                            <label for="nr">Numar strada</label>
                            <input type="text" name="nr"  class="form-control">
                        </div>

                    <div class="form-group pt-3">
                        <label for="" >Suburbie</label>
                        <?php
                        $suburbiiLista = $suburbii->selectAllActiveSuburbii();
                        $select =  '<select name="id_suburbie" class="form-control">';
                        if(count($suburbiiLista)){

                            foreach($suburbiiLista as $val){
                                $select.='<option value="'.$val->id.'">'.$val->nume.'</option>';
                            }
                        }
                        $select .='</select>';
                        echo $select;
                        ?>
                    </div>



                    <div class="form-group">
                        <button type="submit" name="addImobil" class="btn btn-success">Register</button>
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
