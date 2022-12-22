@extends('admin.layouts.template')

@section('content')
    <div class="py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Announcement Detail</p>
            </div>
            <div>
                <a href="{{ route('admin.editAnnouncement', $ann->id) }}">
                    <div class="btn btn-primary">
                        Edit
                    </div>
                </a>
                <a href="{{ route('admin.announcement') }}">
                    <div class="btn btn-error">
                        Back
                    </div>
                </a>
            </div>
        </div>
        <div class="mt-8 card w-full bg-primary text-primary-content p-4">
            <p class="font-semibold">Header : </p>
            <p>{{ $ann->header }}</p>
            <p class="font-semibold">Content : </p>
            <p> {{ $ann->content }}</p>
        </div>
    </div>
@endsection
