<?php

use App\Http\Livewire\Question\Create;
use App\Http\Livewire\Questionnaire\{Index, UpdateOrCreate};
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'questionnaire', 'as' => 'questionnaire.'], function () {
        Route::get('/', Index::class)->name('index');
        Route::get('create/{questionnaire?}', UpdateOrCreate::class)->name('create');
    });

    Route::group(['prefix' => 'question', 'as' => 'question.'], function () {
        Route::get('create/{questionnaire}', Create::class)->name('create');
    });

});
