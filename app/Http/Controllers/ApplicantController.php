<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{

    private $applicant;
    private function getApplicant(){

        $this->applicant = Applicant::where('users_id', Auth::user()->id)->first();

        return $this->applicant;
    }

    public function index()
    {
        return view('applicant.profile', [
            'applicant' => $this->getApplicant()
        ]);
    }

    public function edit()
    {

        $school_list = DB::table('school_courses')->groupBy('school')->get();
        $dynamic_address = DB::table('dynamic_addresses')->groupBy('country')->get();

        return view('applicant.profile_edit', [
            'applicant' => $this->getApplicant(),
            'school_list' => $school_list,
            'dynamic_address' => $dynamic_address,
        ]);
    }

    public function update(Applicant $applicant)
    {
        $formFields = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'civil_status' => 'required',
            'nationality' => 'required',            // Applicant Table
            'educational_attainment' => 'required',
            'years_in_city' => 'required',
            'family_income' => 'required',
            'registered_voter' => 'required',
            'gwa' => 'required',

            'desired_school' => 'required',
            'hei_type' => 'required',               // School Table
            'school_last_attended' => 'required',
            'course_name' => 'required',

            'country' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',               // Address Table
            'street' => 'required',
            'region' => 'required',
            'zipcode' => 'required',

            'contact_number' => 'required',         // Contact Table
            'email' => ['required','email', Rule::unique('contacts', 'email')->ignore($applicant)],

        ]);

        $this->getApplicant()->update([

            'first_name' => ucwords(strtolower($formFields['first_name'])),
            'middle_name' => request()->has('middle_name') ? ucwords(strtolower(request('middle_name'))) : NULL,
            'last_name' => ucwords(strtolower($formFields['last_name'])),
            'age' => $formFields['age'],
            'gender' => $formFields['gender'],
            'civil_status' => $formFields['civil_status'],
            'nationality' => $formFields['nationality'],
            'educational_attainment' => $formFields['educational_attainment'],
            'years_in_city' => $formFields['years_in_city'],
            'family_income' => $formFields['family_income'],
            'registered_voter' => $formFields['registered_voter'],
            'gwa' => $formFields['gwa'],
        ]);

        $this->getApplicant()->school()->update([
            'desired_school' => $formFields['desired_school'],
            'course_name' => $formFields['course_name'],
            'hei_type' => $formFields['hei_type'],
            'school_last_attended' => ucwords(strtolower($formFields['school_last_attended'])),
        ]);

        $this->getApplicant()->address()->update([
            'country' => $formFields['country'],
            'province' => $formFields['province'],
            'city' => $formFields['city'],
            'barangay' => $formFields['barangay'],
            'street' => ucwords(strtolower($formFields['street'])),
            'region' => $formFields['region'],
            'zipcode' => $formFields['zipcode'],
        ]);

        $this->getApplicant()->contact()->update([
            'contact_number' => $formFields['contact_number'],
            'email' => $formFields['email'],
        ]);

        return redirect('/profile')->with('success', 'Profile updated successfully!');
    }

}
