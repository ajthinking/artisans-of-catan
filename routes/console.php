<?php

use App\Map;
use App\MapConsoleRenderer;

Artisan::command('settle', function () {
    $this->info(" --- Artisans of Catan --- ");

    MapConsoleRenderer::for(
        Map::withSize(3)
    )->render();
});