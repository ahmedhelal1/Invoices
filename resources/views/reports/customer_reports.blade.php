                     @extends('layouts.master')
                     @section('css')
                         <!--- Internal Select2 css-->
                         <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
                         <!---Internal Fileupload css-->
                         <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet"
                             type="text/css" />
                         <!---Internal Fancy uploader css-->
                         <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
                         <!--Internal Sumoselect css-->
                         <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
                         <!--Internal  TelephoneInput css-->
                         <link rel="stylesheet"
                             href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
                     @endsection
                     @section('title')
                         تقارير العملاء
                     @stop

                     @section('page-header')
                         <!-- breadcrumb -->
                         <div class="breadcrumb-header justify-content-between">
                             <div class="my-auto">
                                 <div class="d-flex">
                                     <h4 class="content-title mb-0 my-auto">التقارير</h4><span
                                         class="text-muted mt-1 tx-13 mr-2 mb-0">
                                         تقارير العملاء</span>
                                 </div>
                             </div>
                         </div>
                         <!-- breadcrumb -->
                     @endsection
                     @section('content')
                         <form action="{{ route('search_customer_report') }}" method="POST" autocomplete="off">
                             @csrf
                             <div class="row">
                                 <div class="col">
                                     <label for="inputName" class="control-label">القسم</label>
                                     <select name="Section" class="form-control SlectBox"
                                         onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                                         <!--placeholder-->
                                         <option value="" selected disabled>حدد القسم</option>
                                         @foreach ($sections as $section)
                                             <option value="{{ $section->id }}"> {{ $section->section_name }}</option>
                                         @endforeach
                                     </select>
                                 </div>

                                 <div class="col">
                                     <label for="inputName" class="control-label">المنتج</label>

                                     <select id="product" name="product" class="form-control">
                                         <option value="" selected>حدد المنتج</option>

                                     </select>
                                 </div>

                                 <div class="col-lg-3" id="start_at">
                                     <label for="exampleFormControlSelect1">من تاريخ</label>
                                     <div class="input-group">
                                         <div class="input-group-prepend">
                                             <div class="input-group-text">
                                                 <i class="fas fa-calendar-alt"></i>
                                             </div>
                                         </div><input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                             name="start_at" placeholder="YYYY-MM-DD" type="text">
                                     </div><!-- input-group -->
                                 </div>

                                 <div class="col-lg-3" id="end_at">
                                     <label for="exampleFormControlSelect1">الي تاريخ</label>
                                     <div class="input-group">
                                         <div class="input-group-prepend">
                                             <div class="input-group-text">
                                                 <i class="fas fa-calendar-alt"></i>
                                             </div>
                                         </div><input class="form-control fc-datepicker" name="end_at"
                                             value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="text">
                                     </div><!-- input-group -->
                                 </div>

                             </div></br>
                             <div class="row">
                                 <div class="col-sm-1 col-md-1">
                                     <button class="btn btn-primary btn-block">بحث</button>
                                 </div>
                             </div>
                         </form>

                         </div>
                         <div class="card-body">
                             <div class="table-responsive">
                                 @if (isset($details))
                                     <table id="example" class="table key-buttons text-md-nowrap"
                                         style=" text-align: center">
                                         <thead>
                                             <tr>
                                                 <th class="border-bottom-0">#</th>
                                                 <th class="border-bottom-0">رقم الفاتورة</th>
                                                 <th class="border-bottom-0">تاريخ القاتورة</th>
                                                 <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                                 <th class="border-bottom-0">المنتج</th>
                                                 <th class="border-bottom-0">القسم</th>
                                                 <th class="border-bottom-0">الخصم</th>
                                                 <th class="border-bottom-0">نسبة الضريبة</th>
                                                 <th class="border-bottom-0">قيمة الضريبة</th>
                                                 <th class="border-bottom-0">الاجمالي</th>
                                                 <th class="border-bottom-0">الحالة</th>
                                                 <th class="border-bottom-0">ملاحظات</th>

                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php $i = 0; ?>
                                             @foreach ($details as $invoice)
                                                 <?php $i++; ?>
                                                 <tr>
                                                     <td>{{ $i }}</td>
                                                     <td>{{ $invoice->invoices_number }} </td>
                                                     <td>{{ $invoice->invoices_date }}</td>
                                                     <td>{{ $invoice->due_date }}</td>
                                                     <td>{{ $invoice->product }}</td>
                                                     <td><a
                                                             href="{{ url('InvoicesDetails') }}/{{ $invoice->id }}">{{ $invoice->section->section_name }}</a>
                                                     </td>
                                                     <td>{{ $invoice->discount }}</td>
                                                     <td>{{ $invoice->rate_vat }}</td>
                                                     <td>{{ $invoice->value_vat }}</td>
                                                     <td>{{ $invoice->total }}</td>
                                                     <td>
                                                         @if ($invoice->value_status == 1)
                                                             <span class="text-success">{{ $invoice->status }}</span>
                                                         @elseif($invoice->value_status == 2)
                                                             <span class="text-danger">{{ $invoice->status }}</span>
                                                         @else
                                                             <span class="text-warning">{{ $invoice->status }}</span>
                                                         @endif

                                                     </td>

                                                     <td>{{ $invoice->note }}</td>
                                                 </tr>
                                             @endforeach
                                         </tbody>
                                     </table>

                                 @endif
                             </div>
                         </div>
                         </div>

                     @endsection

                     @section('js')
                         <!-- Internal Select2 js-->
                         <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
                         <!--Internal Fileuploads js-->
                         <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
                         <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
                         <!--Internal Fancy uploader js-->
                         <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
                         <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
                         <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
                         <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
                         <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
                         <!--Internal  Form-elements js-->
                         <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
                         <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
                         <!--Internal Sumoselect js-->
                         <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
                         <!--Internal  Datepicker js -->
                         <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
                         <!--Internal  jquery.maskedinput js -->
                         <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
                         <!--Internal  spectrum-colorpicker js -->
                         <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
                         <!-- Internal form-elements js -->
                         <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

                         <script>
                             var date = $('.fc-datepicker').datepicker({
                                 dateFormat: 'yy-mm-dd'
                             }).val();
                         </script>


                         <script>
                             $(document).ready(function() {
                                 $('select[name="Section"]').on('change', function() {
                                     var SectionId = $(this).val();
                                     if (SectionId) {
                                         $.ajax({
                                             url: "{{ URL::to('section') }}/" + SectionId,
                                             type: "GET",
                                             dataType: "json",
                                             success: function(data) {
                                                 $('select[name="product"]').empty();
                                                 $.each(data, function(key, value) {
                                                     $('select[name="product"]').append('<option value="' +
                                                         value + '">' + value + '</option>');
                                                 });
                                             },
                                         });

                                     } else {
                                         console.log('AJAX load did not work');
                                     }
                                 });

                             });
                         </script>
                     @endsection
