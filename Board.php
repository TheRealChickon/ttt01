<?php

class Board
{
    private array $board = array(
        array("X","",""),
        array("","",""),
        array("","","")
    );

    /**
     * @param array|array[] $board
     */
    public function __construct(array $board = []) // add defaut value to board
    {
        if (!empty($board)) { // only overwrite if not empty
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

