@extends('admin.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Add Mall</p>
            </div>
            <div>
                <a href="{{ route('admin.mall') }}">
                    <div class="btn btn-primary">
                        Add Segmentation
                    </div>
                </a>
                <a href="{{ route('admin.mall') }}">
                    <div class="btn btn-error">
                        Back
                    </div>
                </a>
            </div>
        </div>
        <div class="card w-full h-84 bg-primary p-4 mt-4">
            <div class="space-y-2">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-error w-full">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success w-full">
                        {{ Session::get('success') }}
                    </div>
                @else
                @endif
            </div>
            <form action="{{ route('admin.doAddMall') }}" class="space-y-4" method="POST">
                @csrf
                <div>
                    <input type="text" placeholder="Mall Name" name='name' class="input w-full" />
                </div>
                <div>
                    <input type="text" placeholder="Mall Address" name="address" class="input w-full" />
                </div>
                <div class="flex justify-between space-x-2">
                    <div class="w-1/2">
                        <input type="number" min="1" placeholder="Park Space" name="park_space"
                            class="input w-full" />
                    </div>
                    <div class="w-1/2">
                        <input type="number" min="1" placeholder="Reserve Space" name="reserve_space"
                            class="input w-full" />
                    </div>
                </div>
                <div>
                    <button class="btn w-full text-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection