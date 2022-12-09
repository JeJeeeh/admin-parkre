@extends('admin.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Edit Segment</p>
            </div>
            <div>
                <a href="{{ route('admin.segmentation', $segmentation->id) }}">
                    <div class="btn btn-error">
                        Back
                    </div>
                </a>
            </div>
        </div>
        <div class="mt-2 bg-primary p-4 rounded-md">
            <div class="w-full">
                {{-- error message --}}
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-error">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div>
                <form action="{{ route('admin.doEditSegmentation') }}" class="space-y-4 w-full" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $segmentation->id }}">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-lg">Segmentation Name</span>
                        </label>
                        <input type="text" placeholder="Segmentation Name" name="name" class="input input-bordered"
                            value="{{ $segmentation->name }}" />
                    </div>
                    <div class="flex justify-between space-x-2">
                        <div class="form-control w-1/2">
                            <label class="label">
                                <span class="label-text text-lg">Park Space</span>
                            </label>
                            <input type="number" min="1" placeholder="Park Space" name="park_space"
                                class="input input-bordered" value="{{ $segmentation->park_space }}" />
                        </div>
                        <div class="form-control w-1/2">
                            <label class="label">
                                <span class="label-text text-lg">Reserve Space</span>
                            </label>
                            <input type="number" min="1" placeholder="Reserve Space" name="reserve_space"
                                class="input input-bordered" value="{{ $segmentation->reserve_space }}" />
                        </div>
                    </div>
                    <div class="flex justify-between space-x-2">
                        <div class="form-control w-1/2">
                            <label class="label">
                                <span class="label-text text-lg">Initial Price</span>
                            </label>
                            <input type="number" min="1" placeholder="Initial Price" name="initial_price"
                                class="input input-bordered" value="{{ $segmentation->initial_price }}" />
                        </div>
                        <div class="form-control w-1/2">
                            <label class="label">
                                <span class="label-text text-lg">Price</span>
                            </label>
                            <input type="number" min="1" placeholder="Price" name="price"
                                class="input input-bordered" value="{{ $segmentation->price }}" />
                        </div>
                    </div>
                    <div>
                        <button class="btn w-full text-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
