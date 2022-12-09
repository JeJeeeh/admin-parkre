@extends('admin.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Edit Mall</p>
            </div>
            <div>
                <a href="{{ route('admin.mall') }}">
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
                <form action="{{ route('admin.doEditMall') }}" class="space-y-4 w-full" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $mall->id }}">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-lg">Mall Name</span>
                        </label>
                        <input type="text" placeholder="Mall Name" name="name" class="input input-bordered"
                            value="{{ $mall->name }}" />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-lg">Mall Address</span>
                        </label>
                        <input type="text" placeholder="Mall Address" name="address" class="input input-bordered"
                            value="{{ $mall->address }}" />
                    </div>
                    <div class="flex justify-between space-x-2">
                        <div class="form-control w-1/2">
                            <label class="label">
                                <span class="label-text text-lg">Park Space</span>
                            </label>
                            <input type="number" min="1" placeholder="Park Space" name="park_space"
                                class="input input-bordered" value="{{ $mall->park_space }}" />
                        </div>
                        <div class="form-control w-1/2">
                            <label class="label">
                                <span class="label-text text-lg">Reserve Space</span>
                            </label>
                            <input type="number" min="1" placeholder="Reserve Space" name="reserve_space"
                                class="input input-bordered" value="{{ $mall->reserve_space }}" />
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
