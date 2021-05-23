@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        @include('layouts.sidenav')
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title fw-bold">Cepljene osebe</h4>
                <p>Spodaj so prikazane vse osebe, ki so cepljene proti bolezni COVID-19.</p>
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ime in priimek</th>
                        <th scope="col">ZZZS številka pacienta</th>
                        <th scope="col">Število odmerkov</th>
                        <th scope="col">Cepivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vaccinations as $vaccination)
                            @if($vaccination->appointment->count() > 0 && $vaccination->appointment[0]->completed === 1 && $vaccination->appointment[1]->completed === 1)
                            <tr>
                                <th scope="row">{{ $vaccination->appointment->count() }}</th>
                                <td>{{ $vaccination->patient->first_name }} {{ $vaccination->patient->last_name }}</td>
                                <td>{{ $vaccination->patient->zzzs_number }}</td>
                                <td>{{ $vaccination->appointment->count() }}</td>
                                <td>{{ $vaccination->appointment[1]->vaccine->provider }} {{ $vaccination->appointment[1]->vaccine->name }}</td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection