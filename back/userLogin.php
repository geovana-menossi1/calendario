<?php
require_once '../database/database.php';

$email = $_POST['email_usuario'] ?? '';
$senha = $_POST['pass'] ?? '';

if (!empty($email) && !empty($senha)) {
    $query = "SELECT * FROM usuarios WHERE email_usuario = ?";
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $usuario_id = $row['usuario_id'];
            $nome_cliente = $row['nome_usuario'];
            $email_usuario = $row['email_usuario'];
            $senha_hash = $row['senha_usuario'];

            if (password_verify($senha, $senha_hash)) {
                session_start();
                $_SESSION['email_usuario'] = $email;
                $_SESSION['usuario_id'] = $usuario_id;

                header("Location: ../index.php");
                exit();
            } else {
                echo "Email ou senha incorretos.";
            }
        } else {
           
            echo "Email não encontrado.";
        }

        $stmt->close();
    } else {
        echo "Erro no servidor. Tente novamente mais tarde.";
    }
} else {
    echo "Por favor, preencha todos os campos.";
}

$mysqli->close();
?>
