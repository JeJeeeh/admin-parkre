<div class="navbar bg-base-100 fixed top-0 z-50">
    <div class="flex-1">
      <a class="btn btn-ghost normal-case text-xl" href="{{ route('customer.home') }}">ParkRe</a>
    </div>
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
            <li><a>Settings</a></li>
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
