<?php
session_start();
if (!isset($_SESSION['email_usuario'])) {
    header("Location: pages/login.php");
    exit();
}

?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Calendario</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    tr {
        border: none;
    }
    .sair{
        color: #000;
        position: fixed;
        top: 10px;
        left: 97%;
    }
    .sair a{
        text-decoration: none;
        color: black;
    }
    .dia{
        text-decoration: none;
        color: black;
    }
</style>
<body>
    <header class='sair'>
        <a href="sair.php">Sair</a>
    </header>
<div class="background-up"></div>
<div class="background-down"></div>
<main class="pai">
    <div class="conteudo">
        <?php
        function getMonthName($month) {
            $monthNames = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
                "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
            return $monthNames[$month-1];
        }

        function getDaysInMonth($month, $year) {
            return cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }

        $month = isset($_GET['month']) ? $_GET['month'] : date('n');
        $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

        $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
        $numDays = getDaysInMonth($month, $year);
        $monthName = getMonthName($month);
        $dayOfWeek = date('N', $firstDayOfMonth);
        $dayOfWeek = ($dayOfWeek == 7) ? 0 : $dayOfWeek;

        echo "<div class='calendario'>";
        echo "<header>";
        echo "<span class='btn-ant'>&#9664;</span>";
        echo "<h2>$monthName $year</h2>";
        echo "<span class='btn_pro'>&#9654;</span>";
        echo "</header>";
        echo "<table>";
        echo "<tr class='lado'><th>Dom</th><th>Seg</th><th>Ter</th><th>Qua</th><th>Qui</th><th>Sex</th><th>Sáb</th></tr>";

        echo "<tr>";
        for ($i = 0; $i < $dayOfWeek; $i++) {
            echo "<td></td>";
        }

        for ($day = 1; $day <= $numDays; $day++) {
            if ($dayOfWeek > 6) {
                echo "</tr><tr>";
                $dayOfWeek = 0;
            }
            echo "<td><a href='pages/lista.php?date=$year-$month-$day' class='dia'>$day</a></td>";
            $dayOfWeek++;
        }

        while ($dayOfWeek <= 6) {
            echo "<td></td>";
            $dayOfWeek++;
        }

        echo "</tr>";

        echo "</table>";
        echo "</div>";

        $prevMonth = $month - 1;
        $prevYear = $year;
        if ($prevMonth == 0) {
            $prevMonth = 12;
            $prevYear--;
        }

        $nextMonth = $month + 1;
        $nextYear = $year;
        if ($nextMonth == 13) {
            $nextMonth = 1;
            $nextYear++;
        }

        echo "<script>";
        echo "document.querySelector('.btn-ant').addEventListener('click', function() {";
        echo "window.location.href = '?month=$prevMonth&year=$prevYear';";
        echo "});";
        echo "document.querySelector('.btn_pro').addEventListener('click', function() {";
        echo "window.location.href = '?month=$nextMonth&year=$nextYear';";
        echo "});";
        echo "</script>";
        ?>
    </div>

    <div class="move_menu">
        <menu class="menu" style="--timeOut: none">
            <button class="menu__item active" style="--bgColorItem: #4343f5">
            <a href="index.php" class="link-suave">
                <svg class="icon" viewBox="0 0 24 24">
                    <path d="M3.8,6.6h16.4"></path>
                    <path d="M20.2,12.1H3.8"></path>
                    <path d="M3.8,17.5h16.4"></path>
                </svg>
            </a>
            </button>
            <button class="menu__item" style="--bgColorItem: #4343f5">
                <a href="pages/login.php" class="link-suave">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M6.7,4.8h10.7c0.3,0,0.6,0.2,0.7,0.5l2.8,7.3c0,0.1,0,0.2,0,0.3v5.6c0,0.4-0.4,0.8-0.8,0.8H3.8
        C3.4,19.3,3,19,3,18.5v-5.6c0-0.1,0-0.2,0.1-0.3L6,5.3C6.1,5,6.4,4.8,6.7,4.8z"></path>
                        <path d="M3.4,12.9H8l1.6,2.8h4.9l1.5-2.8h4.6"></path>
                    </svg>
                </a>
            </button>
            <button class="menu__item" style="--bgColorItem: #4343f5">
                <a href="pages/tarefa.php" class="link-suave">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M3.4,11.9l8.8,4.4l8.4-4.4"></path>
                        <path d="M3.4,16.2l8.8,4.5l8.4-4.5"></path>
                        <path d="M3.7,7.8l8.6-4.5l8,4.5l-8,4.3L3.7,7.8z"></path>
                    </svg>
                </a>
            </button>
            <button class="menu__item" style="--bgColorItem: #4343f5">
                <a href="pages/lista.php" class="link-suave">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M5.1,3.9h13.9c0.6,0,1.2,0.5,1.2,1.2v13.9c0,0.6-0.5,1.2-1.2,1.2H5.1c-0.6,0-1.2-0.5-1.2-1.2V5.1
          C3.9,4.4,4.4,3.9,5.1,3.9z"></path>
                        <path d="M4.2,9.3h15.6"></path>
                        <path d="M9.1,9.5v10.3"></path>
                    </svg>
                </a>
            </button>
        </menu>

        <div class="svg-container">
            <svg viewBox="0 0 202.9 45.5">
                <clipPath id="menu" clipPathUnits="objectBoundingBox"
                          transform="scale(0.0049285362247413 0.021978021978022)">
                    <path d="M6.7,45.5c5.7,0.1,14.1-0.4,23.3-4c5.7-2.3,9.9-5,18.1-10.5c10.7-7.1,11.8-9.2,20.6-14.3c5-2.9,9.2-5.2,15.2-7
          c7.1-2.1,13.3-2.3,17.6-2.1c4.2-0.2,10.1,0,13.3,0.3c2.2,0.2,3.9,0.4,5.3,0.4c0.9,0,1.4,0,1.4,0c0.2,0,0.3,0,0.4,0
c0.1,0,0.2,0,0.4,0c0.1,0,0.3,0,0.4,0c0.1,0,0.2,0,0.4,0c0.1,0,0.3,0,0.4,0c0.2,0,0.3,0,0.4,0c0.1,0,0.2,0,0.3,0
c0.1,0,0.1,0,0.2,0c0,0,0.1,0,0.1,0"></path>
</clipPath>
</svg>
</div>
</div>

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
