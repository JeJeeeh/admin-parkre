<div class="navbar bg-base-100 fixed top-0 z-50">
  <div class="flex-1">
    <a class="btn btn-ghost normal-case text-xl" href="{{ route('customer.home') }}">ParkRe</a>
  </div>
  <button class="btn btn-ghost btn-circle">
    <div class="indicator">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
      <span class="badge badge-xs badge-primary indicator-item"></span>
    </div>
  </button>
  <div class="flex-none gap-2">
    <div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          @if ($activeUser->image_url == null)
              <img src="{{ asset('images/default.png') }}" />
          @else
              <img src="{{ asset('storage/' . $activeUser->image_url) }}" />
          @endif
        </div>
      </label>
      <ul tabindex="0" class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
          <li>
              <a class="justify-between" href="{{ route('customer.profile') }}">
                  Profile
              </a>
          </li>
          <li>
            <a class="justify-between" href="{{ route('customer.reservations') }}">Reservations</a>
          </li>
          <li>
              <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <input type="submit" value="Logout">
              </form>
          </li>
      </ul>
    </div>
  </div>
</div>
