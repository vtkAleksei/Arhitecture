<?php
function LinearSearch($myArray, $num)
{
    $count = count($myArray);

    for ($i = 0; $i < $count; $i++) {
        if ($myArray[$i] == $num) return $i;
        elseif ($myArray[$i] > $num) return null;
    }
    return null;
}

// Для поиска в этом алгоритме необходимо сделать столько шагов сколько элементов в массиве
