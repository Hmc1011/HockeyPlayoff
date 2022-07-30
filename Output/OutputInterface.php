<?php

namespace Output;

interface OutputInterface
{
    /**
     * print out result
     */
    public function printResult();

    /**
     * apply a result you want to output
     * @param string $string
     */
    public function apply(string $string);

}
