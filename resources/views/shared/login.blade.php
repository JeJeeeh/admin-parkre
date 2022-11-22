@extends('layouts.template')

@section('main')

<div class="hero min-h-screen bg-base-200">
    <div class="hero-content flex space-x-8">
        <div class="text-center lg:text-left">
            <h1 class="text-5xl font-bold">Login now!</h1>
            <p class="py-6">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
        </div>
        <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
            <div class="card-body">
                <form action="{{ route('doLogin') }}" method="POST">
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="text" name="email" placeholder="email" class="input input-bordered" />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="text" name="password" placeholder="password" class="input input-bordered" />
                        <label class="label">
                            <a href="#" class="label-text-alt link link-hover">Forgot password?</a>
                        </label>
                    </div>
                    <div class="form-control mt-6">
                        <input type="submit" value="Login" class="btn btn-primary">
                    </div>
                    <div class="mt-4">
                        Don't have an account? <a href="{{ route('register') }}" class="link link-hover">Register Now!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
