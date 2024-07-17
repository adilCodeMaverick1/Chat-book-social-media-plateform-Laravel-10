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
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:255',
        'summary' => 'required|string',
        'educations' => 'required|array',
        'educations.*.id' => 'required',
        'educations.*.degree' => 'required|string|max:255',
        'educations.*.institution' => 'required|string|max:255',
        'educations.*.year' => 'required|string|max:255',
        'educations.*.description' => 'required|string',
        'experiences' => 'required|array',
        'experiences.*.id' => 'required',
        'experiences.*.title' => 'required|string|max:255',
        'experiences.*.company' => 'required|string|max:255',
        'experiences.*.duration' => 'required|string|max:255',
        'experiences.*.description' => 'required|string',
    ]);

    // Update user information
    $user->update($validatedData);
    //dd($validatedData);

    // Update or create educations
    foreach ($validatedData['educations'] as $educationData) {
        $educationId = $educationData['id'] ?? null;
        //dd($educationId);
        if ($educationId) {
            $user->educations()->where('id', $educationId)->update($educationData);
        } else {
            $user->educations()->create($educationData);
        }
    }

    // Update or create experiences
    foreach ($validatedData['experiences'] as $experienceData) {
        $experienceId = $experienceData['id'] ?? null;
        //dd($experienceId);
        if ($experienceId) {
            $user->experiences()->where('id', $experienceId)->update($experienceData);
        } else {
            $user->experiences()->create($experienceData);
        }
    }

    return redirect()->route('newsfeed');
}


}



