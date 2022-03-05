<?php

$array = [];

for ($i = 0; $i < 20; $i++) {
    $array[] = rand(0, 20);
}

sort($array);
print_r($array);

$randNumber = rand(0, 20);

echo $randNumber;

for ($i = 0; $i < count($array); $i++) {
    if ($randNumber == $array[$i]) {
        unset($array[$i]);
    }
}

print_r($array);
