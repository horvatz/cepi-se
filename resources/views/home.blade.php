@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        @include('layouts.sidenav')
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title fw-bold">Prijave</h4>
                <p>Število vseh prijav na cepljenje</p>
                <h4 class="text-center">{{ $all_signup }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title fw-bold">Pacienti</h4>
                <p>Število vseh pacientov v sistemu</p>
                <h4 class="text-center">{{ $all_patients }}</h4>
            </div>
        </div>
    </div>
</div>
@endsection
