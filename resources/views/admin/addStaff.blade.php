@extends('admin.layouts.template')

@section('content')
    <div class="py-8 px-4">
        <div>
            <div>
                <p class="text-semibold text-3xl">Add Staff</p>
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
                <form action="{{ route('admin.doAddStaff') }}" class="space-y-4" method="POST">
                    @csrf
                    <div>
                        <input type="text" placeholder="Name" name='name' value="{{ old('name') }}"
                            class="input w-full" />
                    </div>
                    <div>
                        <input type="text" placeholder="Username" name='username' value="{{ old('username') }}"
                            class="input w-full" />
                    </div>
                    <div>
                        <input type="password" placeholder="Password" name='password' value="{{ old('password') }}"
                            class="input w-full" />
                    </div>
                    <div>
                        <input type="password" placeholder="Confirm Password" name='confirmPassword'
                            value="{{ old('password') }}" class="input w-full" />
                    </div>
                    <div>
                        <input type="text" name="address" placeholder="Address" value="{{ old('address') }}"
                            class="input w-full">
                    </div>
                    <div>
                        <input type="number" name="phone" placeholder="Phone" value="{{ old('phone') }}"
                            class="input w-full">
                    </div>
                    <div>
                        <button class="btn w-full text-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
