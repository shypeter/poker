<?php

namespace dev;

class Thirteen
{
    private $cards = [];
    private $result = "";

    public function __construct($cards)
    {
        $this->cards = $cards;
    }


    public function checkPattern()
    {
        $this->sixHalf();
        $this->qingLong();
        $this->aDragon();
        $this->twelveRoyalty();
        $this->threeFlush();
    }

    private function sixHalf()
    {

    }

    private function threeFlush()
    {
        $this->isStraight();
    }
}