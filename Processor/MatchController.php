<?php

namespace Processor;

use Model\Team;
use Model\MatchObjectInterface;

class MatchController
{
    const MATCH_NUM = 7;

    /**
     * @var MatchObjectInterface
     */
    protected $t1, $t2;

    private static $instances = [];


    public static function getInstance(): MatchController
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public static function playGame(MatchObjectInterface $t1, MatchObjectInterface $t2)
    {
    }
    /**
     * @return bool
     */
    public static function resultMatch(MatchObjectInterface $t1, MatchObjectInterface $t2)
    {
        $winRate1 = $t1->getWinrateAverage();
        $winRate2 = self::calculateWinRate($t2->getWinrateAverage());

        if ($winRate1 == $winRate2) {
            return self::resultMatch($t1, $t2);
        } else {
            if ($winRate1 < $winRate2) {
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * @return array
     */
    public static function getResultAllMatch(MatchObjectInterface $t1, MatchObjectInterface $t2)
    {
        $maxWinning = round(self::MATCH_NUM / 2);
        $countT1 = $countT2 = 0;
        do {
            self::resultMatch($t1, $t2) ? $countT1++ : $countT2++;
        } while ($countT1 < $maxWinning && $countT2 < $maxWinning);
        $winner = $t1;
        $win = $countT1;
        $lost = $countT2;
        if ($countT2 == $maxWinning) {
            $winner = $t2;
            $win = $countT2;
            $lost = $countT1;
        }
        return [
            'winner' => $winner,
            'win' => $win,
            'lost' => $lost
        ];
    }
    /**
     * @param float $winRate
     * @return float
     */
    public static function calculateWinRate($winRate)
    {
        $factor = (float)rand() / (float)getrandmax();

        if ($factor == 1) return 1;
        return $winRate * $factor / (1 - $factor);
    }
}
