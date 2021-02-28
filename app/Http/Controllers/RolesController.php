<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RolesController extends Controller
{   

    /**
     * Create a new controller instance.
     *
     * @return void
    */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::all();

        return view('admin.roles.index', ['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.roles.create');
    }

    public function addPermissionsRoles($request, $role)
    {
        $permissions = explode(',', $request->roles_permission);//


        foreach($permissions as $permission){
            
            $newPermission = new Permission();
            $newPermission->name = $permission;
            $newPermission->slug = strtolower(str_replace(" ","-",$permission));
            
            $newPermission->save();
            $role->permissions()->attach($newPermission->id);
            $role->save();

        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
        $newRole = new Role();

        $newRole->name = request('name');
        $newRole->slug = request('slug');
        $newRole->save();

        $this->addPermissionsRoles($request,$newRole);
       
        return redirect('roles');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $roleid  = Role::find($id);

        return view('admin.roles.show', ['role'=>$roleid]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        $role = Role::find($role->id);

        return view('admin.roles.edit', ['role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
        $role->name = request('name');
        $role->slug = request('slug');
        $role->save();

        $role->permissions()->delete();
        $role->permissions()->detach();

        $this->addPermissionsRoles($request,$role);

        return redirect('roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        

        $role->permissions()->delete();
        $role->delete();
        $role->permissions()->detach();

        return redirect('/roles');

    }
}
