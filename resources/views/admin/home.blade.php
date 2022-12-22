@extends('admin.layouts.template')

@section('content')
    <div class="py-8 px-4">
        <p class="text-semibold text-3xl">USER LIST</p>
        <div class="mt-2">
            <form action="{{ route('admin.searchUser') }}" method="POST">
                @csrf
                <input type="text" placeholder="Search" name="search"
                    class="input input-bordered border-primary w-full max-w-xs placeholder:text-primary" />
                <button class="btn btn-primary">Search</button>
                </button>
            </form>
        </div>
        <div class="mt-8">
            @if (count($listUser) == null)
                <p class="text-red-500 text-2xl">User Not Found!</p>
            @else
                <table class="table table-compact table-striped w-full">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Phone</th>
                            {{-- <th class="text-center">Address</th> --}}
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listUser as $user)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $user->name }}</td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">{{ $user->phone }}</td>
                                {{-- <td class="text-center">{{ $user->address }}</td> --}}
                                @if ($user->trashed())
                                    <td class="text-center">
                                        <a href="{{ route('admin.userDetail', $user->id) }}"
                                            class="btn btn-disabled disable">Detail</a>
                                        <a href="{{ route('admin.unblockUser', $user->id) }}"
                                            class="btn btn-error">Unblock</a>
                                    </td>
                                @else
                                    <td class="text-center">
                                        <a href="{{ route('admin.userDetail', $user->id) }}"
                                            class="btn btn-primary">Detail</a>
                                        <a href="{{ route('admin.blockUser', $user->id) }}" class="btn btn-error">Block</a>
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
