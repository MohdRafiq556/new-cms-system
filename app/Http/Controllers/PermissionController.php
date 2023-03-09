<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Permission;

use App\Http\Controllers\RoleController;

use Illuminate\Support\Str;

class PermissionController extends Controller
{
    //

    public function index() {
        return view('admin.permissions.index', [
            'permissions'=> Permission::all()
        ]);
    }

    public function store() {
        request()->validate([
            'name'=> ['required']
        ]);

        Permission::create([
            'name'=> Str::ucfirst(request('name')),
            'slug'=> Str::of(Str::lower(request('name')))->slug('-')
        ]);
        return back();
    }

    public function edit(Permission $permission) {
        return view('admin.permissions.edit', ['permission'=> $permission ]);
    }

    public function destroy(Permission $permission) {
        $permission->delete();
        session()->flash('permission-deleted', 'Permission Has Been Deleted ' . $permission->name);
        return back();
    }

    public function update(Permission $permission) {

        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(request('name'))->slug('-');

        if($permission->isDirty('name')) {
            session()->flash('permission-updated', 'Permission: '. request('name') . ' Has Been Updated');
            $permission->save();
        } else {
            session()->flash('permission-updated', 'Nothing Updated');
        }
        return back();
   }
}
