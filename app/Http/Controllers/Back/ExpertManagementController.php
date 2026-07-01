<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\ExpertCategory;
use App\Models\Expert;
use App\Models\HealthTip;
use App\Models\ExpertBooking;
use App\Models\ItemRequest;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Image;
use Illuminate\Http\Request;

class ExpertManagementController extends Controller
{
    // ==================== EXPERT CATEGORIES CRUD ====================

    public function categoriesList()
    {
        $categories = ExpertCategory::withCount('experts')->get();
        return view('back.admin.lifestyle.categories.index', compact('categories'));
    }

    public function categoryAdd()
    {
        return view('back.admin.lifestyle.categories.add');
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:expert_categories,code',
            'badge_style' => 'required|string|max:50',
            'icon' => 'nullable|string|max:50',
        ]);

        ExpertCategory::create($request->all());

        $notification = [
            'message' => 'Expert Category created successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.lifestyle.categories')->with($notification);
    }

    public function categoryEdit($id)
    {
        $category = ExpertCategory::findOrFail($id);
        return view('back.admin.lifestyle.categories.edit', compact('category'));
    }

    public function categoryUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:expert_categories,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:expert_categories,code,' . $request->id,
            'badge_style' => 'required|string|max:50',
            'icon' => 'nullable|string|max:50',
        ]);

        $category = ExpertCategory::findOrFail($request->id);
        $category->update($request->all());

        $notification = [
            'message' => 'Expert Category updated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.lifestyle.categories')->with($notification);
    }

    public function categoryDelete($id)
    {
        $category = ExpertCategory::findOrFail($id);
        $category->delete();

        $notification = [
            'message' => 'Expert Category deleted successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // ==================== EXPERT PROFILES CRUD ====================

    public function expertsList()
    {
        $experts = Expert::with('category')->get();
        return view('back.admin.lifestyle.experts.index', compact('experts'));
    }

    public function expertAdd()
    {
        $categories = ExpertCategory::all();
        return view('back.admin.lifestyle.experts.add', compact('categories'));
    }

    public function expertStore(Request $request)
    {
        $request->validate([
            'expert_category_id' => 'required|exists:expert_categories,id',
            'name' => 'required|string|max:255',
            'initials' => 'nullable|string|max:10',
            'specialty_description' => 'required|string',
            'available_days' => 'required|array|min:1',
            'available_days.*' => 'required|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'whatsapp_number' => 'required|string|max:50',
            'whatsapp_message' => 'nullable|string',
            'avatar_bg_color' => 'required|string|max:15',
            'avatar_text_color' => 'required|string|max:15',
        ]);

        $data = $request->all();
        if (empty($data['initials'])) {
            $words = explode(' ', $data['name']);
            $initials = '';
            foreach ($words as $w) {
                $initials .= strtoupper(substr($w, 0, 1));
            }
            $data['initials'] = substr($initials, 0, 3);
        }

        $data['availability_schedule'] = json_encode([
            'days' => $request->available_days,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        Expert::create($data);

        $notification = [
            'message' => 'Expert Profile created successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.lifestyle.experts')->with($notification);
    }

    public function expertEdit($id)
    {
        $expert = Expert::findOrFail($id);
        $categories = ExpertCategory::all();
        return view('back.admin.lifestyle.experts.edit', compact('expert', 'categories'));
    }

    public function expertUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:experts,id',
            'expert_category_id' => 'required|exists:expert_categories,id',
            'name' => 'required|string|max:255',
            'initials' => 'nullable|string|max:10',
            'specialty_description' => 'required|string',
            'available_days' => 'required|array|min:1',
            'available_days.*' => 'required|string|in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'whatsapp_number' => 'required|string|max:50',
            'whatsapp_message' => 'nullable|string',
            'avatar_bg_color' => 'required|string|max:15',
            'avatar_text_color' => 'required|string|max:15',
            'is_active' => 'required|boolean',
        ]);

        $expert = Expert::findOrFail($request->id);
        $data = $request->all();
        if (empty($data['initials'])) {
            $words = explode(' ', $data['name']);
            $initials = '';
            foreach ($words as $w) {
                $initials .= strtoupper(substr($w, 0, 1));
            }
            $data['initials'] = substr($initials, 0, 3);
        }

        $data['availability_schedule'] = json_encode([
            'days' => $request->available_days,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        $expert->update($data);

        $notification = [
            'message' => 'Expert Profile updated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.lifestyle.experts')->with($notification);
    }

    public function expertDelete($id)
    {
        $expert = Expert::findOrFail($id);
        $expert->delete();

        $notification = [
            'message' => 'Expert Profile deleted successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function expertInactive($id)
    {
        Expert::findOrFail($id)->update(['is_active' => false]);

        $notification = [
            'message' => 'Expert Hidden successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function expertActive($id)
    {
        Expert::findOrFail($id)->update(['is_active' => true]);

        $notification = [
            'message' => 'Expert Activated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // ==================== EDUCATIONAL HEALTH TIPS CRUD ====================

    public function tipsList()
    {
        $tips = HealthTip::all();
        return view('back.admin.lifestyle.tips.index', compact('tips'));
    }

    public function tipAdd()
    {
        return view('back.admin.lifestyle.tips.add');
    }

    public function tipStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'type_slug' => 'required|string|max:50|unique:health_tips,type_slug',
        ]);

        HealthTip::create($request->all());

        $notification = [
            'message' => 'Health Tip created successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.lifestyle.tips')->with($notification);
    }

    public function tipEdit($id)
    {
        $tip = HealthTip::findOrFail($id);
        return view('back.admin.lifestyle.tips.edit', compact('tip'));
    }

    public function tipUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:health_tips,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'type_slug' => 'required|string|max:50|unique:health_tips,type_slug,' . $request->id,
        ]);

        $tip = HealthTip::findOrFail($request->id);
        $tip->update($request->all());

        $notification = [
            'message' => 'Health Tip updated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.lifestyle.tips')->with($notification);
    }

    public function tipDelete($id)
    {
        $tip = HealthTip::findOrFail($id);
        $tip->delete();

        $notification = [
            'message' => 'Health Tip deleted successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // ==================== BOOKINGS LIST & STATUS ====================

    public function bookingsList()
    {
        $bookings = ExpertBooking::latest()->get();
        return view('back.admin.lifestyle.bookings.index', compact('bookings'));
    }

    public function bookingUpdateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:expert_bookings,id',
            'status' => 'required|in:pending,confirmed,completed',
            'expert_feedback' => 'nullable|string|max:1000',
        ]);

        $booking = ExpertBooking::findOrFail($request->id);
        $booking->update([
            'status' => $request->status,
            'expert_feedback' => $request->expert_feedback
        ]);

        $notification = [
            'message' => 'Booking status updated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // ==================== CUSTOM PRODUCT REQUESTS ====================

    public function itemRequestsList()
    {
        $requests = ItemRequest::latest()->get();
        return view('back.admin.lifestyle.requests.index', compact('requests'));
    }

    public function itemRequestRespond(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:item_requests,id',
            'status' => 'required|in:submitted,under_review,sourced,unavailable',
            'admin_response' => 'nullable|string',
        ]);

        $itemRequest = ItemRequest::findOrFail($request->id);
        $itemRequest->update([
            'status' => $request->status,
            'admin_response' => $request->admin_response,
        ]);

        $notification = [
            'message' => 'Item request updated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // ==================== BLOG POSTS CRUD ====================

    public function blogsList()
    {
        $blogs = BlogPost::latest()->get();
        return view('back.admin.lifestyle.blogs.index', compact('blogs'));
    }

    public function blogAdd()
    {
        $categories = BlogCategory::all();
        return view('back.admin.lifestyle.blogs.add', compact('categories'));
    }

    public function blogStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $slug = \Illuminate\Support\Str::slug($request->title);
        $original_slug = $slug;
        $count = 1;
        while (BlogPost::where('slug', $slug)->exists()) {
            $slug = $original_slug . '-' . $count;
            $count++;
        }

        $save_url = null;
        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 600)->save('back/assets/images/blog/'.$name_gen);
            $save_url = 'back/assets/images/blog/'.$name_gen;
        }

        BlogPost::create([
            'title' => $request->title,
            'slug' => $slug,
            'category' => $request->category,
            'author' => $request->author,
            'content' => $request->content,
            'image' => $save_url,
        ]);

        $notification = [
            'message' => 'Blog Post created successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.lifestyle.blogs')->with($notification);
    }

    public function blogEdit($id)
    {
        $blog = BlogPost::findOrFail($id);
        $categories = BlogCategory::all();
        return view('back.admin.lifestyle.blogs.edit', compact('blog', 'categories'));
    }

    public function blogUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:blog_posts,id',
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $blog = BlogPost::findOrFail($request->id);
        
        $slug = \Illuminate\Support\Str::slug($request->title);
        $original_slug = $slug;
        $count = 1;
        while (BlogPost::where('slug', $slug)->where('id', '!=', $request->id)->exists()) {
            $slug = $original_slug . '-' . $count;
            $count++;
        }

        $save_url = $blog->image;
        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 600)->save('back/assets/images/blog/'.$name_gen);
            $save_url = 'back/assets/images/blog/'.$name_gen;

            // Delete old image if it exists
            if ($blog->image && file_exists($blog->image)) {
                @unlink($blog->image);
            }
        }

        $blog->update([
            'title' => $request->title,
            'slug' => $slug,
            'category' => $request->category,
            'author' => $request->author,
            'content' => $request->content,
            'image' => $save_url,
        ]);

        $notification = [
            'message' => 'Blog Post updated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.lifestyle.blogs')->with($notification);
    }

    public function blogDelete($id)
    {
        $blog = BlogPost::findOrFail($id);
        
        if ($blog->image && file_exists($blog->image)) {
            @unlink($blog->image);
        }

        $blog->delete();

        $notification = [
            'message' => 'Blog Post deleted successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // ==================== BLOG CATEGORIES CRUD ====================

    public function blogCategoriesList()
    {
        $categories = BlogCategory::latest()->get();
        return view('back.admin.lifestyle.blog_categories.index', compact('categories'));
    }

    public function blogCategoryAdd()
    {
        return view('back.admin.lifestyle.blog_categories.add');
    }

    public function blogCategoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $slug = \Illuminate\Support\Str::slug($request->name);
        $original_slug = $slug;
        $count = 1;
        while (BlogCategory::where('slug', $slug)->exists()) {
            $slug = $original_slug . '-' . $count;
            $count++;
        }

        BlogCategory::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        $notification = [
            'message' => 'Blog Category created successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.lifestyle.blog_categories')->with($notification);
    }

    public function blogCategoryEdit($id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('back.admin.lifestyle.blog_categories.edit', compact('category'));
    }

    public function blogCategoryUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:blog_categories,id',
            'name' => 'required|string|max:255',
        ]);

        $category = BlogCategory::findOrFail($request->id);
        $oldName = $category->name;

        $slug = \Illuminate\Support\Str::slug($request->name);
        $original_slug = $slug;
        $count = 1;
        while (BlogCategory::where('slug', $slug)->where('id', '!=', $request->id)->exists()) {
            $slug = $original_slug . '-' . $count;
            $count++;
        }

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        // Update blog posts that used the old category name
        if ($oldName !== $request->name) {
            BlogPost::where('category', $oldName)->update(['category' => $request->name]);
        }

        $notification = [
            'message' => 'Blog Category updated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.lifestyle.blog_categories')->with($notification);
    }

    public function blogCategoryDelete($id)
    {
        $category = BlogCategory::findOrFail($id);
        $category->delete();

        $notification = [
            'message' => 'Blog Category deleted successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
