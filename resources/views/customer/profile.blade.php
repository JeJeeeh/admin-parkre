@extends('layouts.template')

@section('header')
    @include('customer.layouts.navbar')
@endsection

@section('main')

<div class="mt-24 mx-12 flex space-x-4">
    {{-- profile card --}}
    @include('customer.layouts.profile')
    {{-- transactions and vehicles --}}
    <div class="flex flex-col space-y-4 w-full">
        {{-- transactions --}}
        <div class="rounded-md p-8 shadow-xl bg-base-100 w-full flex flex-col space-y-3 border-2 border-base-200">
            <div class="text-2xl font-bold">Your Transactions</div>
            @if ($activeUser->transactions)
                <div class="overflow-x-auto">
                        <table class="table w-full border-2 border-base-200 border-none">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th></th>
                                <th>Date</th>
                                <th>Mall</th>
                                <th>Segmentation</th>
                                <th>Vehicle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($activeUser->transactions as $transaction)
                                <tr>
                                    <th>{{ $i }}</th>
                                    <th>{{ $transaction->date }}</th>
                                    <th>{{ $transaction->reservation->segmentation->mall->name }}</th>
                                    <th>{{ $transaction->reservation->segmentation->name }}</th>
                                    <th>{{ $transaction->reservation->vehicle->name }}</th>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach

                        </tbody>
                    </table>
                </div>
            @else
                <div class="flex flex-col space-y-2">
                    <h2 class="text-lg font-bold">You don't have any transactions yet</h2>
                    <p class="text-lg">You can start by reserving a park</p>
                </div>
            @endif
        </div>
        {{-- vehicles --}}
        @include('customer.layouts.vehicles')
        </div>
    </div>
</div>

@endsection
