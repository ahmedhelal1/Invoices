<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sections;
use App\Models\invoices;

class CustomerReportController extends Controller
{
    public function index()
    {
        $sections = sections::all();

        return view('reports.customer_reports', compact('sections'));
    }
    public function search(Request $request)
    {
        if ($request->Section && $request->product && $request->start_at == '' && $request->end_at == '') {


            $details = invoices::select('*')->where('section_id', '=', $request->Section)->where('product', '=', $request->product)->get();
            $sections = sections::all();
            return view('reports.customer_reports', compact('sections', 'details'));
        } else {

            $start_at = date($request->start_at);
            $end_at = date($request->end_at);

            $details = invoices::whereBetween('invoices_date', [$start_at, $end_at])->where('section_id', '=', $request->Section)->where('product', '=', $request->product)->get();
            $sections = sections::all();
            return view('reports.customer_reports', compact('sections', 'details'));
        }
    }
}
