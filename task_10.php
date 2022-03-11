<?php
$str = "(5+3)*2"; // Выражение для примера
echo rpn($str); // Результат 5 3 + 2 *

function rpn($str)
{
    $stack = array();
    $out = array();

    $prior = array(
        "^" => array("prior" => "4", "assoc" => "right"),
        "*" => array("prior" => "3", "assoc" => "left"),
        "/" => array("prior" => "3", "assoc" => "left"),
        "+" => array("prior" => "2", "assoc" => "left"),
        "-" => array("prior" => "2", "assoc" => "left"),
    );

    $token = preg_replace("/\s/", "", $str);
    $token = str_replace(",", ".", $token);
    $token = str_split($token);

    if (preg_match("/[\+\-\*\/\^]/", $token['0'])) {
        array_unshift($token, "0");
    }

    $lastnum = TRUE;
    foreach ($token as $key => $value) {

        if (preg_match("/[\+\-\*\/\^]/", $value)) {
            $endop = FALSE;

            while ($endop != TRUE) {
                $lastop = array_pop($stack);
                if ($lastop == "") {
                    $stack[] = $value;
                    $endop = TRUE;
                } else {
                    /* Получим приоритет */
                    $curr_prior = $prior[$value]['prior'];
                    $curr_assoc = $prior[$value]['assoc'];

                    $prev_prior = $prior[$lastop]['prior'];

                    switch ($curr_assoc) {
                        case "left":

                            switch ($curr_prior) {
                                case ($curr_prior > $prev_prior):
                                    $stack[] = $lastop;
                                    $stack[] = $value;
                                    $endop = TRUE;
                                    break;

                                case ($curr_prior <= $prev_prior):
                                    $out[] = $lastop;
                                    break;
                            }

                            break;

                        case "right":

                            switch ($curr_prior) {
                                case ($curr_prior >= $prev_prior):
                                    $stack[] = $lastop;
                                    $stack[] = $value;
                                    $endop = TRUE;
                                    break;

                                case ($curr_prior < $prev_prior):
                                    $out[] = $lastop;
                                    break;
                            }

                            break;
                    }
                }
            }
            $lastnum = false;
        } elseif (preg_match("/[0-9\.]/", $value)) {
            if ($lastnum == TRUE) {
                $num = array_pop($out);
                $out[] = $num . $value;
            } else {
                $out[] = $value;
                $lastnum = TRUE;
            }
        } elseif ($value == "(") {
            $stack[] = $value;
            $lastnum = FALSE;
        } elseif ($value == ")") {
            $skobka = FALSE;
            while ($skobka != TRUE) {
                $op = array_pop($stack);

                if ($op == "(") {
                    $skobka = TRUE;
                } else {
                    $out[] = $op;
                }
            }

            $lastnum = FALSE;
        }
    }

    $stack1 = $stack;
    $rpn = $out;

    while ($stack_el = array_pop($stack1)) {
        $rpn[] = $stack_el;
    }

    $rpn_str = implode(" ", $rpn);

    echo "<pre>";
    print_r($rpn);
    print_r($out);
    print_r($stack);
    echo "</pre>";

    return $rpn_str;
}
