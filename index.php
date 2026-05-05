<?php

require_once 'Board.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION ['board'])) {
    $_SESSION['board'] = new Board();
    //   $this->board = new TikTakToe(array(array("","",""), array("","",""), array("","",""))); // New game with costom starting point potentially later
}

$boardArray = $_SESSION['board']->getBoard();


// var_dump($_SESSION ['board']);
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Tic-Tac-Toe</title>
    <meta name="description" content="Tic-Tac-Toe game"/>
    <style>
        table.tic td {
            border: 1px solid #333; /* grey cell borders */
            width: 8rem;
            height: 8rem;
            vertical-align: middle;
            text-align: center;
            font-size: 4rem;
            font-family: Arial;
        }

        table {
            margin-bottom: 2rem;
        }

        input.field {
            border: 0;
            background-color: white;
            color: white; /* make the value invisible (white) */
            height: 8rem;
            width: 8rem;
            font-family: Arial;
            font-size: 4rem;
            font-weight: normal;
            cursor: pointer;
        }

        input.field:hover {
            border: 0;
            color: #c81657; /* red on hover */
        }

        .colorX {
            color: #e77;
        }

        /* X is light red */
        .colorO {
            color: #77e;
        }

        /* O is light blue */
        table.tic {
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<section>
    <h1>Tic-Tac-Toe</h1>
    <article id="mainContent">
        <h2>Your free browsergame!</h2>
        <p>Type your game instructions here...</p>
        <form method="get" action="index.php">
            <table class="tic">
                <?php foreach ($boardArray as $row) { ?>
                    <?php foreach($row as $boardRow){ ?>
                        echo $boardRow;
                    <?php } ?>
                <?php } ?>
            </table>
        </form>
    </article>
</section>
</body>
</html>
