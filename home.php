<?php

session_start();
require "database.php";
require "partials/header.php";

if(isset($_SESSION['user'])){
    $statement = $conn->prepare("SELECT * FROM cuenta WHERE propiedad = :propiedad");
    $statement->bindParam(":propiedad", $_SESSION['user']["id_user"]);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    ?>
    <div class="container pt-5 d-flex justify-content-center">
        <div class="card text-bg-success mb-4 col-md-8" style="max-width: 35rem;">
            <div class="card-header">Salario</div>
            <div class="card-body">
                <h5 class="card-title"><?= $user['cantidad_cuenta']; ?> €</h5>
            </div>
        </div>
    </div>

<?php }else{
    echo "<h1 class='alert alert-warning'> No deberia estar aqui sin inciar Sesion Pillin </h1>";
} require "partials/footer.php"; ?>