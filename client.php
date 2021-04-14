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
    $removeClient = $clients->deleteClientById($remove);
}

if (isset($removeClient)) {
    echo $removeClient;
}
if (isset($_GET['deactive'])) {
    $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
    $deactiveId = $clients->clientDeactiveByAdmin($deactive);
}

if (isset($deactiveId)) {
    echo $deactiveId;
}
if (isset($_GET['active'])) {
    $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
    $activeId = $clients->clientActiveByAdmin($active);
}

if (isset($activeId)) {
    echo $activeId;
}


?>

<div class="card ">
    <div class="card-header">
        <h3><i class="fa fa-id-badge mr-2"></i>Lista clientilor <span class="float-right">Welcome! <strong>
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
                <th  class="text-center">ID</th>
                <th  class="text-center">Name</th>
                <th  class="text-center">Surname</th>
                <th  class="text-center">Patronymic</th>
                <th  class="text-center">IDNP</th>
               <!-- <th  class="text-center">Data</th>-->
                <th  class="text-center">Mobile</th>
                <th  class="text-center">Email</th>
                <th  class="text-center">Address</th>
                <th  width='25%' class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $allClient = $clients->selectAllClientData();

            if ($allClient) {
                $i = 0;
                foreach ($allClient as  $value) {
                    $i++;

                    ?>

                    <tr class="text-center"
                        <?php if (Session::get("id") == $value->id) {
                            echo "style='background:#d9edf7' ";
                        } ?>
                    >

                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->nume; ?></td>
                        <td><?php echo $value->prenume; ?> <br>
                        <td><?php echo $value->patronimic; ?></td>

                        <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->IDNP; ?></span></td>
                        <!--<td><span class="badge badge-lg badge-secondary text-white"><?php /*echo $clients->formatDate($value->data);  */?></span></td>-->
                        <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->tel; ?></span></td>
                        <td><?php echo $value->e_mail; ?></td>
                        <td><?php echo $value->adresa; ?></td>

                        <td>
                            <?php if ( Session::get("roleid") == '1') {?>
                                <a class="btn btn-success btn-sm" href="clientVE.php?id=<?php echo $value->id;?>">View</a>

                                <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger
                    <?php if (Session::get("id") == $value->id) {
                                    echo "disabled";
                                } ?>
                             btn-sm " href="?remove=<?php echo $value->id;?>">Remove</a>


                            <?php  }elseif(Session::get("id") == $value->id  && Session::get("roleid") == '2'){ ?>
                                <a class="btn btn-success btn-sm " href="clientVE.php?id=<?php echo $value->id;?>">View</a>

                            <?php  }elseif( Session::get("roleid") == '2'){ ?>
                                <a class="btn btn-success btn-sm
                          <?php if ($value->roleid == '1') {
                                    echo "disabled";
                                } ?>
                          " href="clientVE.php?id=<?php echo $value->id;?>">View</a>
                                <a class="btn btn-info btn-sm
                          <?php if ($value->roleid == '1') {
                                    echo "disabled";
                                } ?>
                          " href="clientVE.php?id=<?php echo $value->id;?>">Edit</a>
                            <?php }elseif(Session::get("id") == $value->id  && Session::get("roleid") == '3'){ ?>
                                <a class="btn btn-success btn-sm " href="clientVE.php?id=<?php echo $value->id;?>">View</a>

                            <?php }else{ ?>
                                <a class="btn btn-success btn-sm
                          <?php if ($value->roleid == '1') {
                                    echo "disabled";
                                } ?>
                          " href="clientVE.php?id=<?php echo $value->id;?>">View</a>

                            <?php } ?>

                        </td>
                    </tr>
                <?php }}else{ ?>
                <tr class="text-center">
                    <td>No clients availabe now !</td>
                </tr>
            <?php } ?>

            </tbody>

        </table>









    </div>
</div>



<?php
include 'inc/footer.php';

?>
