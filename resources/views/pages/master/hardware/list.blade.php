@extends('layouts.modernize')

@section('content')
    <div class="row">

        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">List Hardware</h5>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div style="display:flow-root">
                        <div class="float-end mx-3">
                            <a class="btn btn-primary" href="{{ route('master.hardware.create') }}">
                                <span>
                                    <i class="ti ti-plus"></i>
                                </span>
                                &nbsp;
                                Add
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <br>
                        <table class="table table-hover text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Id</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Hardware</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Plant</h6>
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
                                @foreach ($hardwares as $hardware)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $hardware->id }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{ $hardware->name }}</h6>
                                            <span class="fw-normal">{{ $hardware->code }}</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{ $hardware->plant->name }}</h6>
                                            <span class="fw-normal">{{ $hardware->plant->latin }}</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span
                                                    class="badge bg-success rounded-3 fw-semibold px-3 py-2">{{ $hardware->created_at->diffForHumans() }}</span>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span
                                                    class="badge bg-info rounded-3 fw-semibold px-3 py-2">{{ $hardware->updated_at->diffForHumans() }}</span>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0">
                                            <a class="btn btn-dark mx-1"
                                                href="{{ route('master.hardware.edit', $hardware->id) }}">
                                                <span>
                                                    <i class="ti ti-edit"></i>
                                                </span>
                                            </a>
                                            |
                                            <form class="d-inline"
                                                action="{{ route('master.hardware.destroy', $hardware->id) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Kamu yakin menghapus data ini ?')"
                                                    class="btn btn-danger mx-1">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                            |
                                            <a class="btn btn-dark mx-1" href="{{ route('master.hardware.show', $hardware->id) }}">
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
                    {{ $hardwares->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
