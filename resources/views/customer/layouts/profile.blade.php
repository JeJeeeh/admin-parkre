<div class="flex flex-col space-y-4 rounded-md p-8 shadow-xl bg-base-100 w-1/3 border-2 border-base-200 h-fit">
    <h1 class="text-3xl font-bold"><a href="{{ route('customer.profile') }}">Profile</a></h1>
    <div class="flex flex-col space-y-4">
        <div class="flex justify-center">
            <figure>
                @if ($activeUser->image_url == null)
                    <img src="{{ asset('images/default.png') }}" />
                @else
                    <img class="rounded-full" src="{{ asset('storage/' . $activeUser->image_url) }}" />
                @endif
            </figure>
        </div>
        <div class="flex flex-col space-y-1">
            <h2 class="text-lg font-bold">Name</h2>
            <p class="text-lg">{{ $activeUser->name }}</p>
        </div>
        <div class="flex flex-col space-y-1">
            <h2 class="text-lg font-bold">Email</h2>
            <p class="text-lg">{{ $activeUser->email }}</p>
        </div>
        <div class="flex flex-col space-y-1">
            <h2 class="text-lg font-bold">Phone Number</h2>
            <p class="text-lg">{{ $activeUser->phone }}</p>
        </div>
        <div class="flex flex-col space-y-1">
            <h2 class="text-lg font-bold">Address</h2>
            <p class="text-lg">{{ $activeUser->address }}</p>
        </div>
    </div>
    <div>
        <a href="{{ route('customer.editProfile') }}">
            <button class="btn btn-primary w-full font-semibold">Profile Settings</button>
        </a>
    </div>
</div>
