@extends('layouts.modernize')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Create Data Hardware</h5>
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('master.hardware.store') }}" method="POST">
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
                                <label for="code" class="form-label">Code</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    id="code" name="code" value="{{ old('code') }}">
                                <div id="codeHelp" class="form-text">Bisa menggunakan uuid atau random karakter, ini
                                    berfungsi sebagai penanda dari alat</div>
                                @error('code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="code" class="form-label">Plant</label>
                                <span class="text-danger">*</span>
                                <select class="form-select @error('plant') is-invalid @enderror"
                                    aria-label="Default select example" name="plant">
                                    <option selected disabled>Open this select menu</option>
                                    @foreach ($plants as $plant)
                                        @if (old('plant') == $plant->id)
                                            <option value="{{ $plant->id }}" selected>{{ $plant->name }}</option>
                                        @else
                                            <option value="{{ $plant->id }}">{{ $plant->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('plant')
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
