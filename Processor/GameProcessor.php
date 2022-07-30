<?php

namespace Processor;

use Output\Output;
use Processor\MatchController;
use Model\Division;
use Model\DivisionInterface;
use Helper\Render;

class GameProcessor implements GameProcessorInterface
{

    protected $output;

    public function __construct()
    {
        $this->output = new Output();
    }

    public function playGameAndGetResult()
    {
        $east = new Division("EAST");
        $east->compete();
        $this->output->apply($east->getResultCompete());
        $west = new Division("WEST");
        $west->compete();
        $this->output->apply("--------\n");
        $this->output->apply($west->getResultCompete());
        $this->output->apply("--------\n");
        $this->playFinal($east, $west);
        return $this->output;
    }

    protected function playFinal(DivisionInterFace $d1, DivisionInterface $d2)
    {
        $winnerd1 = $d1->getFinalWinner();
        $winnerd2 = $d2->getFinalWinner();
        $resultMatch = MatchController::getResultAllMatch($winnerd1, $winnerd2);
        $result = "Final " . Render::renderOutput($resultMatch, $winnerd1, $winnerd2, $d1, $d2);
        $this->output->apply($result);
    }
}
