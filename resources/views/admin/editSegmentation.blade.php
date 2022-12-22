@extends('admin.layouts.template')

@section('content')
    <div class="py-8 px-4">
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
        <div>
            <form action="{{ route('admin.doEditSegmentation') }}" enctype="multipart/form-data" class="space-y-4"
                method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $segmentation->id }}">
                <div class="w-full h-84 bg-primary rounded-xl p-4  space-y-2">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-error w-full">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success w-full">
                            {{ Session::get('success') }}
                        </div>
                    @else
                    @endif
                    <div class="flex">
                        <div class="w-1/4 space-y-2 mt-8">
                            <div class="flex">
                                <figure>
                                    @if ($segmentation->image_url == null)
                                        <img src="{{ asset('images/default.png') }}" />
                                    @else
                                        <img class="rounded-full"
                                            src="{{ asset('storage/' . $segmentation->image_url) }}" />
                                    @endif
                                </figure>
                            </div>
                            <input type="file" name="image" class="file-input file-input-bordered w-full max-w-xs" />
                        </div>
                        <div class="w-3/4 p-4 space-y-4">
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Segment Name</span>
                                </label>
                                <input type="text" placeholder="Type here" name="name"
                                    value="{{ $segmentation->name }}" class="input input-bordered w-full" />
                            </div>
                            <div class="flex justify-between space-x-2">
                                <div class="form-control w-1/2">
                                    <label class="label">
                                        <span class="label-text">Park Space</span>
                                    </label>
                                    <input type="number" min="1" placeholder="Park Space"
                                        value="{{ $segmentation->park_space }}" name="park_space" class="input w-full" />
                                </div>
                                <div class="form-control w-1/2">
                                    <label class="label">
                                        <span class="label-text">Reserve Space</span>
                                    </label>
                                    <input type="number" min="1" placeholder="Reserve Space"
                                        value="{{ $segmentation->reserve_space }}" name="reserve_space"
                                        class="input w-full" />
                                </div>
                            </div>
                            <div class="flex justify-between space-x-2">
                                <div class="form-control w-1/2">
                                    <label class="label">
                                        <span class="label-text">Initial Price</span>
                                    </label>
                                    <input type="number" min="1" placeholder="Initial Price"
                                        value="{{ $segmentation->initial_price }}" name="initial_price"
                                        class="input w-full" />
                                </div>
                                <div class="form-control w-1/2">
                                    <label class="label">
                                        <span class="label-text">Hourly Space</span>
                                    </label>
                                    <input type="number" min="1" placeholder="hourly Space"
                                        value="{{ $segmentation->price }}" name="price" class="input w-full" />
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn w-full text-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
