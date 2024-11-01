<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Show all jobs
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    // Create a job form page
    public function create()
    {
        return view('jobs.create');
    }

    // Show individual job
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    // Create a job and save
    public function store()
    {
        // validation
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);
        return redirect('/jobs');
    }

    // Edit a job form page
    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    // Update a job
    public function update(Job $job)
    {
        // Authorize (On hold)

        // validation
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);


        // Update the job
        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);

        // redirect (job specific)
        return redirect('/jobs/' . $job->id);
    }

    // Delete a job
    public function destroy(Job $job)
    {
        // Authorize (On hold)

        // Delete 
        $job->delete();

        // redirect 
        return redirect('/jobs');
    }
}
