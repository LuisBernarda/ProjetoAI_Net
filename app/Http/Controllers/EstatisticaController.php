<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class EstatisticaController extends Controller
{
    public function index()
    {
        return view('estatistica.index');
    }
}
