@extends('layouts.master')
@section('title', 'print invoices')

@section('css')
    {{-- //////////// this code for display form without buttom --}}
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    طباعه الفاتوره</span>
            </div>
        </div>

    </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            {{-- ////////////////////////////////////////////////////////////////////////// --}}
            {{-- ////////////////////////////////////////////////////////////////////////// --}}
            {{-- ////////////////////////////////////////////////////////////////////////// --}}
            {{-- ////////////////////////////////////////////////////////////////////////// --}}
            {{-- ////////////////////////////////////////////////////////////////////////// --}}
            {{-- ////////////////////////////////////////////////////////////////////////// --}}
            {{-- ////////////////////////////////////////////////////////////////////////// --}}
            {{-- idddddddddddd = print    this is form for print --}}
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">الفاتوره</h1>
                            <div class="billed-from">
                                <h6>SoluTions company</h6>
                                <p>Regulating debt repayment systems<br>
                                    Tel No: 324 445-4544<br>
                                    Email: SoluTion@gmail.com</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">

                            <div class="col-md">
                                <label class="tx-gray-600"> معلومات الفاتوره</label>
                                <p class="invoice-info-row"><span> رقم الافتوره</span>
                                    <span>{{ $invoice->invoices_number }}</span>
                                </p>
                                <p class="invoice-info-row"><span> تاريخ الفاتوره</span>
                                    <span>{{ $invoice->invoices_date }}</span>
                                </p>
                                <p class="invoice-info-row"><span>تاريخ الاستحقاق </span>
                                    <span>{{ $invoice->due_date }}</span>
                                </p>
                                <p class="invoice-info-row"><span> القسم</span>
                                    <span>{{ $invoice->section->section_name }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">المنتج</th>
                                        <th class="wd-40p">مبلغ التحصيل</th>
                                        <th class="tx-center">مبلغ العموله</th>
                                        <th class="tx-right"> اجمالي الفاتوره</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $invoice->product }}</td>
                                        <td class="tx-12">{{ number_format($invoice->amount_collection, 2) }}</td>
                                        <td class="tx-center">{{ number_format($invoice->amount_commission, 2) }}</td>



                                        <td class="tx-right">
                                            {{ number_format($total_all = $invoice->amount_collection + $invoice->total, 2) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="valign-middle" colspan="2" rowspan="4">
                                            <div class="invoice-notes">
                                                <label class="main-content-label tx-13">الملاحظات</label>
                                                <h6>{{ $invoice->note }}</h6>
                                            </div><!-- invoice-notes -->
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="tx-right">نسبه الضريبه </td>
                                        <td class="tx-right" colspan="2">{{ $invoice->rate_vat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">قيمه الخصم</td>
                                        <td class="tx-right" colspan="2">{{ number_format($invoice->value_vat, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">الاجمالي شامل الضريبه</td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{ $invoice->total }}</h4>
                                        </td>

                                    </tr>
                                    <td class="tx-right">الاجمالي</td>
                                    <td class="tx-right" colspan="2">
                                        <h4 class="tx-primary tx-bold">{{ number_format($total_all, 2) }}</h4>
                                    </td>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">

                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>

                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection
