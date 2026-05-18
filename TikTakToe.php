<?php

class TikTakToe
{
    // Checks if the cell is empty and places the token
    public function makeMove(Board $board, int $row, int $col, string $token): bool
    {
        $currentBoard = $board->getBoard();
        
        if ($currentBoard[$row][$col] === "") {
            $currentBoard[$row][$col] = $token;
            $board->setBoard($currentBoard);
            return true;
        }
        
        return false;
    }

    // Basic check for 3 in a row
    public function checkWin(array $board): string
    {
        // Check rows
        for ($i = 0; $i < 3; $i++) {
            if ($board[$i][0] !== "" && $board[$i][0] === $board[$i][1] && $board[$i][1] === $board[$i][2]) {
                return $board[$i][0];
            }
        }

        // Check columns
        for ($i = 0; $i < 3; $i++) {
            if ($board[0][$i] !== "" && $board[0][$i] === $board[1][$i] && $board[1][$i] === $board[2][$i]) {
                return $board[0][$i];
            }
        }

        // Check diagonals
        if ($board[0][0] !== "" && $board[0][0] === $board[1][1] && $board[1][1] === $board[2][2]) {
            return $board[0][0];
        }
        if ($board[0][2] !== "" && $board[0][2] === $board[1][1] && $board[1][1] === $board[2][0]) {
            return $board[0][2];
        }

        return "";
    }
}
