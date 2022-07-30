<?php
require 'vendor/autoload.php';

use Input\Console\Input;
use Processor\GameProcessor;

$input = new Input();

while ($input->getStatus()) {
    $gameProcessor = new GameProcessor();
    $output = $gameProcessor->playGameAndGetResult();
    $output->printResult();
}
