<?php

namespace Model;

use Model\Team;
use Processor\MatchController;
use Model\MatchObjectInterface;
use Helper\Render;

class Division implements DivisionInterface
{
    const TEAM_NAMES = ["A", "B", "C", "D", "E", "F", "G", "H"];
    protected $_name = "";
    protected $_teams = [];
    protected $resultCompete = "";

    public function __construct(string $name)
    {
        $this->_name = $name;
        $this->initTeams();
    }
    protected function initTeams()
    {
        foreach (self::TEAM_NAMES as $key => $name) {
            $this->_teams[$key] = new Team($name);
        }
    }

    public function getName()
    {
        return $this->_name;
    }

    public function compete()
    {
        $this->resultCompete .= $this->getName() . " Division:\n";
        $round = 0;
        do {
            $this->resultCompete .= "Round # " . "$round:\n";
            $round++;
            $t1Detected = false;
            $t2Detected = false;
            $t1 = $t2 = new Team("");
            $countPair = 0;
            for ($i = 0; $i < count($this->_teams); $i++) {
                if (!$this->_teams[$i]->getStatus()) continue;
                if (!$t1Detected) {
                    $t1 = $this->_teams[$i];
                    $t1Detected = true;
                } elseif (!$t2Detected) {
                    $t2 = $this->_teams[$i];
                    $t2Detected = true;
                    $this->competeInPair($t1, $t2);
                    $countPair++;
                    $t1Detected = false;
                    $t2Detected = false;
                }
            }
        } while ($countPair > 1);
    }

    protected function competeInPair(MatchObjectInterface $t1, MatchObjectInterface $t2)
    {
        MatchController::playGame($t1, $t2);
        $resultMatch = MatchController::getResultAllMatch($t1, $t2);
        $t1->setStatus(false);
        $t2->setStatus(false);
        $resultMatch['winner']->setStatus(true);
        $this->resultCompete .= Render::renderOutput($resultMatch, $t1, $t2);
    }

    public function getResultCompete()
    {
        return $this->resultCompete;
    }

    public function getFinalWinner()
    {
        foreach ($this->_teams as $team) {
            if ($team->getStatus()) return $team;
        }
    }
}
