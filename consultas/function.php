<?php

if(isset($_GET['cerrarsesion']))
{
    session_start();
    session_destroy();
    header('Location: ../index.php');
}
?>