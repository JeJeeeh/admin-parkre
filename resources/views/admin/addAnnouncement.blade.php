@extends('admin.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Add Announcement</p>
            </div>
            <div>
                <a href="{{ route('admin.announcement') }}">
                    <div class="btn btn-error">
                        Back
                    </div>
                </a>
            </div>
        </div>
        <div class="card w-full h-84 bg-primary p-4 mt-4">
            <div class="space-y-2">
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
            </div>
            <form action="{{ route('admin.doAddAnnouncement') }}" class="space-y-4" method="POST">
                @csrf
                <div>
                    <select class="select w-full" name="mall">
                        <option disabled selected value="-2">Select Mall</option>
                        <option value="-1">All</option>
                        @foreach ($listMall as $mall)
                            <option value="{{ $mall->id }}">{{ $mall->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <input type="text" placeholder="Announcement Header" name='header' value="{{ old('header') }}"
                        class="input w-full" />
                </div>
                <div>
                    <textarea class="textarea w-full h-48" placeholder="Announcement Content" name="content" value='{{ old('content') }}'></textarea>
                </div>
                <div>
                    <button class="btn w-full text-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
