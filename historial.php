<?php
session_start();

require "database.php";
require "partials/header.php";

if(isset($_SESSION['user'])){
    $uses = $conn -> prepare("SELECT * FROM trasferencias join users ON trasferencias.id_user = users.id_user");
    $uses -> execute();
    
    foreach($uses as $use)
    { ?>
        <div class="card text-bg-success mb-4 d-flex justify-content-center" style="max-width: 25rem;">
            <div class="card-header"><?= $use['name']; ?> </div>
            <div class="card-body">
                <h5 class="card-title"><?= $use['cantidad_trasferencia']; ?> €</h5>
            </div>
        </div>
    <?php }
}else{
    echo "<h1 class='alert alert-warning'> No deberia estar aqui sin inciar Sesion Pillin </h1>";
} require "partials/footer.php"; ?>
