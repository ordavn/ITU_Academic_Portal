<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacilityController;

Route::apiResource('facilities', FacilityController::class);