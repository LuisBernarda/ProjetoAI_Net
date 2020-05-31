<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Http\Movimento;

class DashboardController extends Controller
{
    public function index()
    {
        $chart_options = [
            'chart_title' => 'Transactions by dates',
            'report_type' => 'group_by_date',
            'model' => 'App\Http\Movimento',
            'group_by_field' => 'data',
            'group_by_period' => 'day',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'valor',
            'chart_type' => 'line',
        ];

    $chart = new LaravelChart($chart_options);
        
        return view('dashboard.index', compact('chart'));
    }
}
