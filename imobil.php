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
    $removeImobil = $imobile->deleteImobileById($remove);
}

if (isset($removeImobil)) {
    echo $removeImobil;
}
if (isset($_GET['deactive'])) {
    $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
    $deactiveId = $imobile->imobileDeactiveByAdmin($deactive);
}

if (isset($deactiveId)) {
    echo $deactiveId;
}
if (isset($_GET['active'])) {
    $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
    $activeId = $imobile->imobileActiveByAdmin($active);
}

if (isset($activeId)) {
    echo $activeId;
}


?>

    <div class="card ">
        <div class="card-header">
            <h3><i class="fa fa-id-badge mr-2"></i>Lista Imobilelor <span class="float-right">Welcome! <strong>
            <span class="badge badge-lg badge-secondary text-white">
<?php
$username = Session::get('username');
if (isset($username)) {
    echo $username;
}
?></span>

          </strong></span></h3>
        </div>
        <div class="card-body pr-2 pl-2">

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Proprietar</th>
                    <th class="text-center">Strada</th>
                    <th class="text-center">Nr cadastral</th>
                    <th class="text-center">Telefon</th>
                    <th class="text-center">Numarul strazii</th>
                    <th class="text-center">Suburbie</th>
                    <th class="text-center">Status</th>
                    <th width='25%' class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $allImobil = $imobile->selectAllImobileData();

                if ($allImobil) {
                    $i = 0;
                    foreach ($allImobil as $value) {
                        $i++;

                        ?>

                        <tr class="text-center"
                            <?php if (Session::get("id") == $value->id) {
                                echo "style='background:#d9edf7' ";
                            } ?>
                        >


                            <td><?php echo $i; ?></td>
                            <td><?php echo $value->id_proprietar; ?></td>
                            <td><?php echo $value->id_strada; ?></td>
                            <td><?php echo $value->nr_cadastral; ?></td>
                            <td><?php echo $value->tel; ?></td>
                            <td><?php echo $value->nr; ?></td>
                            <td><?php echo $value->id_suburbie; ?></td>
                            <td>
                                <?php if ($value->isActive == '1') { ?>
                                    <span class="badge badge-lg badge-info text-white">Active</span>
                                <?php } else { ?>
                                    <span class="badge badge-lg badge-danger text-white">Deactive</span>
                                <?php } ?>

                            </td>
                            <td>
                                <?php if (Session::get("roleid") == '1') { ?>
                                    <a class="btn btn-success btn-sm" href="imobilVE.php?id=<?php echo $value->id; ?>">View</a>
                                    <a class="btn btn-primary btn-sm " href="imobilVE.php?id=<?php echo $value->id; ?>">Edit</a>
                                    <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger

                             btn-sm " href="?remove=<?php echo $value->id; ?>">Remove</a>

                                    <?php if ($value->isActive == '1') { ?>
                                        <a onclick="return confirm('Are you sure To Deactive ?')" class="btn btn-warning

                                btn-sm " href="?deactive=<?php echo $value->id; ?>">Disable</a>
                                    <?php } elseif ($value->isActive == '0') { ?>
                                        <a onclick="return confirm('Are you sure To Active ?')" class="btn btn-secondary

                                btn-sm " href="?active=<?php echo $value->id; ?>">Active</a>
                                    <?php } ?>


                                <?php } elseif (Session::get("id") == $value->id && Session::get("roleid") == '2') { ?>
                                    <a class="btn btn-success btn-sm " href="imobilVE.php?id=<?php echo $value->id; ?>">View</a>
                                    <a class="btn btn-info btn-sm " href="imobilVE.php?id=<?php echo $value->id; ?>">Edit</a>
                                <?php } elseif (Session::get("roleid") == '2') { ?>
                                    <a class="btn btn-success btn-sm
                          <?php if ($value->roleid == '1') {
                                        echo "disabled";
                                    } ?>
                          " href="imobilVE.php?id=<?php echo $value->id; ?>">View</a>
                                    <a class="btn btn-info btn-sm
                          <?php if ($value->roleid == '1') {
                                        echo "disabled";
                                    } ?>
                          " href="imobilVE.php?id=<?php echo $value->id; ?>">Edit</a>
                                <?php } elseif (Session::get("id") == $value->id && Session::get("roleid") == '3') { ?>
                                    <a class="btn btn-success btn-sm " href="imobilVE.php?id=<?php echo $value->id; ?>">View</a>
                                    <a class="btn btn-info btn-sm " href="imobilVE.php?id=<?php echo $value->id; ?>">Edit</a>
                                <?php } else { ?>
                                    <a class="btn btn-success btn-sm
                          <?php if ($value->roleid == '1') {
                                        echo "disabled";
                                    } ?>
                          " href="imobilVE.php?id=<?php echo $value->id; ?>">View</a>

                                <?php } ?>

                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr class="text-center">
                        <td>No availabe now !</td>
                    </tr>
                <?php } ?>


                </tbody>
            </table>
        </div>
    </div>


<?php
include 'inc/footer.php';

?>