@extends('layouts.modernize')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Monitoring per Hardware</h5>
                <div class="card">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-md-6">
                            <label for="name" class="form-label">Hardware Name</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="name" name="name"
                                aria-describedby="nameHelp" value="{{ $hardware->name }}" disabled>
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="code" class="form-label">Hardware Code</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="code" name="code"
                                value="{{ $hardware->code }}" disabled>
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label">Plant Name</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" aria-describedby="nameHelp"
                                value="{{ $plant->name }}" disabled>
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label">Plant Latin</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" value="{{ $plant->latin }}" disabled>
                        </div>

                        <div class="mb-3 col-12 col-md-4">
                            <label for="code" class="form-label">Temperature Now</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="temperatureNow" disabled>
                        </div>
                        <div class="mb-3 col-12 col-md-4">
                            <label for="code" class="form-label">Humidity Now</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="humidityNow" disabled>
                        </div>
                        <div class="mb-3 col-12 col-md-4">
                            <label for="code" class="form-label">Conclusion Now</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="conclusionNow" disabled>
                        </div>

                        <div id="chartTemp" class="col-md-4">

                        </div>

                        <div id="chartHumi" class="col-md-4">

                        </div>

                        <div id="chartConc" class="col-md-4">

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
            chart: {
                height: 350,
                id: 'temperature',
                type: 'line',
                group: 'hardware'
            },
            yaxis: {
                forceNiceScale: true
            },
            dataLabels: {
                enabled: false
            },
            series: [],
            title: {
                text: 'Data Temperature',
            },
            noData: {
                text: 'Loading...'
            }
        }
        var options2 = {
            chart: {
                height: 350,
                id: 'humidity',
                type: 'line',
                group: 'hardware'
            },
            yaxis: {
                forceNiceScale: true
            },
            dataLabels: {
                enabled: false
            },
            series: [],
            title: {
                text: 'Data Humidity',
            },
            noData: {
                text: 'Loading...'
            }
        }
        var options3 = {
            chart: {
                height: 350,
                id: 'conclusion',
                type: 'line',
                group: 'hardware'
            },
            yaxis: {
                forceNiceScale: true
            },
            dataLabels: {
                enabled: false
            },
            series: [],
            title: {
                text: 'Data Conclusion',
            },
            noData: {
                text: 'Loading...'
            }
        }

        var chart = new ApexCharts(document.querySelector("#chartTemp"), options);
        var chart2 = new ApexCharts(document.querySelector("#chartHumi"), options2);
        var chart3 = new ApexCharts(document.querySelector("#chartConc"), options3);

        chart.render();
        chart2.render();
        chart3.render();

        var url = `{{ route('api.hardware.data', [$hardware->id, 'temperature']) }}`;
        var url2 = `{{ route('api.hardware.data', [$hardware->id, 'humidity']) }}`;
        var url3 = `{{ route('api.hardware.data', [$hardware->id, 'conclusion']) }}`;

        window.setInterval(function() {
            $.getJSON(url, function(response) {
                chart.updateSeries([{
                    name: 'Temperature',
                    data: response
                }])
                $("#temperatureNow").val(response.pop().y)
            });
            $.getJSON(url2, function(response) {
                chart2.updateSeries([{
                    name: 'Humidity',
                    data: response
                }])
                $("#humidityNow").val(response.pop().y)
            });
            $.getJSON(url3, function(response) {
                chart3.updateSeries([{
                    name: 'Conclusion',
                    data: response
                }])
                if (response.pop().y == 1)
                    $("#conclusionNow").val('Positive')
                else
                    $("#conclusionNow").val('Negative')
            });
        }, 5000)
    </script>
@endpush
