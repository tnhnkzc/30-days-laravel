<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

// Index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

// Create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});


// Store
Route::post('/jobs', function () {
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
});

// Show
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

// Edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
    // validation
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    // Authorize (On hold)

    // Update the job
    $job = Job::findOrFail($id);
    $job->title = request('title');
    $job->salary = request('salary');
    $job->save();

    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);

    // redirect (job specific)
    return redirect('/jobs/' . $job->id);
});

// Destroy
Route::delete('/jobs/{id}', function ($id) {

    // Authorize (On hold)


    // Delete 
    Job::findOrFail($id)->delete();

    // redirect 
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
