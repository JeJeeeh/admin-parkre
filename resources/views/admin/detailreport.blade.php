@extends('admin.layouts.template')

@push('chart_script')
    @vite('resources/js/details_chart.js')
@endpush

@section('content')
    <div class="py-8 px-4">
        <div>
            <p class="text-semibold text-3xl">Detail Report</p>
        </div>
        <div class="mt-4">
            <div class="stats shadow">

                <div class="stat">
                    <div class="stat-title"></div>
                    <div class="stat-value"></div>
                    <div class="stat-desc"></div>
                    {{-- <div class="stat-title">Successful Transactions This Month</div>
                    <div class="stat-value">89,400</div>
                    <div class="stat-desc">21% of this year</div> --}}
                </div>

            </div>
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">Filter :</span>
                </label>
                <input type="hidden" id="type-selector" value="{{ $type }}">
                <select id="month-selector" class="select select-primary select-bordered">
                    <option selected value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <div id="canvas-parent" class="mt-4">
                <canvas id="detail-report" height="250px"></canvas>
            </div>
        </div>
    </div>
@endsection
