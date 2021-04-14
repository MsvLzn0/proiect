<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . "/../lib/Session.php";
Session::init();
Session::CheckSession();


spl_autoload_register(function ($classes) {

    include 'classes/' . $classes . ".php";

});


include('init.php');

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>CRUD User Management</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

</head>
<body>


<?php


if (isset($_GET['action']) && $_GET['action'] == 'logout') {

    Session::destroy();
}


?>


<div class="container">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark card-header">
        <a class="navbar-brand" href="news.php"><i class="bi bi-card-checklist"></i>News</a>
        <a class="navbar-brand" href="service.php"><i class="bi bi-card-checklist"></i>Servicii</a>
        <a class="navbar-brand" href="traseu.php"><i class="bi bi-card-checklist"></i>Traseu</a>
        <a class="navbar-brand" href="contract.php"><i class="bi bi-card-checklist"></i>Contract</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">


                <?php if (Session::get('id') == TRUE) { ?>
                    <?php if (Session::get('roleid') == '1') { ?>

                        <div class="dropdown">
                            <button style="color: gray" class="btn ml-2" type="button" data-toggle="dropdown">Add
                                </span></button>
                            <ul class="dropdown-menu">
                                <li><a href="addUser.php">Add User</a></li>
                                <li><a href="addClient.php">Add Client</a></li>
                                <li><a href="addImobil.php">Add Imobil</a></li>
                                <li><a href="addService.php">Add Service</a></li>
                                <li><a href="addRegiune.php">Add Regiune</a></li>
                                <li><a href="addRaion.php">Add Raion</a></li>
                                <li><a href="addLocalitate.php">Add Localitate</a></li>
                                <li><a href="addStrada.php">Add Strada</a></li>
                                <li><a href="addSuburbie.php">Add Suburbie</a></li>
                                <li><a href="addImobil.php">Add Imobil</a></li>
                                <li><a href="addContract.php">Add Contract</a></li>
                                <li><a href="addPrestat.php">Add Servicii contract</a></li>

                            </ul>
                        </div>
                        <div class="dropdown">
                            <button style="color: gray" class="btn ml-2" type="button" data-toggle="dropdown">Lists
                                </span></button>
                            <ul class="dropdown-menu">
                                <li><a href="prestat.php">Servicii contract</a></li>
                                <li><a href="contract.php">Contract lists</a></li>
                                <li><a href="imobil.php">Imobil lists</a></li>
                                <li><a href="suburbie.php">Suburbie lists</a></li>
                                <li><a href="strada.php">Strada lists</a></li>
                                <li><a href="localitate.php">Localitate lists</a></li>
                                <li><a href="regiune.php">Regiune lists</a></li>
                                <li><a href="raion.php">Raion lists</a></li>
                                <li><a href="client.php">Client lists</a></li>
                                <li><a href="index.php">User lists</a></li>


                            </ul>
                        </div>


                    <?php } ?>
                    <li class="nav-item
            <?php

                    $path = $_SERVER['SCRIPT_FILENAME'];
                    $current = basename($path, '.php');
                    if ($current == 'profile') {
                        echo "active ";
                    }

                    ?>

            ">


                        <a class="nav-link" href="profile.php?id=<?php echo Session::get("id");?>"><i
                                    class="fab fa-500px mr-2"></i>Profile <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="?action=logout"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                    </li>
                <?php } else { ?>

                    <li class="nav-item

              <?php

                    $path = $_SERVER['SCRIPT_FILENAME'];
                    $current = basename($path, '.php');
                    if ($current == 'register') {
                        echo " active ";
                    }

                    ?>">
                        <a class="nav-link" href="register.php"><i class="fas fa-user-plus mr-2"></i>Register</a>
                    </li>
                    <li class="nav-item
                <?php

                    $path = $_SERVER['SCRIPT_FILENAME'];
                    $current = basename($path, '.php');
                    if ($current == 'login') {
                        echo " active ";
                    }

                    ?>">
                        <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
                    </li>

                <?php } ?>


            </ul>

        </div>
    </nav>
