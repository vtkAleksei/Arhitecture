<?php
function binarySearch($myArray, $num)
{

    //определяем границы массива
    $left = 0;
    $right = count($myArray) - 1;
    $countStep = 0;

    while ($left <= $right) {

        $countStep += 1;
        //находим центральный элемент с округлением индекса в меньшую сторону
        $middle = floor(($right + $left) / 2);
        //если центральный элемент и есть искомый   
        if ($myArray[$middle] == $num) {
            return $countStep;
        } elseif ($myArray[$middle] > $num) {
            //сдвигаем границы массива до диапазона от left до middle-1
            $right = $middle - 1;
        } elseif ($myArray[$middle] < $num) {
            $left = $middle + 1;
        }
    }
    return "$countStep. Элемент не найден";
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
        $countStep = binarySearch($array, $randNumber);
        ?><br><?
        echo "Количество шагов для поиска заданного числа составило: $countStep";
