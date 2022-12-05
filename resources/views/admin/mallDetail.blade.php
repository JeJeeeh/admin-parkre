@extends('admin.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Mall Detail</p>
            </div>
            <div>
                <a href="{{ route('admin.mall') }}">
                    <div class="btn btn-error">
                        Back
                    </div>
                </a>
            </div>
        </div>
        <div class="mt-2 flex flex-col-2 bg-warning p-4 rounded-md">
            <div>
                <p class="text-semibold text-xl">Name</p>
                <p class="text-semibold text-xl">Address</p>
                <p class="text-semibold text-xl">Park Space</p>
                <p class="text-semibold text-xl">Reserve Space</p>
            </div>
            <div class="ml-4">
                <p class="text-xl"> : {{ $mall->name }}</p>
                <p class="text-xl"> : {{ $mall->address }}</p>
                <p class="text-xl"> : {{ $mall->park_space }}</p>
                <p class="text-xl"> : {{ $mall->reserve_space }}</p>
            </div>
        </div>
        <p class="text-semibold text-3xl mt-4">Segmentation List</p>
        <div class="mt-8">
            @if (count($listSegment) == null)
                <p class="text-red-500 text-2xl">No Segmentation!</p>
            @else
                <table class="table table-compact table-striped w-full">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Park Space</th>
                            <th class="text-center">Reserve Space</th>
                            <th class="text-center">Initial Price</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listSegment as $segment)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $segment->name }}</td>
                                <td class="text-center">{{ $segment->park_space }}</td>
                                <td class="text-center">{{ $segment->reserve_space }}</td>
                                <td class="text-center">Rp. {{ $segment->initial_price }}</td>
                                <td class="text-center">
                                    <a href="{{ route('staff.reservationDetail', $segment->id, $mall->id) }}"
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
