<?php

namespace App\Http\Controllers\Back;

use App\Models\RecognitionTier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecognitionTierController extends Controller
{
    public function all_tiers()
    {
        if (!\Illuminate\Support\Facades\Schema::hasTable('recognition_tiers')) {
            $tiers = collect([]);
            $migration_missing = true;
            return view('back.admin.setting.recognition_tiers', compact('tiers', 'migration_missing'));
        }
        $tiers = RecognitionTier::orderBy('min_spent', 'desc')->get();
        return view('back.admin.setting.recognition_tiers', compact('tiers'));
    }

    public function store_tier(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'min_spent' => 'required|numeric|min:0',
            'discount_percent' => 'required|numeric|min:0|max:100',
            'badge_style' => 'required|string|max:50',
        ]);

        RecognitionTier::create([
            'name' => $request->name,
            'min_spent' => $request->min_spent,
            'discount_percent' => $request->discount_percent,
            'badge_style' => $request->badge_style,
        ]);

        $notification = [
            'message' => 'Recognition Tier Created Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function edit_tier($id)
    {
        $tier = RecognitionTier::findOrFail($id);
        return response()->json($tier);
    }

    public function update_tier(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'name' => 'required|string|max:255',
            'min_spent' => 'required|numeric|min:0',
            'discount_percent' => 'required|numeric|min:0|max:100',
            'badge_style' => 'required|string|max:50',
        ]);

        RecognitionTier::findOrFail($id)->update([
            'name' => $request->name,
            'min_spent' => $request->min_spent,
            'discount_percent' => $request->discount_percent,
            'badge_style' => $request->badge_style,
        ]);

        $notification = [
            'message' => 'Recognition Tier Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function delete_tier($id)
    {
        RecognitionTier::findOrFail($id)->delete();

        $notification = [
            'message' => 'Recognition Tier Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
