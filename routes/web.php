<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\PublicSearchStudent;


// Route::get('/', function () {
//     return redirect()->route('filament.admin.auth.login');
// });

Route::get('/', function () {
    return redirect('/search-student');
});
Route::get('/search-student', PublicSearchStudent::class)->name('public.search-student');


// Route::get('/search-student', action: PublicSearchStudent::class)->name('public.search-student');

