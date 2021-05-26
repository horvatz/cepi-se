@extends('layouts.app')

@section('content')
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold">Potrdilo o uspešni prijavi</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead">Spodaj vidite vaše potrdilo o uspešno prejeti prijavi na cepljenje. Shranite si ta naslov kot dokaz o cepljenju.</p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title">{{ $patient->first_name." ".$patient->last_name}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">ZZZS številka: {{$patient->zzzs_number}}</h6>
                    @if(isset($patient->vaccination->appointment[0]) && isset($patient->vaccination->appointment[1]))
                        @if($patient->vaccination->appointment[0]->completed === 1 && $patient->vaccination->appointment[1]->completed === 1)
                            <h6 class="card-subtitle mb-2 text-success">Precepljena oseba</h6>
                        @endif
                    @endif
                    @if(isset($patient->vaccination->appointment[0]))
                        @if(!isset($patient->vaccination->appointment[1]) || (isset($patient->vaccination->appointment[1]) && !$patient->vaccination->appointment[1]->completed))
                            @if($patient->vaccination->appointment[0]->completed === 1)
                                <h6 class="card-subtitle mb-2 text-warning">Prejeti en odmerek cepiva</h6>
                            @endif
                        @endif
                    @endif
                    <ul class="list-group pt-3 pb-3">
                        <li class="list-group-item">Številka prijave: {{$cert->id}}</li>
                        <li class="list-group-item">Datum in čas prijave: {{$cert->created_at}}</li>
                        <li class="list-group-item">Že opravljeno cepljenje:
                        @if ($cert->completed === 0)
                            Ne
                        @else
                            Da
                        @endif
                        </li>
                        @if(isset($patient->vaccination->appointment[0]) && isset($patient->vaccination->appointment[1]))
                            @if($patient->vaccination->appointment[0]->completed === 1 && $patient->vaccination->appointment[1]->completed === 1)
                                <li class="list-group-item">
                                    <div>Prva doza: {{$patient->vaccination->appointment[0]->appointment_date}}</div>
                                    <div>Cepivo: {{$patient->vaccination->appointment[0]->vaccine->provider}} {{$patient->vaccination->appointment[0]->vaccine->name}}</div>
                                </li>
                                <li class="list-group-item">
                                    <div>Druga doza: {{$patient->vaccination->appointment[1]->appointment_date}}</div>
                                    <div>Cepivo: {{$patient->vaccination->appointment[1]->vaccine->provider}} {{$patient->vaccination->appointment[0]->vaccine->name}}</div>
                                </li>
                            @elseif($patient->vaccination->appointment[0]->completed === 1)
                                <li class="list-group-item">
                                    <div>Prva doza: {{$patient->vaccination->appointment[0]->appointment_date}}</div>
                                    <div>Cepivo: {{$patient->vaccination->appointment[0]->vaccine->provider}} {{$patient->vaccination->appointment[0]->vaccine->name}}</div>
                                </li>
                                <li class="list-group-item">
                                    <div><strong>Termin cepljenja (druga doza): {{$patient->vaccination->appointment[1]->appointment_date}}<strong></div>
                                </li>
                            @endif
                        @endif
                        @if(isset($patient->vaccination->appointment[0]) && !isset($patient->vaccination->appointment[1]))
                            @if($patient->vaccination->appointment[0]->completed === 1)
                                <li class="list-group-item">
                                    <div>Prva doza: {{$patient->vaccination->appointment[0]->appointment_date}}</div>
                                    <div>Cepivo: {{$patient->vaccination->appointment[0]->vaccine->provider}} {{$patient->vaccination->appointment[0]->vaccine->name}}</div>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <div><strong>Termin cepljenja (prva doza): {{$patient->vaccination->appointment[0]->appointment_date}}<strong></div>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection