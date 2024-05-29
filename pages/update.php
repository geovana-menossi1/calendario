<?php
session_start();
if (!isset($_SESSION['email_usuario'])) {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$usuario = "root";
$senha = "";
$bd = "calendario";

$mysqli = new mysqli($host, $usuario, $senha, $bd);

if ($mysqli->connect_errno) {
    echo "Falha na conexão: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_evento']) && $_POST['update_evento'] == "1") {
    $evento_id = $mysqli->real_escape_string($_POST['id_evento']);
    $nome_evento = $mysqli->real_escape_string($_POST['nome_evento']);
    $data_evento = $mysqli->real_escape_string($_POST['data_evento']);
    $descricao_evento = $mysqli->real_escape_string($_POST['descricao_evento']);
    
    $sql_update = "UPDATE eventoNome SET nome_evento = ?, data_evento = ?, descricao_evento = ? WHERE evento_id = ?";
    $stmt_update = $mysqli->prepare($sql_update);
    if ($stmt_update) {
        $stmt_update->bind_param('sssi', $nome_evento, $data_evento, $descricao_evento, $evento_id);
        if ($stmt_update->execute()) {
            header("Location: tarefa.php?id=" . $evento_id);

            exit();
        } else {
            echo "Erro ao atualizar o evento: " . $stmt_update->error;
        }
        $stmt_update->close();
    } else {
        echo "Erro ao preparar a declaração: " . $mysqli->error;
    }
}

$evento_id = isset($_GET['id']) ? $mysqli->real_escape_string($_GET['id']) : 0;
$sql = "SELECT * FROM eventoNome WHERE evento_id = ?";
$stmt = $mysqli->prepare($sql);
if ($stmt) {
    $stmt->bind_param('i', $evento_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $evento = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "Erro ao preparar a declaração: " . $mysqli->error;
}

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fd;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 500px;
            height: 600px;
            background: #f8f9fd;
            background: linear-gradient(0deg, rgb(255, 255, 255) 0%, rgb(244, 247, 251) 100%);
            border-radius: 40px;
            padding: 25px 35px;
            border: 5px solid rgb(255, 255, 255);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 30px 30px -20px;
            margin: 20px;
            text-align: center;
        }

        .heading {
            font-weight: 900;
            font-size: 45px;
            color: rgb(16, 137, 211);
            margin-bottom: 30px;
        }

        .form {
            margin-top: 20px;
        }

        .form .input {
            width: 90%;
            height: 30px;
            background: white;
            border: none;
            padding: 20px 25px;
            border-radius: 20px;
            margin-top: 20px;
            font-size: 20px;
            box-shadow: #cff0ff 0px 10px 10px -5px;
            border-inline: 2px solid transparent;
        }

        .form .input:focus {
            outline: none;
            border-inline: 2px solid #12b1d1;
        }

        .form .login-button {
            display: block;
            width: 90%;
            height: 50px;
            font-weight: bold;
            background: linear-gradient(45deg, rgb(16, 137, 211) 0%, rgb(18, 177, 209) 100%);
            color: white;
            padding-block: 15px;
            margin: 40px auto;
            border-radius: 20px;
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 20px 10px -15px;
            border: none;
            transition: all 0.2s ease-in-out;
            font-size: 20px;
        }

        .form .login-button:hover {
            transform: scale(1.03);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 23px 10px -20px;
        }

        .form .login-button:active {
            transform: scale(0.95);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 15px 10px -10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="heading">Update</div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form">
            <input type="hidden" name="id_evento" value="<?php echo htmlspecialchars($evento['evento_id']); ?>">
            <input type="hidden" name="update_evento" value="1">
            <input required class="input" type="text" name="nome_evento" id="nome_evento" placeholder="Nome do Evento" value="<?php echo htmlspecialchars($evento['nome_evento']); ?>">
            <input required class="input" type="text" name="data_evento" id="data_evento" placeholder="Data do Evento" value="<?php echo htmlspecialchars($evento['data_evento']); ?>">
            <input required class="input" type="text" name="descricao_evento" id="descricao_evento" placeholder="Descrição do Evento" value="<?php echo htmlspecialchars($evento['descricao_evento']); ?>">
            <input class="login-button" type="submit" value="Atualizar">
        </form>
    </div>
</body>
</html>
