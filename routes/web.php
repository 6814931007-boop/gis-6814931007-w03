<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('gis');
})->name('home');

Route::get('/gis', function () {
    return view('gis');
})->name('gis');

Route::get('/bio', function () {
    return view('bio');
})->name('bio');

Route::get('/assignment', function () {
    return view('assignment');
})->name('assignment');

Route::get('/form', function () {
    return view('W03/form');
})->name('form');

Route::post('/form', function (Request $request) {
    $request->validate([
        'report_date' => ['nullable', 'date'],
        'attachments' => ['nullable', 'array'],
        'attachments.*' => ['in:activity_photos,other_evidence'],
        'student_name' => ['required', 'string', 'max:255'],
        'student_id' => ['required', 'string', 'max:50'],
        'faculty' => ['required', 'string', 'max:255'],
        'major' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'string', 'max:30'],
        'location' => ['required', 'string', 'max:255'],
        'activity_date' => ['required', 'date'],
        'start_time' => ['required', 'date_format:H:i'],
        'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
        'total_hours' => ['required', 'numeric', 'min:0', 'max:24'],
        'activity_description' => ['required', 'string', 'max:3000'],
        'photo_1' => ['nullable', 'image', 'max:5120'],
        'photo_2' => ['nullable', 'image', 'max:5120'],
        'supervisor_name' => ['required', 'string', 'max:255'],
        'supervisor_position' => ['required', 'string', 'max:255'],
    ]);

    return to_route('form')->with('status', 'ส่งรายงานเรียบร้อยแล้ว');
})->name('form.submit');
