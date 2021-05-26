@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-md-4">
        @include('layouts.sidenav')
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title fw-bold">Naročeni termini na cepljenje</h4>
                <p>Spodaj so prikazani vsi termini za cepljenje COVID-19.</p>
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Termin</th>
                        <th scope="col">Doza cepiva</th>
                        <th scope="col">Cepljenje opravljeno</th>
                        <th scope="col">ZZZS številka pacienta</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <th scope="row">{{ $appointment->id }}</th>
                                <td>{{ $appointment->appointment_date }}</td>
                                <td>{{ $appointment->dose }}</td>
                                
                                @if ($appointment->completed === 0)
                                    <td style="color: red">Ne</td>
                                @else
                                    <td style="color: green">Da</td>
                                @endif
                                <td>{{ $appointment->vaccination->patient->zzzs_number }}</td>
                                <td>
                                @if ($appointment->completed === 0)
                                    <div class="row">
                                      <div class="col">
                                        <a href="{{ route('deleteAppointment', $appointment->id) }}" class="btn btn-danger" tabindex="-1" role="button" aria-disabled="true">Izbriši termin</a>
                                      </div>
                                      <div class="col">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="getAppointment({{ $appointment->id }})">
                                            Zaključi cepljenje
                                        </button>
                                      </div>
                                    </div>
                                @else
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="getAppointment({{ $appointment->id }})">
                                        Cepljenje opravljeno
                                    </button>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Podatki o terminu cepljenja</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zapri</button>
        <a href="{{ route('completeAppointment', $appointment->id) }}" id="modal-btn" class="btn btn-success" tabindex="-1" role="button" aria-disabled="true">Zaključi cepljenje</a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Podatki o terminu cepljenja</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zapri</button>
      </div>
    </div>
  </div>
</div>
<script>
    const getAppointment = async(id) => {
        document.querySelector("#modal-btn").setAttribute("href", `/admin/appointment/complete/${id}`);
        const res = await fetch(`/admin/appointment/${id}`);
        const appointment = await res.json();

        const modals = document.querySelectorAll(".modal-body");
        
        modals[0].innerHTML= `
            <p>Številka termina: <strong>${appointment.appointment.id}</strong></p>
            <p>Datum in ura termina: <strong>${appointment.appointment.appointment_date}</strong></p>
            <p>Cepivo: <strong>${appointment.vaccine.provider} ${appointment.vaccine.name}</strong></p>
            <p>Doza cepiva: <strong>${appointment.appointment.dose}</strong></p>
            <p>Ime in priimek pacienta: <strong>${appointment.patient.first_name} ${appointment.patient.last_name}</strong></p>
            <p>Datum rojstva: <strong>${new Date(appointment.patient.birthdate).toLocaleDateString()}</strong></p>
            <p>ZZZS številka: <strong>${appointment.patient.zzzs_number}</strong></p>
        `

        modals[1].innerHTML= `
            <p>Številka termina: <strong>${appointment.appointment.id}</strong></p>
            <p>Datum in ura termina: <strong>${appointment.appointment.appointment_date}</strong></p>
            <p>Cepivo: <strong>${appointment.vaccine.provider} ${appointment.vaccine.name}</strong></p>
            <p>Doza cepiva: <strong>${appointment.appointment.dose}</strong></p>
            <p>Ime in priimek pacienta: <strong>${appointment.patient.first_name} ${appointment.patient.last_name}</strong></p>
            <p>Datum rojstva: <strong>${new Date(appointment.patient.birthdate).toLocaleDateString()}</strong></p>
            <p>ZZZS številka: <strong>${appointment.patient.zzzs_number}</strong></p>
        `
        return appointment;
    }
</script>
@endsection