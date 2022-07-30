<?php

namespace Input;

class Input implements InputInterface
{
    const QUESTION = "Are you want to play?(y/n) : ";

    public function __construct()
    {
    }

    /**
     * return entered string
     */
    protected function inputQuest($string)
    {
        return readline($string);
    }
    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        $inputString = '';
        while (true) {
            $inputString = strtolower($this->inputQuest(self::QUESTION));
            if ($inputString == "n") {
                return false;
            }
            if ($inputString == "y") {
                return true;
            }
            echo "Not match!\n";
        }
    }
}
