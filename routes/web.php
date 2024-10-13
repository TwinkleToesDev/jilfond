<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('welcome'); // Замените 'welcome' на ваше основное представление, если оно отличается
})->where('any', '.*');
