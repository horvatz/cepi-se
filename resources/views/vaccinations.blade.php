@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        @include('layouts.sidenav')
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title fw-bold">Vse prijave na cepljenje</h4>
                <p>Spodaj so prikazane vse prijave na cepljenje COVID-19.</p>
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Datum in čas</th>
                        <th scope="col">Vsaj eno cepljenje</th>
                        <th scope="col">ZZZS številka pacienta</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $application)
                            <tr>
                                <th scope="row">{{ $application->id }}</th>
                                <td>{{ $application->created_at }}</td>
                                <td>
                                @if ($application->completed === 0)
                                    Ne
                                @else
                                    Da
                                @endif
                                </td>
                                <td>{{ $application->patient->zzzs_number }}</td>
                                <td>
                                @if (isset($application->appointment[0]) && isset($application->appointment[1]) && $application->appointment->count() > 0 && $application->appointment[0]->completed === 1 && $application->appointment[1]->completed === 1)
                                    <button type="button" class="btn btn-success" disabled>Oseba je precepljena</button>
                                @else
                                    <a href="{{ route('appointmentCreate', $application->id) }}" class="btn btn-success">Dodaj termin</a>
                                @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection