@extends('layouts.template')

@section('header')
    @include('customer.layouts.navbar')
@endsection

@section('main')

<div class="mt-24 mx-12 flex space-x-4">
    {{-- profile card --}}
    @include('customer.layouts.profile')
    {{-- transactions and vehicles --}}
    <div class="flex flex-col space-y-4 w-full">
        {{-- transactions --}}
        <div class="rounded-md p-8 shadow-xl bg-base-100 w-full flex flex-col space-y-3 border-2 border-base-200">
            <div class="flex items-center">
                <div class="text-2xl font-bold w-1/4">Add Vehicle</div>
                @if (Session::has('success'))
                    <div class="alert alert-success shadow-lg">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>{{ Session::get('success') }}</span>
                        </div>
                    </div>
                @endif
            </div>
            <form action="{{ route('customer.doAddVehicle') }}" method="POST">
                @csrf
                <div class="flex flex-col space-y-4">
                    <div class="flex flex-col space-y-1">
                        <label for="name" class="text-lg font-bold">Name</label>
                        <input type="text" name="name" id="name" class="input input-bordered w-full" placeholder="Vehicle Name">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="plate" class="text-lg font-bold">Plate</label>
                        <input type="text" name="plate" id="plate" class="input input-bordered w-full" placeholder="Vehicle Plate">
                        @error('plate')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="color" class="text-lg font-bold">Color</label>
                        <input type="text" name="color" id="color" class="input input-bordered w-full" placeholder="Vehicle Color">
                        <span class="text-sm text-gray-500">*Optional</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Vehicle</button>
                </div>
            </form>
        </div>
        {{-- vehicles --}}
        @include('customer.layouts.vehicles')
        </div>
    </div>
</div>

@endsection
