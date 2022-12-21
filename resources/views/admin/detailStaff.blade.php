@extends('admin.layouts.template')

@section('content')
    <div class="py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Staff Detail</p>
                @if (Session::has('success'))
                    <div class="alert alert-success w-full">
                        {{ Session::get('success') }}
                    </div>
                @endif
            </div>
            <div>
                <a href="{{ route('admin.staff') }}">
                    <div class="btn btn-error">
                        Back
                    </div>
                </a>
            </div>
        </div>
        <div class="mt-2 flex flex-col-2 bg-primary p-4 rounded-md">
            <div class="ml-2">
                <p class="text-semibold text-xl">Name : {{ $staff->name }}</p>
                <p class="text-semibold text-xl">Phone : {{ $staff->phone }}</p>
                <p class="text-semibold text-xl">Address : {{ $staff->address }}</p>
            </div>
        </div>
        <div>
            <p class="text-semibold text-3xl my-2">Jobs</p>
            @if (count($listJob) == null)
                <p class="text-red-500 text-2xl">No Job!</p>
            @else
                <table class="table table-compact table-striped w-full">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Mall</th>
                            <th class="text-center">Start Date</th>
                            <th class="text-center">End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listJob as $job)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $job->mall->name }}</td>
                                <td class="text-center">{{ $job->start_date }}</td>
                                <td class="text-center">{{ $job->end_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
