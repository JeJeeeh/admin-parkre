@extends('layouts.template')

@section('main')

<div class="hero min-h-screen bg-base-200">
    <div class="hero-content flex space-x-8">
        <div class="text-center lg:text-left">
            <h1 class="text-5xl font-bold">Forgot Your Password?</h1>
        </div>
        <div class="flex flex-col space-y-4 max-w-sm w-full">
            @if (session('error'))
                <div class="alert alert-error shadow-lg">
                    <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success shadow-lg">
                    <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            <div class="card flex-shrink-0 w-full shadow-2xl bg-base-100">
                <div class="card-body">
                    <form action="{{ route('doForgotPassword') }}" method="POST">
                        @csrf
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Email</span>
                            </label>
                            <input type="text" name="email" placeholder="email" class="input input-bordered" />
                            @error('email')
                              <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-control mt-6">
                            <input type="submit" value="Change Password" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
