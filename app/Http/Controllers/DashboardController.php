<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
}
