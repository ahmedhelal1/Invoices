@extends('layouts.master')
@section("title","invoices")
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">قائمة الفواتير</span>
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
								</tr>
							</thead>
							<tbody>
								@php 
								$i=0
								@endphp
								
								@foreach($invoice as $data)

									@php 
								$i++;
								@endphp
								
								<tr>
									<td>{{$i}}</td>
									<td>{{$data->invoices_number}}</td>
									<td>{{$data->invoices_date}}</td>
									<td>{{$data->due_date}}</td>
									<td>{{$data->product}}</td>
									<td>{{$data->section->section_name}}</td>
									<td>{{$data->discount}}</td>
									<td>{{$data->rate_vat}}</td>
									<td>{{$data->value_vat}}</td>
									<td>{{$data->total}}</td>
									<td>
										@if($data->value_status == 1)
										 <span class="text-success">{{$data->status}}</span>
										@elseif ($data->value_status == 2) 
										 <span class="text-danger">{{$data->status}}</span>
										@else 
										 <span class="text-warning">{{$data->status}}</span>
										@endif
										</td>
									<td>{{$data->note}}</td>

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
								$i=0
								@endphp
								
								@foreach($details as $data)

									@php 
								$i++;
								@endphp
								
								<tr>
									<td>{{$i}}</td>
									<td>{{$data->invoice_number}}</td>
									<td>{{$data->product}}</td>
									<td>{{$data->section}}</td>
									<td>{{$data->value_status}}</td>
									<td>{{$data->note}}</td>
									<td>{{$data->user}}</td>

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
						
								</tr>
							</thead>
							<tbody>
								@php 
								$i=0
								@endphp
								
								@foreach($invoice_attachment as $data)

									@php 
								$i++;
								@endphp
								
								<tr>
									<td>{{$i}}</td>
									<td>{{$data->file_name}}</td>
									<td>{{$data->invoices_number}}</td>
									<td>{{$data->created_by}}</td>
									
						
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

@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection
</div>





