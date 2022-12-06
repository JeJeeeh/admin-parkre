@extends('layouts.template')

@section('header')
    @include('customer.layouts.navbar')
@endsection

@section('main')

<div class="flex flex-col space-y-12 mt-24 mx-12">
    <div class="flex space-x-8">
        <div class="flex flex-col space-y-6 w-1/3">
            <div class="flex flex-col space-y-4">
                <h1 class="text-3xl font-bold">{{ $mall->name }}</h1>
                <p class="text-lg">{{ $mall->address }}</p>
            </div>
            <div class="rounded-md">
                <figure>
                    <img class="rounded-md" src="https://placeimg.com/500/500/arch" alt="Mall Image"/>
                </figure>
            </div>
        </div>
        <div class="flex flex-col space-y-2 w-2/3">
            {{-- announcements --}}
            @if ($newAnnouncement)
                <div class="alert shadow-lg mb-4">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-info flex-shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <h3 class="font-bold">{{ $newAnnouncement->header }}</h3>
                            <div class="text-xs">{{ $newAnnouncement->content }}</div>
                        </div>
                    </div>
                </div>
            @endif
            <h1 class="text-xl font-bold">Available Mall Segmentations</h1>
            <div class="flex space-x-6 overflow-x-auto">
                @foreach ($mall->segmentations as $segmentation)
                    <div class="card w-72 bg-base-100 shadow-lg border-2 border-base-200">
                        <figure class="px-10 pt-10">
                            <img src="https://placeimg.com/400/225/arch" alt="Segmentation Image" class="rounded-xl" />
                        </figure>
                        <div class="card-body items-center text-center">
                            <h2 class="card-title">{{ $segmentation->name }}</h2>
                            <p>Available Parking Space : {{ $segmentation->park_space }}</p>
                            <p>Available Reserve Space : {{ $segmentation->reserve_space }}</p>
                            <form action="{{ route('customer.reserve', $mall->slug) }}">
                                <input type="hidden" name="segmentation" value="{{ $segmentation->slug }}">
                                <button class="btn btn-primary w-full" type="submit">Reserve a Park</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
