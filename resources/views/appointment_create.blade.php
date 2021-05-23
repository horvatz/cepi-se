@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        @include('layouts.sidenav')
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title fw-bold">Dodaj termin cepljenja</h4>
                <p>Na podlagi prijave lahko pacientu določite termin za cepljenje.</p>
                <form action="{{ route('appointmentStore') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="patientFirstName" class="form-label">Ime</label>
                        <input required type="text" name="patientFirstName" class="form-control" id="patientFirstName" value="{{ $vaccination->patient->first_name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="patientLastName" class="form-label">Priimek</label>
                        <input required type="text" name="patientLastName" class="form-control" id="patientLastName" value="{{ $vaccination->patient->last_name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="patientNumber" class="form-label">ZZZS številka</label>
                        <input required type="text" name="zzzs_number" class="form-control" id="zzzsNumber" maxlength="9" value="{{ $vaccination->patient->zzzs_number }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="applicationNumber" class="form-label">Številka prijave</label>
                        <input required type="text" name="applicationNumber" class="form-control" id="applicationNumber" maxlength="9" value="{{ $vaccination->id }}" readonly>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="dose">Doza cepljenja</label>
                                <select class="form-select" aria-label="Default select example" name="dose">
                                    <option value="1">1. doza</option>
                                    <option value="2">2. doza</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="vaccine">Cepivo</label>
                                <select class="form-select" aria-label="Default select example" name="vaccine">
                                    @foreach($vaccines as $vaccine)
                                        <option value="{{ $vaccine->id }}">{{ $vaccine->provider }} {{ $vaccine->name }}</option>
                                    @endforeach                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="appointmentTime">Izberite termin cepljenja:</label>
                        <input type="datetime-local" id="appointment_date"
                            name="appointment_date" value="2021-05-26T19:30">
                    </div>
                    <button type="submit" class="btn btn-primary">Dodaj termin cepljenja</button>
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection