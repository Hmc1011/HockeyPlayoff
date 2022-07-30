<?php

namespace Model;

interface MatchObjectInterface
{
    /**
     * @return float
     */
    public function getWinrateAverage();

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $status
     * @return this
     */
    public function setStatus($status);

    /**
     * @return string
     */
    public function getStatus();
}
