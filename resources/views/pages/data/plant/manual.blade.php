@extends('layouts.modernize')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('data.plant.manual.update', $plant->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body pb-0">
                    <h5 class="card-title fw-semibold mb-4">Manual Data</h5>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="name" name="name"
                                    aria-describedby="nameHelp" value="{{ $plant->name }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="latin" class="form-label">Latin Name</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" id="latin" name="latin"
                                    value="{{ $plant->latin }}" disabled>
                                @error('latin')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Upload CSV</h5>
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="name" class="form-label">File</label>
                                    <span class="text-danger">*</span>
                                    <input type="file"
                                        class="form-control @error('fileCsv') is-invalid @enderror"
                                        name="fileCsv" aria-describedby="nameHelp" accept=".csv">
                                    @error('fileCsv')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div id="latinHelp" class="form-text">
                                        Column A berisi data temperatur, Column B berisi data humidity, dan Column C berisi
                                        data conclusion (0/1)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
