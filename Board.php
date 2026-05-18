<?php

class Board
{
    // Cleared the hardcoded test data so it starts empty
    private array $board = array(
        array("","",""),
        array("","",""),
        array("","","")
    );

    /**
     * @param array|array[] $board
     */
    public function __construct(array $board = []) 
    {
        if (!empty($board)) { 
            $this->board = $board;
        }
    }

    public function getBoard(): array
    {
        return $this->board;
    }

    public function setBoard(array $board): void
    {
        $this->board = $board;
    }
}
