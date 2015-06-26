@extends('base')

{{-- Page title --}}
@section('title')@lang('admin/index.dashboard') @parent

@stop
{{-- page level styles --}}
@section('header_styles')
@stop

{{-- Page content --}}
@section('content')
    <div class="row">
        <div class="lock-container">
            <div class="col-lg-12 text-center m-t-md animated-panel zoomIn" style="animation-delay: 0.1s;">
                <h1> SimpleInvoice </h1>
                <h4> {{$simpleInvoiceVersion or ""}} </h4>
            </div>
        </div>
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop