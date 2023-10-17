<?php

session_start();
$error = null;
require "database.php";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(empty($_POST['user1']) || empty($_POST['user2']) || empty($_POST['cantidad']))
    {
        $error = "Porfavor rellene todos los campos";
    }
    else
    {
        //NOMBRE USUARIO 1//
        $user = $conn -> prepare("SELECT * FROM users WHERE name = :name LIMIT 1");
        $user -> bindParam(":name", $_POST['user1']);
        $user -> execute();

        $user1 = $user->fetch(PDO::FETCH_ASSOC);

        // NOMBRE USUARIO 2//
        $users = $conn -> prepare("SELECT * FROM users WHERE name = :name LIMIT 1");
        $users -> bindParam(":name", $_POST['user2']);
        $users -> execute();

        $user2 = $users->fetch(PDO::FETCH_ASSOC);

        //CUENTA 1 DEL USUARIO 1//

        $cuentas = $conn -> prepare("SELECT * FROM cuenta WHERE propiedad = :propietario LIMIT 1");
        $cuentas -> bindParam(":propietario", $user1['id_user']);
        $cuentas -> execute();

        $cuenta1 = $cuentas->fetch(PDO::FETCH_ASSOC);

        if($cuenta1['cantidad_cuenta'] < $_POST['cantidad'])
        {
            $error = "Lo sentimos pero no dispone de tante efectivo en la cuenta";
        }
        else
        {
            //RESTAR A LA CUENTA //
            $resta = $cuenta1['cantidad_cuenta'] - $_POST['cantidad'];
            echo "resta: " . $resta . "</br>";

            $cone = $conn -> prepare("UPDATE cuenta SET cantidad_cuenta = {$resta} WHERE propiedad = {$user1['id_user']}");
            $cone -> execute();

            //SUMAR A LA OTRA CUENTA //
            $cuentas2 = $conn -> prepare("SELECT * FROM cuenta WHERE propiedad = {$user2['id_user']} LIMIT 1");
            $cuentas2 -> execute();

            $cuenta = $cuentas2->fetch(PDO::FETCH_ASSOC);
            $suma = $cuenta['cantidad_cuenta'] + $_POST['cantidad'];

            echo "resta: " . $suma . "</br>";

            $suma1 = $conn -> prepare("UPDATE cuenta SET cantidad_cuenta = {$suma} WHERE propiedad = {$user2['id_user']}");
            $suma1 -> execute();
            //REGISTRAR TRASFERENCIA //

            $registro = $conn -> prepare("INSERT INTO trasferencias  (id_user, id_cuenta, cantidad_trasferencia) VALUE ( {$user1['id_user']} , {$cuenta['id_cuenta']} , {$_POST['cantidad']} )");
            $registro -> execute();
        }
    }
}
require "partials/header.php";
?>

<div class="container pt-5">
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h1>TRASFERENCIAS</h1></div>
            <div class="card-body">
            <?php if ($error): ?>
                <p class="text-danger">
                <?= $error ?>
                </p>
            <?php endif ?>
            <form method="POST" action="transanciones.php">
                <div class="mb-3 row">
                <label for="user1" class="col-md-4 col-form-label text-md-end">Usuario que realizara la Trasferencia</label>

                <div class="col-md-6">
                    <input id="user1" type="user1" class="form-control" name="user1" autocomplete="user1" autofocus>
                </div>
                </div>

                <div class="mb-3 row">
                <label for="user2" class="col-md-4 col-form-label text-md-end">Usuario que realizara la Trasferencia</label>

                <div class="col-md-6">
                    <input id="user2" type="user2" class="form-control" name="user2" autocomplete="user2" autofocus>
                </div>
                </div>

                <div class="mb-3 row">
                <label for="cantidad" class="col-md-4 col-form-label text-md-end">Cantidad de Dinero</label>

                <div class="col-md-6">
                    <input id="cantidad" type="cantidad" class="form-control" name="cantidad" autocomplete="cantidad" autofocus>
                </div>
                </div>

                <div class="mb-3 row">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Transferencia</button>
                </div>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "partials/footer.php"; ?>