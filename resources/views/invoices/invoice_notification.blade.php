@extends('layouts.master')
@section('title', 'invoices')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')

    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">قائمة
                    الفواتير</span>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table text-md-nowrap" id="example1">
                <thead>
                    <tr>

                        <th class="wd-15p border-bottom-0">رقم الفاتورة</th>
                        <th class="wd-15p border-bottom-0">تاريخ الفاتوره </th>
                        <th class="wd-20p border-bottom-0">تاريخ الاستحقاق</th>
                        <th class="wd-15p border-bottom-0">المنتج </th>
                        <th class="wd-10p border-bottom-0">القسم</th>
                        <th class="wd-25p border-bottom-0">الخصم</th>
                        <th class="wd-15p border-bottom-0">نسبه الضريبه </th>
                        <th class="wd-15p border-bottom-0">قيمه الضريبه </th>
                        <th class="wd-20p border-bottom-0">الاجمالي </th>
                        <th class="wd-15p border-bottom-0">الحاله </th>
                        <th class="wd-10p border-bottom-0">الملاحظات</th>

                    </tr>
                </thead>
                <tbody>

                    <tr>

                        <td>{{ $invoices->invoices_number }}</td>
                        <td>{{ $invoices->invoices_date }}</td>
                        <td>{{ $invoices->due_date }}</td>
                        <td>{{ $invoices->product }}</td>
                        <td>
                            <a href="{{ route('invoicesDetails', $invoices->id) }}">
                                {{ $invoices->section->section_name }}
                            </a>
                        </td>
                        <td>{{ $invoices->discount }}</td>
                        <td>{{ $invoices->rate_vat }}</td>
                        <td>{{ $invoices->value_vat }}</td>
                        <td>{{ $invoices->total }}</td>
                        <td>
                            @if ($invoices->value_status == 1)
                                <span class="text-success">{{ $invoices->status }}</span>
                            @elseif ($invoices->value_status == 2)
                                <span class="text-danger">{{ $invoices->status }}</span>
                            @else
                                <span class="text-warning">{{ $invoices->status }}</span>
                            @endif
                        </td>
                        <td>{{ $invoices->note }}</td>


                    </tr>
                </tbody>
            </table>
            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                href="{{ route('dashboard') }}" style="width: 200px; height: 50px; font-size: 16px;">رجوع</a>

        </div>
    </div>
    </div>
    </div>


    < <!-- breadcrumb -->
    @endsection
