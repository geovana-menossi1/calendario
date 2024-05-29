<?php


require_once '../database/database.php';
$nome = addslashes($_POST['nome']);
$email = addslashes($_POST['email']);
$senha = addslashes($_POST['senha']);

if (!empty($nome) && !empty($email) && !empty($senha)) {
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    $query = "INSERT INTO usuarios (`usuario_id`, `nome_usuario`, `email_usuario`, `senha_usuario`) VALUES (null, '$nome', '$email', '$senha_hash')";

    if ($mysqli->query($query)) {
        $usuario_id = $mysqli->insert_id;
        
        header("Location: ../pages/login.php");
    } else {
        echo "Erro ao inserir registro: " . $mysqli->error;
    }

        
    }


?>