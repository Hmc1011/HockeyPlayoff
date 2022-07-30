<?php
require("Autoload/autoload.php");

use Input\Input;
use Processor\GameProcessor;

$input = new Input();

while ($input->getStatus()) {
    $gameProcessor = new GameProcessor();
    $output = $gameProcessor->playGameAndGetResult();
    $output->printResult();
}
