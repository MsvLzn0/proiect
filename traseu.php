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


<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10048.524038430249!2d28.82858092058485!3d47.02473492558062!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40c97e998113b3f5%3A0xc314c794f9836dea!2zQ2VudHJ1LCBDaGnImWluxIN1!5e0!3m2!1sro!2s!4v1617635268207!5m2!1sro!2s" width=100% height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>


<div class="list-group">
    <a href="service.php" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Serviciul de colectare si trasnsport deseuri</h5>

        </div>
        <p class="mb-1">Deseurile se colecteaza o data pe saptamana comform oraruli:</br>
            <h5>·Botanica - Luni</br>
            ·Buiucani - Marti</br>
            ·Centru   - Miercuri</br>
            ·Ciocana  - Joi</br>
            ·Riscani  - Vineri</h5>


        </p>
        <small>Aici puteti gasi costul serviciilor</small>
    </a>
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Serviciul de salubrizare stradala si piete</h5>

        </div>
        <p class="mb-1">Acest serviciu se efectuiaza zilnic cu exceptia zilelor de odihna</p>
        <small class="text-muted"></small>
    </a>
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Servicii de deszapezire</h5>

        </div>
        <p class="mb-1">Acest serviciu se efectuiaza zilnic cu exceptia zilelor de odihna</p>
        <small class="text-muted"></small>
    </a>
</div>



<?php
include 'inc/footer.php';

?>
