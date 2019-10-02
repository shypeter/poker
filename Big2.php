<?php

namespace test;

class Big2
{
    private $cards = [];
    private $result = "";

    public function __construct($cards)
    {
        $this->cards = $cards;
    }

    public function checkPattern()
    {
        $this->checkFlush();
        $this->checkFourOfAKind();
        $this->checkFullHouse();
        //$this->checkThreeOfAKind();
        //$this->checkPair();
        return $this->result;
    }

    private function checkFlush()
    {
        $isFlush = false;
        $numbers = array_column($this->cards, "intNumber");
        asort($numbers);

        if (($numbers[0] == 1) && ($numbers[1] == 10)) {
            $isFlush = true;
        } else if (($numbers[0] + 4) == $numbers[4]) {
            $isFlush = true;
        }

        if ($isFlush) {
            if ($this->isStraight($isFlush)) {
                $this->result = "同花順";
            } else {
                $this->result =  "順子";
            }
        }
    }

    private function isStraight($isFlush)
    {
        if ($isFlush) {
            $folwers = array_column($this->cards, "folwer");
            $folwers = array_unique($folwers);
            if (count($folwers) == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    private function checkFourOfAKind()
    {
        $this->checkByParameters("鐵支", 4, 1);
    }

    private function checkFullHouse()
    {
        $this->checkByParameters("葫蘆", 3, 2);
    }

    private function checkByParameters($resultType, $groupOneCount, $groupTwoCount)
    {
        if ($this->result == "") {
            $numbers = array_column($this->cards, "intNumber");
            $counts = array_count_values($numbers);
            arsort($counts);
            if ((array_shift($counts) == $groupOneCount) && (array_shift($counts) == $groupTwoCount)) {
                $this->result = $resultType;
            }
        }
    }

//    private function checkThreeOfAKind()
//    { }
//
//    private function checkPair()
//    { }
}
