<?php

namespace App;

use App\Hexagon;

class Map
{
    public function __construct($size = 3) {
        $this->hexagons = collect();

        for($row = -floor($size/2); $row < $size/2; $row++) {
            for($col = -floor($size/2); $col < $size/2; $col++) {
                if((abs($row + $col)) < (floor($size/2) * 2)) {
                    $this->hexagons->push(
                        new Hexagon($row,$col)
                    );
                }
            }            
        }
    }

    public static function withSize($size) {
        return new Map($size);
    }

    public function hexagonOffsetFromCenter() {
        return $this->hexagons->map(function($hexagon) {
            return $hexagon->row;
        })->max();    
    }

    public function numberOfHexagonRows() {
        return$this->hexagonOffsetFromCenter()*2+1;
    }
}