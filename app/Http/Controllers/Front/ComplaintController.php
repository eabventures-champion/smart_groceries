<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function user_complaints()
    {
        $id = Auth::user()->id;
        $complaints = Complaint::where('user_id', $id)->orderBy('id', 'DESC')->get();
        return view('front.user.complaints', compact('complaints'));
    }

    public function store_complaint(Request $request)
    {
        $request->validate([
            'type' => 'required|in:complaint,suggestion',
            'subject' => 'required|string|max:255',
            'comment' => 'required|string',
        ]);

        Complaint::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'subject' => $request->subject,
            'comment' => $request->comment,
            'status' => 'pending',
        ]);

        $notification = [
            'message' => 'Your request has been sent successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
