<?php

// app/Http/Controllers/ResumeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAdditionalInfo;
use App\Models\Education;
use App\Models\Experience;

class ResumeController extends Controller
{
    public function create()
    {
        return view('resume.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
           
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'summary' => 'required|string',
            'educations' => 'required|array',
            'educations.*.degree' => 'required|string|max:255',
            'educations.*.institution' => 'required|string|max:255',
            'educations.*.year' => 'required|string|max:255',
            'educations.*.description' => 'required|string',
            'experiences' => 'required|array',
            'experiences.*.title' => 'required|string|max:255',
            'experiences.*.company' => 'required|string|max:255',
            'experiences.*.duration' => 'required|string|max:255',
            'experiences.*.description' => 'required|string',
        ]);

        $user = auth()->user()->id;

        UserAdditionalInfo::create([
            'user_id' => $user,
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'summary' => $validatedData['summary'],
        ]);

        foreach ($validatedData['educations'] as $education) {
            Education::create([
                'user_id' => $user,
                'degree' => $education['degree'],
                'institution' => $education['institution'],
                'year' => $education['year'],
                'description' => $education['description'],
            ]);
        }

        foreach ($validatedData['experiences'] as $experience) {
            Experience::create([
                'user_id' => $user,
                'title' => $experience['title'],
                'company' => $experience['company'],
                'duration' => $experience['duration'],
                'description' => $experience['description'],
            ]);
        }

        return redirect()->route('resume.create')->with('success', 'Resume created successfully.');
    }
}



