<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccination;
use App\Models\Vaccine;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::all();

        return view('appointments', [
            'appointments' => $appointments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $vaccination = Vaccination::findOrFail($id);

        $vaccines = Vaccine::all()->sortBy('provider');

        return view('appointment_create', [
            'vaccination' => $vaccination,
            'vaccines' => $vaccines
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patientFirstName' => 'bail|required',
            'patientLastName' => 'required',
            'zzzs_number' => 'required|integer|digits:9',
            'applicationNumber' => 'required|integer',
            'dose' => 'required|integer',
            'vaccine' => 'required',
            'appointment_date' => 'required|after:yesterday',
        ], 
        [
            'appointment_date' => 'Datum ne sme biti starejši od današnjega.'
        ]);

        $vaccination = Vaccination::findOrFail($request->applicationNumber);
        $vaccine = Vaccine::findOrFail($request->vaccine); 

        $vaccination->completed = true;

        $vaccination->save();

        $appointment = new Appointment;

        $appointment->appointment_date = $request->appointment_date;
        $appointment->dose = $request->dose;

        $appointment->vaccination()->associate($vaccination);
        $appointment->vaccine()->associate($vaccine);

        $appointment->save();

        return view('success_info', [
            'headerTitle' => 'Dodan termin',
            'message' => 'Novi termin za cepljenje je bil uspešno dodan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        $patient = $appointment->vaccination->patient;
        $vaccine = $appointment->vaccine;

        return response()->json([
            'appointment' => $appointment,
            'patient' => $patient,
            'vaccine' => $vaccine,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->delete();

        return redirect()->route('allAppointments');
    }

    public function complete($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->completed = true;

        $appointment->save();

        return redirect()->route('allAppointments');
    }
}
