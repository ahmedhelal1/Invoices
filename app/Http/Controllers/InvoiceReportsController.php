<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class InvoiceReportsController extends Controller
{
    public function index()
    {
        return view('reports.invoices_report');
    }
    public function Search_invoices(Request $request)
    {
        $type = $request->type;
        if ($request->radio == 1) {
            if ($request->type  && $request->start_at == '' && $request->end_at == '') {
                if ($request->type == "all invoices") {
                    $details = invoices::all();
                    return view('reports.invoices_report', compact('type', 'details'));
                } else {
                    $details = invoices::select('*')->where('status', "=", $request->type)->get();
                    return view('reports.invoices_report', compact('type', 'details'));
                }
            } else {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                if ($request->type == "all invoices") {
                    $details = invoices::whereBetween('invoices_date', [$start_at, $end_at])->get();
                    return view('reports.invoices_report', compact('type', 'details'));
                } else {
                    $details = invoices::whereBetween('invoices_date', [$start_at, $end_at])->where('status', "=", $request->type)->get();
                    return view('reports.invoices_report', compact('type', 'details'));
                }
            }
        } else {
            echo "this else";
        }
        return $request;
    }
}
