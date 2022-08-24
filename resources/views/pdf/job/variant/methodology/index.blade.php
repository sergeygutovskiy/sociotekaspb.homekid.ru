@extends('pdf.job.layout.index')

@section('content')
    <div class="page-breaker">
        @include('pdf.job.template.primary-information.index')
    </div>
    <div class="page-breaker">
        @include('pdf.job.variant.methodology.info')
    </div>
    <div class="page-breaker">
        @include('pdf.job.template.experience.index')
    </div>
    <div class="page-breaker">
        @include('pdf.job.template.contacts.index')
    </div>

    @include('pdf.job.template.reporting-periods.index')
@endsection