@extends('layouts.modernize')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Data Plant for Training</h5>
                <div class="card">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="name" name="name"
                                aria-describedby="nameHelp" value="{{ $plant->name }}" disabled>
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="latin" class="form-label">Latin Name</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="latin" name="latin"
                                value="{{ $plant->latin }}" disabled>

                        </div>

                        <div id="chartPlant">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var options = {
            series: [{
                name: "Negative",
                data: @json($negative)
            }, {
                name: "Positive",
                data: @json($positive)

            }],
            chart: {
                height: 350,
                type: 'scatter',
                zoom: {
                    enabled: true,
                    type: 'xy'
                }
            },
            xaxis: {
                tickAmount: 10,
                min: {{ $humiMin }},
                max: {{ $humiMax }},
                title: {
                    text: 'Humidity (%)',
                    offsetY: 85,
                },
                tooltip: {
                    enabled: false
                }
            },
            yaxis: {
                tickAmount: 7,
                min: {{ $tempMin }},
                max: {{ $tempMax }},
                title: {
                    text: 'Temperature (°C)',
                },
            },
            legend: {
                show: true,
                position: 'bottom',
            },
            tooltip: {
                y: {
                    formatter: function(value, {
                        series,
                        seriesIndex,
                        dataPointIndex,
                        w
                    }) {
                        var data = w.globals.initialSeries[seriesIndex].data[dataPointIndex];
                        return `${data[1]}°C, ${data[0]}%`
                    }
                },
                x: {
                    show: false
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chartPlant"), options);
        chart.render();
    </script>
@endpush
