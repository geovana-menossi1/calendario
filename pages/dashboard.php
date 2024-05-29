<?php
include('../database/database.php');

$result_usuarios = $mysqli->query("SELECT COUNT(*) as total_usuarios FROM usuarios");
$result_eventos = $mysqli->query("SELECT COUNT(*) as total_eventos FROM eventos");
$result_eventos_futuros = $mysqli->query("SELECT COUNT(*) as eventos_futuros FROM eventos WHERE data_evento > NOW()");

$total_usuarios = $result_usuarios->fetch_assoc()['total_usuarios'];
$total_eventos = $result_eventos->fetch_assoc()['total_eventos'];
$eventos_futuros = $result_eventos_futuros->fetch_assoc()['eventos_futuros'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
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
            flex-direction: column;
            text-align: start;
        }
        .container {
            width: 80%;
            height: 500px;
            background: #f8f9fd;
            background: linear-gradient(0deg, rgb(255, 255, 255) 0%, rgb(244, 247, 251) 100%);
            border-radius: 20px;
            padding: 25px 35px;
            border: 5px solid rgb(255, 255, 255);
            box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 30px 30px -20px;
            margin: 20px;
            text-align: center;
            display: flex;
            flex-direction: row;
        }
        .heading {
            font-weight: 900;
            font-size: 45px;
            color: rgb(16, 137, 211);
            margin-bottom: 30px;
        }
        .stats {
            margin-top: 20px;
            width: 30%;
            height: 400px;
            display: flex;
            flex-direction: row;
            position: relative;
            top: 10%;
        }
        #eventosChart{
            position: relative;
            top: 20%;
            left: 10%;
        }
        p{
            width: 100%;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: end;
        }
        a{
            text-decoration: none;
            position: relative;
            right: 20px;
            color: #00addf;
            font-weight: bold;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<p><a href="../index.php">Ir para Home</a></p>
    <div class="container">
        <div class="heading">Dashboard</div>
        <div class="stats">
            <canvas id="usuariosChart"></canvas>
            <canvas id="eventosChart"></canvas>
        </div>
    </div>
    <script>
        const totalUsuarios = <?php echo $total_usuarios; ?>;
        const totalEventos = <?php echo $total_eventos; ?>;
        const eventosFuturos = <?php echo $eventos_futuros; ?>;
        
        const ctxUsuarios = document.getElementById('usuariosChart').getContext('2d');
        const usuariosChart = new Chart(ctxUsuarios, {
            type: 'doughnut',
            data: {
                labels: ['Total de Usuários'],
                datasets: [{
                    label: 'Usuários',
                    data: [totalUsuarios],
                    backgroundColor: ['#1093D3'],
                    borderColor: ['#0B69A3'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            }
        });
        const ctxEventos = document.getElementById('eventosChart').getContext('2d');
        const eventosChart = new Chart(ctxEventos, {
            type: 'bar',
            data: {
                labels: ['Total de Eventos', 'Eventos Futuros'],
                datasets: [{
                    label: 'Eventos',
                    data: [totalEventos, eventosFuturos],
                    backgroundColor: ['#1093D3', '#FFCE56'],
                    borderColor: ['#0B69A3', '#FFB347'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
