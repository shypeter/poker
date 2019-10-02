<?php

namespace test;

require("Poker.php");
require("Big2.php");

$stringPattern = [
    "2222334T1K",
    "1G12334T1K",
    "5112334T1K",
    "1112334T1K",
    "1112131415",
    "1121314112",
    "1T2T3T3242"
];

foreach ($stringPattern as $string) {
    $poker = new Poker($string);
    list($cards, $errMsg) = $poker->getCards();
    if ($cards) {
        $big2 = new Big2($cards);
        $result = $big2->checkPattern();

        //var_dump($cards);
        var_dump($result);
    } else {
        var_dump($errMsg);
    }
}