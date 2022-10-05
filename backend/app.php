<?php

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, OPTIONS");

    include("connect.php");
    include("clientes.php");

    $cliente = new Clientes();

?>