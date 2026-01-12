<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\banner;
use App\Models\Post;
use App\Models\Facility;
use App\Models\SiteFooterSetting;
class PageController extends Controller
{
    //
    public function index()
    {
        $banners = banner::where('banner_type', 'homepage')->get();
        $News = Post::where('is_published', true)->orderBy('id', 'desc')->limit(3)->get();
        $facilities = Facility::latest()->take(4)->get();
        $footer = SiteFooterSetting::first();
        return view('frontend.pages.index',compact('banners','News','facilities','footer'));
    }

}
