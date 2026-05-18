<?php
session_start();

require_once 'Board.php';
require_once 'TikTakToe.php';

// If reset button is pressed, clear the session to start over
if (isset($_POST['reset'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// Initialize the game if it doesn't exist
if (!isset($_SESSION['board'])) {
    $_SESSION['board'] = new Board();
    $_SESSION['turn'] = "X"; // X always starts
    $_SESSION['winner'] = "";
}

$boardObj = $_SESSION['board'];
$game = new TikTakToe();

// Handle a move if the game isn't over yet
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['winner'] === "") {
    // Check which button was clicked
    for ($r = 0; $r < 3; $r++) {
        for ($c = 0; $c < 3; $c++) {
            if (isset($_POST["cell-$r-$c"])) {
                // Try to make the move
                if ($game->makeMove($boardObj, $r, $c, $_SESSION['turn'])) {
                    
                    // Check if someone won after this move
                    $winner = $game->checkWin($boardObj->getBoard());
                    if ($winner !== "") {
                        $_SESSION['winner'] = $winner;
                    } else {
                        // Switch turn
                        if ($_SESSION['turn'] === "X") {
                            $_SESSION['turn'] = "O";
                        } else {
                            $_SESSION['turn'] = "X";
                        }
                    }
                }
            }
        }
    }
}

$boardArray = $boardObj->getBoard();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Tic-Tac-Toe</title>
    <meta name="description" content="Tic-Tac-Toe game"/>
    <style>
        table.tic td {
            border: 1px solid #333;
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
            color: black; /* you had this as white, changed to black so you can see empty spaces but colors override below */
            height: 8rem;
            width: 8rem;
            font-family: Arial;
            font-size: 4rem;
            font-weight: normal;
            cursor: pointer;
        }

        input.field:hover {
            border: 0;
            color: #c81657; 
        }

        .colorX {
            color: #e77;
        }

        .colorO {
            color: #77e;
        }

        table.tic {
            color: #7777ee;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<section>
    <h1>Tic-Tac-Toe</h1>
    <article id="mainContent">
        
        <h2>
            <?php 
                // Display winner or current turn
                if ($_SESSION['winner'] !== "") {
                    echo "Player " . $_SESSION['winner'] . " wins!";
                } else {
                    echo "Current Turn: " . $_SESSION['turn'];
                }
            ?>
        </h2>

        <form method="POST" action="index.php">
            <table class="tic">
                <?php foreach ($boardArray as $rowIndex => $row) { ?>
                    <tr>
                        <?php foreach ($row as $colIndex => $cell) { 
                            // Apply your custom colors dynamically
                            $colorClass = "";
                            if ($cell === "X") $colorClass = "colorX";
                            if ($cell === "O") $colorClass = "colorO";
                        ?>
                            <td>
                            <input type="submit" class="field <?= $colorClass ?>" name="cell-<?= $rowIndex ?>-<?= $colIndex ?>"
                                   value="<?= $cell ?>"/>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </table>
            
            <button type="submit" name="reset" style="padding: 10px 20px; font-size: 1.2rem; cursor: pointer;">Restart Game</button>
        </form>
    </article>
</section>
</body>
</html>
