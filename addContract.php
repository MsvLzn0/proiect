<?php
include 'inc/header.php';
$sId =  Session::get('roleid');
if ($sId === '1') { ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addContract'])) {

        $contractAdd = $contracte->addNewContractByAdmin($_POST);
    }

    if (isset($contractAdd)) {
        echo $contractAdd;
    }


    ?>


    <div class="card ">
        <div class="card-header">
            <h3 class='text-center'>Add New Contract</h3>
        </div>
        <div class="cad-body">



            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="post">
                    <div class="form-group pt-3">
                        <label for="nr_contract">Nr contract</label>
                        <input type="text" name="nr_contract"  class="form-control">
                    </div>

                    <div class="form-group pt-3">
                        <label for="" >Nr cadastral</label>
                        <?php
                        $imobilLista = $imobile->selectAllActiveImobile();
                        $select =  '<select name="id_imobil" class="form-control">';
                        if(count($imobilLista)){

                            foreach($imobilLista as $val){
                                $select.='<option value="'.$val->id.'">'.$val->nr_cadastral.'</option>';
                            }
                        }
                        $select .='</select>';
                        echo $select;
                        ?>
                    </div>


                    <div class="form-group">
                        <button type="submit" name="addContract" class="btn btn-success">Register</button>
                    </div>



                </form>
            </div>


        </div>
    </div>

    <?php
}else{

    header('Location:contract.php');



}
?>

<?php
include 'inc/footer.php';

?>
