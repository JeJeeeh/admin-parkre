@extends('layouts.template')

@section('header')
  @include('customer.layouts.navbar')
@endsection

@section('main')

<div class="mt-24 mx-12 flex flex-col space-y-12">

<h1 class="text-3xl font-bold">My Reservations</h1>

<div class="flex flex-col space-y-6">
  @forelse ($reservations as $reservation)
      <div class="p-6 rounded-xl bg-base-100 shadow-lg flex space-x-4 border-2 border-base-200">
        <div class="flex justify-center">
          <figure>
            <img src="https://placeimg.com/225/225/arch" alt="Mall Image" class="rounded-xl" />
          </figure>
        </div>
        <div class="flex flex-col justify-between w-full">
          <div class="flex flex-col space-y-2 w-full">
            <div class="flex justify-between">
                <div class="text-2xl font-bold">{{ $reservation->segmentation->mall->name }} - {{ $reservation->segmentation->name }}</div>
                <div class="text-xl">Date : {{ $reservation->date }}</div>
            </div>
              <p class="text-lg">Time : {{ $reservation->start_time }} - {{ $reservation->end_time }}</p>
              <p class="text-lg">Vehicle : {{ $reservation->vehicle->name }}</p>
          </div>
          <div class="flex justify-between">
            <div class="text-xl font-semibold align-text-bottom">Price : Rp. {{ $reservation->price }}</div>
            <div>
              @if ($reservation->status == 1)
              <div class="alert alert-success shadow-lg">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                  <span>Paid!</span>
                </div>
              </div>
              @else
              <form class="alert alert-warning shadow-lg" action="{{ route('customer.payment') }}">
                @csrf
                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                <button type="submit">
                  <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                  <span>Waiting Payment. Pay Now</span>
                </button>
              </form>
              @endif
            </div>
          </div>
        </div>

      </div>
  @empty
        <div class="text-center flex flex-col space-y-6">
            <h1 class="text-3xl font-bold">You don't have any reservation yet</h1>
            <a href="{{ route('customer.home') }}" class="btn btn-primary w-fit mx-auto">Find a Parking</a>
        </div>
  @endforelse
</div>

</div>

@endsection
