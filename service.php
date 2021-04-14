<?php
include 'inc/header.php';

$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
    echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
    echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);
?>
<?php

if (isset($_GET['remove'])) {
    $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
    $removeService = $services->deleteServiceById($remove);
}

if (isset($removeService)) {
    echo $removeService;
}
if (isset($_GET['deactive'])) {
    $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
    $deactiveId = $services->serviceDeactiveByAdmin($deactive);
}

if (isset($deactiveId)) {
    echo $deactiveId;
}
if (isset($_GET['active'])) {
    $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
    $activeId = $services->serviceActiveByAdmin($active);
}

if (isset($activeId)) {
    echo $activeId;
}


?>

<div class="card ">
    <div class="card-header">
        <h3><i class="fa fa-id-badge mr-2"></i>Lista serviciilor <span class="float-right">Welcome! <strong>
            <span class="badge badge-lg badge-secondary text-white">
<?php
$username = Session::get('username');
if (isset($username)) {
    echo $username;
}
?></span>

          </strong></span></h3>
    </div>
    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h3 class="mb-1">Serviciul de colectare si trasnsport deseuri.</h3>

            </div>
            <p class="mb-1">Efectuăm servicii de colectare pentru toate tipurile de deşeuri atât pentru persoane fizice cât şi pentru agenţi economici. Deseurile odata colectate sunt repartizate fie catre reciclatori/valorificatori fie catre Depozitul Ecologic Zonal FIN-ECO.</br>


            </p>
            <small></small>
        </a>
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h3 class="mb-1">Serviciul de salubrizare stradala si piete</h3>

            </div>
            <p class="mb-1">Oferim beneficiarilor noştri servicii complete de salubrizare stradală și piețe agroalimentare.</p>
            <small class="text-muted"></small>
        </a>
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h3 class="mb-1">Servicii de deszapezire.</h3>

            </div>
            <p class="mb-1">Pe timpul iernii va punem la dispozitie profesionalismul nostru si utilajele moderne pentru a acoperi intreaga gama de servicii specifice sezonului.</p>
            <small class="text-muted"></small>
        </a>
    </div>
    <div class="card-body pr-2 pl-2">

        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th  class="text-center">ID</th>
                <th  class="text-center">Name</th>
                <th  class="text-center">Unit Kg/Km</th>
                <th  class="text-center">Cost</th>
                <th  class="text-center">Start date</th>
                <th  class="text-center">Stop date</th>
                <th  class="text-center">Status</th>
                <th  width='25%' class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $allService = $services->selectAllServiceData();

            if ($allService) {
                $i = 0;
                foreach ($allService as  $value) {
                    $i++;

                    ?>

                    <tr class="text-center"
                        <?php if (Session::get("id") == $value->id) {
                            echo "style='background:#d9edf7' ";
                        } ?>
                    >

                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->nume; ?></td>
                        <td><?php echo $value->unit_masura; ?> <br>
                        <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->cost; ?></span></td>
                        <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->data_start; ?></span></td>
                        <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->data_stop; ?></span></td>
                        <td>
                            <?php if ($value->isActive == '0') { ?>
                                <span class="badge badge-lg badge-info text-white">Active</span>
                            <?php }else{ ?>
                                <span class="badge badge-lg badge-danger text-white">Deactive</span>
                            <?php } ?>

                        </td>
                        <td>
                            <?php if ( Session::get("roleid") == '1') {?>
                                <a class="btn btn-success btn-sm" href="serviceVE.php?id=<?php echo $value->id;?>">View</a>
                                <a class="btn btn-primary btn-sm " href="serviceVE.php?id=<?php echo $value->id;?>">Edit</a>
                                <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger

                             btn-sm " href="?remove=<?php echo $value->id;?>">Remove</a>

                                <?php if ($value->isActive == '0') {  ?>
                                    <a onclick="return confirm('Are you sure To Deactive ?')" class="btn btn-warning

                                btn-sm " href="?deactive=<?php echo $value->id;?>">Disable</a>
                                <?php } elseif($value->isActive == '1'){?>
                                    <a onclick="return confirm('Are you sure To Active ?')" class="btn btn-secondary

                                btn-sm " href="?active=<?php echo $value->id;?>">Active</a>
                                <?php } ?>




                            <?php  }elseif(Session::get("id") == $value->id  && Session::get("roleid") == '2'){ ?>
                                <a class="btn btn-success btn-sm " href="serviceVE.php?id=<?php echo $value->id;?>">View</a>
                                <a class="btn btn-info btn-sm " href="serviceVE.php?id=<?php echo $value->id;?>">Edit</a>
                            <?php  }elseif( Session::get("roleid") == '2'){ ?>
                                <a class="btn btn-success btn-sm
                          <?php if ($value->roleid == '1') {
                                    echo "disabled";
                                } ?>
                          " href="serviceVE.php?id=<?php echo $value->id;?>">View</a>
                                <a class="btn btn-info btn-sm
                          <?php if ($value->roleid == '1') {
                                    echo "disabled";
                                } ?>
                          " href="serviceVE.php?id=<?php echo $value->id;?>">Edit</a>
                            <?php }elseif(Session::get("id") == $value->id  && Session::get("roleid") == '3'){ ?>
                                <a class="btn btn-success btn-sm " href="serviceVE.php?id=<?php echo $value->id;?>">View</a>
                                <a class="btn btn-info btn-sm " href="serviceVE.php?id=<?php echo $value->id;?>">Edit</a>
                            <?php }else{ ?>
                                <a class="btn btn-success btn-sm
                          <?php if ($value->roleid == '1') {
                                    echo "disabled";
                                } ?>
                          " href="serviceVE.php?id=<?php echo $value->id;?>">View</a>

                            <?php } ?>

                        </td>
                    </tr>
                <?php }}else{ ?>
                <tr class="text-center">
                    <td>No user availabe now !</td>
                </tr>
            <?php } ?>





            </tbody>
        </table>
    </div>
</div>



<?php
include 'inc/footer.php';

?>