<?php

namespace test;

require("Poker.php");
require("Big2.php");
require("CardsGenerator.php");

//$stringPattern = [
//    "2K2T3Q2J29",
//    "1Q2T284T3J",
//    "1K1T1K4T11",
//    "21451J1Q15",
//    "2222334T1K",
//    "1G12334T1K",
//    "5112334T1K",
//    "1112334T1K",
//    "1112131415",
//    "1121314112",
//    "1T2T3T3242"
//];

echo "gen cards sets : " . date("Y-m-d H:i:s\n");
$generator = new CardsGenerator(5, 1000000);
$stringPattern = $generator->getAmountCardsSet();
echo "end gen : " . date("Y-m-d H:i:s\n");

echo "start check pattern : " . date("Y-m-d H:i:s\n");
foreach ($stringPattern as $string) {
    $poker = new Poker($string);
    list($cards, $errMsg) = $poker->getCards();
    if ($cards) {
        $big2 = new Big2($cards);
        $result = $big2->checkPattern();

        //var_dump($cards);
        if ($result != "") {
            var_dump("{$string}: {$result}");
        }
    } else {
        var_dump("{$string}: {$errMsg}");
    }
}
echo "end : " . date("Y-m-d H:i:s\n");