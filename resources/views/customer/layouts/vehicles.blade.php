<div class="flex flex-col space-y-3 rounded-md p-8 shadow-xl bg-base-100 w-full border-2 border-base-200">
    <div class="flex justify-between items-center">
        <div class="text-2xl font-bold">Your Vehicles</div>
        <a href="{{ route('customer.addVehicle') }}">
            <div class="btn btn-primary">Add Vehicle</div>
        </a>
    </div>
    @if ($activeUser->vehicles->count() > 0)
        <div class="overflow-x-auto">
            <table class="table w-full border-2 border-base-200 border-none">
                <!-- head -->
                <thead>
                    <tr>
                        <th></th>
                        <th>Vehicle</th>
                        <th>Plate Number</th>
                        <th>Color</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($activeUser->vehicles as $vehicle)
                        <tr>
                            <th>{{ $i }}</th>
                            <th>{{ $vehicle->name }}</th>
                            <th>{{ $vehicle->plate }}</th>
                            <th>{{ $vehicle->color }}</th>
                            <th class="flex justify-center space-x-2">
                                <form action="{{ route('customer.editVehicle') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $vehicle->id }}">
                                    <button class="btn btn-primary">Edit</button>
                                </form>
                                <form action="{{ route('customer.deleteVehicle') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $vehicle->id }}">
                                    <button class="btn btn-error">Delete</button>
                                </form>
                            </th>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach

                </tbody>
            </table>
        </div>
    @else
        <div class="flex flex-col space-y-2">
            <h2 class="text-lg font-bold">You don't have any vehicles yet</h2>
            <p class="text-lg">You can start by adding a vehicle</p>
        </div>
    @endif
</div>
