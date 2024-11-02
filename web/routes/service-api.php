<?php

use Illuminate\Support\Facades\Route;
use App\Services\IdentifierService;

Route::group(['prefix' => 'service'], function () {
    Route::group(['prefix' => '{identifier}', 'whereIn' => ['identifier' => ['ztna']]], function () {
        Route::get('/show', function (IdentifierService $identifierService) {
             return $identifierService->getName();
        });
    });
    Route::group(['prefix' => 'kasm'], function () {
        Route::get('/show', function (IdentifierService $identifierService) {
            return $identifierService->getName();
        });
    });
});
