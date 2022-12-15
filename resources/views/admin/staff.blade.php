@extends('admin.layouts.template')

@section('content')
    <div class="py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">STAFF ONSITE LIST</p>
            </div>
            <div class="flex justify-between space-x-2">
                <a href="{{ route('admin.addStaff') }}">
                    <button class="btn btn-primary">ADD STAFF</button>
                </a>
                <a href="{{ route('admin.addJob') }}">
                    <button class="btn btn-primary">ADD JOB</button>
                </a>
            </div>
        </div>
        <div class="mt-2">
            <form action="{{ route('admin.searchStaff') }}" method="POST">
                @csrf
                <input type="text" placeholder="Search" name="search"
                    class="input input-bordered border-primary w-full max-w-xs placeholder:text-primary" />
                <button class="btn btn-primary">Search</button>
                </button>
            </form>
        </div>
        <div class="mt-8">
            @if (count($listStaff) == null)
                <p class="text-red-500 text-2xl">Staff Not Found!</p>
            @else
                <table class="table table-compact table-striped w-full">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            {{-- <th class="text-center">Email</th> --}}
                            <th class="text-center">Phone</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listStaff as $staff)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $staff->name }}</td>
                                <td class="text-center">{{ $staff->phone }}</td>
                                <td class="text-center">{{ $staff->address }}</td>
                                @if ($staff->trashed())
                                    <td class="text-center">
                                        <a href="{{ route('admin.staffDetail', $staff->id) }}"
                                            class="btn btn-disabled disable">Detail</a>
                                        <a href="{{ route('admin.unblockStaff', $staff->id) }}"
                                            class="btn btn-error">Unblock</a>
                                    </td>
                                @else
                                    <td class="text-center">
                                        <a href="{{ route('admin.staffDetail', $staff->id) }}"
                                            class="btn btn-primary">Detail</a>
                                        <a href="{{ route('admin.blockStaff', $staff->id) }}"
                                            class="btn btn-error">Block</a>
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
