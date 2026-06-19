<?php

namespace App\Http\Controllers\Back;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function dashboard(){
        return view('back.admin.index');
    }

    public function login(){
        return view('back.admin.login');
    }

    public function mark_as_read(Request $request, $notificationId){

        $user = Auth::user();
        $notification = $user->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }
        return response()->json(['count' => $user->unreadNotifications()->count()]);
    }

    public function mark_all_as_read(Request $request){

        $user = Auth::user();
        $notification = $user->unreadNotifications->markAsRead();;

        if ($notification) {
            $notification->markAsRead();
        }
        return response()->json(['count' => $user->unreadNotifications()->count()]);
    }

    public function delete_all_notifications(){
        $user = Auth::user();
        $user->notifications()->delete();

        $notification = array(
            'message' => 'All notifications cleared successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function admin_profile(){
        $id = Auth::user()->id;
        $profile = User::find($id);

        return view('back.admin.profile', compact('profile'));
    }

    public function admin_profile_update(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('back/assets/images/admin/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('back/assets/images/admin'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function admin_change_password(){
        $id = Auth::user()->id;
        $profile = User::find($id);

        return view('back.admin.change_password', compact('profile'));
    }

    public function admin_update_password(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if(!Hash::check($request->old_password, auth::user()->password)){
            $notification = array(
                'message' => 'Old Password does not match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password changed successfully',
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }

    

    public function all_admin(){
        $alladminuser = User::whereIn('role', ['admin', 'expert'])->latest()->get();
        return view('back.admin.admin.all_admin', compact('alladminuser'));
    }

    public function add_admin(){
        $roles = Role::all();
        return view('back.admin.admin.add_admin', compact('roles'));
    }

    public function admin_user_store(Request $request){
        $user = new User;
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        if ($request->roles === 'expert') {
            $user->role = 'expert';
        } else {
            $user->role = 'admin';
        }
        $user->status = 'active';
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

         $notification = array(
            'message' => 'New Admin User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    }

    public function edit_admin_role($id){

        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('back.admin.admin.edit_admin', compact('user', 'roles'));
    }


    public function admin_user_update(Request $request, $id){
        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address; 
        if ($request->roles === 'expert') {
            $user->role = 'expert';
        } else {
            $user->role = 'admin';
        }
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

         $notification = array(
            'message' => 'New Admin User Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.admin')->with($notification);

    }

    public function delete_admin_role($id){

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

         $notification = array(
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}
