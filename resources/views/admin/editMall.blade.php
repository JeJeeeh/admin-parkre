@extends('admin.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Edit Mall</p>
            </div>
            <div>
                <a href="{{ route('admin.mallDetail', $mall->id) }}">
                    <div class="btn btn-error">
                        Back
                    </div>
                </a>
            </div>
        </div>
        <div>
            <form action="{{ route('admin.doEditMall') }}" enctype="multipart/form-data" class="space-y-4" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $mall->id }}">
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
                        <div class="w-1/4 space-y-2">
                            <div class="flex mt-16">
                                <figure>
                                    @if ($mall->image_url == null)
                                        <img src="{{ asset('images/default.png') }}" />
                                    @else
                                        <img class="rounded-full" src="{{ asset('storage/' . $mall->image_url) }}" />
                                    @endif
                                </figure>
                            </div>
                            <input type="file" name="image" class="file-input file-input-bordered w-full max-w-xs" />
                        </div>
                        <div class="w-3/4 p-4 space-y-10 mt-2">
                            <div>
                                <label class="label">
                                    <span class="label-text">Mall Name</span>
                                </label>
                                <input type="text" placeholder="Mall Name" value="{{ $mall->name }}" name='name'
                                    class="input w-full" />
                            </div>
                            <div>
                                <label class="label">
                                    <span class="label-text">Mall Address</span>
                                </label>
                                <input type="text" placeholder="Mall Address" value="{{ $mall->address }}" name="address"
                                    class="input w-full" />
                            </div>
                            <div class="flex justify-between space-x-2">
                                <div class="w-1/2">
                                    <label class="label">
                                        <span class="label-text">Parking Space</span>
                                    </label>
                                    <input type="number" min="1" placeholder="Park Space"
                                        value="{{ $mall->park_space }}" name="park_space" class="input w-full" />
                                </div>
                                <div class="w-1/2">
                                    <label class="label">
                                        <span class="label-text">Reserve Space</span>
                                    </label>
                                    <input type="number" min="1" placeholder="Reserve Space"
                                        value="{{ $mall->reserve_space }}" name="reserve_space" class="input w-full" />
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
