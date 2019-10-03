<?php

namespace dev;

class Thirteen
{
    private $cards = [];
    private $numbers = [];
    private $numbersCount = [];
    private $result = "";

    public function __construct($cards)
    {
        $this->cards = $cards;
        $this->numbers = array_column($cards, "intNumber");
        $this->numbersCount = array_count_values($this->numbers);
    }

    public function checkPattern()
    {
        $this->twelveRoyalty();
        $this->sixHalf();
        //$this->threeFlush();
        $this->threePart();
        $this->allBig();
        $this->allSmall();
        $this->aDragon();
        return $this->result;
    }

    private function twelveRoyalty()
    {
        $keyArr = array_keys($this->numbersCount);
        $this->checkParameterInArray(
            "十二皇族",
            [1, 11, 12, 13],
            $keyArr
        );
    }

    private function threePart()
    {
        if ($this->result == "") {
            $valArr = array_unique(array_values($this->numbersCount));
            $this->checkParameterInArray(
                "三分天下",
                [1, 4],
                $valArr
            );
        }
    }

    private function allBig()
    {
        if ($this->result == "") {
            $keyArr = array_keys($this->numbersCount);
            $this->checkParameterNotInArray(
                "全大",
                [2, 3, 4, 5, 6, 7],
                $keyArr
            );
        }
    }
    
    private function allSmall()
    {
        if ($this->result == "") {
            $keyArr = array_keys($this->numbersCount);
            $this->checkParameterNotInArray(
                "全小",
                [9, 10, 11, 12, 13, 1],
                $keyArr
            );
        }
    }

    private function sixHalf()
    {
        if ($this->result == "") {
            if (count($this->numbersCount) == 7) {
                $countsType = array_count_values($this->numbersCount);
                if (
                    (isset($countsType[2]) && isset($countsType[1])) && ($countsType[2] == 6) && ($countsType[1] == 1)
                ) {
                    $this->result = "六對半";
                }
            }
        }
    }

    private function aDragon() {
        if ($this->result == "") {
            $isDragon = true;
            for ($i=0 ; $i<(count($this->numbers)-1) ; $i++) {
                if (($this->numbers[$i] + 1) != $this->numbers[$i+1]) {
                    $isDragon = false;
                    break;
                }
            }

            if ($isDragon) {
                if ($this->isOnlyOneFlower()) {
                    $this->result = "清龍";
                } else {
                    $this->result = "一條龍";
                }
            }
        }
    }

    private function threeFlush()
    {
        $pattern = [1, 10, 11, 12, 13];
        //$this->isStraight();
    }

    private function isOnlyOneFlower() {
        $flowers = array_column($this->cards, "flower");
        $flowers = array_unique($flowers);
        if (count($flowers) == 1) {
            return true;
        } else {
            return false;
        }
    }

    private function checkParameterInArray($resultType, $cadidate, $compareArr)
    {
        $isResultType = true;
        if (count($this->numbersCount) == 4) {
            foreach ($cadidate as $val) {
                if (!in_array($val, $compareArr)) {
                    $isResultType = false;
                    break;
                }
            }
            if ($isResultType) {
                $this->result = $resultType;
            }
        }
    }
    
    private function checkParameterNotInArray($resultType, $cadidate, $compareArr)
    {
        $isResultType = true;
        foreach ($cadidate as $val) {
            if (in_array($val, $compareArr)) {
                $isResultType = false;
                break;
            }
        }
        if ($isResultType) {
            $this->result = $resultType;
        }
    }
}