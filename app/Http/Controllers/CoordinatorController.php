<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Carbon\Carbon;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\ApplicantList;
use App\Models\RejectedApplicant;

class CoordinatorController extends Controller
{
    public function home(){

        return view('coordinator.home', [
            'activities' => Activity::latest()->limit(5)->get(),
            'applications' => Application::latest()->get()
        ]);
    }

    public function report(){

        /**
         * This is for Applied Applicants chart in dashboard
         */
        $appliedApplicantData = ApplicantList::select('id', 'created_at')->get()->groupBy(function($data){

           return Carbon::parse($data->created_at)->format('Y');
        });

        $appliedApplicantYears = [];
        $appliedApplicantYearCount = [];
        foreach($appliedApplicantData as $year => $value){
            $appliedApplicantYears[] = $year;
            $appliedApplicantYearCount[] = count($value);
        }

         /**
         * This is for Qualified Applicants chart in dashboard
         */
        $rejectedApplicantData = RejectedApplicant::select('id', 'created_at')->get()->groupBy(function($data){

            return Carbon::parse($data->created_at)->format('Y');
         });

         $rejectedApplicantYears = [];
         $rejectedApplicantYearCount = [];
         foreach($rejectedApplicantData as $year => $value){
             $rejectedApplicantYears[] = $year;
             $rejectedApplicantYearCount[] = count($value);
         }

        /**
         * This is for the Pie Chart with family income data
         */
        // $applicant = Applicant::get();
        // $applicantFamilyIncome = [0, 0, 0, 0, 0];
        // foreach($applicant as $applicants){

        //     switch($applicants->family_income){
        //         case 8000:
        //             $applicantFamilyIncome[0]++;
        //             break;

        //         case 12000:
        //             $applicantFamilyIncome[1]++;
        //             break;

        //         case 16000:
        //             $applicantFamilyIncome[2]++;
        //             break;

        //         case 20000:
        //             $applicantFamilyIncome[3]++;
        //             break;

        //         case 24000:
        //             $applicantFamilyIncome[4]++;
        //             break;

        //     }
        // }

        return view('coordinator.report',[
            'appliedApplicantYears' => $appliedApplicantYears,
            'appliedApplicantYearCount' => $appliedApplicantYearCount,

            'rejectedApplicantYears' => $rejectedApplicantYears,
            'rejectedApplicantYearCount' => $rejectedApplicantYearCount,

            // 'applicantFamilyIncome' => $applicantFamilyIncome,

            'totalApplicants' => Applicant::without(['school', 'address', 'contact'])
                                ->select('id')
                                ->get(),
            'totalApplications' => Application::select('id')->get(),
            'totalSubmissions' => ApplicantList::select('id')->get()
        ]);

    }

    public function application()
    {

        return view('coordinator.application', [
            'applications' => Application::with([
                                'applicantList:applications_id'
                            ])
                            ->latest()->paginate(10)
        ]);
    }

}