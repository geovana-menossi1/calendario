<?php
session_start();
if (!isset($_SESSION['email_usuario'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../database/database.php");

    $nome = $mysqli->real_escape_string($_POST['nome']);
    $data = $mysqli->real_escape_string($_POST['data']);
    $time = $mysqli->real_escape_string($_POST['time']);
    $descricao = $mysqli->real_escape_string($_POST['descricao']);
    $usuario_id = $_SESSION['usuario_id'];

    $data_evento = $data . ' ' . $time;

    $sql = "INSERT INTO eventos (evento_id, nome_evento, data_evento, descricao_evento, usuarios_usuario_id) VALUES (null, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $nome, $data_evento, $descricao, $usuario_id);

        if ($stmt->execute()) {
            header("Location: ../pages/tarefa.php");
        } else {
            echo "Erro ao cadastrar evento: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $mysqli->error;
    }

    $mysqli->close();
}
?>
