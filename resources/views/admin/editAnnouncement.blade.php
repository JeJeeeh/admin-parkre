@extends('admin.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Edit Announcement</p>
            </div>
            <div>
                <a href="{{ route('admin.announcementDetail', $ann->id) }}">
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
                <form action="{{ route('admin.doEditAnnouncement') }}" class="space-y-4 w-full" method="POST">
                    @csrf
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-lg">Announcement Header</span>
                        </label>
                        <input type="text" placeholder="Announcement Header" name="header" class="input input-bordered"
                            value="{{ $ann->header }}" />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-lg">Announcement Content</span>
                        </label>
                        <textarea type="text" placeholder="Announcement Content" name="content" class="input input-bordered h-40 p-2">{{ $ann->content }}</textarea>
                    </div>
                    <div>
                        <select class="select w-full" name="mall">
                            <option selected value="{{ $ann->mall_id }}">
                                {{ $ann->mall->name }}
                            </option>
                            <option value="-1">All</option>
                            @foreach ($listMall as $mall)
                                <option value="{{ $mall->id }}">{{ $mall->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="id" value="{{ $ann->id }}">
                    <div>
                        <button class="btn w-full text-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
