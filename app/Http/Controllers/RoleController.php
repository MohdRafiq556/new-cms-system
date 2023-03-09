<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

use App\Http\Controllers\PermissionController;

use Illuminate\Support\Str;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    //

    public function index() {
        return view('admin.roles.index', [
            'roles'=> Role::all()
        ]);
    }

    public function edit(Role $role) {
        return view('admin.roles.edit', [
            'role'=>$role,
            'permissions'=> Permission::all()
            ]);
    }

    public function store(Request $request) {

        request()->validate([
            'name'=> ['required']
        ]);

        Role::create([
            'name'=> Str::ucfirst(request('name')),
            'slug'=> Str::of(Str::lower(request('name')))->slug('-')
        ]);
        return back();
    }

    public function attach_permission(Role $role) {
        $role->permissions()->attach(request('permission'));
        return back();
    }

    public function detach_permission(Role $role) {
        $role->permissions()->detach(request('permission'));
        return back();
    }

    public function destroy(Role $role) {
        $role->delete();
        session()->flash('role-deleted', 'Roles Has Been Deleted ' . $role->name);
        return back();
    }

   public function update(Role $role) {

        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(request('name'))->slug('-');

        if($role->isDirty('name')) {
            session()->flash('role-updated', 'Role: '. request('name') . ' Has Been Updated');
            $role->save();
        } else {
            session()->flash('role-updated', 'Nothing Updated');
        }
        return back();
   }

   
}
