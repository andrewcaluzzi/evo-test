<?php

class Bot
{
    public $name;
    public $strength;

    public function __construct($id, $strength = null)
    {
        $this->name = $id;

        if($strength == null)
        {
            $this->strength = mt_rand() / mt_getrandmax();
        }

        else
        {
            $this->strength = $strength;
        }
    }

    public function __toString()
    {
        return $this->name . ", strength " . $this->strength;
    }

    public function getFitness()
    {
        return $this->strength;
    }

    public function scan()
    {

    }
}
