<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\CandidateLogin;
use App\Livewire\CandidateWelcome;
use App\Livewire\CandidateExam;
use App\Livewire\CandidateFinish;

Route::redirect('/', '/candidate/login');


Route::get('/candidate/login', CandidateLogin::class)->name('candidate.login');
Route::get('/candidate/welcome', CandidateWelcome::class)->name('candidate.welcome');
Route::get('/candidate/exam', CandidateExam::class)->name('candidate.exam');
Route::get('/candidate/finish', CandidateFinish::class)->name('candidate.finish');
