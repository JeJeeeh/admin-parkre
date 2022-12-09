@extends('admin.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Segmentation Detail</p>
            </div>
            <div>
                <a href="{{ route('admin.editSegmentation', $segmentation[0]->id) }}">
                    <div class="btn btn-primary">
                        Edit
                    </div>
                </a>
                <a href="{{ route('admin.mall') }}">
                    <div class="btn btn-error">
                        Back
                    </div>
                </a>
            </div>
        </div>
        <div class="mt-2 flex flex-col-2 bg-primary p-4 rounded-md">
            <div>
                <p class="text-semibold text-xl">Name</p>
                <p class="text-semibold text-xl">Park Space</p>
                <p class="text-semibold text-xl">Reserve Space</p>
                <p class="text-semibold text-xl">Initial Price</p>
                <p class="text-semibold text-xl">Price/Hour</p>
            </div>
            <div class="ml-4">
                <p class="text-xl"> : {{ $segmentation[0]->name }}</p>
                <p class="text-xl"> : {{ $segmentation[0]->park_space }}</p>
                <p class="text-xl"> : {{ $segmentation[0]->reserve_space }}</p>
                <p class="text-xl"> : Rp. {{ $segmentation[0]->initial_price }}</p>
                <p class="text-xl"> : Rp. {{ $segmentation[0]->price }}</p>
            </div>
        </div>
    </div>
@endsection
