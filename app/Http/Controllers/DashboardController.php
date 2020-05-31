<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Movimento;
use App\Charts\MovChart;

class DashboardController extends Controller
{
    public function index()
    {
        

        $movsChart = new MovChart;
        $movsChart->labels(['Jan', 'Feb', 'Mar']);
        $movsChart->dataset('Users by trimester', 'line', [10, 25, 13]);

        return view('dashboard.index', compact('movsChart'));
    }
}
