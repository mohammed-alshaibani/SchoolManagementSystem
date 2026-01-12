<?php

namespace App\Http\Controllers;
use App\Models\AboutPage as AboutPage;
use Illuminate\Http\Request;
use App\Models\PageSetting;
use Illuminate\Contracts\View\View;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = AboutPage::latest()->first();
        // $about = About::latest()->first();
        return view('frontend.pages.about', compact('about'));
    }

    // public function __invoke(Request $request)
    // {
    //     // why: only show a published record, newest wins
    //     $page = AboutPage::query()
    //         ->where('published', true)
    //         ->latest('updated_at')
    //         ->firstOrFail();


    //     return view('frontend.pages.about', [
    //         'page' => $page,
    //     ]);
    // }



    public function __invoke(Request $request): View
    {
        $page = AboutPage::query()
            ->where('published', true)
            ->latest('updated_at')
            ->firstOrFail();


        $about = PageSetting::first(); // may be null if not created yet

        return view('frontend.pages.about', [
            'page' => $page,
            'about' => $about,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
