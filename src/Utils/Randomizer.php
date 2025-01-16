<?php

namespace App\Utils;

class Randomizer {
    public static function token() {
        $string = sha1(rand());
        $randomString = substr($string, 0, 16);

        return $randomString;
    }
}