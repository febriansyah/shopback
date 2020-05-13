@extends('master.layouts.default')

@section('content')

<div class="content-wrapper">
<section class="content-header">
		<h1>
			Groups
			<small>it all starts here</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('groups') }}"><i class="fa fa-dashboard"></i> Groups</a></li>
		</ol>
	</section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-header">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-message">
                            @if (session('form_message'))
                            {!! alert_box(session('form_message')['message'], session('form_message')['status']) !!}
                            @endif
                        </div>
                    </div>
                </div>

                <form action="{{ $form_action }}" method="post" accept-charset="utf-8" id="form-data" role="form">
                    {!! csrf_field() !!}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" id="select-all"/> <label for="select-all">Select All</label>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                @include(backend_path('.groups.menus'), ['menu_listing' => $user_menus['root'], 'prefix' => ''])
                            </div>
                        </div>
                    </div>
                    <div class="row button-row">
                        <div class="col-md-12 text-left">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-danger" href="{{ $data_url }}; ?>">Cancel</a>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </form>
            </div>
        </div>
        <!--/.box-body-->
    </section>
</div>
<!--/.box-->

@endsection

@section('script')
<script type="text/javascript">
    $(function() {
        $('#select-all').on('ifChecked', function (e) {
            $('.checkauth').iCheck('check');
        })
        $('#select-all').on('ifUnchecked', function (e) {
            $('.checkauth').iCheck('uncheck');
        })
        if ($('.checkauth:checked').length == $('.checkauth').length) {
            $('#select-all').iCheck('check');
        }
    });
</script>
@endsection
