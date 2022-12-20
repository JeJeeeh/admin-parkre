@extends('layouts.template')

@section('header')
    @include('customer.layouts.navbar')
@endsection

@section('main')

<div class="mt-24 w-3/4 p-8 border-2 border-base-200 mx-auto rounded-md shadow-xl flex flex-col space-y-4">
    <div class="flex justify-between space-x-6">
        <div class="text-4xl font-bold w-1/3">Profile Settings</div>
        @if (session('success'))
            <div class="alert alert-success shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>Your account has been updated!</span>
                </div>
            </div>
        @endif
    </div>
    <form action="{{ route('customer.doEditProfile') }}" class="flex space-x-8 justify-between" method="POST" enctype="multipart/form-data">
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
                <input type="password" name="password" id="password" class="input input-bordered w-full" placeholder="Your Password">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>

@endsection
