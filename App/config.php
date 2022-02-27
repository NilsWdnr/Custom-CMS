<?php

namespace App;

class config{
    private static $options = [
        "root" => "http://localhost:8888",
        "database" => [
            "host" => "localhost:8889",
            "name" => "endpruefung_uebung",
            "username" => "root",
            "password" => "root"
        ]
        ];

    public static function get(string $selector){
        $elements = explode(">", $selector);
        $option = self::$options;

        foreach($elements as $element){
            $option = $option[$element];
        }

        return $option;
    }
}