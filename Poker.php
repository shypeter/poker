<?php

namespace test;

use Exception;

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
                $folwer = $this->getFolwer(substr($pattern, 0, 1));
                $number = substr($pattern, 1, 1);
                if ($this->isUniqueCard($folwer, $number)) {
                    $this->cards[] = [
                        "folwer" => $folwer,
                        "number" => $number,
                        "intNumber" => $this->getIntNumber($number),
                    ];
                } else {
                    throw new \Exception("Card repeated");
                }
                $startIndex += 2;
            }

        } catch (Exception $e) {
            $this->cards = [];
            $this->errMsg = $e->getMessage();
        }

    }

    public function getCards()
    {
        return [$this->cards, $this->errMsg];
    }

    private function isUniqueCard($folwer, $number)
    {
        if (
            isset($this->uniqueCards[$folwer]) &&
            isset($this->uniqueCards[$folwer][$number])
        ) {
            return false;
        } else {
            if (!isset($this->uniqueCards[$folwer])) {
                $this->uniqueCards[$folwer] = [];
            }
            $this->uniqueCards[$folwer][$number] = true;
            return true;
        }
    }

    private function checkStringLength($string)
    {
        $length = mb_strlen($string);
        if (($length == 0) || (($length % 2) != 0)) {
            throw new \Exception("String input error with wrong pair");
        }
    }

    private function getFolwer($char)
    {
        $folwer = [
            "1" => "spade",
            "2" => "heart",
            "3" => "diamond",
            "4" => "club"
        ];
        if (isset($folwer[$char])) {
            return $folwer[$char];
        } else {
            throw new \Exception("Input error Folwer card");
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
