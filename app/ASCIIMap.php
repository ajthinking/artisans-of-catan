<?php

namespace App;

class ASCIIMap
{
    public function __construct($map) {
        $this->map = $map;
        
        $this->hexagonWidth = 8;
        $this->hexagonHeight = 5;
        
        $this->initMatrix();
        $this->insertAllHexagons();
    }

    public static function for($map) {
        return new ASCIIMap($map);
    }
    
    const HEXAGON_TEMPLATE =  [
        '  _____',
        ' /     \\' ,
        '/       \\' ,
        '\\       /' ,
        ' \\_____/'
    ];    

    public function initMatrix() {
        $this->matrix = array_fill(
            0,
            $this->map->numberOfHexagonRows()*$this->hexagonHeight,
            array_fill(0, $this->map->numberOfHexagonRows()*$this->hexagonWidth, " ")
        );        
    }
    
    public function insertAllHexagons() {
        $this->map->hexagons->each(function($hexagon) {
            $this->insertHexagon($hexagon);            
        });
    }
    
    public function insertHexagon($hexagon) {
        $baseRow = $this->hexagonToASCIIRowIndex($hexagon);
        $baseCol = $this->hexagonToASCIIColIndex($hexagon);
        
        // Top
        $this->matrix[$baseRow+0][$baseCol+2] = '_';
        $this->matrix[$baseRow+0][$baseCol+3] = '_';
        $this->matrix[$baseRow+0][$baseCol+4] = '_';
        $this->matrix[$baseRow+0][$baseCol+5] = '_';
        $this->matrix[$baseRow+0][$baseCol+6] = '_';
            
        // Upper middle
        $this->matrix[$baseRow+1][$baseCol+1] = '/';
        $this->matrix[$baseRow+1][$baseCol+7] = '\\';

        // Middle
        $this->matrix[$baseRow+2][$baseCol+0] = '/';
        $this->matrix[$baseRow+2][$baseCol+8] = '\\';

        // Lower middle
        $this->matrix[$baseRow+3][$baseCol+0] = '\\';
        $this->matrix[$baseRow+3][$baseCol+8] = '/';

        // Bottom
        $this->matrix[$baseRow+4][$baseCol+1] = '\\';
        $this->matrix[$baseRow+4][$baseCol+2] = '_';
        $this->matrix[$baseRow+4][$baseCol+3] = '_';
        $this->matrix[$baseRow+4][$baseCol+4] = '_';
        $this->matrix[$baseRow+4][$baseCol+5] = '_';
        $this->matrix[$baseRow+4][$baseCol+6] = '_';
        $this->matrix[$baseRow+4][$baseCol+7] = '/';
    }

    public function hexagonToASCIIRowIndex($hexagon) {
        $result = ($hexagon->row + $this->map->hexagonOffsetFromCenter()) * ($this->hexagonHeight-1);
        return $result + ($hexagon->col%2)*2;
    }

    public function hexagonToASCIIColIndex($hexagon) {
        return ($hexagon->col + $this->map->hexagonOffsetFromCenter()) * ($this->hexagonWidth-1);
    }    
}