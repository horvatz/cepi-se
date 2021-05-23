@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        @include('layouts.sidenav')
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title fw-bold">{{ $headerTitle }}</h4>
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
                <a href="/admin">Nazaj na nadzorno ploščo</a>
            </div>
        </div>
    
    </div>

</div>


@endsection