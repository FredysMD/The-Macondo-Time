<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    public function create()
    {
        //
        return view('admin.users.create');
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
        $newUser->password = request('password');
        
        $newUser->save();

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

        return view('admin.users.edit', ['user' => $user]);
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
        //
        $this->validator($request);


        $updateUser = User::findOrFail($user->id);

        $updateUser->name     = request('name');
        $updateUser->email    = request('email');

        if(request('password')){
            $updateUser->password = Hash::make(request('password'));
        }

        $updateUser->save();

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
