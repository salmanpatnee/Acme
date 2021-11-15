<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\User;
use App\Notifications\NewInquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth')->except('store');
    }

    public function index()
    {
        $inquiries = Inquiry::latest()->get();
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(Inquiry $inquiry)
    {
        if (!$inquiry->read_at) {
            $inquiry->update(['read_at' => \Carbon\Carbon::now()->toDateTimeString()]);
        }

        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function store()
    {
        $inquiry = Inquiry::create($this->validateAttributes());

        User::find(1)->notify(new NewInquiry($inquiry));

        return back()->with('message', 'Email has been sent.');
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return redirect(route('inquiries.index'))->with('message', 'Inquiry deleted.');
    }

    protected function validateAttributes()
    {
        return request()->validate(
            [
                'name'    => 'required|string|min:3|max:100',
                'email'   => 'required|email',
                'subject' => 'nullable|string|min:3|max:100',
                'message' => 'required|string|min:3',
            ]
        );
    }
}
