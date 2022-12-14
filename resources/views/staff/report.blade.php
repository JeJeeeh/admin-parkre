@extends('staff.layouts.template')

@push('chart_script')
    @vite('resources/js/staff_chart.js')
@endpush

@section('content')
    <div class="mt-16 py-8 px-4">
        <div>
            <p class="text-semibold text-3xl">Report List</p>
        </div>
        <div>
            <canvas id="myChart" height="100px"></canvas>
        </div>
        <div>
            <canvas id="myChart2" height="100px"></canvas>
        </div>
    </div>
@endsection
