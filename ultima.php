<?php
session_start();
require "database.php";
require "partials/header.php";

if(isset($_SESSION['user'])){
    //CANTIDAD //
    $statement = $conn->prepare("SELECT * FROM trasferencias ORDER BY fecha_transferencia DESC LIMIT 1 ");
    $statement->execute();
    $ORDEN = $statement->fetch(PDO::FETCH_ASSOC);

    //USUARIO 1//
    $us = $conn ->prepare("SELECT * FROM users WHERE id_user = {$ORDEN['id_user']} LIMIT 1");
    $us -> execute();
    $nombre = $us->fetch(PDO::FETCH_ASSOC);

    //USUARIO 2//
    $us2 = $conn ->prepare("SELECT * FROM cuenta WHERE id_cuenta = {$ORDEN['id_cuenta']} LIMIT 1");
    $us2 -> execute();
    $use2 = $us2->fetch(PDO::FETCH_ASSOC);

    $user2 = $conn ->prepare("SELECT * FROM users WHERE id_user = {$use2['propiedad']} LIMIT 1");
    $user2 -> execute();
    $users2 = $user2->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="d-flex justify-content-center mb-4 p-2 m-5">
        <div class="card text-bg-success  " style="min-width: 25rem;">
        <div class="row">
            <div class="card-header col">DE: <div class="text-warning"><?= $nombre['name'] ?></div></div>
            <div class="card-header col">A: <div class="text-warning"><?= $users2['name'] ?></div></div>
        </div>
            <div class="card-header">FECHA: <div class="text-warning"><?= $ORDEN['fecha_transferencia'] ?></div></div>
            <div class="card-body">
                <h5 class="card-title">cantidad: <div class="text-warning"><?= $ORDEN['cantidad_trasferencia']; ?> €</div></h5>
            </div>
        </div>
    </div>
<?php }else{
    echo "<h1 class='alert alert-warning'> No deberia estar aqui sin inciar Sesion Pillin </h1>";
} require "partials/footer.php"; ?>
