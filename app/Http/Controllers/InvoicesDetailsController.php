<?php

namespace App\Http\Controllers;

use App\Models\invoices_details;
use Carbon\Cli\Invoker;
use Illuminate\Http\Request;
use App\Models\invoices_attachments;
use App\Models\invoices;
use App\Models\Sections;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:قائمة الفواتير', ['only' => ['openfile', 'download']]);
        $this->middleware('permission:اضافة مستخدم', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل الفاتورة', ['only' => ['edit']]);
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


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $invoice = Invoices::where('id', $id)->first();
        $details = Invoices_details::where('id_invoices', $id)->get();
        $invoice_attachment = invoices_attachments::where('id_invoices', $id)->get();

        return view('invoices.details_invoice', compact('invoice', 'details', 'invoice_attachment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // return $request;
        $invoice = invoices_attachments::findOrFail($request->id_file);
        Storage::disk('public_uploads')->delete($request->invoices_number . '/' . $request->file_name);
        $invoice->delete();
        session()->flash("delete", "لقد تم حذف الملف بنجاح");
        return redirect()->back();
    }


    public function openfile($invoice_number, $file_name)
    {
        $st = "attachment";
        $pathToFile = public_path($st . '/' . $invoice_number . '/' . $file_name);
        return response()->file($pathToFile);
    }
    public function download($invoice_number, $file_name)
    {
        $st = "attachment";
        $pathToFile = public_path($st . '/' . $invoice_number . '/' . $file_name);
        return response()->download($pathToFile);
    }
}
