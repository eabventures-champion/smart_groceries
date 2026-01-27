<?php

namespace App\Http\Controllers\Back;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    public function all_permission(){

        $permissions = Permission::all();
        return view('back.admin.access.permission.all_permission', compact('permissions'));
    } 

    public function add_permission(){
        return view('back.admin.access.permission.add_permission');
    }

    public function store_permission(Request $request){
        $role = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification); 
    }

    public function edit_permission($id){

        $permission = Permission::findOrFail($id);
        return view('back.admin.access.permission.edit_permission', compact('permission'));
 
    }// End Method 
 
    public function update_permission(Request $request){
          $permission_id = $request->id;
          Permission::findOrFail($permission_id)->update([
             'name' => $request->name,
             'group_name' => $request->group_name,
 
         ]);
 
         $notification = array(
             'message' => 'Permission Updated Successfully',
             'alert-type' => 'success'
         );
 
         return redirect()->route('all.permission')->with($notification); 
     }
 
 
    public function delete_permission($id){
          Permission::findOrFail($id)->delete();
          $notification = array(
             'message' => 'Permission Deleted Successfully',
             'alert-type' => 'success'
         );
         return redirect()->back()->with($notification); 
    }


    ///////////////////// All Roles ////////////////////
    public function all_roles(){
        $roles = Role::all();
        return view('back.admin.access.roles.all_roles', compact('roles'));

    } // End Method 

    public function add_roles(){
        return view('back.admin.access.roles.add_roles');
    }// End Method 


    public function store_roles(Request $request){
        $role = Role::create([
            'name' => $request->name, 
        ]);

        $notification = array(
            'message' => 'Roles Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification); 
    } 
    
    public function edit_roles($id){
        $roles = Role::findOrFail($id);
        return view('back.admin.access.roles.edit_roles', compact('roles'));
    }// End Method 

    public function update_roles(Request $request){
        $role_id = $request->id; 
        Role::findOrFail($role_id)->update([
            'name' => $request->name, 
        ]);

        $notification = array(
            'message' => 'Roles Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification); 
    }

    public function delete_roles($id){
        Role::findOrFail($id)->delete();
          $notification = array(
               'message' => 'Roles Deleted Successfully',
               'alert-type' => 'success'
           );
        return redirect()->back()->with($notification); 
    }



    // Roles and Permission
    public function add_roles_permission(){
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('back.admin.access.role_permissions.add_roles_permission', compact('roles', 'permissions', 'permission_groups'));
    }

    public function role_permisssion_store(Request $request){
        $data = array();
        $permissions = $request->permission;

        foreach($permissions as $key => $item){
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

         $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification); 
    }

    public function all_roles_permission(){
        $roles = Role::all();
        return view('back.admin.access.role_permissions.all_roles_permission', compact('roles'));
    }

    public function admin_roles_edit($id){

        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('back.admin.access.role_permissions.role_permission_edit', compact('role', 'permissions', 'permission_groups'));
    }

    public function admin_roles_update(Request $request, $id){
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
           $role->syncPermissions($permissions);
        }
        $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification); 
    }

    public function admin_roles_delete($id){

        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }

         $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
