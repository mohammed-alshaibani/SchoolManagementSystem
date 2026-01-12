<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactUsStoreRequest;
use App\Models\ContactUs;
use App\Models\SiteFooterSetting;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function show(Request $request): View
    {
        $footer = SiteFooterSetting::first(); // for address/email/phone in the header cards
        return view('frontend.pages.contact', [
            'footer' => $footer,
        ]);
    }


    public function store(ContactUsStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();


        ContactUs::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'subject' => $data['subject'],
            'message' => $data['message'],
            'status' => 'new',
            'is_read' => false,
        ]);


        return back()->with('status', 'Thanks! Your message has been sent.');
    }
}
