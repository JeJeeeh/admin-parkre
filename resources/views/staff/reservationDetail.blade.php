@extends('staff.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Reservation Detail</p>
            </div>
            <div>
                <a href="{{ route('staff.home') }}">
                    <div class="btn btn-error">
                        Back
                    </div>
                </a>
            </div>
        </div>
        <div class="mt-8">
            <table class="table table-compact table-striped w-full">
                <thead>
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Segment</th>
                        <th class="text-center">Initial Price</th>
                        <th class="text-center">Price/Hour</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">{{ $reservasi->user->name }}</td>
                        <td class="text-center">{{ $reservasi->segmentation->name }}</td>
                        <td class="text-center">Rp. {{ $reservasi->segmentation->initial_price }}</td>
                        <td class="text-center">Rp. {{ $reservasi->segmentation->price }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
