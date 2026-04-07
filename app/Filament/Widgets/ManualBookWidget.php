<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class ManualBookWidget extends Widget
{
        protected static ?int $sort = -11;
    protected int | string | array $columnSpan = 1;

    protected static string $view = 'filament.widgets.manual-book-widget';
}
