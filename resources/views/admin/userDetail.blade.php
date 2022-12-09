@extends('admin.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">User Detail</p>
            </div>
            <div>
                <a href="{{ route('admin.home') }}">
                    <div class="btn btn-error">
                        Back
                    </div>
                </a>
            </div>
        </div>
        <div class="mt-2 flex flex-col-2 bg-primary p-4 rounded-md">
            <div>
                <p class="text-semibold text-xl">Name</p>
                <p class="text-semibold text-xl">Email</p>
                <p class="text-semibold text-xl">Address</p>
                <p class="text-semibold text-xl">Phone</p>
            </div>
            <div class="ml-4">
                <p class="text-xl"> : {{ $user->name }}</p>
                <p class="text-xl"> : {{ $user->email }}</p>
                <p class="text-xl"> : {{ $user->address }}</p>
                <p class="text-xl"> : {{ $user->phone }}</p>
            </div>
        </div>
        <div class="mt-8">
            @if (count($history) == null)
                <p class="text-red-500 text-2xl">No History!</p>
            @else
                <p class="text-semibold text-3xl mb-8">User's History</p>
                <table class="table table-compact table-striped w-full">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Segment Name</th>
                            <th class="text-center">Start Time</th>
                            <th class="text-center">End Time</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $history)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $history->segmentation->name }}</td>
                                <td class="text-center">{{ $history->start_time }}</td>
                                <td class="text-center">{{ $history->end_time }}</td>
                                <td class="text-center">Rp. {{ $history->price }}</td>
                                {{-- <td class="text-center">{{ $history->status }}</td> --}}
                                @if ($history->status == '1')
                                    <td class="text-center">
                                        Already Paid
                                    </td>
                                @else
                                    <td class="text-center">
                                        Not Paid
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
