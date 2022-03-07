<?php
function quickSort(&$arr, $low, $high)
{
    $i = $low;
    $j = $high;
    $middle = $arr[($low + $high) / 2];   // middle – опорный элемент; в нашей реализации он находится посередине между low и high
    do {
        while ($arr[$i] < $middle) ++$i;  // Ищем элементы для правой части
        while ($arr[$j] > $middle) --$j;   // Ищем элементы для левой части
        if ($i <= $j) {
            // Перебрасываем элементы
            $element = $arr[$i];
            $arr[$i] = $arr[$j];
            $arr[$j] = $element;
            // Следующая итерация
            $i++;
            $j--;
        }
    } while ($i < $j);

    if ($low < $j) {
        // Рекурсивно вызываем сортировку для левой части
        quickSort($arr, $low, $j);
    }

    if ($i < $high) {
        // Рекурсивно вызываем сортировку для правой части
        quickSort($arr, $i, $high);
    }
    return $arr;
}


$array = [];

for ($i = 0; $i < 1000; $i++) {
    $array[] = rand(0, 1000);
}

$startSort = microtime(true);
print_r(quickSort($array, 0, count($array)-1));
$endSort = microtime(true);

echo $endSort - $startSort;
