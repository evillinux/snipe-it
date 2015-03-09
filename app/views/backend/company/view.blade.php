@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
@lang('admin/company/table.view') -
{{{ $company->name }}} ::
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="row header">
    <div class="col-md-12">
        <a href="{{ route('update/company', $company->id) }}" class="btn-flat white pull-right">
        @lang('admin/company/table.update')</a>
        <h3 class="name">
        @lang('admin/company/table.view_assets_for')
        {{{ $company->name }}} </h3>
    </div>
</div>

<div class="user-profile">
<div class="row profile">
<div class="col-md-9 bio">
    <div class="profile-box">

                            <!-- checked out company table -->
                            <h6>Assets</h6>
                            <br>
                            @if (count($company->assets) > 0)
                           <table id="example">
                            <thead>
                                <tr role="row">
                                        <th class="col-md-3">Name</th>
                                        <th class="col-md-3">Asset Tag</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($company->assets as $companyassets)
                                    <tr>
                                        <td><a href="{{ route('view/hardware', $companyassets->id) }}">{{{ $companyassets->name }}}</a></td>
                                        <td><a href="{{ route('view/hardware', $companyassets->id) }}">{{{ $companyassets->asset_tag }}}</a></td>                                      
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>

                            @else
                            <div class="col-md-12">
                                <div class="alert alert-info alert-block">
                                    <i class="fa fa-info-circle"></i>
                                    @lang('general.no_results')
                                </div>
                            </div>
                            @endif
                            <br>
                            <br>
                            <h6>Software</h6>
                            <br>
    </div>
</div>
@stop