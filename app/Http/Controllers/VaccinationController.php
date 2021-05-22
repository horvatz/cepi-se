<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccination;
use App\Models\Patient;

class VaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vaccination_signup');
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
       ], 
       [
            'patientFirstName.required' => 'Niste vnesli imena.',
            'patientLastName.required' => 'Niste vnesli priimka.',
            'zzzs_number.required' => 'Niste vnesli ZZZS številke.',
            'zzzs_number.digits' => 'Niste vnesli pravilne ZZZS številke',
            'zzzs_number.integer' => 'Niste vnesli pravilne ZZZS številke',
       ]);

       $patient = Patient::where('zzzs_number', $request->zzzs_number)->where('first_name', $request->patientFirstName)->where('last_name', $request->patientLastName)->first();
       
       if($patient === null) 
       {
           return view('vaccination_signup', [
               'err' => "Oseba s to ZZZS številko ne obstaja"
           ]);

       } else {

            $check_vacc = Vaccination::where('patient_id', $patient->id)->first();
            
            if($check_vacc === null) 
            {
                $vaccination = new Vaccination;
                $vaccination->patient()->associate($patient);
                $vaccination->save();
                
                return redirect()->route('certificate', ['id' => $vaccination->id]);

            } else {
                return view('vaccination_signup', [
                    'err' => "Prijava na cepljenje za to osebo že obstaja!"
                ]);
            }
       } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vaccination = Vaccination::findOrFail($id);
        $patient = $vaccination->patient;

        return view('vaccination_confirmed', [
            'cert' => $vaccination,
            'patient' => $patient
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
        //
    }
}
