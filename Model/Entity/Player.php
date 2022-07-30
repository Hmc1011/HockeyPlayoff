<?php

namespace Model\Entity;

class Player
{
    const START_WIN_RATE = 0.15;
    const END_WIN_RATE = 1;
    const MUL = 10000;

    protected $_win_rate = self::START_WIN_RATE;

    public function __construct()
    {
        $this->initWinRate();
    }

    protected function initWinRate()
    {
        $this->_win_rate = mt_rand(self::START_WIN_RATE * self::MUL, self::END_WIN_RATE * self::MUL) / self::MUL;
    }

    public function getWinRate()
    {
        return $this->_win_rate;
    }

    public function __clone()
    {
        $this->initWinRate();
    }
}
