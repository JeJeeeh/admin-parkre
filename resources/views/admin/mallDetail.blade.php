@extends('admin.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Mall Detail</p>
                {{-- success message --}}
                @if (Session::has('success'))
                    <div class="alert alert-success w-full">
                        {{ Session::get('success') }}
                    </div>
                @endif
            </div>
            <div>
                <a href="{{ route('admin.editMall', $mall->id) }}">
                    <div class="btn btn-primary">
                        Edit
                    </div>
                </a>
                <a href="{{ route('admin.mall') }}">
                    <div class="btn btn-error">
                        Back
                    </div>
                </a>
            </div>
        </div>
        <div class="mt-2 flex flex-col-2 bg-primary p-4 rounded-md">
            <div>
                @if ($mall->image_url == null)
                    <img class="rounded-full w-48" src="{{ asset('images/default.png') }}" />
                @else
                    <img class="rounded-full w-48" src="{{ asset('storage/' . $mall->image_url) }}" />
                @endif
            </div>
            <div class="ml-8">
                <p class="text-semibold text-xl">Name : {{ $mall->name }}</p>
                <p class="text-semibold text-xl">Address : {{ $mall->address }}</p>
                <p class="text-semibold text-xl">Park Space : {{ $mall->park_space }}</p>
                <p class="text-semibold text-xl">Reserve Space : {{ $mall->reserve_space }}</p>
            </div>
        </div>
        <div class="flex justify-between mt-4">
            <div>
                <p class="text-semibold text-3xl">Segmentation List</p>
            </div>
        </div>
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
                                @if ($segment->trashed())
                                    <td class="text-center">
                                        <a href="{{ route('admin.segmentation', $segment->id) }}"
                                            class="btn btn-disabled disable">Detail</a>
                                        <a href="{{ route('admin.unblockSegmentation', $segment->id) }}"
                                            class="btn btn-error">Unblock</a>
                                    </td>
                                @else
                                    <td class="text-center">
                                        <a href="{{ route('admin.segmentation', $segment->id) }}"
                                            class="btn btn-primary">Detail</a>
                                        <a href="{{ route('admin.blockSegmentation', $segment->id) }}"
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
