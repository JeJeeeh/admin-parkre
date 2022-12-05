@extends('admin.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">MALL LIST</p>
            </div>
            <div class="flex justify-between space-x-2">
                <form action="{{ route('admin.addMall') }}">
                    <button class="btn btn-primary">ADD MALL</button>
                </form>
                <a href="{{ route('admin.addSegmentation') }}">
                    <div class="btn btn-primary">
                        Add Segmentation
                    </div>
                </a>
            </div>
        </div>
        <div class="mt-2">
            <form action="{{ route('admin.searchMall') }}" method="POST">
                @csrf
                <input type="text" placeholder="Search" name="search"
                    class="input input-bordered border-primary w-full max-w-xs placeholder:text-primary" />
                <button class="btn btn-primary">Search</button>
                </button>
            </form>
        </div>
        <div class="mt-8">
            @if (count($listMall) == null)
                <p class="text-red-500 text-2xl">Mall Not Found!</p>
            @else
                <table class="table table-compact table-striped w-full">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Park Space</th>
                            <th class="text-center">Reserve Space</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listMall as $mall)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $mall->name }}</td>
                                <td class="text-center">{{ $mall->address }}</td>
                                <td class="text-center">{{ $mall->park_space }}</td>
                                <td class="text-center">{{ $mall->reserve_space }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.mallDetail', $mall->id) }}" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
