@extends('master.layouts.default')

@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
			<small>it all starts here</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		</ol>
	</section>

</div>
<!-- /.content-wrapper -->

@endsection
