@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
     @lang('admin/hardware/general.checkin') ::
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="row header">
    <div class="col-md-12">
        <a href="{{ URL::previous() }}" class="btn-flat gray pull-right"><i class="fa fa-arrow-left icon-white"></i>  @lang('general.back')</a>
        <h3> @lang('admin/hardware/general.checkin')</h3>
    </div>
</div>

<div class="row form-wrapper">
<!-- left column -->
<div class="col-md-10 column">

<form class="form-horizontal" method="post" action="" autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <!-- Asset tag -->
            <div class="form-group">
            <label class="col-sm-2 control-label">@lang('admin/hardware/form.tag')</label>
                <div class="col-md-6">
                  <p class="form-control-static">{{{ $asset->asset_tag }}}</p>
                </div>
            </div>

			@if ($asset->name)
            <!-- Asset name -->
            <div class="form-group">
            <label class="col-sm-2 control-label">@lang('admin/hardware/form.name')</label>
                <div class="col-md-6">
                  <p class="form-control-static">{{{ $asset->name }}}</p>
                </div>
            </div>
            @endif

            <!-- Note -->
            <div class="form-group {{ $errors->has('note') ? 'error' : '' }}">
                <label for="note" class="col-md-2 control-label">@lang('admin/hardware/form.notes')</label>
                <div class="col-md-7">
                    <textarea class="col-md-6 form-control" id="note" name="note">{{{ Input::old('note', $asset->note) }}}</textarea>
                    {{ $errors->first('note', '<br><span class="alert-msg"><i class="fa fa-times"></i> :message</span>') }}
                </div>
            </div>
            <!-- Form actions -->
                <div class="form-group">
                <label class="col-md-2 control-label"></label>
                    <div class="col-md-7">
                        <a class="btn btn-link" href="{{ URL::previous() }}">@lang('button.cancel')</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-ok icon-white"></i>@lang('general.checkin')</button>
                    </div>
                </div>

</form>
</div>
</div>

@stop
