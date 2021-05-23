<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Vaccination;
use App\Models\Patient;
use App\Models\Appointment;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_vacc = Vaccination::count();
        $count_patients = Patient::count();

        return view('home', [
            'all_signup'=> $count_vacc,
            'all_patients' => $count_patients
        ]);
    }

    public function allApplications()
    {
        $applications = Vaccination::all();

        return view('vaccinations', [
            'applications' => $applications,
        ]);
    }

    public function allVaccinated()
    {
        $vaccinations = Vaccination::all();

        return view('vaccinated_people', [
            'vaccinations' => $vaccinations
        ]);
    }
}
