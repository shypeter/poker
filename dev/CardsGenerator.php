<?php

namespace dev;

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
                $flower = $this->getFlower();
                $number = $this->getNumber();
                if ($this->isUniqueCard($flower, $number)) { 
                    $cardString .= $flower . $number;
                } else {
                    $card -= 1;
                }
            }
            $this->rtn[] = $cardString;
        }
    }

    private function isUniqueCard($flower, $number)
    {
        if (isset($this->uniqueCards[$flower.$number])) {
            return false;
        } else {
            $this->uniqueCards[$flower.$number] = true;
            return true;
        }
    }

    private function getFlower()
    {
        $index = rand(0, 3);
        $flower = ["1", "2", "3", "4"];
        return $flower[$index];
    }

    private function getNumber()
    {
        $index = rand(0, 12);
        $number = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "T", "J", "Q", "K"];
        return $number[$index];
    }
}
