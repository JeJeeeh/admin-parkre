@extends('layouts.template')

@section('header')
    @include('customer.layouts.navbar')
@endsection

@section('main')

<div class="my-24 mx-12 flex flex-col space-y-12">
    {{-- announcements --}}
    @if ($newAnnouncement)
        <div class="alert shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-info flex-shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <h3 class="font-bold">{{ $newAnnouncement->header }}</h3>
                    <div class="text-xs">{{ $newAnnouncement->content }}</div>
                </div>
            </div>
        </div>
    @endif

    {{-- malls --}}
    <form action="{{ route('customer.search.mall') }}">
        <div class="form-control">
            <div class="input-group">
                <input type="text" placeholder="Search Mall..." class="input input-bordered w-full" name="keyword"/>
                <button class="btn btn-square" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </button>
            </div>
        </div>
    </form>
    <div class="grid grid-cols-4 gap-4">
        @foreach ($malls as $mall)
            <div class="card bg-base-100 shadow-xl">
                <figure class="px-10 pt-10">
                    {{-- <img src="{{$mall->image_url}}" alt="Shoes" class="rounded-xl" /> --}}
                @if ($mall->image_url == null)
                    <img class="rounded-md" src="https://placeimg.com/500/500/arch" alt="Mall Image"/>
                @else
                    <img class="rounded-xl" src="{{ asset('storage/' . $mall->image_url) }}" />
                @endif
                </figure>
                <div class="card-body items-center text-center">
                    <h2 class="card-title">{{ $mall->name }}</h2>
                    <p>{{ $mall->address }}</p>
                    <div class="card-actions">
                        <a href="{{ route('customer.mall.detail', $mall->slug) }}">
                            <button class="btn btn-primary">See Now</button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
