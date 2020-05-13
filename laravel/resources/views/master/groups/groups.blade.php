@extends('master.layouts.default')

@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>
        User Groups
			<small>it all starts here</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('user_menu') }}"><i class="fa fa-dashboard"></i> User Groups</a></li>
		</ol>
	</section>

	<!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-dttables box-info">
            <div class="row top-cursor">
                <div class="flash-message">
				<div class="col-md-12">
                    <div class="form-message">
                        @if (session('form_message'))
                        <div class="alert alert-warning alert-rounded alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php
                        $msg =session('form_message')['message'];
                            $html = (is_array($msg)) ? implode('<br/ >', $msg) : $msg;
                            $html .= '</div>';
                            echo $html;
                        ?>
                        @endif
                    </div>
                </div>
                </div>
                <div class="col-md-4 col-md-offset-8 text-right">
                 <a href="{{ $add_url }}" class="btn btn-success">Add</a>
                 <button type="button" class="btn btn-danger delete-record" data-url="{{ $delete_url }}">Delete</button>
                </div>
            </div>

            <div class="box-body">
			<table class="table table-striped table-bordered table-hover" id="dataTables-list">
                <thead>
                    <tr>
                        <th data-searchable="false" data-orderable="false" data-name="actions" data-classname="text-center"></th>
                        <th data-name="name">Name Groups</th>
                       <th data-name="create_at" data-searchable="false">Create Date</th>
                    </tr>
                </thead>
            </table>

            </div>
            <!--/.box-body-->

            <br/><br/>
            <div class="row">
                <div class="col-md-4 col-md-offset-8 text-right">
                    <a href="{{ $add_url }}" class="btn btn-success">Add</a>
                   <button type="button" class="btn btn-danger delete-record" data-url="{{ $delete_url }}">Delete</button>
                </div>
            </div>

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@section('script')
<script type="text/javascript">
    list_dataTables('#dataTables-list', '{{ $url_data }}');
</script>
@endsection
