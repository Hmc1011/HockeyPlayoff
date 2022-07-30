<?php

namespace Model;

use Model\Player;

class Team implements MatchObjectInterface
{
    const NUM_PLAYERS = 21;
    protected $_name = "";
    protected $_players = [];
    protected $status = true;

    public function __construct(string $name)
    {
        $this->_name = $name;
        $this->initPlayers();
    }

    protected function initPlayers()
    {
        $player = new Player(); 
        for ($i = 0; $i < self::NUM_PLAYERS; $i++) {
            $this->_players[$i] = clone $player;
        }
    }
    /**
     * @inheritDoc
     */
    public function getWinrateAverage()
    {
        $average = 0;
        foreach ($this->_players as $player) {
            $average += $player->getWinRate();
        }
        return $average / count($this->_players);
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}
