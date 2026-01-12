<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\NewsResource;
use App\Models\News;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('news', function(){
return NewsResource::collection(News::with('categories')->latest()->paginate());
})->middleware('auth:sanctum');