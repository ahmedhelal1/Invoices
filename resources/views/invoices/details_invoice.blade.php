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
@endsection
@section('page-header')
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
    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

@endsection
@section('content')
    <!-- row -->
    <div class="row">


    @section('content')

        <div class=" tab-menu-heading">
            <div class="tabs-menu1">
                <!-- Tabs -->
                <ul class="nav panel-tabs main-nav-line">
                    <li><a href="#tab1" class="nav-link active" data-toggle="tab">تفاصيل الفاتوره</a></li>
                    <li><a href="#tab2" class="nav-link" data-toggle="tab">تفاصيل الفاتوره</a></li>
                    <li><a href="#tab3" class="nav-link" data-toggle="tab">المرفقات</a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body tabs-menu-body main-content-body-right border">
            <div class="tab-content">
                <div class="tab-pane active" id="tab1">

                    <!-- row opened -->
                    <div class="row row-sm">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header pb-0">

                                    <div class="col-sm-6 col-md-4 col-xl-3">
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
                                                        <th class="wd-10p border-bottom-0">العمليات</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 0;
                                                    @endphp


                                                    @php
                                                        $i++;
                                                    @endphp

                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>{{ $invoice->invoices_number }}</td>
                                                        <td>{{ $invoice->invoices_date }}</td>
                                                        <td>{{ $invoice->due_date }}</td>
                                                        <td>{{ $invoice->product }}</td>
                                                        <td>{{ $invoice->section->section_name }}</td>
                                                        <td>{{ $invoice->discount }}</td>
                                                        <td>{{ $invoice->rate_vat }}</td>
                                                        <td>{{ $invoice->value_vat }}</td>
                                                        <td>{{ $invoice->total }}</td>

                                                        <td>
                                                            @if ($invoice->value_status == 1)
                                                                <span class="text-success">{{ $invoice->status }}</span>
                                                            @elseif ($invoice->value_status == 2)
                                                                <span class="text-danger">{{ $invoice->status }}</span>
                                                            @else
                                                                <span class="text-warning">{{ $invoice->status }}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $invoice->note }}</td>

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
                                                                        href="{{ route('invoices.edit', $invoice->id) }}">تعديل
                                                                    </a>

                                                                    <div class="dropdown-divider"></div><a
                                                                        class="dropdown-item" href="#">Separated
                                                                        link</a>
                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>

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


                </div>
                <div class="tab-pane" id="tab2">
                    <!-- row opened -->
                    <div class="row row-sm">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header pb-0">

                                    <div class="col-sm-6 col-md-4 col-xl-3">
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table text-md-nowrap" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-10p border-bottom-0">#</th>
                                                        <th class="wd-15p border-bottom-0">رقم الفاتورة</th>
                                                        <th class="wd-15p border-bottom-0">المنتج </th>
                                                        <th class="wd-10p border-bottom-0">القسم</th>
                                                        <th class="wd-25p border-bottom-0">حاله الفاتوره</th>
                                                        <th class="wd-20p border-bottom-0">الملاحظات </th>
                                                        <th class="wd-15p border-bottom-0">اسم الموظف </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 0;
                                                    @endphp

                                                    @foreach ($details as $data)
                                                        @php
                                                            $i++;
                                                        @endphp

                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $data->invoice_number }}</td>
                                                            <td>{{ $data->product }}</td>
                                                            <td>{{ $data->sections->section_name }}</td>
                                                            <td>{{ $data->value_status }}</td>
                                                            <td>{{ $data->note }}</td>
                                                            <td>{{ $data->user }}</td>

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


                </div>
                <div class="tab-pane" id="tab3">
                    <!-- row opened -->

                    <div class="card-body">
                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">اضافة مرفقات</h5>
                        <form method="post" action="{{ route('invoice_attachments') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="custom-file">
                                <label class="custom-file-label" for="file_name">حدد المرفق</label>
                                <input type="file" class="custom-file-input" id="file_name" name="file_name"
                                    required>
                                <input type="hidden" id="invoice_number" name="invoice_number"
                                    value="{{ $data->invoice_number }}">
                                <input type="hidden" id="invoice_id" name="invoice_id" value="{{ $invoice->id }}">

                            </div><br><br>
                            <button type="submit" class="btn btn-primary btn-sm " name="submit">تاكيد</button>
                        </form>
                    </div>

















                    <div class="row row-sm">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header pb-0">

                                    <div class="col-sm-6 col-md-4 col-xl-3">
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table text-md-nowrap" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-10p border-bottom-0">#</th>
                                                        <th class="wd-15p border-bottom-0">اسم الملف </th>
                                                        <th class="wd-15p border-bottom-0">رقم الفاتوره</th>
                                                        <th class="wd-20p border-bottom-0"> اسم الموظف</th>
                                                        <th class="wd-20p border-bottom-0"> التعاملات </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 0;
                                                    @endphp

                                                    @foreach ($invoice_attachment as $data)
                                                        @php
                                                            $i++;
                                                        @endphp

                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $data->file_name }}</td>
                                                            <td>{{ $data->invoices_number }}</td>
                                                            <td>{{ $data->created_by }}</td>
                                                            <td>
                                                                <a class="btn btn-outline-success btn-sm"
                                                                    href="{{ route('View_file', [$data->invoices_number, $data->file_name]) }}"
                                                                    role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                    عرض</a>

                                                                <a class="btn btn-outline-info btn-sm"
                                                                    href="{{ route('download', [$data->invoices_number, $data->file_name]) }}"
                                                                    role="button"><i class="fas fa-download"></i>&nbsp;
                                                                    تحميل</a>


                                                                <a class="btn btn-outline-danger btn-sm"
                                                                    data-toggle="modal"
                                                                    data-file_name="{{ $data->file_name }}"
                                                                    data-invoices_number="{{ $data->invoices_number }}"
                                                                    data-id_file="{{ $data->id }}"
                                                                    data-target="#delete_file">حذف</a>

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

                </div>
            </div>
        </div>






        <!-- delete -->
        <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('delete') }}" method="post">

                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p class="text-center">
                            <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                            </p>

                            <input type="hidden" name="id_file" id="id_file" value="">
                            <input type="hidden" name="file_name" id="file_name" value="">
                            <input type="hidden" name="invoices_number" id="invoices_number" value="">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
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
    <script>
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var invoices_number = button.data('invoices_number')
            var modal = $(this)

            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoices_number').val(invoices_number);
        })
    </script>

@endsection
</div>
