@extends('layouts.template')

@section('header')
    @include('layouts.navbar')
@endsection

@section('main')

<div class="flex flex-col space-y-12">
    {{-- Hero --}}
    <div class="hero min-h-screen" style="background-image: url(https://placeimg.com/1000/800/arch);">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
          <div class="max-w-md">
            <h1 class="mb-5 text-5xl font-bold">Hello there</h1>
            <p class="mb-5">Get to know available parking spaces now by using our service. Start using our service by first signing in.</p>
            <a href="{{ route('login') }}">
                <button class="btn btn-primary">Get Started</button>
            </a>
          </div>
        </div>
    </div>

    {{-- <div class="flex space-x-12 m-12">
        <div class="w-1/2 flex flex-col space-y-2">
            <div class="font-title font-semibold text-5xl">Powering Tomorrow's</div>
            <div class="font-title font-semibold text-5xl text-primary">Smart Transportation</div>
            <div class="font-title font-semibold text-5xl">Solutions</div>
            <div class="text-xl">We are dedicated to help people to go where they need</div>
        </div>
        <div class="w-1/2">
            TODO Image
        </div>
    </div>

    <div class="flex flex-col space-y-4 m-12">
        <div class="font-title font-semibold text-5xl text-center">
            <span class="text-primary">Products</span> and <span class="text-primary">Services</span>
        </div>
        <div class="flex justify-between space-x-12 items-center">
            <div class="w-1/2">TODO Image</div>
            <div class="w-1/2 flex flex-col space-y-4 items-middle">
                <div class="font-title font-semibold text-5xl">Mobile <span class="text-primary">Apps</span></div>
                <div class="font-bold text-3xl">One Stop Parking Solutions</div>
                <div class="text-xl">Find parking space in your favorite places, compare prices, check real-time availability, easy check out process, partner discounts, and more.</div>
            </div>
        </div>
    </div>

    <div class="flex m-12 space-x-12">
        <div class="w-1/2 flex flex-col space-y-2">
            <div class="font-title font-semibold text-5xl">Parking <span class="text-primary">System</span></div>
            <div class="font-title font-bold text-3xl">Off-Street Parking Solution</div>
            <div class="text-xl">New concept parking management systems managed by PC and mobile anytime, anywhere.</div>
        </div>
        <div class="w-1/2">
            TODO Image
        </div>
    </div> --}}
</div>

@endsection
