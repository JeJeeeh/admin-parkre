@extends('staff.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <p class="text-semibold text-3xl">Reservation List</p>
        @if ($listReservasi != null)
            <div class="mt-8">
                <table class="table table-compact table-striped w-full">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Segment</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listReservasi as $reservasi)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $reservasi->user->name }}</td>
                                <td class="text-center">{{ $reservasi->segmentation->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('staff.reservationDetail', $reservasi->id) }}"
                                        class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <h1>No Reservation</h1>
        @endif
    </div>
@endsection
