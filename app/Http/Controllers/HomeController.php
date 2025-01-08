<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\invoices;
use Fx3costa\LaravelChartJs\ChartJs;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $total_invoices = invoices::count();
        $paid = invoices::where('status', 'paid')->count();
        $Partially_paid = invoices::where('status', 'Partially paid')->count();
        $unpaid = invoices::where('status', 'unpaid')->count();

        $paid_percent = ($paid * 100) / $total_invoices;
        $Partially_paid_percent = ($Partially_paid * 100) / $total_invoices;
        $unpaid_percent = ($unpaid * 100) / $total_invoices;


        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 300])
            ->labels(['الفواتير الغير مدفوعه', 'الفواتير المدفوعه جزئيا',  'الفواتير المفوعه'])
            ->datasets([
                [
                    "label" => "الفواتير الغير مدفوعه",
                    'backgroundColor' => ['#c1121f'],
                    'data' => [$unpaid_percent]
                ],
                [
                    "label" => "الفواتير المدفوعه جزئيا",
                    'backgroundColor' => ['#fb5607'],
                    'data' => [$Partially_paid_percent]
                ],

                [
                    "label" => "الفواتير المدفوعه",
                    'backgroundColor' => ['#4f772d'],
                    'data' => [$paid_percent]
                ]
            ])
            ->options([]);



        return view('dashboard', compact('chartjs'));
    }
}
