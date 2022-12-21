@extends('layouts.template')

@section('main')
    <div class="drawer drawer-mobile">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />

        <div class="drawer-content flex flex-col">
            <!-- Page content here -->
            <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">Open drawer</label>
            @include('staff.layouts.navbar')
            @yield('content')
        </div>
        <div class="drawer-side">
            <label for="my-drawer-2" class="drawer-overlay"></label>

            <ul class="menu p-4 w-80 bg-base-200 text-base-content space-y-2">
                <li class="mb-4">
                    <a class="normal-case text-xl font-bold">ParkRe</a>
                </li>
                <!-- Sidebar content here -->
                <li><a class="{{ $sidebar == 'home' ? 'active' : '' }}" href="{{ route('staff.home') }}">Today's Reservation
                        List</a></li>
                <li><a class="{{ $sidebar == 'announcement' ? 'active' : '' }}"
                        href="{{ route('staff.announcement') }}">Announcement List</a>
                </li>
                {{-- <li><a class="{{ $sidebar == 'report' ? 'active' : '' }} " href="{{ route('staff.report') }}">Report
                        List</a></li> --}}
                {{-- <li><a>Berita Acara</a></li> --}}
            </ul>
        </div>
    </div>
@endsection
