<?php

include 'Bot.php';
include 'Grid.php';

class Engine
{
    const NUM_GENERATIONS = 5;
    const BOTS_PER_GENERATION = 5;

    private $grid;
    private $bots = array();
    private $parents = array();

    private function log($log)
    {
        echo $log . "\n";
    }

    private function breedNewGeneration($generationId)
    {
        // first generation, no parents -> mutant freaks
        if(empty($this->parents))
        {
            for($botId = 0; $botId < self::BOTS_PER_GENERATION; $botId++)
            {
                $bot = new Bot("[Generation: $generationId, ID: $botId]");
                $this->log("Created new bot " . $bot);
                $this->bots[] = $bot;
            }
        }

        else
        {
            $averageParentStrength = ($this->parents[0]->strength + $this->parents[1]->strength) / 2.0;

            for($botId = 0; $botId < self::BOTS_PER_GENERATION; $botId++)
            {
                $strength = ($averageParentStrength + mt_rand() / mt_getrandmax()) / 2.0;
                $bot = new Bot("[Generation: $generationId, ID: $botId]", $strength);
                $this->log("Created new bot " . $bot);
                $this->bots[] = $bot;
            }
        }

        if(count($this->bots) > self::BOTS_PER_GENERATION)
        {
            usort($this->bots, array($this, "compareBots"));
            $this->bots = array_slice($this->bots, 0, self::BOTS_PER_GENERATION);
        }

        foreach($this->bots as $bot)
        {
            $this->log($bot);
        }
    }

    private function compareBots(Bot $botA, Bot $botB)
    {
        if($botA->getFitness() == $botB->getFitness())
        {
            return 0;
        }

        return $botA->getFitness() > $botB->getFitness() ? -1 : 1;
    }

    private function selectParents()
    {
        usort($this->bots, array($this, "compareBots"));

        $this->parents = array
        (
            $this->bots[0],
            $this->bots[1]
        );

        $this->log("Parent 1: " . $this->bots[0]);
        $this->log("Parent 2: " . $this->bots[1]);
    }

    public function execute()
    {
        $this->grid = new Grid();

        for($generationId = 1; $generationId <= self::NUM_GENERATIONS; $generationId++)
        {
            $this->log("--- Generation $generationId ---");

            // breed new generation of bots
            $this->breedNewGeneration($generationId);

            $this->log("> " . count($this->bots) . " bots");

            #CODE FOR DELETING BOTS AND RESETTING ARRAY KEYS
            #unset($this->bots[rand(0,self::BOTS_PER_GENERATION)]);
            #$this->bots = array_values($this->bots);

            // do something with bots, output?
            for($i = 0; $i < 100; $i++)
            {
                foreach($this->bots as $bot)
                {

                }
            }

            // decide who the parents will be
            $this->selectParents();
        }
    }
}
