<?php
public function getBracket($base, $team_array)
{
    $knownBrackets = [2,4,8,16,32]; // brackets with "perfect" proportions (full fields, no byes)


    $closest =current(array_filter($knownBrackets, function($element) use ($base){
        return $element >= $base;
    }));

    $byes = $closest-$base;

    if($byes>0)	$base = $closest;

    $brackets = [];
    $round = 1;
    $baseT = $base/2;
    $baseC = $base/2;
    $teamMark = 0;
    $nextInc = $base/2;

    for ($i = 1; $i <= ($base-1); $i++) {
        $baseR = $i/$baseT;
        $isBye = false;

        if($byes > 0 && ($i%2 != 0 || $byes >= ($baseT-$i))) {
            $isBye = true;
            $byes--;
        }

        $arrTemp = array_values(array_filter($brackets, function($c) use($i){
           return $c->nextGame == $i;
        }));

        $last = array_map(function($b){
            return (object) array(
                'game' => $b->bracketNo,
                'teams' => $b->teamnames
            );
        }, $arrTemp);


        $brackets[] =  (object) [
            "lastGames" =>	($round == 1) ? null : [ $last[0]->game, $last[1]->game],
            "nextGame" =>	(($nextInc+$i) > $base-1) ? null: ($nextInc+$i),
            "teamnames" =>	($round == 1) ? [$team_array[$teamMark],$team_array[$teamMark+1]] : [$last[0]->teams[rand(0,1)],$last[1]->teams[rand(0,1)]],
            "bracketNo" =>	$i,
            "roundNo" =>	$round,
            "bye" =>	        $isBye
        ];

        $teamMark += 2;
        if ($i%2 !=0 ) {
            $nextInc--;
        }
        while($baseR >= 1) {
            $round++;
            $baseC /= 2;
            $baseT = $baseT + $baseC;
            $baseR = $i/$baseT;
        }
    }

    return $brackets;
}
?>
