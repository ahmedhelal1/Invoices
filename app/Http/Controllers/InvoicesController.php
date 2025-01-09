<?php

namespace App\Http\Controllers;


use App\Models\invoices;
use App\Models\invoices_attachments;
use App\Models\invoices_details;
use App\Models\sections;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Mail\CreateInvoice;
use Illuminate\Support\Facades\Mail;
use App\Exports\InvoicesExport;
use App\Notifications\AddInvoices;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Notification;


class InvoicesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:قائمة الفواتير', ['only' => ['index', 'show']]);
        $this->middleware('permission:اضافة فاتورة', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل الفاتورة', ['only' => ['edit', 'update']]);
        $this->middleware(['permission:حذف الفاتورة', 'permission:ارشفة الفاتورة'], ['only' => ['destroy']]);
        $this->middleware('permission:طباعةالفاتورة', ['only' => ['print_invoice']]);
        $this->middleware('permission:تصدير EXCEL', ['only' => ['export']]);
        $this->middleware('permission:تغير حالة الدفع', ['only' => ['Status_show', 'Status_update', 'partiallyPaid', 'unpaid', 'paid']]);
        $this->middleware('permission:المنتجات', ['only' => ['getproducts']]);
    }
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
            'status' => "Unpaid",
            'value_status' => 2,

        ]);
        $invoice_id = invoices::latest()->first()->id;

        invoices_details::create([
            'id_invoices' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->Section,
            'status' => " Unpaid",
            'value_status' => 2,
            'note' => $request->note,
            'user' => auth()->user()->name,

        ]);

        // $this->validate(
        //     $request,
        //     ['file_name' => 'mimes:pdf,jpg,png,jpeg'],
        //     ['file_name.mimes' => ' pdf,jpg,png,jpeg صيغه المرفق يجب ان تكون ']
        // );
        if ($request->hasFile('pic')) {
            $image = $request->file('pic');
            // $imagefile = $image->getClientOriginalExtension();
            $image_name = $request->pic->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoices_attachments();
            $attachments->file_name = $image_name;
            $attachments->invoices_number = $invoice_number;
            $attachments->id_invoices = $invoice_id;
            $attachments->created_by = auth()->user()->name;
            $attachments->save();


            $request->pic->move(public_path('attachment/' . $invoice_number), $image_name);
        }

        $user = User::where('id', '!=', auth()->user()->id)->get();
        $user_created = auth()->user()->name;
        Notification::send($user, new AddInvoices($invoice_id, $user_created));
        //////////////////////
        Mail::to(auth()->user()->email)->send(new CreateInvoice($invoice_id));
        session()->flash('add', "لقد تم اضافه فاتوره بنجاح ");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoices = invoices::findOrFail($id);

        $getId = DB::table('notifications')->where('data->invoice_id', $id)->where('notifiable_id', auth()->user()->id)->pluck('id');
        DB::table('notifications')->where('id', $getId)->update(['read_at' => now()]);
        return view('invoices.invoice_notification', compact('invoices'));
    }


    public function edit($id)
    {
        $invoices = Invoices::where('id', $id)->first();
        $sections = sections::all();
        return view('invoices.invoices_edit', compact('invoices', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoices = Invoices::findOrFail($id);
        $invoices->update([
            'invoices_number' => $request->invoice_number,
            'invoices_date' => $request->invoice_Date,
            'due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->Amount_collection,
            'rate_vat' => $request->Rate_VAT,
            'value_vat' => $request->Value_VAT,
            'note' => $request->note,
            'discount' => $request->Discount,
            'total' => $request->Total,
        ]);
        session()->flash('edit', "لقد تم تعديل فاتوره بنجاح ");

        return redirect()->route('invoicesDetails', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoice = Invoices::where('id', $id)->first();
        $attachments = invoices_attachments::where('id_invoices', $id)->first();

        if ($request->id_page == 2) {
            $invoice->Delete();
            session()->flash('archive_successful');
        } else {
            if (!empty($attachments->invoices_number)) {
                Storage::disk('public_uploads')->deleteDirectory($attachments->invoices_number);
            }

            $invoice->forceDelete();
            session()->flash('delete_invoice');
        }

        return redirect()->back();
    }
    public function getproducts($id)
    {
        $products = DB::table('products')->where('section_id', $id)->pluck('product_name', 'id');
        return json_encode($products);
    }
    public function Status_show($id)
    {
        $invoice = Invoices::where('id', $id)->first();
        $sections = sections::all();


        return view('invoices.change_status', compact('invoice', 'sections'));
    }
    public function Status_update(Request $request, $id)
    {
        $invoice = invoices::findOrFail($id);
        if ($request->Status === 'paid') {
            $invoice->update([
                'value_status' => 1,
                'status' => $request->Status,
                'payment_date' => $request->payment_date,
            ]);
            invoices_details::create([
                'id_invoices' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->Section,
                'status' => $request->Status,
                'payment_date' => $request->payment_date,
                'value_status' => 1,
                'note' => $request->note,
                'user' => auth()->user()->name,



            ]);
        } else {
            $invoice->update([
                'value_status' => 3,
                'status' => $request->Status,
                'payment_date' => $request->payment_date,
            ]);
            invoices_details::create([
                'id_invoices' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->Section,
                'status' => $request->Status,
                'payment_date' => $request->payment_date,
                'value_status' => 3,
                'note' => $request->note,
                'user' => auth()->user()->name,

            ]);
        }
        session()->flash('status_update');
        return redirect('invoices');
    }
    public function paid()
    {
        $invoices = Invoices::where('value_status', 1)->get();
        return view('invoices.paid', compact('invoices'));
    }
    public function unpaid()
    {

        $invoices = Invoices::where('value_status', 2)->get();
        return view('invoices.unpaid', compact('invoices'));
    }
    public function partiallyPaid()
    {

        $invoices = Invoices::where('value_status', 3)->get();
        return view('invoices.partially_paid', compact('invoices'));
    }
    public function print_invoice($id)
    {
        $invoice = Invoices::where('id', $id)->first();
        return view('invoices.print_invoice', compact('invoice'));
    }
    public function export()
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
        return redirect()->back();
    }
    public function markAsRead()
    {
        $user = User::find(Auth()->user()->id);
        foreach ($user->unreadnotifications as $notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }
}
