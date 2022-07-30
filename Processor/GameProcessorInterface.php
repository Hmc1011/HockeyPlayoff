<?php

namespace Processor;

interface GameProcessorInterface
{
    /**
     * play game and return the result
     * @return \Output\OutputInterface
     */
    public function playGameAndGetResult();
}
