@extends('admin.layouts.template')

@section('content')
    <div class="py-8 px-4">
        <div>
            <div>
                <p class="text-semibold text-3xl">Add Job</p>
                @if (Session::has('success'))
                    <div class="alert alert-success w-full">
                        {{ Session::get('success') }}
                    </div>
                @endif
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
                <form action="{{ route('admin.doAddJob') }}" class="space-y-4" method="POST">
                    @csrf
                    <div>
                        <input type="text" name="title" class="input w-full" placeholder="Title"
                            value="{{ old('title') }}">
                    </div>
                    <div>
                        <select class="select w-full" name="mall">
                            <option disabled selected value="-2">Select Mall</option>
                            @foreach ($listMall as $mall)
                                <option value="{{ $mall->id }}">{{ $mall->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select class="select w-full" name="staff">
                            <option disabled selected value="-2">Select Staff</option>
                            @foreach ($listStaff as $staff)
                                <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <div class="flex justify-between space-x-2">
                            <div class='w-1/2'>
                                <label for="">Select Start date</label>
                                <input type="date" name="start" class="input w-full" placeholder="Select start date" />
                            </div>
                            <div class='w-1/2'>
                                <label for="">Select Start date</label>
                                <input type="date" class="input w-full" placeholder="Select end date" name="end" />
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn w-full text-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
