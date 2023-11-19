@extends('layouts.modernize')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-9 fw-semibold">Data Training</h5>
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="fw-semibold mb-3">{{ $plant_data_training->count }} Data</h4>
                                    <div class="row gap-1">
                                        <div class="me-4">
                                            <span class="round-8 bg-primary rounded-circle me-2 d-inline-block">
                                            </span>
                                            <span class="fs-2">
                                                Positive : {{ $plant_data_training->positive_count }} Data
                                            </span>
                                        </div>
                                        <div>
                                            <span class="round-8 bg-light-primary rounded-circle me-2 d-inline-block">
                                            </span>
                                            <span class="fs-2">
                                                Negative : {{ $plant_data_training->negative_count }} Data
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-center">
                                        <div id="dataConclusion">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var dataConclusion = {
            color: "#adb5bd",
            series: [{{ $plant_data_training->positive_count }}, {{ $plant_data_training->negative_count }}],
            labels: ["Positive", "Negative"],
            chart: {
                width: 180,
                type: "donut",
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    donut: {
                        size: '75%',
                    },
                },
            },

            dataLabels: {
                enabled: false,
            },

            legend: {
                show: false,
            },
            colors: ["#5D87FF", "#ecf2ff", "#F9F9FD"],

            responsive: [{
                breakpoint: 991,
                options: {
                    chart: {
                        width: 150,
                    },
                },
            }, ],
            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };

        var chart = new ApexCharts(document.querySelector("#dataConclusion"), dataConclusion);
        chart.render();
    </script>
@endpush
