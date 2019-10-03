<?php

include_once __DIR__ . "/autoload.php";

$stringPattern = [
    "18192T3T2J3J2Q3Q4Q4K112131",
    "12221323141516263617182838",
    "14243444172737471K2K3K4K4J",
    "2527171541381434224Q2Q2132",
    "2Q153938261132354K49331648",
    "111J2J3J4J1Q2Q3Q4Q1K2K3K4K",
    "12221323142418281J2J1K2K21",
    "1122334415263748192T3J4Q1K",
    "1112131415161718191T1J1Q1K",
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
];

$gameType = ["dev\Big2", "dev\Thirteen"];
$game = $gameType[1];

//echo "gen cards sets : " . date("Y-m-d H:i:s\n");
//$generator = new dev\CardsGenerator(13, 1000000);
//$stringPattern = $generator->getAmountCardsSet();
//echo "end gen : " . date("Y-m-d H:i:s\n");

echo "start check pattern : " . date("Y-m-d H:i:s\n");
foreach ($stringPattern as $string) {
    $poker = new dev\Poker($string);
    list($cards, $errMsg) = $poker->getCards();
    if ($cards) {
        $big2 = new $game($cards);
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