<header class="masthead">
    <div class="inner m-3">
        <h3 class="masthead-brand text-light">BANQUETE</h3>
        <nav class="nav nav-masthead justify-content-center">
            <?php if(!isset($_SESSION['user'])){ ?>
                
                <a class="list-group-item nav-link active text-decoration btn btn-primary text-light p-2 m-2" href="register.php">Register</a>
                <a class="list-group-item nav-link active text-decoration btn btn-primary text-light p-2 m-2" href="login.php">Login</a>
                
                
            <?php }else{ ?>
                <a class=" nav-link  btn btn-primary text-light p-2 m-2" href="home.php">Inicio</a>
                <a class=" nav-link  btn btn-primary text-light p-2 m-2" href="salarios.php">Todos Los Salarios</a>
                <a class=" nav-link  btn btn-primary text-light p-2 m-2" href="transanciones.php">Trasanciones</a>
                <a class=" nav-link  btn btn-primary text-light p-2 m-2" href="ultima.php">Ultima Trasferencia</a>
                <a class=" nav-link  btn btn-primary text-light p-2 m-2" href="historial.php">Historial Trasanciones</a>
                <a class=" nav-link  btn btn-primary text-light p-2 m-2" href="consultas/function.php?cerrarsesion">Cerrar Sesión</a>
                <h2 class="nav-link text-warning p-2 m-2">USUARIO: <?= $_SESSION['user']['name'] ?> </h2>
            <?php } ?>
        </nav>
    </div>
</header>