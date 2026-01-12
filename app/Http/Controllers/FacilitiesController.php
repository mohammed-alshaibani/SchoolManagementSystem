<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
class FacilitiesController extends Controller
{
    //
    public function index()
    {
        // Fetch the post by its ID from the database
        $facilities = Facility::latest()->get();
        
        // Return the view with the post data
        return view('frontend.pages.facility',compact('facilities'));
    }
}
