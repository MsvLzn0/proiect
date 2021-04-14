<?php
include 'inc/header.php';
$sId =  Session::get('roleid');
if ($sId === '1') { ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addSuburbie'])) {

        $suburbieAdd = $suburbii->addNewSuburbieByAdmin($_POST);
    }

    if (isset($suburbieAdd)) {
        echo $suburbieAdd;
    }


    ?>


    <div class="card ">
        <div class="card-header">
            <h3 class='text-center'>Add New Suburbie</h3>
        </div>
        <div class="cad-body">



            <div style="width:600px; margin:0px auto">

                <form class="" action="" method="post">
                    <div class="form-group pt-3">
                        <label for="" >Localitate</label>
                        <?php
                        $localitatiLista = $localitati->selectAllActiveLocalitati();
                        $select =  '<select name="id_localitate" class="form-control">';
                        if(count($localitatiLista)){

                            foreach($localitatiLista as $val){
                                $select.='<option value="'.$val->id.'">'.$val->nume.'</option>';
                            }
                        }
                        $select .='</select>';
                        echo $select;
                        ?>


                    </div>

                    <div class="form-group pt-3">
                        <label for="nume">Suburbie</label>
                        <input type="text" name="nume"  class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="submit" name="addSuburbie" class="btn btn-success">Register</button>
                    </div>



                </form>
            </div>


        </div>
    </div>

    <?php
}else{

    header('Location:suburbie.php');



}
?>

<?php
include 'inc/footer.php';

?>
