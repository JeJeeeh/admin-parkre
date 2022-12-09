@extends('layouts.template')

@section('header')
    @include('customer.layouts.navbar')
@endsection

@section('main')

<div class="mt-24 w-3/4 p-8 border-2 border-base-200 mx-auto rounded-md shadow-xl flex flex-col space-y-4">
    <div class="text-4xl font-bold">Profile Settings</div>
    <form action="" class="flex space-x-8 justify-between" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col space-y-6 w-1/4">
            <div class="flex justify-center">
                <figure>
                    @if ($activeUser->image_url == null)
                        <img src="{{ asset('images/default.png') }}" />
                    @else
                        <img class="rounded-full" src="{{ asset('storage/' . $activeUser->image_url) }}" />
                    @endif
                </figure>
            </div>
            <input type="file" name="image" class="file-input file-input-bordered w-full max-w-xs" />
            @error('image')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex flex-col space-y-4 w-3/4">
            <div class="flex flex-col space-y-1">
                <label for="name" class="text-lg font-bold">Name</label>
                <input type="text" name="name" id="name" class="input input-bordered w-full" placeholder="Your Name" value="{{ $activeUser->name }}">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col space-y-1">
                <label for="address" class="text-lg font-bold">Address</label>
                <input type="text" name="address" id="address" class="input input-bordered w-full" placeholder="Your Address" value="{{ $activeUser->address }}">
                @error('address')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col space-y-1">
                <label for="phone" class="text-lg font-bold">Phone</label>
                <input type="text" name="phone" id="phone" class="input input-bordered w-full" placeholder="Your Phone" value="{{ $activeUser->phone }}">
                @error('phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col space-y-1">
                <label for="password" class="text-lg font-bold">Password</label>
                <input type="text" name="password" id="password" class="input input-bordered w-full" placeholder="Your Password">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>

@endsection
