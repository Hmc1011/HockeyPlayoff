<?php

namespace Output;

class Output implements OutputInterface
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
