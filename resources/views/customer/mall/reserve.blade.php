@extends('layouts.template')

@section('header')
    @include('customer.layouts.navbar')
@endsection

@section('main')

<div class="mt-24 mx-12 flex flex-col space-y-12">

    <div class="flex space-x-4">
        <div class="flex flex-col space-y-4">
            <div class="flex flex-col space-y-2">
                <h1 class="text-3xl font-bold">Reserve Park at {{ $segmentation->name }}</h1>
                <p class="text-lg">On {{ $mall->name }}</p>
            </div>
            <div class="rounded-md">
                <figure>

                    @if ($mall->image_url == null)
                    <img src="{{ asset('images/default.png') }}" />
                @else
                    <img class="rounded-xl" src="{{ asset('storage/' . $mall->image_url) }}" />
                @endif

                </figure>
            </div>
        </div>
        {{-- form --}}
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
            <h1 class="text-xl font-bold">Reservation Details</h1>
            <form class="flex flex-col justify-between space-y-2 h-full" method="POST" action="{{ route('customer.doReserve') }}">
                @csrf
                <div class="flex flex-col justify-between">
                    <div class="flex flex-col space-y-2">
                        <div>Initial Price : Rp. {{ $segmentation->initial_price }}</div>
                        <div>Price per Hour : Rp. {{ $segmentation->price }}</div>
                    </div>
                    <div class="text-xl font-bold mt-4 mb-2">Reservation Hour</div>
                    <div class="flex space-x-4">
                        <div class="flex flex-col space-y-2">
                            <div>Start</div>
                            <div class="mt-2 h-12 flex items-center justify-center w-40 bg-white rounded-lg shadow-xl border-2">
                                <div class="flex">
                                    <select name="starthour" onchange="countTotal()" id="starthour" class="bg-transparent text-xl appearance-none outline-none px-2">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">10</option>
                                        <option value="12">12</option>
                                    </select>
                                    <span class="text-xl mr-3">:</span>
                                    <select name="startminute" onchange="countTotal()" id="startminute" class="bg-transparent text-xl appearance-none outline-none px-2">
                                        <option value="0">00</option>
                                        <option value="30">30</option>
                                    </select>
                                    <select name="startampm" onchange="countTotal()" id="startampm" class="bg-transparent text-xl appearance-none outline-none px-2">
                                        <option value="am">AM</option>
                                        <option value="pm">PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="h-full flex items-end text-xl font-semibold pb-3"> - </div>
                        <div class="flex flex-col space-y-2">
                            <div>Finish</div>
                            <div class="mt-2 h-12 flex items-center justify-center w-40 bg-white rounded-lg shadow-xl border-2">
                                <div class="flex">
                                <select name="endhour" id="endhour" onchange="countTotal()" class="bg-transparent text-lg appearance-none outline-none px-2">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">10</option>
                                    <option value="12">12</option>
                                </select>
                                <span class="text-xl mr-3">:</span>
                                <select name="endminute" onchange="countTotal()" id="endminute" class="bg-transparent text-xl appearance-none outline-none px-2">
                                    <option value="0">00</option>
                                    <option value="30">30</option>
                                </select>
                                <select name="endampm" onchange="countTotal()" id="endampm" class="bg-transparent text-lg appearance-none outline-none px-2">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-2 w-full">
                            <div class="flex justify-between">
                                <div>
                                    Vehicle
                                </div>
                                @error('vehicle')
                                    <div class="text-red-500 text-md">{{ $message }}</div>
                                @enderror
                            </div>
                            <select class="select select-bordered w-full h-12" name="vehicle">
                                <option disabled selected>Select a Vehicle</option>
                                @foreach ($activeUser->vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col space-y-2 w-full">
                            <div class="flex justify-between">
                                <div>
                                    Select Date
                                </div>
                                @error('date')
                                    <div class="text-red-500 text-md">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="date" name="date" class="h-12 border-2 border-base-200 rounded-md px-4 items-center">
                        </div>
                    </div>
                    @error('starthour')
                        <div class="text-red-500 text-md mt-4">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col space-y-2">
                    <div class="text-xl font-semibold">Subtotal : Rp. <span id="subtotal">0</span></div>
                    <input type="hidden" name="price" id="price" value="0">
                    <input type="hidden" name="segmentation" value="{{ $segmentation->id }}">
                    <input type="submit" class="btn btn-primary" value="Reserve">
                </div>

            </form>
        </div>
    </div>
</div>

<script>

    function countTotal(){
        var starthour = document.getElementById("starthour").value;
        var startminute = document.getElementById("startminute").value;
        var startampm = document.getElementById("startampm").value;
        var endhour = document.getElementById("endhour").value;
        var endminute = document.getElementById("endminute").value;
        var endampm = document.getElementById("endampm").value;
        var initialPrice = {{ $segmentation->initial_price }};
        var pricePerHour = {{ $segmentation->price }};

        if(startampm == "pm"){
            starthour = parseInt(starthour) + 12;
        }
        if(endampm == "pm"){
            endhour = parseInt(endhour) + 12;
        }

        var start = new Date();
        start.setHours(starthour);
        start.setMinutes(startminute);
        var end = new Date();
        end.setHours(endhour);
        end.setMinutes(endminute);

        var diff = end - start;
        var hours = diff / 1000 / 60 / 60;
        var total = 0;
        if(hours > 1){
            total = initialPrice + (hours - 1) * pricePerHour;
        }else{
            total = initialPrice;
        }
        document.getElementById("subtotal").innerHTML = total;
        document.getElementById("price").value = total;
    }


    countTotal();
</script>

@endsection
