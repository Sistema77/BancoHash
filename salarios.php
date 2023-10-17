<?php

session_start();

require "database.php";
require "partials/header.php";

$uses = $conn -> prepare("SELECT * FROM users join cuenta ON id_user = propiedad");
$uses -> execute();

foreach($uses as $use)
{ ?>
    <div class="card text-bg-success mb-4 d-flex justify-content-center" style="max-width: 25rem;">
        <div class="card-header"><?= $use['name']; ?> </div>
        <div class="card-body">
            <h5 class="card-title"><?= $use['cantidad_cuenta']; ?> €</h5>
        </div>
    </div>
<?php }
    
require "partials/footer.php"; ?>