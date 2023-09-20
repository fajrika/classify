@extends('layouts.modernize')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('data.plant.generate.update', $plant->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body pb-0">
                    <h5 class="card-title fw-semibold mb-4">Generate Data</h5>
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
                                <div id="latinHelp" class="form-text">Jika tidak tahu, isikan sama dengan nama</div>
                                @error('latin')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Data Range</h5>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="name" class="form-label">Temperature Minimal</label>
                                    <span class="text-danger">*</span>
                                    <input type="number"
                                        class="form-control @error('rangeTemperatureMin') is-invalid @enderror"
                                        name="rangeTemperatureMin" aria-describedby="nameHelp"
                                        value="{{ old('rangeTemperatureMin') }}">
                                    @error('rangeTemperatureMin')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="name" class="form-label">Temperature Maximal</label>
                                    <span class="text-danger">*</span>
                                    <input type="number"
                                        class="form-control @error('rangeTemperatureMax') is-invalid @enderror"
                                        name="rangeTemperatureMax" aria-describedby="nameHelp"
                                        value="{{ old('rangeTemperatureMax') }}">
                                    @error('rangeTemperatureMax')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="name" class="form-label">Humidity Minimal</label>
                                    <span class="text-danger">*</span>
                                    <input type="number"
                                        class="form-control @error('rangeHumidityMin') is-invalid @enderror"
                                        name="rangeHumidityMin" aria-describedby="nameHelp"
                                        value="{{ old('rangeHumidityMin') }}">
                                    @error('rangeHumidityMin')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="name" class="form-label">Humidity Maximal</label>
                                    <span class="text-danger">*</span>
                                    <input type="number"
                                        class="form-control @error('rangeHumidityMax') is-invalid @enderror"
                                        name="rangeHumidityMax" aria-describedby="nameHelp"
                                        value="{{ old('rangeHumidityMax') }}">
                                    @error('rangeHumidityMax')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Data Positive/Negative</h5>
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="name" class="form-label">Type</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control @error('dataType') is-invalid @enderror"
                                        name="dataType" aria-describedby="nameHelp"
                                        value="{{ old('dataType') }}">
                                        <option value="1">Positive</option>
                                        <option value="0">Negative</option>
                                    </select>
                                    @error('dataType')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="name" class="form-label">Temperature Minimal</label>
                                    <span class="text-danger">*</span>
                                    <input type="number"
                                        class="form-control @error('dataTemperatureMin') is-invalid @enderror"
                                        name="dataTemperatureMin" aria-describedby="nameHelp"
                                        value="{{ old('dataTemperatureMin') }}">
                                    @error('dataTemperatureMin')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="name" class="form-label">Temperature Maximal</label>
                                    <span class="text-danger">*</span>
                                    <input type="number"
                                        class="form-control @error('dataTemperatureMax') is-invalid @enderror"
                                        name="dataTemperatureMax" aria-describedby="nameHelp"
                                        value="{{ old('dataTemperatureMax') }}">
                                    @error('dataTemperatureMax')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="name" class="form-label">Humidity Minimal</label>
                                    <span class="text-danger">*</span>
                                    <input type="number"
                                        class="form-control @error('dataHumidityMin') is-invalid @enderror"
                                        name="dataHumidityMin" aria-describedby="nameHelp"
                                        value="{{ old('dataHumidityMin') }}">
                                    @error('dataHumidityMin')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="name" class="form-label">Humidity Maximal</label>
                                    <span class="text-danger">*</span>
                                    <input type="number"
                                        class="form-control @error('dataHumidityMax') is-invalid @enderror"
                                        name="dataHumidityMax" aria-describedby="nameHelp"
                                        value="{{ old('dataHumidityMax') }}">
                                    @error('dataHumidityMax')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
