@extends('layouts.app')

@section('content')
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold">Prijava na cepljenje</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead">Spodaj se lahko prijavite na cepljenje</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="/vaccination/signup">
                        @csrf
                        <div class="mb-3">
                            <label for="patientFirstName" class="form-label">Ime</label>
                            <input required type="text" name="patientFirstName" class="form-control" id="patientFirstName">
                        </div>
                        <div class="mb-3">
                            <label for="patientLastName" class="form-label">Priimek</label>
                            <input required type="text" name="patientLastName" class="form-control" id="patientLastName">
                        </div>
                        <div class="mb-3">
                            <label for="patientNumber" class="form-label">ZZZS številka</label>
                            <input required type="text" name="zzzs_number" class="form-control" id="patientNumber" maxlength="9">
                            <div id="patientNumberHelp" class="form-text">ZZZS številko najdete na vaši kartici zdravstvenega zavarovanja.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Oddaj prijavo</button>
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
                    @isset($err)
                    <div class="alert alert-danger mt-3">
                            <ul>
                                <li>{{ $err }}</li>
                            </ul>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection