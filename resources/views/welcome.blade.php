@extends('layouts.app')

@section('content')
<div class="px-4 py-5 my-5 text-center">
    <i class="fas fa-medkit fa-3x"></i>
    <h1 class="display-5 fw-bold">Prijava na cepljenje</h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead">Le cepljenje nas bo rešilo epidemije. Spodaj je spletni obrazec za enostavno in hitro naročanje na cepljenje proti bolezni COVID-19.</p>
        <a href="/vaccination/signup" class="btn btn-primary btn-lg" tabindex="-1" role="button" aria-disabled="true">Prijavi se na cepljenje</a>
    </div>
</div>

@endsection
