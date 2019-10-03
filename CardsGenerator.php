<?php

namespace test;

class CardsGenerator
{
    private $cards = 0;
    private $amount = 0;
    private $rtn = [];
    private $uniqueCards = [];

    public function __construct($cards, $amount)
    {
        if (($cards != 0) && ($amount != 0)) {
            $this->cards = $cards;
            $this->amount = $amount;
            $this->result();
        }
    }

    public function getAmountCardsSet()
    {
        return $this->rtn;
    }

    private function result()
    {
        for ($amount = 0; $amount < $this->amount; $amount++) {
            $cardString = "";
            $this->uniqueCards = [];
            for ($card = 0; $card < $this->cards; $card++) {
                $folwer = $this->getFlower();
                $number = $this->getNumber();
                if ($this->isUniqueCard($folwer, $number)) { 
                    $cardString .= $folwer . $number;
                } else {
                    $card -= 1;
                }
            }
            $this->rtn[] = $cardString;
        }
    }

    private function isUniqueCard($folwer, $number)
    {
        if (isset($this->uniqueCards[$folwer.$number])) {
            return false;
        } else {
            $this->uniqueCards[$folwer.$number] = true;
            return true;
        }
    }

    private function getFlower()
    {
        $index = rand(0, 3);
        $folwer = ["1", "2", "3", "4"];
        return $folwer[$index];
    }

    private function getNumber()
    {
        $index = rand(0, 12);
        $number = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "T", "J", "Q", "K"];
        return $number[$index];
    }
}
