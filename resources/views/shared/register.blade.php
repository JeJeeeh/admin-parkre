@extends('layouts.template')

@section('main')

<div class="hero min-h-screen bg-base-200">
    <div class="hero-content flex space-x-8">
        <div class="text-left">
            <h1 class="text-5xl font-bold">Register now!</h1>
            <p class="py-6">Sign Up to access real time park space availability and reserve a park space to save time on parking.</p>
        </div>
        <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
            <div class="card-body">
                <form action="{{ route('doRegister') }}" method="POST">
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Name</span>
                        </label>
                        <input type="text" name="name" placeholder="name" class="input input-bordered" value="{{ old('name') }}"/>
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="text" name="email" placeholder="email" class="input input-bordered" value="{{ old('email') }}"/>
                        @error('email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Address</span>
                        </label>
                        <input type="text" name="address" placeholder="address" class="input input-bordered" value="{{ old('address') }}"/>
                        @error('address')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Phone</span>
                        </label>
                        <input type="text" name="phone" placeholder="phone" class="input input-bordered" value="{{ old('phone') }}"/>
                        @error('phone')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" name="password" placeholder="password" class="input input-bordered" />
                        @error('password')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Confirm Password</span>
                        </label>
                        <input type="password" name="password_confirmation" placeholder="password" class="input input-bordered" />
                        @error('password_confirmation')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-control mt-6">
                        <input type="submit" value="Register" class="btn btn-primary">
                    </div>
                    <div class="mt-4">
                        Already have an account? <a href="{{ route('login') }}" class="link link-hover">Login Now!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
