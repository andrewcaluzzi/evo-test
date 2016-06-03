<?php

class Grid
{
    const GRID_MAX_X = 50;
    const GRID_MAX_Y = 50;

    private $grid;

    public function __construct()
    {
        $this->grid = array();

        for($x = 0; $x < self::GRID_MAX_X; $x++)
        {
            $this->grid[$x] = array();

            for($y = 0; $y < self::GRID_MAX_Y; $y++)
            {
                $this->grid[$x][$y] = null;
            }
        }
    }

    public function placeBot(Bot $bot)
    {

    }
}
