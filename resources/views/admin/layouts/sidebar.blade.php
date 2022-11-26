<div class="drawer drawer-mobile">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />

    <div class="drawer-content flex flex-col items-center justify-center">
    <!-- Page content here -->
        <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">Open drawer</label>
        @include('admin.layouts.navbar')
    </div>
    <div class="drawer-side">
        <label for="my-drawer-2" class="drawer-overlay"></label>

        <ul class="menu p-4 w-80 bg-base-100 text-base-content">
            <li class="mb-4">
                <a class="normal-case text-xl font-bold">ParkRe</a>
            </li>
            <!-- Sidebar content here -->
            <li><a class="active">Home</a></li>
            <li><a>Sidebar Item 2</a></li>
        </ul>
    </div>
</div>
