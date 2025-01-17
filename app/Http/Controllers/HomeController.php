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
        if ($paid) {
            $paid_percent = ($paid * 100) / $total_invoices;
        } else {
            $paid_percent = 0;
        }
        if ($Partially_paid) {
            $Partially_paid_percent = ($Partially_paid * 100) / $total_invoices;
        } else {
            $Partially_paid_percent = 0;
        }
        if ($unpaid) {
            $unpaid_percent = ($unpaid * 100) / $total_invoices;
        } else {
            $unpaid_percent = 0;
        }



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


        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 300])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214', '#ff9642'],
                    'data' => [$unpaid_percent, $paid_percent, $Partially_paid_percent]
                ]
            ])
            ->options([]);


        return view('dashboard', compact('chartjs', 'chartjs_2'));
    }
}
