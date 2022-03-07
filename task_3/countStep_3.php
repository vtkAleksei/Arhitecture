<?php

function InterpolationSearch($myArray, $num)
{

    $start = 0;
    $last = count($myArray) - 1;
    $countStep = 0;

    while (($start <= $last) && ($num >= $myArray[$start]) && ($num <= $myArray[$last])) {

        $countStep += 1;
        $pos = floor($start + ((($last - $start) / ($myArray[$last] - $myArray[$start]))  * ($num - $myArray[$start])));

        if ($myArray[$pos] == $num) {
            return $countStep;
        }

        if ($myArray[$pos] < $num) {
            $start = $pos + 1;
        } else {
            $last = $pos - 1;
        }
    }
}


$array = [];

for ($i = 0; $i < 20; $i++) {
    $array[] = rand(0, 20);
}

sort($array);
print_r($array);

$randNumber = rand(0, 20);
?><br><?
        echo "Случайное число = $randNumber";
        $countStep = InterpolationSearch($array, $randNumber);
        ?><br><?
                echo "Количество шагов для поиска заданного числа составило: $countStep";
