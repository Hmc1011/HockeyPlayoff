<?php

namespace Helper;

use Model\DivisionInterFace;
use Model\Team;

class Render
{
    /**
     * @param array $resultMatch
     * @param Team $t1
     * @param Team $t2
     * @param DivisionInterFace $d1
     * @param DivisionInterFace $d2
     * @return string
     * Output decoration
     */
    public static function renderOutput($resultMatch, $t1, $t2, DivisionInterFace $d1 = null, DivisionInterface $d2 = null)
    {
        $score = $resultMatch['win'] . "/" . $resultMatch['lost'];
        if ($d1 == null && $d2 == null) {
            $result = "Serie " . $t1->getName() . " vs " . $t2->getName();
            $result .= " - Winner: " . $resultMatch['winner']->getName() . "($score)\n";
            return $result;
        } else {
            $result = $d1->getName() . " " . $t1->getName()
                . " vs "
                . $d2->getName() . " " . $t2->getName();
        }

        $dwinner = $d1;
        if ($resultMatch['winner'] == $t2) $dwinner = $d2;
        $result .= " - Winner: " . $dwinner->getName() . " " . $resultMatch['winner']->getName() . " ($score)\n";
        return "\e[0;32m" . $result . " \e[0m";
    }
}
