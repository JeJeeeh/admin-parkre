@extends('staff.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <p class="text-semibold text-3xl">Add Announcement</p>
        <div class="card max-w-md bg-primary text-primary-content mt-4">
            <div class="card-body">
                <form action="" method="POST" class="space-y-2 form-control">
                    @csrf
                    <div>
                        <input type="text" placeholder="Announcement Header" name="header" class="input w-full max-w-xs" />
                    </div>
                    <div>
                        <textarea class="textarea w-full max-w-xs" placeholder="Announcement Content" name="content"></textarea>
                    </div>
                    <div class="">
                        <select class="select w-full max-w-xs">
                            <option disabled selected>Select Mall Segmentation</option>
                            <option>All</option>
                            @foreach ($listSegment as $segment)
                                <option value="{{ $segment->id }}">{{ $segment->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
