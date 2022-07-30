<?php

namespace Output\Console;

class Output implements \Output\OutputInterface
{

    protected  $output = "";

    public function printResult()
    {
        echo $this->output;
    }
    
    public function apply(string $string)
    {
        $this->output .= $string;
    }
    
}
