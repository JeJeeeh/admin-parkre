@extends('staff.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Announcement Detail</p>
            </div>
            <div>
                <a href="{{ route('staff.announcement') }}">
                    <div class="btn btn-error">
                        Back
                    </div>
                </a>
            </div>
        </div>
        <div class="mt-8 card w-full bg-primary text-primary-content p-4">
            <p class="font-semibold">Header : </p>
            <p>{{ $announcement->header }}</p>
            <p class="font-semibold">Content : </p>
            <p> {{ $announcement->content }}</p>
        </div>
    </div>
@endsection
