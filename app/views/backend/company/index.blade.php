@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('admin/company/table.companies')
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="row header">
    <div class="col-md-12">
        <a href="{{ route('create/company') }}" class="btn btn-success pull-right"><i class="fa fa-plus icon-white"></i>  @lang('general.create')</a>
        <h3>@lang('admin/company/table.companies')</h3>
    </div>
</div>

<div class="user-profile">
<div class="row profile">
<div class="col-md-12">

@if ($companies->count() >= 1)
<table id="example">
    <thead>
        <tr role="row">
            <th class="col-md-3">@lang('admin/company/table.name')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($companies as $company)
        <tr>
            <td><a href="{{ route('view/company', $company->id) }}">
            {{{ $company->name }}}
            </a>
        </tr>
        @endforeach
    </tbody>
</table>
@else
        @lang('general.no_results')

        @endif
</div>



</div>


@stop
