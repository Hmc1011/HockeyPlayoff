<?php

namespace Model;

interface DivisionInterface
{
    public function getName();
    
    /**
     * compete all teams in division
     */
     public function compete();
    
     /**
     * get result of the compete
     * @return string
     */
    public function getResultCompete();
    
    /**
     * get final winner of division after the competition
     * @return \Model\Team
     */
    public function getFinalWinner();
}
