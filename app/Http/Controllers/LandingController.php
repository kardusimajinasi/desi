<?php

namespace App\Http\Controllers;

use App\Filament\Widgets\DashboardBalihoMap;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $widget = new DashboardBalihoMap();

        return view('landing', [
            'tableData' => $widget->getTableData(),
        ]);
    }

    public function petaBaliho()
    {
        return view('peta-baliho');
    }
}
