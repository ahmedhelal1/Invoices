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

    @if (session()->has('delete_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف الفاتورة بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">قائمة
                    الفواتير</span>
            </div>
        </div>
    </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- row -->
    <div class="row">


    @section('content')
        <!-- row opened -->
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">

                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                                href="{{ route('invoices.create') }}">اضافه قسم</a>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-10p border-bottom-0">#</th>
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
                                        <th class="wd-10p border-bottom-0">المعاملات</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp

                                    @foreach ($invoices as $data)
                                        @php
                                            $i++;
                                        @endphp

                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $data->invoices_number }}</td>
                                            <td>{{ $data->invoices_date }}</td>
                                            <td>{{ $data->due_date }}</td>
                                            <td>{{ $data->product }}</td>
                                            <td>
                                                <a href="{{ route('invoicesDetails', $data->id) }}">
                                                    {{ $data->section->section_name }}
                                                </a>
                                            </td>
                                            <td>{{ $data->discount }}</td>
                                            <td>{{ $data->rate_vat }}</td>
                                            <td>{{ $data->value_vat }}</td>
                                            <td>{{ $data->total }}</td>
                                            <td>
                                                @if ($data->value_status == 1)
                                                    <span class="text-success">{{ $data->status }}</span>
                                                @elseif ($data->value_status == 2)
                                                    <span class="text-danger">{{ $data->status }}</span>
                                                @else
                                                    <span class="text-warning">{{ $data->status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $data->note }}</td>

                                            <td>
                                                <div class="dropdown">
                                                    <button aria-expanded="false" aria-haspopup="true"
                                                        class="btn ripple btn-info" data-toggle="dropdown"
                                                        type="button">العمليات<i
                                                            class="fas fa-caret-down ml-1"></i></button>
                                                    <div class="dropdown-menu tx-13">
                                                        <h6
                                                            class="dropdown-header tx-uppercase tx-11 tx-bold tx-inverse tx-spacing-1">
                                                            Dropdown header</h6>
                                                        <a class="dropdown-item"
                                                            href="{{ route('invoices.edit', $data->id) }}">تعديل
                                                        </a>
                                                        <a class="dropdown-item" href="#"
                                                            data-invoice_id="{{ $data->id }}" data-toggle="modal"
                                                            data-target="#delete_invoice"><i
                                                                class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                            الفاتورة</a>
                                                        <div class="dropdown-divider"></div><a class="dropdown-item"
                                                            href="#">Separated
                                                            link</a>

                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->


            <!-- /row -->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->




    <!-- حذف الفاتورة -->
    <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('invoices.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        @csrf
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الحذف ؟
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
    <script>
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
    </script>
@endsection










</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
@endsection
