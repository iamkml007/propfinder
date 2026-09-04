<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Inquiry;
class InquiryController extends Controller
{
    public function store(Request $request, Property $property){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:1000|min:10',
        ]);

        $inquiry = new Inquiry();
        $inquiry->property_id = $property->id;
        $inquiry->user_id = auth()->id();
        $inquiry->message = $request->message;
        $inquiry->status = 'new';

        if (auth()->check()) {
            $inquiry->name = auth()->user()->name;
            $inquiry->email = auth()->user()->email;
            $inquiry->phone = auth()->user()->phone;
        } else {
            $inquiry->name = $request->name;
            $inquiry->email = $request->email;
            $inquiry->phone = $request->phone;
        }
        $inquiry->save();
        return redirect()->back()->with('success', 'Your inquiry has been submitted successfully.');
    }
    public function index()
    {
        $inquiries = Inquiry::with('property')->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.inquiries.index', compact('inquiries'));
    }
    public function show($id)
    {
        $inquiry = Inquiry::with('property')->findOrFail($id);
        return view('admin.inquiries.show', compact('inquiry'));
    }
    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'status' => 'required|in:new,read,replied',
        ]);

        $inquiry->status = $request->status;
        $inquiry->save();

        return back()->with('success', '✅ Status updated to ' . ucfirst($request->status) . '!');
    }
    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Inquiry deleted successfully!');
    }

}
