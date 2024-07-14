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

        return redirect()->route('newsfeed')->with('success', 'Resume created successfully.');
    }
    public function edit(User $user)
    {
        $user->load('additionalInfo', 'educations', 'experiences');
        return view('resume.edit', compact('user'));
    }
    public function update(Request $request, User $user)
{
    // Validate request
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'summary' => 'required|string',
        'education' => 'array',
        'education.*.degree' => 'required|string|max:255',
        'education.*.school' => 'required|string|max:255',
        'education.*.start_year' => 'required|integer',
        'education.*.end_year' => 'nullable|integer',
        'experience' => 'array',
        'experience.*.title' => 'required|string|max:255',
        'experience.*.company' => 'required|string|max:255',
        'experience.*.start_year' => 'required|integer',
        'experience.*.end_year' => 'nullable|integer',
    ]);

    // Update additional info
    $user->additionalInfo()->updateOrCreate(
        [],
        [
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'summary' => $request->input('summary'),
        ]
    );

    // Update educations
    foreach ($request->input('education', []) as $educationData) {
        $user->educations()->updateOrCreate(
            ['id' => $educationData['id'] ?? null],
            [
                'degree' => $educationData['degree'],
                'school' => $educationData['school'],
                'start_year' => $educationData['start_year'],
                'end_year' => $educationData['end_year'],
            ]
        );
    }

    // Update experiences
    foreach ($request->input('experience', []) as $experienceData) {
        $user->experiences()->updateOrCreate(
            ['id' => $experienceData['id'] ?? null],
            [
                'title' => $experienceData['title'],
                'company' => $experienceData['company'],
                'start_year' => $experienceData['start_year'],
                'end_year' => $experienceData['end_year'],
            ]
        );
    }

    return redirect()->route('newsfeed')->with('success', 'Resume updated successfully.');
}
}



