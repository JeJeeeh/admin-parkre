@extends('admin.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Add Mall</p>
            </div>
            <div>
                <a href="{{ route('admin.mall') }}">
                    <div class="btn btn-error">
                        Back
                    </div>
                </a>
            </div>
        </div>
        <div>
            <form action="{{ route('admin.doAddMall') }}" class="space-y-4" method="POST">
                @csrf
                <div class="w-full h-84 bg-primary rounded-xl p-4  space-y-2">
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
                    <div class="flex">
                        <div class="w-1/4 space-y-2">
                            <div class="flex justify-center">
                                <figure>
                                    <img src="{{ asset('images/default.png') }}" />
                                    {{-- @if ($activeUser->image_url == null)
                                    @else
                                        <img class="rounded-full" src="{{ asset('storage/' . $activeUser->image_url) }}" />
                                    @endif --}}
                                </figure>
                            </div>
                            <input type="file" name="image" class="file-input file-input-bordered w-full max-w-xs" />
                        </div>
                        <div class="w-3/4 p-4 space-y-10 mt-2">
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
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
