<?php

namespace App\Http\Controllers;

use App\Models\invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesAttachmentsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:اضافة مرفق', ['only' => ['create', 'store']]);
        $this->middleware('permission:حذف المرفق', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate(
            $request,
            ['file_name' => 'mimes:pdf,jpg,png,jpeg'],
            ['file_name.mimes' => ' pdf,jpg,png,jpeg صيغه المرفق يجب ان تكون ']
        );
        $image = $request->file('file_name');
        $file_name = $image->getClientOriginalName();
        $attachment = new invoices_attachments();
        $attachment->invoices_number = $request->invoice_number;
        $attachment->id_invoices = $request->invoice_id;
        $attachment->file_name = $file_name;
        $attachment->created_by = auth()->user()->name;
        $attachment->save();

        $request->file_name->move(public_path('attachment/' . $attachment->invoices_number), $file_name);

        session()->flash('add', 'لقد تم اضافه المرفق بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices_attachments $invoices_attachments)
    {
        //
    }
}
