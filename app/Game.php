<?php

namespace App;

use App\Map;
use App\MapConsoleRenderer;

class Game
{
    public static function test() {
        return MapConsoleRenderer::for(
            Map::withSize(3)
        )->render();
    }
}