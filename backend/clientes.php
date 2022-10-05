<?php

class Clientes extends Connect {

    private $insert;
    private $select;
    private $exists;

    function set_insert($nome,$email,$senha,$foto) {
        $senha = md5($senha);
        $this->insert = "INSERT INTO cliente (nome, email, senha, foto) VALUES ('$nome','$email','$senha','$foto')";
    }

    function cliente_exists($nome,$email) {
        $this->exists = "SELECT COUNT(*) AS QUANT FROM cliente WHERE nome LIKE '$nome' OR email LIKE '$email'";
    }

    function set_select_cliente($arg) {
        if (!is_numeric($arg)) $this->select = "SELECT * FROM cliente WHERE nome LIKE '$arg'";
        else $this->select = "SELECT * FROM cliente WHERE id = $arg";
    }

    function upload_foto($foto) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($foto["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($foto["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
        if($imageFileType != "jpg"  && $imageFileType != "png" && 
            $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }
        if ($uploadOk != 0) {
            if (move_uploaded_file($foto["tmp_name"], $target_file)) {
                $uploadOk = $target_file;
            }
        }
        return $uploadOk;
    }
    
    function new_cliente($nome,$email,$senha,$foto) {

        if (!isset($nome)  && !isset($email) &&
            !isset($senha) && !isset($foto)) {
            return ["msg" => "Post Error", "img" => 0, "success" => false];
        }
        
        $con = mysqli_connect($this->get_host(), $this->get_user(), $this->get_password(), $this->get_database()) or die("Error connect");
        $this->cliente_exists($nome,$email);
        $quant = (int) mysqli_fetch_assoc(mysqli_query($con, $this->exists))['QUANT'];
        if ($quant > 0) {
            return ["msg" => "Nome ou email já usados", "img" => 0, "success" => false];
        }

        $foto = $this->upload_foto($foto);
        if (!is_string($foto)) {
            return ["msg" => "Erro ao salvar a foto", "img" => 0, "success" => false];
        }

        $this->set_insert($nome,$email,$senha,$foto);
        if (mysqli_query($con, $this->insert)) {
            mysqli_close($con);
            return ["msg" => "Cliente criado com sucesso", "img" => $foto, "success" => true];
        }
        mysqli_close($con);
        return ["msg" => "Error new cliente", "img" => 0, "success" => false];
    }

    function get_cliente($arg) {
        if (!isset($arg)) {
            return ["msg" => "GET error", "success" => false];
        }
        $this->set_select_cliente($arg);
        $con = mysqli_connect($this->get_host(), $this->get_user(), $this->get_password(), $this->get_database()) or die("Error connect");
        $return = mysqli_fetch_assoc(mysqli_query($con, $this->select));
        return ["obj" => $return, "success" => true];
    }
    
}

?>