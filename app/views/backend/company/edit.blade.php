@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
    @if ($company->id)
        @lang('admin/company/table.update') ::
    @else
        @lang('admin/company/table.create') ::
    @endif
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="row header">
    <div class="col-md-9">
        <a href="{{ URL::previous() }}" class="btn-flat gray pull-right"><i class="fa fa-arrow-left icon-white"></i>  @lang('general.back')</a>
        <h3>
        @if ($company->id)
            @lang('admin/company/table.update')
        @else
            @lang('admin/company/table.create')
        @endif
    </h3>
    </div>
</div>

<div class="user-profile">
    <div class="row profile">
        <div class="col-md-9">

           {{ Form::open(['method' => 'POST', 'files' => true, 'class' => 'form-horizontal', 'autocomplete' => 'off' ]) }}
                <!-- CSRF Token -->
                {{ Form::token() }}

                        <!-- Name -->
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ HTML::decode(Form::label('name', Lang::get('admin/company/table.name').' <i class="fa fa-asterisk"></i>', array('class' => 'col-md-3 control-label'))) }}
                                <div class="col-md-6">
                                    {{Form::text('name', Input::old('name', $company->name), array('class' => 'form-control')) }}
                                    {{ $errors->first('name', '<br><span class="alert-msg"><i class="fa fa-times"></i> :message</span>') }}
                                </div>
                        </div>
                      
                    <!-- Form actions -->
                    <div class="form-group">
                    {{ Form::label('', ' ', array('class' => 'col-md-3 control-label')) }}
                        <div class="col-md-7">
                            @if ($company->id)
                            <a class="btn btn-link" href="{{ URL::previous() }}">@lang('button.cancel')</a>
                            @else
                            <a class="btn btn-link" href="{{ route('company') }}">@lang('button.cancel')</a>
                            @endif
                            <button type="submit" class="btn btn-success"><i class="fa fa-ok icon-white"></i> @lang('general.save')</button>
                        </div>
                    </div>

            </form>

        </div>
    </div>
</div>

@stop