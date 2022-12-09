<div class="navbar h-12 flex justify-end top-0 w-[calc(100vw-22rem)]">

    <div class="flex-none">
        <div class="dropdown dropdown-end">
            {{-- <div>
                {{ $activeUser->name }}
            </div> --}}
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img src="https://placeimg.com/80/80/people" />
                </div>
            </label>
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                <form action="{{ route('logout') }} " method="POST">
                    <li>
                        @csrf
                        <input type="submit" value="Logout">
                    </li>
                </form>
            </ul>
        </div>
    </div>
</div>
