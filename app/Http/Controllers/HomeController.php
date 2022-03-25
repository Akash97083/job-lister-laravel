<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->paginate(5);
        $companies = array();
        foreach ($jobs as $idx => $job) {
            $c_id = $job->company_id;
            if(!array_key_exists($c_id, $companies)) {
                $company = Company::where('company_id', $c_id)->first();
                $companies[$c_id] = $company;
            }
        }
        
        
        $skills = array("Flutter", "Python", "Java", "Dart", "Kotlin", "PHP", "PugJs", "NodeJs", "Flutter", "AngularJs", "Laravel", "Bootstrap", "GCP (Google Cloud Platform)", "Firebase", "RestAPIs", "MySQL", "Adobe Xd");
        $job_types = [
            'Internship',
            'Full-time',
            'Part-time',
            'Contract',
            'Temporary',
            'Volunteer'
        ];
        return view('home.index', ['jobs' => $jobs, 'job_types' => $job_types, 'skills' => $skills, 'companies' => $companies]);
    }

    public function listCompanies()
    {
        $companies = Company::all();
        return view('home.companies', ['companies' => $companies]);
    }
}
