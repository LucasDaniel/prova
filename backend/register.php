<?php 

    include("app.php");
    
    $cliente = $cliente->new_cliente($_POST['nome'],$_POST['email'],$_POST['senha'],$_FILES['foto']);
    
    echo json_encode($cliente);
    
?>