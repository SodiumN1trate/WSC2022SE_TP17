<?php
class Number {
    public static $NUMBERS = [];
    public static $ORG = [];

    public static function number($n) {
        $factor = $_GET['factor'];
        if ($n > 40) {
            return 0;
        }
        $str  = $n % $factor === 0 ? " is a multiple of $factor**" : '';
        self::$NUMBERS[] = $n . $str;
        self::$ORG[] = $n;
        Number::number($n + 1);
    }
}

Number::number(1);
print("<pre> Original ".print_r(Number::$ORG,true)."</pre>");
print("<pre> Modified ".print_r(Number::$NUMBERS,true)."</pre>");