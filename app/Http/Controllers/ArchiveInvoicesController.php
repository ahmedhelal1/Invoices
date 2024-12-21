<?php

namespace App\Http\Controllers;

use App\Models\archiveInvoices;
use Illuminate\Http\Request;
use App\Models\invoices;

class ArchiveInvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoices::onlyTrashed()->get();
        return view('invoices.archive', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\archiveInvoices  $archiveInvoices
     * @return \Illuminate\Http\Response
     */
    public function show(archiveInvoices $archiveInvoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\archiveInvoices  $archiveInvoices
     * @return \Illuminate\Http\Response
     */
    public function edit(archiveInvoices $archiveInvoices)
    {
        //
    }

    public function update(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = invoices::withTrashed();
        $invoices->where('id', $id)->restore();
        session()->flash('restore_invoices');
        return redirect()->back();
    }


    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = invoices::withTrashed();
        $invoices->where('id', $id)->forceDelete();
        session()->flash('delete_invoice');
        return redirect()->back();
    }
}
