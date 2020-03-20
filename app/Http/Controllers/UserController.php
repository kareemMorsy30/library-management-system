<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['username' => [
            'required','regex:/^[a-zA-Z_]+$/u','unique:users,username,NULL,id,deleted_at,NULL'],
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'confirmed'
            ],
            'email' => [
                'required',
                'email:filter',
                'unique:users,email,NULL,id,deleted_at,NULL'
            ],
            'privilege' =>[
                Rule::in(['user'])
            ],
            'phone' => [
                'required',
                'starts_with:012,010,011',
                'digits:11',
                'size:11',
                'unique:users,phone,NULL,id,deleted_at,NULL'
            ]
        ]);
        $user = new User;
        $request->merge(['password' => Hash::make(request()->all()['password'])]);
        $request->merge(['privilege' => 'user']);
        $user->create(request()->all());
        return view('Login.login');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        /*//
        User::updateOrCreate(['id'=>$user->id],request()->all());
        return redirect()->route('all_users', ['users' => User::all()]);*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        /*$user->delete();
        return redirect()->route('all_users', ['users' => User::all()]);*/
    }
}
