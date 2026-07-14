<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function admin_complaints()
    {
        $complaints = Complaint::with('user')->orderBy('id', 'DESC')->get();
        return view('back.admin.complaints.index', compact('complaints'));
    }

    public function respond_complaint(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:complaints,id',
            'status' => 'required|in:pending,reviewed,resolved',
            'admin_reply' => 'nullable|string',
        ]);

        $complaint = Complaint::findOrFail($request->id);
        $complaint->update([
            'status' => $request->status,
            'admin_reply' => $request->admin_reply,
        ]);

        $notification = [
            'message' => 'Response updated successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function delete_complaint($id)
    {
        Complaint::findOrFail($id)->delete();

        $notification = [
            'message' => 'Complaint/Suggestion deleted successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
