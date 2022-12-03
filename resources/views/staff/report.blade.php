@extends('staff.layouts.template')

@section('script')
    <script src="{{ mix('/js/app.js') }}"></script>
@endsection

@section('content')
    <div class="mt-16 py-8 px-4">
        <div>
            <p class="text-semibold text-3xl">Report List</p>
        </div>
        <div>
            <canvas id="myChart" height="100px"></canvas>
        </div>
        {{-- <script type="text/javascript">
            var labels = {{ Js::from($labels) }};
            var reportz = {{ Js::from($data) }};

            const data = {
                labels: labels,
                dataset: [{
                    label: 'Report',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: reportz,
                }]
            };

            const config = {
                type: 'line',
                data,
                options: {}
            };

            const myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
        </script> --}}
    </div>
@endsection
