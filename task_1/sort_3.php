<?php

$array = [];

for ($i = 0; $i < 1000; $i++) {
    $array[] = rand(0, 1000);
}

$startSort = microtime(true);
sort($array);
$endSort = microtime(true);

print_r($array);

echo $endSort - $startSort;
