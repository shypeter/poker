<?php

namespace dev;

class Poker
{
    private $uniqueCards = [];
    private $cards = [];
    private $errMsg = "";

    public function __construct($string)
    {
        return $this->analysisCards($string);
    }

    public function analysisCards($string)
    {
        $startIndex = 0;
        $this->checkStringLength($string);
        try {
            while (($pattern = substr($string, $startIndex, 2)) !== "") {
                $flower = $this->getFlower($pattern[0]);
                $number = $pattern[1];
                $this->cards[] = [
                    "flower" => $flower,
                    "number" => $number,
                    "intNumber" => $this->getIntNumber($number),
                ];
                $startIndex += 2;
            }
        } catch (\Exception $e) {
            $this->cards = [];
            $this->errMsg = $e->getMessage();
        }
    }

    private function cardSort()
    {
        return function ($cardA, $cardB) {
            if ($cardA['intNumber'] == $cardB['intNumber']) {
                return 0;
            }
            return ($cardA['intNumber'] < $cardB['intNumber']) ? -1 : 1;
        };
    }

    public function getCards()
    {
        usort($this->cards, $this->cardSort());
        return [$this->cards, $this->errMsg];
    }

    private function checkStringLength($string)
    {
        $length = mb_strlen($string);
        if (($length == 0) || (($length % 2) != 0)) {
            throw new \Exception("String input error with wrong pair");
        }
    }

    private function getFlower($char)
    {
        $flower = [
            "1" => "spade",
            "2" => "heart",
            "3" => "diamond",
            "4" => "club"
        ];
        if (isset($flower[$char])) {
            return $flower[$char];
        } else {
            throw new \Exception("Input error Flower card");
        }
    }

    private function getIntNumber($char)
    {
        $char = strtoupper($char);
        $number = [
            "A" => 1,
            "1" => 1,
            "2" => 2,
            "3" => 3,
            "4" => 4,
            "5" => 5,
            "6" => 6,
            "7" => 7,
            "8" => 8,
            "9" => 9,
            "10" => 10,
            "T" => 10,
            "J" => 11,
            "Q" => 12,
            "K" => 13,
        ];
        if (isset($number[$char])) {
            return $number[$char];
        } else {
            throw new \Exception("Input error Number card");
        }
    }
}
