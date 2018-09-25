<?php

namespace App;

use App\ASCIIMap;

class MapConsoleRenderer
{
    public function __construct($map) {
        $this->map = $map;
        $this->ASCIIMap = ASCIIMap::for($map);
    }

    public static function for($map) {
        return new MapConsoleRenderer($map);
    }

    public function render() {
        collect($this->ASCIIMap->matrix)->each(function($line) {
            echo join("", $line) . PHP_EOL;
        });
        return "OK IM RENDERING!";
    }
}