<?php

namespace App\Http\Controllers;


use App\Models\invoices;
use App\Models\invoices_attachments;
use App\Models\invoices_details;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoices::all();

        return view('invoices.invoices', compact('invoices'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoices = Invoices::all();
        $sections = Sections::all();
        return view('invoices.add_invoice', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        Invoices::create([

            'invoices_number' => $request->invoice_number,
            'invoices_date' => $request->invoice_Date,
            'due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'amount_collection' => $request->Amount_collection,
            'amount_commission' => $request->Amount_Commission,
            'rate_vat' => $request->Rate_VAT,
            'value_vat' => $request->Value_VAT,
            'note' => $request->note,
            'user' => auth()->user()->name,
            'discount' => $request->Discount,
            'total' => $request->Total,
            'status' => "غير مدفوع",
            'value_status' => 2,

        ]);
        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'id_invoices' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->Section,
            'status' => "غير مدفوع",
            'value_status' => 2,
            'note' => $request->note,
            'user' => auth()->user()->name,

        ]);
        if ($request->hasFile('pic')) {
            $invoice_id = invoices::latest()->first()->id;
            $image = $request->file('pic');
            $imagefile = $image->getClientOriginalExtension();
            $invoice_number = $request->invoice_number;

            $attachments = new invoices_attachments();
            $attachments->file_name = $imagefile;
            $attachments->invoices_number = $invoice_number;
            $attachments->id_invoices = $invoice_id;
            $attachments->created_by = auth()->user()->name;
            $attachments->save();


            $image_name = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('attachment/' . $invoice_number), $image_name);
            session()->flash('add', "لقد تم اضافه فاتوره بنجاح ");
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices $invoices)
    {
        //
    }
    public function getproducts($id)
    {
        $products = DB::table('products')->where('section_id', $id)->pluck('product_name', 'id');
        return json_encode($products);
    }
}
