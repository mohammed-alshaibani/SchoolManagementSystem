<?php

namespace App\Http\Controllers;

use App\Models\SiteFooterSetting;
use Illuminate\Http\Request;
use App\Models\AboutPage;
class SiteFooterSettingController extends Controller
{
    public function index()
    {
        $footersetting = SiteFooterSetting::first();
        return view('frontend.layouts.footer',compact('footersetting'));
    }
}
