<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
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
        $users = User::all();

        return view('admin.users.index',['users' => $users]);
    }

    /**
     * validator: validate the fields in form.
     *
     * @param  $options -> options for validate.
     * @return ->  nothing.
    */
    public function validator($user)
    {
        $data = request()->validate(['email' => 'required|email|unique:users,email,'.$user->id,]);
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if($request->ajax()){
            
            $role = Role::where('id', $request->role_id)->first();

            $permissions = $role->permissions;

            return $permissions;

        }

        $roles = Role::all();

        return view('admin.users.create',['roles' => $roles]);
    }

    public function storeUserAndRole($user, $request)
    {
        if($request->role != null){
            $user->roles()->attach($request->role);
            $user->save();
        }
        
    }

    public function storeUserAndPermission($user, $request)
    {

        if($request->permissions != null ){
            foreach($request->permissions as $permission){
                $user->permissions()->attach($request->permissions);
                $user->save();
            }
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
        $this->validator($request);

        $newUser = new User();

        $newUser->name     = request('name');
        $newUser->email    = request('email');
        $newUser->password = Hash::make(request('password'));
        $newUser->save();

        $this->storeUserAndRole($newUser, $request);
        $this->storeUserAndPermission($newUser, $request);

        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $userid = User::find($id);

        return view('admin.users.show', ['user' => $userid]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $user = User::find($user->id);
        $roles = Role::all();
        $userRole = $user->roles->first();

        if($userRole != null){
           $rolePermissions = $userRole->permissions;
        }else{
           $rolePermissions = null;
        }   
        $userPermissions = $user->permissions;

        return view('admin.users.edit', [
                    'user' => $user,
                    'userRole' => $userRole,
                    'roles' => $roles,
                    'rolePermissions' => $rolePermissions,
                    'userPermissions' => $userPermissions
                   ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //$this->validator($request);


        $updateUser = User::findOrFail($user->id);

        $updateUser->name     = request('name');
        $updateUser->email    = request('email');

        if(request('password') != null){
            $updateUser->password = Hash::make(request('password'));
        }

        $updateUser->save();

        $updateUser->roles()->detach();
        $updateUser->permissions()->detach();

        $this->storeUserAndRole($updateUser, $request);
        $this->storeUserAndPermission($updateUser, $request);

        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $user = User::find($request->userId);

        $user->delete();

        return redirect('users');
    }
}
