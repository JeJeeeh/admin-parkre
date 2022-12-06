@extends('staff.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <p class="text-semibold text-3xl mb-2">Add Announcement</p>
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
        <div class="card w-full bg-primary text-primary-content mt-4">
            <div class="card-body">
                <form action="{{ route('staff.doAddAnnouncement') }}" method="POST" class="space-y-2 form-control">
                    @csrf
                    <div>
                        <input type="text" placeholder="Announcement Header" name="header" class="input w-full"
                            value="{{ old('header') }}" />
                    </div>
                    <div>
                        <textarea class="textarea w-full h-48" placeholder="Announcement Content" name="content" value='{{ old('content') }}'></textarea>
                    </div>
                    <div>
                        {{-- <label class="label">
                            <span class="label-text">Select Mall Segmentation</span>
                        </label> --}}
                        <select class="select w-full" name="mall">
                            <option disabled selected value="-1">Select Mall</option>
                            {{-- <option value="-1">All</option> --}}
                            @foreach ($listMall as $mall)
                                <option value="{{ $mall->id }}">{{ $mall->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button class="btn w-full">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
