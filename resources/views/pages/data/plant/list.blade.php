@extends('layouts.modernize')

@section('content')
    <div class="row">

        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">List Plant</h5>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <br>
                        <table class="table table-hover text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Id</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Plant</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Count</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Created At</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Updated At</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plants as $plant)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $plant->id }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{ $plant->name }}</h6>
                                            <span class="fw-normal">{{ $plant->latin }}</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">Data Training :
                                                {{ $plant->plant_data_trainings_count }}</h6>
                                            <span class="fw-normal">Hardware : {{ $plant->hardwares_count }}</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span
                                                    class="badge bg-success rounded-3 fw-semibold px-3 py-2">{{ $plant->created_at->diffForHumans() }}</span>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span
                                                    class="badge bg-info rounded-3 fw-semibold px-3 py-2">{{ $plant->updated_at->diffForHumans() }}</span>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0">
                                            <a class="btn btn-primary mx-1"
                                                href="{{ route('data.plant.generate.create', $plant->id) }}">
                                                <span>
                                                    <i class="ti ti-edit"></i>
                                                    Generate
                                                </span>
                                            </a>
                                            |
                                            <a class="btn btn-primary mx-1"
                                                href="{{ route('data.plant.manual.create', $plant->id) }}">
                                                <span>
                                                    <i class="ti ti-edit"></i>
                                                    Manual
                                                </span>
                                            </a>
                                            |
                                            <a class="btn btn-dark mx-1" href="{{ route('data.plant.show', $plant->id) }}">
                                                <span>
                                                    <i class="ti ti-eye"></i>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    {{ $plants->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
