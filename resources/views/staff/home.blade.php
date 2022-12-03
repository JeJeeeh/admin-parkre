@extends('staff.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <p class="text-semibold text-3xl">Reservation List</p>
        <div class="mt-8">
            @if (count($listReservasi) == null)
                <p class="text-red-500 text-2xl">No Reservation!</p>
            @else
                <table class="table table-compact table-striped w-full">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Segment Name</th>
                            <th class="text-center">Start Time</th>
                            <th class="text-center">End Time</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listReservasi as $reservasi)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $reservasi->name }}</td>
                                <td class="text-center">{{ $reservasi->start_time }}</td>
                                <td class="text-center">{{ $reservasi->end_time }}</td>
                                <td class="text-center">
                                    <a href="{{ route('staff.reservationDetail', $reservasi->id) }}"
                                        class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
