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

                <form action="{{ $form_action }}" method="post" accept-charset="utf-8" id="form-data" role="form">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Group Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ ( old('name') ? old('name') : ( (isset($data['name'])) ? $data['name'] : '') ) }}" required="required" />
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-2">
                            @if (auth_user()->is_superadmin)
                            <div class="form-group">
                                <label for="is_superadmin">Super Administrator</label>
                                <div class="checkbox">
                                    <label class="no-padding">
                                        <input type="checkbox" class="iCheckBox" value="1" name="is_superadmin" id="is_superadmin"
                                            @if (old())
                                                @if (old('is_superadmin') == 1)
                                                checked="checked"
                                                @endif
                                            @elseif (isset($data['is_superadmin']) && $data['is_superadmin'] == 1)
                                                checked="checked"
                                            @endif
                                        /> Yes
                                    </label>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row button-row">
                        <div class="col-md-12 text-left">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-danger" href="{{ $data_url }}">Cancel</a>
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
