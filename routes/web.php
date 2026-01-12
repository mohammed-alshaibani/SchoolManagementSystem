<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StaffMemberController;
use App\Http\Controllers\GalleryAlbumController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SinglePostController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;



Route::middleware(['auth'])->group(function(){
// Route::resource('pages', PageController::class)->middleware('permission:pages.view');
// Route::resource('news', NewsController::class)->middleware('permission:news.view');
// Route::resource('events', EventController::class)->middleware('permission:events.view');
// Route::resource('departments', DepartmentController::class)->middleware('permission:staff.view');
// Route::resource('staff-members', StaffMemberController::class)->middleware('permission:staff.view');
// Route::resource('albums', GalleryAlbumController::class)->middleware('permission:albums.view');
// Route::resource('photos', PhotoController::class)->only(['store','update','destroy'])->middleware('permission:photos.manage');
// Route::resource('contact-messages', ContactMessageController::class)->only(['index','show','destroy'])->middleware('permission:contact.view');
});

Route::get('/',[PageController::class,"index"])->name('home');

Route::get('/index', function () {
    return view('frontend.pages.index');
})->name('index');

Route::get('/news', function () {
    return view('frontend.pages.news');
})->name('news');

Route::get('/appointment', function () {
    return view('frontend.pages.appointment');
})->name('appointment');

Route::get('/call-to-action', function () {
    return view('frontend.pages.call-to-action');
})->name('call-to-action');

Route::get('/classes', function () {
    return view('frontend.pages.classes');
})->name('classes');

Route::get('/contact', function () {
    return view('frontend.pages.contact');
})->name('contact');

Route::get('/single-post/{id}', [SinglePostController::class,"index"])->name('single-post');

Route::get('/facility',[FacilitiesController::class,"index"])->name('facility');
// Route::get('/about',[AboutController::class,"index"])->name('about');


Route::get('/about', AboutController::class)->name('about');


// Route::get('/about', function () {
//     return view('frontend.pages.about');
// })->name('about');

Route::get('/class-details', function () {
    return view('frontend.pages.class-details');
})->name('class-details');

route::get('/gallery', function () {
    return view('frontend.pages.gallery');
})->name('gallery');

Route::get('/gallery-details', function () {
    return view('frontend.pages.gallery-details');
})->name('gallery-details');


Route::get('/team', function () {
    return view('frontend.pages.team');
})->name('team');

Route::get('/testimonial', function () {
    return view('frontend.pages.testimonial');
})->name('testimonial');

// Add these additional routes for the dropdown pages
Route::get('/404', function () {
    return view('p404');
})->name('404');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])
->middleware('throttle:10,1') // anti-spam: 10 submissions/min/IP
->name('contact.store');

// Route::get('/locale/{lang}', function (string $lang) {
//     abort_unless(in_array($lang, ['en','ar'], true), 404);

//     session(['locale' => $lang]);
//     session(['dir' => $lang === 'ar' ? 'rtl' : 'ltr']); // optional

//     return back();
// })->name('locale.switch');

// Route::get('/locale/{lang}', function (string $lang) {
//     abort_unless(in_array($lang, ['en', 'ar'], true), 404);

//     session(['locale' => $lang]);
//     session(['dir' => $lang === 'ar' ? 'rtl' : 'ltr']); // optional

//     return back();
// })->name('locale.switch');

// Route::get('/locale/{lang}', function (string $lang) {
//     abort_unless(in_array($lang, ['en','ar'], true), 404);
//     session(['locale' => $lang]);
//     session(['dir' => $lang === 'ar' ? 'rtl' : 'ltr']);   // optional
//     return back();
// })->name('locale.switch');

Route::get('/locale/{lang}', function (string $lang) {
    abort_unless(in_array($lang, ['en','ar'], true), 404);

    session(['locale' => $lang]);
    session(['dir' => $lang === 'ar' ? 'rtl' : 'ltr']); // optional

    return back();
})->name('locale.switch');