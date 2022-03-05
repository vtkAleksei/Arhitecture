<?php
function bubbleSort($array)
{
    for ($i = 0; $i < count($array); $i++) {
        $count = count($array);
        for ($j = $i + 1; $j < $count; $j++) {
            if ($array[$i] > $array[$j]) {
                $element = $array[$j];
                $array[$j] = $array[$i];
                $array[$i] = $element;
            }
        }
    }
    return $array;
}

$array = [];

for ($i = 0; $i < 1000; $i++) {
    $array[] = rand(0, 1000);
}

$startSort = microtime(true);
print_r(bubbleSort($array));
$endSort = microtime(true);

echo $endSort - $startSort;
