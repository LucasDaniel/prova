<?php 

    include("app.php");
    
    $cliente = $cliente->get_cliente($_GET['arg']);
    
    echo json_encode($cliente);
    
?>