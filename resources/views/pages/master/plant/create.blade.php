@extends('layouts.modernize')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Create Data Plant</h5>
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('master.plant.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" aria-describedby="nameHelp" value="{{ old('name') }}">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="latin" class="form-label">Latin Name</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control @error('latin') is-invalid @enderror"
                                    id="latin" name="latin" value="{{ old('latin') }}">
                                <div id="latinHelp" class="form-text">Jika tidak tahu, isikan sama dengan nama</div>
                                @error('latin')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
