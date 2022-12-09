@extends('admin.layouts.template')

@push('chart_script')
    @vite('resources/js/admin_chart.js')
@endpush

@section('content')
    <div class="mt-16 py-8 px-4">
        <div>
            <p class="text-semibold text-3xl">Report List</p>
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div class="flex flex-col border">
                <div>
                    <canvas id="transaksi_user" height="250px"></canvas>
                </div>
                <div class="p-2">
                    <a href="" class="btn btn-primary w-full">Details</a>
                </div>
            </div>
            <div class="flex flex-col border">
                <div>
                    <canvas id="keuntungan_customer" height="250px"></canvas>
                </div>
                <div class="p-2">
                    <a href="" class="btn btn-primary w-full">Details</a>
                </div>
            </div>
            <div class="flex flex-col border">
                <div>
                    <canvas id="reservasi_customer" height="250px"></canvas>
                </div>
                <div class="p-2">
                    <a href="" class="btn btn-primary w-full">Details</a>
                </div>
            </div>
            <div class="flex flex-col border">
                <div>
                    <canvas id="reservasi_sukses" height="250px"></canvas>
                </div>
                <div class="p-2">
                    <a href="" class="btn btn-primary w-full">Details</a>
                </div>
            </div>
            <div class="flex flex-col border">
                <div>
                    <canvas id="review_customer" height="250px"></canvas>
                </div>
                <div class="p-2">
                    <a href="" class="btn btn-primary w-full">Details</a>
                </div>
            </div>
        </div>
    </div>
@endsection
