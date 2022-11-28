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
    <div class="grid grid-cols-4 gap-4">
        @foreach ($malls as $mall)
            <div class="card bg-base-100 shadow-xl">
                <figure class="px-10 pt-10">
                    <img src="https://placeimg.com/400/225/arch" alt="Shoes" class="rounded-xl" />
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
