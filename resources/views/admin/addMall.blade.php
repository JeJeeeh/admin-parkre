@extends('admin.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Add Mall</p>
            </div>
            <div>
                <a href="{{ route('admin.mall') }}">
                    <div class="btn btn-error">
                        Back
                    </div>
                </a>
            </div>
        </div>
        <div class="card w-full h-84 bg-warning p-4 mt-4 space-y-4">
            <div>
                <input type="text" placeholder="Mall Name" class="input w-full" />
            </div>
            <div>
                <input type="text" placeholder="Mall Address" class="input w-full" />
            </div>
            {{-- park space --}}
            <div class="flex space-x-2">
                <div class="w-1/2">
                    <input type="number" min="0" placeholder="Park Space" class="input w-full" />
                </div>
                <div class="w-1/2">
                    <input type="number" min="0" placeholder="Reserve Space" class="input w-full" />
                </div>
                {{-- reserve space --}}
            </div>
        </div>
    @endsection
